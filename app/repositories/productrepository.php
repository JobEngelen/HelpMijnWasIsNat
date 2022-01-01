<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/product.php';

class ProductRepository extends Repository {

    function getAll() {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM products");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            $products = $stmt->fetchAll();

            return $products;

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

}