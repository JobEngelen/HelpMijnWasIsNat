<?php
require __DIR__ . '/../helpers/session_helper.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Help! Mijn was is nat!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Bootstrap Font Icon CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <script src="https://kit.fontawesome.com/8a30a83fae.js" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4 navbar-static-top">
    <div class="container">
      <a class="navbar-brand" href="/">HelpMijnWasIsNat.nl</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0 w-25">
          <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/product">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/home/about">About</a>
          </li>
        </ul>
        <ul class="navbar-nav me-auto mb-2 mb-md-0 w-50">
          <li class="nav-item">
            <span class="input-group-btn">
              <div class="row justify-content-center">
                <div class="card-body align-items-center">
                  <div class="input-group">
                    <input id="search" class="form-control form-control-lg form-control-borderless" type="search" placeholder="Zoek wasdrogers...">
                    <button type="button" class="btn btn-secondary">
                      <span class="glyphicon glyphicon-search"></span> Zoek
                    </button>
                  </div>
                </div>
              </div>
            </span>
          </li>
        </ul>
        <?php
        if (isset($_SESSION['id'])) {
        ?>
          <ul class="navbar-nav me-auto mb-2 mb-md-0 w-25">
            <li class="nav-item">
              <p class="navbar-brand m-0">Welcome <?php echo $_SESSION['username']; ?>!</p>
            </li>
            <li class="nav-item me-5">
              <div class="row justify-content-center">
                <div class="card-body row no-gutters align-items-center">
                  <div class="input-group">
                    <a class="btn btn-light" href="/login">
                      <i class="fas fa-sign-in-alt"></i> Log out
                    </a>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        <?php
        } else {
        ?>
          <!-- right side of navbar -->
          <ul class="navbar-nav me-auto mb-2 mb-md-0 w-25">
            <li class="nav-item mx-5">
              <div class="row justify-content-center">
                <div class="card-body row no-gutters align-items-center">
                  <div class="input-group">
                    <a class="btn btn-secondary" href="/register">
                      <i class="fas fa-user-plus"></i> Registreer
                    </a>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item me-5">
              <div class="row justify-content-center">
                <div class="card-body row no-gutters align-items-center">
                  <div class="input-group">
                    <a class="btn btn-light" href="/login">
                      <i class="fas fa-sign-in-alt"></i> Log in
                    </a>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        <?php
        }
        ?>
      </div>
    </div>
  </nav>

  <div class="w-100 pull-center overflow-hidden">