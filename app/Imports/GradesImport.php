<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GradesImport implements ToCollection, WithHeadingRow
{
    /**
     * All related students in the database.
     *
     * @var \Illuminate\Support\Collection;
     */
    private $students;

    /**
     * All related courses in the database.
     *
     * @var \Illuminate\Support\Collection;
     */
    private $courses;

    /**
     * Assign the global variables that contain the related students and courses.
     * 
     * @param array $studentNumbers
     * @param array $courseCodes
     *
     * @return void
     */
    private function getRelatedData(array $studentNumbers, array $courseCodes)
    {
        $this->students = Student::select('id', 'student_number')->whereIn('student_number', $studentNumbers)->get();
        $this->courses  = Course::select('id', 'code')->whereIn('code', $courseCodes)->get();
    }

    /**
     * The entry point of the importer which calls all respective functions.
     *
     * @param \Illuminate\Support\Collection $rows
     *
     * @return void
     */
    public function collection(Collection $rows)
    {
        $this->validator($rows->toArray());

        $this->upsertRelationships($rows);

        $this->upsertGrades($rows);
    }

    /**
     * Validates the data supplied by the csv.
     *
     * @param array $data
     *
     * @return void
     */
    private function validator(array $data)
    {
        // Check all the data is valid
        Validator::make($data, [
            '*.student_number'     => ['required', 'numeric'],
            '*.firstname'          => ['required', 'string', 'min:2', 'max:50'],
            '*.surname'            => ['required', 'string', 'min:2', 'max:50'],
            '*.course_code'        => ['required', 'string', 'size:5'],
            '*.course_description' => ['required', 'string', 'min:5', 'max:50'],
            '*.grade'              => [Rule::in(Grade::availableLetters())],
        ])->validate();
    }

    /**
     * Create courses and students that don't exist and update the ones that do in a single query each.
     *
     * @param \Illuminate\Support\Collection $rows
     *
     * @return void
     */
    private function upsertRelationships(Collection $rows)
    {
        $collections = $this->buildCollections($rows);

        Student::upsert($collections['students']->toArray(), ['student_number'], ['first_name', 'surname']);
        Course::upsert($collections['courses']->toArray(), ['code'], ['description']);
    }

    /**
     * Create grades that don't exist and update the ones that do in a single query.
     *
     * @param \Illuminate\Support\Collection $rows
     *
     * @return void
     */
    private function upsertGrades(Collection $rows)
    {
        // Get all related students and courses
        $studentNumbers = $rows->pluck('student_number')->unique()->toArray();
        $courseCodes = $rows->pluck('course_code')->unique()->toArray();

        $this->getRelatedData($studentNumbers, $courseCodes);

        // Build a collection of grades for upserting
        $grades = collect();

        foreach ($rows as $row) {
            $grade = $this->buildGrade($row);

            if ($grade) {
                $grades->add($grade);
            }
        }

        Grade::upsert($grades->toArray(), ['course_id', 'student_id'], ['letter']);
    }

    /**
     * Build a collection of students and courses that need to be added or updated in the database.
     *
     * @param \Illuminate\Support\Collection $rows
     *
     * @return array
     */
    private function buildCollections(Collection $rows)
    {
        $students = collect();
        $courses  = collect();

        foreach ($rows as $row) {
            $students->add($this->buildStudent($row));
            $courses->add($this->buildCourse($row));
        }

        return [
            'students' => $students,
            'courses'  => $courses,
        ];
    }

    /**
     * Creates a student model out of the data in the .csv row.
     * 
     * @param \Illuminate\Support\Collection $row
     *
     * @return \App\Models\Student
     */
    private function buildStudent(Collection $row)
    {
        return new Student([
            'student_number' => $row['student_number'],
            'first_name'     => $row['firstname'],
            'surname'        => $row['surname'],
        ]);
    }

    /**
     * Creates a course model out of the data in the .csv row.
     * 
     * @param \Illuminate\Support\Collection $row
     *
     * @return \App\Models\Course
     */
    private function buildCourse(Collection $row)
    {
        return new Course([
            'code' => $row['course_code'],
            'description' => $row['course_description']
        ]);
    }

    /**
     * Creates a grade model out of the data in the .csv row and return null if related data cannot be found.
     * 
     * @param \Illuminate\Support\Collection $row
     *
     * @return \App\Models\Grade|null
     */
    private function buildGrade(Collection $row)
    {
        $student = $this->students->firstWhere('student_number', $row['student_number']);
        $course  = $this->courses->firstWhere('code', $row['course_code']);

        if ($student && $course) {
            return new Grade([
                'course_id' => $course->id,
                'student_id' => $student->id,
                'letter' => $row['grade']
            ]);
        }

        // If the student or course could not be found, don't add the grade
        return null;
    }
}
