<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class GradesImport implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;

    /**
     * All students currently in the database
     *
     * @var \Illuminate\Support\Collection;
     */
    private $students;

    /**
     * All courses currently in the database
     *
     * @var \Illuminate\Support\Collection;
     */
    private $courses;

    /**
     * Initialise with all current students and courses to avoid redundant data
     */
    public function __construct()
    {
        $this->students = Student::all();
        $this->courses = Course::all();
    }

    /**
     * TODO: Take a look at using the ToCollection instead to avoid hundreds of queries
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $student = Student::updateOrCreate([
            'student_number' => $row['student_number']
        ],[
            'first_name' => $row['firstname'],
            'surname' => $row['surname']
        ]);

        $course = Course::updateOrCreate([
            'course_code' => $row['course_code']
        ], [
            'description' => $row['course_description']
        ]);

        return new Grade([
            'course_id' => $course->id, 
            'student_id' => $student->id, 
            'letter' => $row['grade'], 
        ]);
    }

    public function rules(): array
    {
        return [
            'student_number' => ['required', 'numeric'],
            'firstname' => ['required', 'string', 'min:2', 'max:50'],
            'surname' => ['required', 'string', 'min:2', 'max:50'],
            'course_code' => ['required', 'string', 'size:5'],
            'course_description' => ['required', 'string', 'min:5', 'max:50'],
            'grade' => [Rule::in(Grade::availableLetters())]
        ];
    }
}
