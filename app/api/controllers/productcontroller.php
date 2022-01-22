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
        // your code here
        // return all products in the database as JSON
        $products = $this->productService->getAll();
        $json = json_encode($products);
        echo $json;


        // return null;       
    }
}
