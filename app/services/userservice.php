<?php
require __DIR__ . '/../repositories/userrepository.php';

class UserService {

    public function register($user) {
        $repository = new UserRepository();
        $repository->register($user); 
    }

}