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

    public function run()
    {
        foreach ($this->seeders as $seeder) {
            if (! method_exists($seeder, 'run')) {
                throw new InvalidArgumentException('Method run does not exist on class', get_class($seeder));
            }

            (new $seeder)->run();
        }  
    }

    /**
     * Run all seeders.
     * 
     * @return void
     */
    public function runSeeders()
    {
        
    } 
}