<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            StudentSeeder::class,
            CourseSeeder::class,
            GradeSeeder::class,
        ]);

        $this->outputAdminCredentials();
    }

    /**
     * Get the login details of the first admin user and display it in the console.
     *
     * @return void
     */
    private function outputAdminCredentials()
    {
        $admin = User::firstWhere('is_admin', true);

        if ($admin) {
            $this->command->comment("The admin login is \n- Email: " . $admin->email . "\n- Password: password");
        }
    }
}
