<?php
require __DIR__ . '/../services/userservice.php';

class LoginController
{

    private $userService;

    function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        if (isset($_SESSION['id'])) { // logout
            session_unset();
        }
        require __DIR__ . '/../views/login/login.php';
    }
}
