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
        //require __DIR__ . '/../views/product/index.php';
        //require __DIR__ . '/../views/admin/home/vieworders.php';

        //$directory = strtolower(substr(get_class($this), 0, -10));
        //$view = debug_backtrace()[1]['function'];
        //require __DIR__ . '/../views/admin/home/vieworders.php';
        //require __DIR__ . "/../views/admin/$directory/$view.php";
    }

    public function editProduct()
    {
        require __DIR__ . '/../views/admin/home/editproduct.php';
    }

    public function addProduct()
    {
        require __DIR__ . '/../views/admin/home/addproduct.php';
    }

    public function _getOrder()
    {
    }
}
