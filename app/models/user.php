<?php
class User {
    
    private int $id;
    private string $username;
    private string $email;
    private string $password;

    public function __construct($_username, $_email, $_password)
    {
        $this->username = $_username;
        $this->email = $_email;
        $this->password = $_password;
    }

    /*public function setId(int $id) {
        $this->id = $id;
    }*/

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }
}