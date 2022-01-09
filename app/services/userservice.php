<?php
require __DIR__ . '/../repositories/userrepository.php';

class UserService {

    public function register($user) {
        $repository = new UserRepository();
        $repository->register($user); 
    }

    public function login($username, $password) {
        $repository = new UserRepository();
        $repository->login($username, $password);
    }
}