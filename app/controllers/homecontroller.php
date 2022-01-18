<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/userservice.php';

class HomeController extends Controller
{

    private $userService;

    function __construct()
    {
        $this->userService = new UserService();
    }
    public function index()
    {
        $_SESSION['isAdmin'] = false;
        if (isset($_POST['login'])) {
            try {
                $username = ($_POST['username']);
                $password = ($_POST['password']);

                $this->userService->login($username, $password);
            } catch (Exception $e) {
                echo $e;
                echo "Er ging iets verkeerd...";
            }
        }
        if ($_SESSION['isAdmin']) {
            require __DIR__ . '/../views/admin/home/editproduct.php';
        } else {
            require __DIR__ . '/../views/home/index.php';
        }
    }

    public function about()
    {
        require __DIR__ . '/../views/home/about.php';
    }
}
