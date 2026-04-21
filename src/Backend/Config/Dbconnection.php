<?php

namespace App\Config;

use PDO;

class Dbconnection {

    public static function connect(): PDO {
        return new PDO(
            "mysql:host=db;dbname=testdb;charset=utf8mb4",
            "testuser",
            "testpass"
        );
    }
}