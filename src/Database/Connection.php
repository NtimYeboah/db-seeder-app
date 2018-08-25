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
            'host'      => getenv('DB_HOST'),
            'database'  => getenv('DB_DATABASE'),
            'username'  => getenv('DB_USERNAME'),
            'password'  => getenv('DB_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ]);

        $capsule->setAsGlobal();

        $capsule->bootEloquent();
    }
}