<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/user.php';

class UserRepository extends Repository
{

    public function register($user)
    {
        try {
            $stmt = $this->connection->prepare("INSERT into users (username, email, password) VALUES (?,?,?)");
            $stmt->execute([$user->getUsername(), $user->getEmail(), $user->getPassword()]);
            echo '<script>alert("Account '. $user->getUsername() .' is aangemaakt!")</script>';
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function login($username, $password)
    {
        $this->db->query('SELECT * FROM users WHERE username = :username');

        //Bind value
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        $hashedPassword = $row->password;

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email)
    {
        //Prepared statement
        $this->db->query('SELECT * FROM users WHERE email = :email');

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        //Check if email is already registered
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
