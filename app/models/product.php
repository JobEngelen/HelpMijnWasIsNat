<?php
class Product implements \JsonSerializable
{
    private int $id;
    private string $title;
    private string $content;
    private float $rating;
    private float $price;
    private string $image;

    public function __construct($_title=null, $_content=null, $_rating=null, $_price=null, $_image=null)
    {
        if ($_title !== null) $this->title = $_title;
        if ($_title !== null) $this->content = $_content;
        if ($_title !== null) $this->rating = $_rating;
        if ($_title !== null) $this->price = $_price;
        if ($_title !== null) $this->image = $_image;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}
