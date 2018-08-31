<?php

namespace NtimYeboah\Database\Migration;

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

    /**
     * Drop table if exists
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('users');
    }
}