<?php

namespace App\Service;

use App\Model\User;

class UserService{
    //create user -> calls model/user
    public function createUser(){
        header('Content-Type: application/json');

        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['name'], $input['email'], $input['password'])) {
            http_response_code(400);
            echo json_encode(["error" => "Missing fields"]);
            return;
        }

         $ok = User::create(
            $input['name'],
            $input['email'],
            $input['password']
        );

        if ($ok) {
            echo json_encode(["message" => "User created"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Failed to create user"]);
        }
    }
     public function getAllUsers() {
        return User::getAll();
    }
}