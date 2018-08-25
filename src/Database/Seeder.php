<?php

namespace NtimYeboah\Database;

use Faker\Factory;
use NtimYeboah\Models\User;
use NtimYeboah\Database\Connection;
use Illuminate\Database\Capsule\Manager as Capsule;
use NtimYeboah\Database\Migrations\CreateUsersTable;

class Seeder
{
    private $schema;

    public function __construct(CreateUsersTable $schema)
    {
        $this->schema = $schema;
    }

    /**
     * Run available table seeders
     * 
     * @return void
     */
    public function run()
    {
        $this->prepare();
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

    private function prepare()
    {
        Connection::initialize();

        $this->schema->down();
        $this->schema->up();
    }
}