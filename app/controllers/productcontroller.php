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

    //insert

    /*public function single()
    {
        $model = $this->productService->getAll();

        require __DIR__ . '/../views/product/single.php';
    }*/
}
