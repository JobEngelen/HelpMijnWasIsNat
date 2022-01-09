<?php
//require __DIR__ . '/controller.php';
require __DIR__ . '/../services/userservice.php';

//class LoginController extends Controller {
class LoginController {

    /*public function __construct() {

        $this->userService = new UserService();

    }*/

    public function index()
    {
        require __DIR__ . '/../views/login/login.php';
    }
}
