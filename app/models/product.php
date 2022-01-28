<?php
class Product implements \JsonSerializable {

    private int $id;
    private string $title;
    private string $content;
    private float $rating;
    private float $price;
    private string $image;

    public function __construct($_title, $_content, $_rating, $_price, $_image)
    {
        $this->title = $_title;
        $this->content = $_content;
        $this->rating = $_rating;
        $this->price = $_price;
        $this->image = $_image;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getRating() {
        return $this->rating;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getImage() {
        return $this->image;
    }

    public function jsonSerialize(): mixed
    {
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>