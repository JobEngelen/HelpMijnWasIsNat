<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/adminservice.php';

class AdminController extends Controller
{
    private $adminService;

    function __construct()
    {
        $this->adminService = new AdminService();
    }

    public function index()
    {
        $orders = $this->adminService->getOrders();
        $this->displayView($orders);
    }

    public function editProduct()
    {
        require __DIR__ . '/../views/admin/editproduct.php';
    }

    public function addProduct()
    {
        require __DIR__ . '/../views/admin/addproduct.php';
    }

    public function editOrder()
    {
        if (!empty($_POST["id"]) && !empty($_POST["status"])) {
            $this->adminService->updateOrder($_POST["id"], $_POST["status"]);
        } 
    }
}
