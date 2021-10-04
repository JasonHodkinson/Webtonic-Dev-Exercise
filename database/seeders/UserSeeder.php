<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Make sure the first user created is an admin
        User::factory(3)
            ->sequence(fn ($sequence) => ['is_admin' => $sequence->index == 0 ? true : false])
            ->create();
    }
}
