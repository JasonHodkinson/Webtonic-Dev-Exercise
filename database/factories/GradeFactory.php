<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Grade::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'course_id' => Course::factory(),
            'student_id' => Student::factory(),
            'letter' => $this->faker->randomElement(Grade::availableLetters())
        ];
    }
}
