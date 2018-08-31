<?php

namespace NtimYeboah\Database\Seeder;

use Faker\Factory;
use NtimYeboah\Database\Migration\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class UsersTableSeeder extends DatabaseSeeder
{
    public function run()
    {
        $faker = Factory::create();

        $users = array_map(function() use ($faker) {
            return [
                'full_name' => $faker->name,
                'email' => $faker->safeEmail,
                'created_at' => date('Y-m-d h:i:s', time())
            ];
        }, range(1, 20));
        
        Capsule::table('users')->insert($users);
    }
}