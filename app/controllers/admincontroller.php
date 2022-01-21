<?php
require __DIR__ . '/../services/productservice.php';

class AdminController
{
    private $productService;

    function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index()
    {
        require __DIR__ . '/../views/admin/home/vieworders.php';
    }

    public function editProduct()
    {
        require __DIR__ . '/../views/admin/home/editproduct.php';
    }

    public function addProduct()
    {
        require __DIR__ . '/../views/admin/home/addproduct.php';
    }
}
