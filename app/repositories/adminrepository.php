<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/order.php';

class AdminRepository extends Repository
{
    function getOrders()
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT orders.id, users.username, SUM(products.price), orders.order_date, orders.status
            FROM orders
            INNER JOIN users ON orders.user_id = users.id
            INNER JOIN order_product ON orders.id = order_product.order_id
            INNER JOIN products ON order_product.product_id = products.id
            GROUP BY orders.id");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
            $orders = $stmt->fetchAll();
            var_dump($orders);
            return $orders;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
