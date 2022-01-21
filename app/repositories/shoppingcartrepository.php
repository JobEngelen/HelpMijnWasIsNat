<?php
require __DIR__ . '/repository.php';
//require __DIR__ . '/../models/user.php';

class ShoppingCartRepository extends Repository
{
    public function order()
    {
        $user_id = 0;
        if (isset($_SESSION['id'])) {
            $user_id = $_SESSION['id'];
        }
        try {
            $stmt = $this->connection->prepare("
            INSERT into orders (user_id) 
            VALUES ((SELECT id FROM users WHERE id = ?))");
            $stmt->execute([$user_id]);

            $stmt = $this->connection->prepare("
            INSERT into order_product (order_id, product_id, quantity) 
            VALUES 
            ((SELECT MAX(id) AS product_id FROM orders),
            (SELECT id FROM products WHERE id = ?), ?)");
            foreach ($_SESSION["cart_item"] as $item) {
                $stmt->execute([$item["code"], $item["quantity"]]);
            }
            unset($_SESSION["cart_item"]);

            echo "<script>alert('Bestelling geplaatst!')</script>";
        } catch (PDOException $e) {
            echo $e;
            echo "<script>alert('" . $e . "')</script>";
        }
    }
}
