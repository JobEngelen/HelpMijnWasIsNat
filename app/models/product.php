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

    public function getRating() {
        return $this->rating;
    }

    public function jsonSerialize(): mixed
    {
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>