<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/order.php';
require __DIR__ . '/../models/ordercontent.php';

class AdminRepository extends Repository
{
    function getOrders()
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT order_product.order_id, products.title, products.price, products.image, order_product.quantity
            FROM order_product
            INNER JOIN products ON order_product.product_id = products.id
            ORDER BY order_id ASC");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'OrderContent');
            $ordercontent = $stmt->fetchAll();

            $stmt = $this->connection->prepare("
            SELECT orders.id, users.username, SUM(products.price) AS totalPrice, orders.order_date, orders.status
            FROM orders
            INNER JOIN users ON orders.user_id = users.id
            INNER JOIN order_product ON orders.id = order_product.order_id
            INNER JOIN products ON order_product.product_id = products.id
            GROUP BY orders.id
            ORDER BY orders.status ASC, orders.order_date ASC");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
            $orders = $stmt->fetchAll();

            foreach ($orders as $order) {
                foreach ($ordercontent as $content) {
                    if ($order->getId() == $content->getOrderId()) {
                        $order->setOrderContent($content);
                    }
                }
            }

            return $orders;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function updateOrder(int $id, int $status)
    {
        try {
            $stmt = $this->connection->prepare("
            UPDATE orders
            SET status = ?
            WHERE id = ?");
            $stmt->execute(array($status, $id));
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
