<?php

namespace NtimYeboah\Database\Migration;

use NtimYeboah\Database\Connection;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;

class Migration
{
    /**
     * List of possible migrations to run.
     * 
     * @var array
     */
    protected $migrations = [];

    /**
     * Namespace of migration classes
     * 
     * @var string
     */
    protected $namespace = 'NtimYeboah\\Database\\Migration\\';

    public function run($rerun = false, $seederClass = null)
    {
        $this->makeDbConnection();

        $this->runMigrations($rerun, $seederClass);
    }

    /**
     * Run migrations
     * 
     * @return void
     */
    private function runMigrations($rerun = false, $seederClass = null)
    {
        if (! is_null($seederClass)) {
            $table = $this->getSeederTable($seederClass);

            if (! Capsule::schema()->hasTable(strtolower($table))) {
                $migration = $this->namespace . 'Create'. $table. 'Table';
                
                $this->createTable($migration);
            }
        } elseif ($rerun) {
            foreach ($this->migrations as $migration) {
                $this->rerunMigration($migration);
            }
        } else {
            foreach ($this->migrations as $migration) {
                $this->createTable($migration);
            }
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

    /**
     * Get seeder table name
     * 
     * @return string
     */
    private function getSeederTable($seederClass)
    {
        $splittedClassName = preg_replace('/([a-z0-9])?([A-Z])/','$1 $2', $seederClass);
        
        list($spaceChar, $tableNameString, $tableString, $seederString) = explode(' ', $splittedClassName);
        
        return $tableNameString;
    }

    /**
     * Create table from migration
     * 
     * @param string $migration
     * @return void
     */
    private function createTable($migration)
    {
        if (! method_exists($migration, 'up')) {
            throw new \InvalidArgumentException('Method run does not exist on ', get_class($migration));
        }

        (new $migration)->up();
    }

    /**
     * Drop table from migration
     * 
     * @param string $migration
     * @return void
     */
    private function dropTable($migration)
    {
        if (! method_exists($migration, 'down')) {
            throw new \InvalidArgumentException('Method run does not exist on ', get_class($migration));
        }

        (new $migration)->down();
    }

    /**
     * Drop and create table
     * 
     * @param string $migration
     * @return void
     */
    private function rerunMigration($migration)
    {
        $this->dropTable($migration);

        $this->createTable($migration);
    }
}