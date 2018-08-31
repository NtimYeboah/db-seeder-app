<?php

namespace NtimYeboah\Database\Migration;

use NtimYeboah\Database\Connection;
use Illuminate\Container\Container;

class Migration
{
    /**
     * List of possible migrations to run.
     * 
     * @var array
     */
    protected $migrations = [];

    public function run()
    {
        $this->makeDbConnection();

        $this->runMigrations();
    }

    /**
     * Run migrations
     * 
     * @return void
     */
    private function runMigrations()
    {
        foreach ($this->migrations as $migration) {
            if (! method_exists($migration, 'up')) {
                throw new InvalidArgumentException('Method run does not exist on ', get_class($migration));
            }

            (new $migration)->up();
        }
    }

    /**
     * Establish database connection.
     *
     * @return void
     */
    public function makeDbConnection()
    {
        Connection::initialize();
    }
}