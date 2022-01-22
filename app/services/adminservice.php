<?php
require __DIR__ . '/../repositories/adminrepository.php';

class AdminService {
    public function getOrders() {
        $repository = new AdminRepository();
        return $repository->getOrders();
    }
}