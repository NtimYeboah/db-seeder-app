<?php

namespace NtimYeboah\Database;

use Illuminate\Database\Capsule\Manager as Capsule;

class Connection
{
    /**
     * Initialize database connection
     */
    public static function initialize()
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'seeder-app',
            'username'  => 'homestead',
            'password'  => 'secret',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ]);

        $capsule->setAsGlobal();
    }
}