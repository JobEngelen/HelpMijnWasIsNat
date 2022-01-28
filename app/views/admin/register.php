<?php
include __DIR__ . '/header.php';
?>

<h1>Registreren medewerker</h1>

<form class="mx-1 mx-md-4 w-50 mt-5"  method="post" action="/admin/_register" enctype="multipart/form-data">
    <div class="d-flex flex-row align-items-center mb-4">
        <label class="form-label me-4 w-25" for="registerForm">Gebruikersnaam</label>
        <input type="text" id="registerForm" class="form-control" maxlength="255" name="username" required />
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <label class="form-label me-4 w-25" for="registerForm">E-mail</label>
        <input type="email" id="registerForm" class="form-control" maxlength="255" name="email" required />
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <label class="form-label me-4 w-25" for="password">Wachtwoord</label>
        <input type="password" id="password" class="form-control" maxlength="255" name="password" required />
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <label class="form-label me-4 w-25" for="confirm_password">Bevestig wachtwoord</label>
        <input type="password" id="confirm_password" class="form-control" maxlength="255" name="confirmpassword" required />
    </div>

    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
        <button type="submit" class="btn btn-primary btn-lg" name="register">Maak account aan</button>
    </div>
</form>

</div>

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