<?php
require __DIR__ . '/../services/userservice.php';

class RegisterController
{
    private $userService;

    function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        require __DIR__ . '/../views/login/register.php';
    }

    public function _register() {
        if (isset($_POST['register'])) {
            try {
                $username = htmlspecialchars($_POST['username']);
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);
                $hashed_password = password_hash(htmlspecialchars($password), PASSWORD_DEFAULT);
                $user = new User($username, $email, $hashed_password);

                $this->userService->register($user);
                require __DIR__ . '/../views/login/login.php';
            } catch (Exception $e) {
                echo $e;
                echo "Er ging iets verkeerd...";
            }
        }
    }
}
