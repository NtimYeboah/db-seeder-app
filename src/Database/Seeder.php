<?php

namespace NtimYeboah\Database;

use Faker\Factory;
use NtimYeboah\Models\User;
use Illuminate\Database\Capsule\Manager as Capsule;

class Seeder
{
    /**
     * Run available table seeders
     * 
     * @return void
     */
    public function run()
    {
        $this->dropUsersTable();
        $this->seedUsersTable();
    }

    /**
     * Run seeder for users table
     * 
     * @return void
     */
    public function seedUsersTable()
    {
        $faker = Factory::create();

        User::create([
            'full_name' => $faker->name,
            'email' => $faker->safeEmail
        ]);
    }

    /**
     * Drop users table if exists
     */
    private function dropUsersTable()
    {
        Capsule::schema()->drop('users'); 
    }
}