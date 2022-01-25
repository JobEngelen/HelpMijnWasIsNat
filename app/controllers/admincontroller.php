<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/adminservice.php';

class AdminController extends Controller
{
    private $adminService;

    function __construct()
    {
        session_start();
        $this->adminService = new AdminService();
    }

    public function index()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
            $orders = $this->adminService->getOrders();
            $this->displayView($orders);
        } else {
            $this->noPermission();
        }
    }

    public function editProduct()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
            require __DIR__ . '/../views/admin/editproduct.php';
        } else {
            $this->noPermission();
        }
    }

    public function addProduct()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
            require __DIR__ . '/../views/admin/addproduct.php';
        } else {
            $this->noPermission();
        }
    }

    public function editOrder()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
            if (!empty($_POST["id"]) && !empty($_POST["status"])) {
                $this->adminService->updateOrder($_POST["id"], $_POST["status"]);
            }
        } else {
            $this->noPermission();
        }
    }

    public function noPermission()
    {
        echo "<h1>Geen toegang tot deze pagina.</h1>";
        echo "<h3>Error code: 403 forbidden</h3>";
        echo "<a href='/home'>Terug naar homepagina</a>";
    }
}
