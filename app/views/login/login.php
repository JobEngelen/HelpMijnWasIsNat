<?php
include __DIR__ . '/../header.php';
?>
<div class="row">
    <form class="mx-1 w-25 mt-5 col-md-8 mx-auto" method="post" action="/home" enctype="multipart/form-data">

        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Log in</p>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <label class="form-label me-4 w-50" for="loginForm">Gebruikersnaam</label>
            <input type="text" id="loginForm" class="form-control" maxlength="255" name="username" required />
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <label class="form-label me-4 w-50" for="loginForm">Wachtwoord</label>
            <input type="password" id="loginForm" class="form-control" maxlength="255" name="password" required />
        </div>
    
        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
            <button type="submit" class="btn btn-primary btn-lg" name="login">Log in</button>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <p>Nog geen account? <a id="loginForm" href="/register">Maak account aan.</a></p>

        </div>

    </form>
</div>
</div>

<?php
include __DIR__ . '/../footer.php';
?>