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
            echo '<script>alert("Account ' . $user->getUsername() . ' is aangemaakt!")</script>';
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function login($username, $password)
    {
        $stmt = $this->connection->prepare("SELECT id, username, password FROM users where username = ?");
        $stmt->execute([$username]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $loggedInUser = $stmt->fetchObject();

        if (password_verify($password, $loggedInUser->password)) {
            $_SESSION['id'] = $loggedInUser->id;
            $_SESSION['username'] = $loggedInUser->username;

            echo '<script>alert("Account ' . $loggedInUser->id . ' en session='.$_SESSION['id'].'")</script>';
            require __DIR__ . '/../views/home/index.php';
        } else {
?>
            <script>
                var password = document.getElementById("password");
                password.setCustomValidity("Wachtwoord en gebruikersnaam komen niet met elkaar overeen.");
            </script>
<?php
        }
    }
}
