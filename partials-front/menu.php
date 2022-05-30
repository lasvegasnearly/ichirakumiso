
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./img/ichirakuMiso-elements/logo-Recovered0.png">
    <link rel="stylesheet" href="./style/bootstrap_fichier/bootstrap.min.css">
    <link rel="stylesheet" href="./style/mp.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@1,900&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Grape+Nuts&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <title>Restaurant | Ichiraku Miso</title>
</head>

<?php include('config/constants.php');
      ob_start(); ?>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
        <div class="container">
            <span class="navbar-brand text-white">ICHIRAKU MISO</span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="mx-auto"></div>
                      <ul class="navbar-nav">
                      <li class="nav-item">
                      <a class="nav-link text-white" href="<?=SITEURL; ?>">Acceuil</a>
                      </li>
                      <li class="nav-item">
                      <a class="nav-link text-white" href="<?=SITEURL; ?>categories.php">Catégories</a>
                      </li>
                      <li class="nav-item">
                      <a class="nav-link text-white" href="<?=SITEURL; ?>plats.php">Plats</a>
                      </li>
                      <li class="nav-item">
                      <a class="nav-link text-white" href="<?=SITEURL; ?>admin/login.php">Employées</a>
                      </li>
                      </ul>
                    </div>
                </div>
    </nav>

<script src="js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
      var nav = document.querySelector('nav');
      window.addEventListener('scroll', function () {
        if (window.pageYOffset > 100) {
          nav.classList.add('bg-dark', 'shadow');
        } else {
          nav.classList.remove('bg-dark', 'shadow');
        }
      });
    </script>