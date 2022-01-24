<?php
require __DIR__ . '/../../services/productservice.php';

class ProductController
{

    private $productService;

    // initialize services
    function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $products = $this->productService->getAll();
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($products);
        }
    }
}
