<?php
include __DIR__ . '/../header.php';
?>

<div class="row">
    <form class="mx-1 w-25 mt-5 col-md-8 mx-auto" method="post" action="/register/_register" enctype="multipart/form-data">

        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registreren</p>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <label class="form-label me-4 w-50" for="registerForm">Gebruikersnaam</label>
            <input type="text" id="registerForm" class="form-control" maxlength="255" name="username" required />
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <label class="form-label me-4 w-50" for="registerForm">E-mail</label>
            <input type="email" id="registerForm" class="form-control" maxlength="255" name="email" required />
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <label class="form-label me-4 w-50" for="password">Wachtwoord</label>
            <input type="password" id="password" class="form-control" maxlength="255" name="password" required />
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <label class="form-label me-4 w-50" for="confirm_password">Bevestig wachtwoord</label>
            <input type="password" id="confirm_password" class="form-control" maxlength="255" name="confirmpassword" required />
        </div>

        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
            <button type="submit" class="btn btn-primary btn-lg" name="register">Maak account aan</button>
        </div>
    </form>
</div>
</div>

<?php
include __DIR__ . '/../footer.php';
/*
$user = new $user();
$registerController = new registerController();

if (isset($_POST['register'])) {

    try {
        $username = ($_POST['username']);
        $email = ($_POST['email']);
        $password = ($_POST['password']);

        $user->$this->__construct($username, $email, $password);
        $registerController->$this->register($user);
    } catch (Exception $e) {
        echo $e;
        echo "the frick!?";
    }
}*/

?>

<!-- Confirm password -->
<script>
    var password = document.getElementById("password"),
        confirm_password = document.getElementById("confirm_password");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("De wachtwoorden komen niet met elkaar overeen");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>