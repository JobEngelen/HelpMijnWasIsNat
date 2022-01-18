<?php
class Product implements \JsonSerializable {

    private int $id;
    private string $title;
    private string $content;
    private float $rating;
    private float $price;

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

    public function jsonSerialize(): mixed
    {
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>