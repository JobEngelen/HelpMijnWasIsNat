<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/product.php';

class ProductRepository extends Repository {

    function getAll() {
        try {
            //$stmt = $this->connection->prepare("SELECT * FROM products");
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

   /* function insert($product) {
        try {
            $stmt = $this->connection->prepare("INSERT into article (title, content, author, posted_at) VALUES (?,?,?, NOW())");            
            
            $stmt->execute([$article->getTitle(), $article->getContent(), $article->getAuthor()]);

        } catch (PDOException $e) {
            echo $e;
        }
    }*/

}