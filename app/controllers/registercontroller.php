<?php
require __DIR__ . '/../services/userservice.php';

class RegisterController {

    public function index()
    {
        require __DIR__ . '/../views/login/register.php';
    }
}
