<?php

namespace NtimYeboah\Database\Migration;

class Schema extends Migration
{
    /**
     * List of migrations to be run.
     * 
     * @var array
     */
    protected $migrations = [
        CreateUsersTable::class,
    ];
}