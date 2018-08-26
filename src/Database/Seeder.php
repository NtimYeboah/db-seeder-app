<?php

namespace NtimYeboah\Database;

use Faker\Factory;
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

        $users = array_map(function() use ($faker) {
            return [
                'full_name' => $faker->name,
                'email' => $faker->safeEmail,
                'created_at' => date('Y-m-d h:i:s', time())
            ];
        }, range(1, 20));

        Capsule::table('users')->insert($users);
    }

    private function prepare()
    {
        Connection::initialize();

        $this->schema->down();
        $this->schema->up();
    }
}