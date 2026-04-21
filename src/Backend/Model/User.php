<?php

namespace App\Model;

use App\Config\Dbconnection;
use PDO;

class User {

    public static function create(string $name, string $email, string $password) {

        $pdo = Dbconnection::connect();

        $stmt = $pdo->prepare("
            INSERT INTO users (name, email, password)
            VALUES (:name, :email, :password)
        ");

        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);
    }
}