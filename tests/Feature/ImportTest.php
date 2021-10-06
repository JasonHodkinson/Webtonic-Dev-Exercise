<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImportTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that importing the CSV will insert the data.
     *
     * @return void
     */
    public function test_uploading_inserts_data()
    {
        // Create an admin
        $admin = User::factory()->create(['is_admin' => true]);

        // Get the example .csv
        $file = new UploadedFile(storage_path('framework/testing/grades.csv'), 'grades.csv', null, null, true);

        $response = $this->actingAs($admin)->postJson('/grades/import', ['csv_document' => $file]);

        // Assert all the records exist on their respective tables
        $this->assertDatabaseCount('students', 5);
        $this->assertDatabaseCount('courses', 4);
        $this->assertDatabaseCount('grades', 10);
    }

    /**
     * Test that importing the CSV will update an existing user.
     *
     * @return void
     */
    public function test_uploading_updates_existing_student()
    {
        // Create an admin
        $admin = User::factory()->create(['is_admin' => true]);

        // Create a student with a different name to the .csv file
        Student::create([
            'student_number' => '96041',
            'first_name'     => 'Fahem',
            'surname'        => 'Tacbot',
        ]);

        // Get the example .csv
        $file = new UploadedFile(storage_path('framework/testing/grades.csv'), 'grades.csv', null, null, true);

        $response = $this->actingAs($admin)->postJson('/grades/import', ['csv_document' => $file]);

        // Assert the old name no longer exists
        $this->assertDatabaseMissing('students', [
            'student_number' => '96041',
            'first_name'     => 'Fahem',
            'surname'        => 'Tacbot',
        ]);

        // Assert the new name is now in the database
        $this->assertDatabaseHas('students', [
            'student_number' => '96041',
            'first_name'     => 'Faheem',
            'surname'        => 'Takbot',
        ]);
    }

    /**
     * Test that importing the CSV will update an existing course.
     *
     * @return void
     */
    public function test_uploading_updates_existing_course()
    {
        // Create an admin
        $admin = User::factory()->create(['is_admin' => true]);

        // Create a course with a different description to the .csv file
        Course::create([
            'code'        => 'CS101',
            'description' => 'Technology Science',
        ]);

        // Get the example .csv
        $file = new UploadedFile(storage_path('framework/testing/grades.csv'), 'grades.csv', null, null, true);

        $response = $this->actingAs($admin)->postJson('/grades/import', ['csv_document' => $file]);

        // Assert the old description no longer exists
        $this->assertDatabaseMissing('courses', [
            'code'        => 'CS101',
            'description' => 'Technology Science',
        ]);

        // Assert the new description is now in the database
        $this->assertDatabaseHas('courses', [
            'code'        => 'CS101',
            'description' => 'Computer Science 1',
        ]);
    }

    /**
     * Test that importing the CSV will update an existing grade.
     *
     * @return void
     */
    public function test_uploading_updates_existing_grade()
    {
        // Create an admin
        $admin = User::factory()->create(['is_admin' => true]);

        // Create a student existing in the .csv
        $student = Student::create([
            'student_number' => '96041',
            'first_name'     => 'Faheem',
            'surname'        => 'Takbot',
        ]);

        // Create a course existing in the .csv
        $course = Course::create([
            'code'        => 'CS101',
            'description' => 'Computer Science 1',
        ]);

        // Create a grade for this student and course
        $grade = Grade::create([
            'course_id'  => $course->id,
            'student_id' => $student->id,
            'letter'     => 'F',
        ]);

        // Get the example .csv
        $file = new UploadedFile(storage_path('framework/testing/grades.csv'), 'grades.csv', null, null, true);

        $response = $this->actingAs($admin)->postJson('/grades/import', ['csv_document' => $file]);

        // Assert the old grade no longer exists
        $this->assertDatabaseMissing('grades', [
            'course_id'  => $course->id,
            'student_id' => $student->id,
            'letter'     => 'F',
        ]);

        // Assert the new grade is now in the database
        $this->assertDatabaseHas('grades', [
            'course_id'  => $course->id,
            'student_id' => $student->id,
            'letter'     => 'A',
        ]);
    }

    /**
     * Test that a non admin user will receive a forbidden.
     *
     * @return void
     */
    public function test_non_admin_cant_upload()
    {
        // Create a regular user
        $user = User::factory()->create(['is_admin' => false]);

        // Get the example .csv
        $file = new UploadedFile(storage_path('framework/testing/grades.csv'), 'grades.csv', null, null, true);

        $response = $this->actingAs($user)->postJson('/grades/import', ['csv_document' => $file]);

        // Assert unauthorised
        $response->assertForbidden();
    }

    /**
     * Test that a non authenticated user will receive an unauthorised.
     *
     * @return void
     */
    public function test_guest_user_cant_upload()
    {
        // Get the example .csv
        $file = new UploadedFile(storage_path('framework/testing/grades.csv'), 'grades.csv', null, null, true);

        $response = $this->postJson('/grades/import', ['csv_document' => $file]);

        // Assert unauthorized
        $response->assertUnauthorized();
    }
}
