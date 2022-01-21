<?php
require __DIR__ . '/../repositories/shoppingcartrepository.php';

class ShoppingCartService {

    public function order() {
        $repository = new ShoppingCartRepository();
        $repository->order(); 
    }
}