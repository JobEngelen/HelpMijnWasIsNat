<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/productservice.php';

class ProductController extends Controller
{
    private $productService;

    function __construct()
    {
        $this->productService = new ProductService();
    }
}
