<?php

namespace NtimYeboah\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateUsersTable
{
    /**
     * Create users table
     */
    public function up()
    {
        Capsule::schema()->create('users', function ($table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }
}