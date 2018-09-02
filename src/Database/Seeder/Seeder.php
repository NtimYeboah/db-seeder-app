<?php

namespace NtimYeboah\Database\Seeder;

use NtimYeboah\Database\Migration\Schema;

class Seeder
{
    /**
     * Possible list of table seeders.
     * 
     * @var array
     */
    protected $seeders = [];

    /**
     * Run all seeders.
     * 
     * @return void
     */
    public function call($class = null)
    {
        if (! is_null($class)) {
            $qualifiedClassName = $this->getQualifiedClassName($class);

            if (is_null($qualifiedClassName)) {
                throw new \InvalidArgumentException('Class does not exists'. get_class($class));
            }

            $this->runSeeder($qualifiedClassName);
        } else {
            foreach ($this->seeders as $seeder) {   
                $this->runSeeder($seeder);
            } 
        }   
    }

    /**
     * Run a specific seeder
     * 
     * @param string $class
     */
    private function runSeeder($class) 
    {
        if (! method_exists($class, 'run')) {
            throw new \InvalidArgumentException('Method run does not exist on class'. get_class($class));
        }

        (new $class)->run();
    }

    /**
     * Get qualified class name
     * 
     * @param string $class
     * @return string|null
     */
    private function getQualifiedClassName($class) 
    {
        foreach ($this->seeders as $seeder) {
            list($authorName, $databaseDir, $seederDir, $className) = explode('\\', $seeder);
            
            if ($className === $class) {
                return $seeder;
            }

            return null;
        }
    }
}