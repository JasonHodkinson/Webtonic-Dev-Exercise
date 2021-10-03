<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Use existing courses and students when creating grades
        $courses = Course::all();
        $students = Student::all();

        foreach ($courses as $course) {
            // Select up to 5 random students to add to each course and give them a grading
            $studentsInCourse = $students->shuffle()->take(5);

            Grade::factory($studentsInCourse->count())
                ->for($course)
                ->state(new Sequence(
                    fn ($sequence) => [
                        'student_id' => $studentsInCourse->shift() // Use shift to prevent duplicating keys
                    ]
                ))->create();
        }
    }
}
