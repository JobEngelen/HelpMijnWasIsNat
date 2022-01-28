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

    function addProduct($product)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO products (title, content, rating, price, image) 
            VALUES(?, ?, ?, ?, ?)");
            $stmt->execute([$product->getTitle(), $product->getContent(), $product->getRating(), $product->getPrice(), $product->getImage()]);
            echo "New record created successfully";
        } catch (PDOException $e) {
            echo $stmt . "<br>" . $e->getMessage();
        }

        /*
    //foto naar mapje sturen
    $fnm = $_FILES["image"]["name"];
    $dst = "/home/" . $fnm;
    //move_uploaded_file($_FILES["image"]["tmp_name"], $dst);

    //foto uit mapje halen en decoden naar base64
    $imagedata = file_get_contents($dst);
    // alternatively specify an URL, if PHP settings allow
    $base64 = base64_encode($imagedata);*/

        //echo $title . " " . $description . " "  . $rating . " " . $price;
    }

    function updateProduct(int $id, string $title, string $content, $rating, $price)
    {
        try {
            $stmt = $this->connection->prepare("
            UPDATE products
            SET title = ?, content = ?, rating = ?, price = ?
            WHERE id = ?");
            $stmt->execute(array($title, $content, $rating, $price, $id));
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function deleteProduct(int $id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM products WHERE id = ?");
            $stmt->execute(array($id));
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function register($user)
    {
        try {
            $stmt = $this->connection->prepare("INSERT into users (username, email, password, isAdmin) VALUES (?,?,?, 1)");
            $stmt->execute([$user->getUsername(), $user->getEmail(), $user->getPassword()]);
            echo '<script>alert("Medewerker-account ' . $user->getUsername() . ' is aangemaakt!")</script>';
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
