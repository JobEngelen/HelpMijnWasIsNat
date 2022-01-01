<?php
require __DIR__ . '/../services/productservice.php';

class ProductController
{
    private $productService;

    function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index()
    {
        $model = $this->productService->getAll();

        require __DIR__ . '/../views/product/index.php';
    }

    public function single()
    {
        $model = $this->productService->getAll();

        require __DIR__ . '/../views/product/single.php';
    }
}
