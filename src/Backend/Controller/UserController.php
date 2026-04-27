<?php

namespace App\Controller;

use App\Service\UserService;

class UserController {

    private UserService $service;

    public function __construct() {
        $this->service = new UserService();
    }

    //POST http://localhost:8081/user
    public function store() {
        $this->service->createUser();
    }

    //GET http://localhost:8081/users
    public function index() {
        $users = $this->service->getAllUsers();

        echo json_encode([
            "data" => $users
        ]);
    }
}