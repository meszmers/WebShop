<?php

namespace App;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;

class Database
{
    private static $connection = null;

    public static function connection()
    {
        if (self::$connection === null) {
            $connectionParams = [
                'dbname' => 'WebShop',
                'user' => 'root',
                'password' => 'password',
                'host' => 'localhost',
                'driver' => 'pdo_mysql',
            ];
            try {
                self::$connection = DriverManager::getConnection($connectionParams);
            } catch (Exception $e) {
                echo "<pre>" . $e;
                exit;
            }



        }
        return self::$connection;
    }
}