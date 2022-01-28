<?php
require __DIR__ . '/../repositories/adminrepository.php';

class AdminService {
    public function getOrders() {
        $repository = new AdminRepository();
        return $repository->getOrders();
    }

    public function updateOrder(int $id, int $status) {
        $repository = new AdminRepository();
        return $repository->updateOrder($id, $status);
    }

    public function addProduct($product) {
        $repository = new AdminRepository();
        $repository->addProduct($product); 
    }

    public function updateProduct(int $id, string $title, string $content, $rating, $price) {
        $repository = new AdminRepository();
        return $repository->updateProduct($id, $title, $content, $rating, $price);
    }

    public function deleteProduct(int $id) {
        $repository = new AdminRepository();
        return $repository->deleteProduct($id);
    }

    public function register($user) {
        $repository = new AdminRepository();
        $repository->register($user); 
    }
}