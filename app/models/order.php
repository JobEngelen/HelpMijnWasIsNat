<?php
class Order {
    private int $id;
    private string $username;
    private float $totalPrice;
    private DateTime $date;
    private int $status;

    /*public function __construct($_id, $_username, $_totalPrice, $_date, $_status)
    {
        $this->id = $_id;
        $this->username = $_username;
        $this->totalPrice = $_totalPrice;
        $this->date = $_date;
        $this->status = $_status;
    }
    public function __construct($_username)
    {
        $this->username = $_username;
    }*/

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getTotalPrice() {
        return $this->totalPrice;
    }

    public function getDate() {
        return $this->date;
    }

    public function getStatus() {
        return $this->status;
    }
}