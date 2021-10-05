<?php

namespace Tests\Feature;

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
        // Get the example .csv
        $file = new UploadedFile(storage_path('framework/testing/grades.csv'), 'grades.csv');

        $response = $this->postJson('/grades/import', ['grades' => $file]);

        // Assert the request was successful
        $response->assertSessionHas('success', true);

        // Assert all the records exist on their respective tables
        $this->assertDatabaseCount('students', 5);
        $this->assertDatabaseCount('courses', 4);
        $this->assertDatabaseCount('grades', 10);
    }
}
