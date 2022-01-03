<?php
class Product implements \JsonSerializable {

    public int $id;
    public string $title;
    public string $content;
    public float $rating;
    public float $price;

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function jsonSerialize(): mixed
    {
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>