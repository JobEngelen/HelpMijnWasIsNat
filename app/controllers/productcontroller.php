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

    public function index()
    {
        //$model = $this->productService->getAll();      
        //require __DIR__ . '/../views/product/index.php';
        
        // retrieve data 
        $products = $this->productService->getAll();
    
        // show view, param = accessible as $model in the view
        // displayView maps this to /views/article/index.php automatically
        $this->displayView($products);
    }

    /*public function single()
    {
        $model = $this->productService->getAll();

        require __DIR__ . '/../views/product/single.php';
    }*/
}
