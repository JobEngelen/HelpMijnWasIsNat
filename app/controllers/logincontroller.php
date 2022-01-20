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
        require __DIR__ . '/../views/login/login.php';
    }

    public function _login()
    {
        if (isset($_POST['login'])) {
            try {
                $username = ($_POST['username']);
                $password = ($_POST['password']);

                $this->userService->login($username, $password);
                require __DIR__ . '/../views/login/login.php';
            } catch (Exception $e) {
                echo $e;
                echo "Er ging iets verkeerd...";
            }
        }
    }
}
