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
}