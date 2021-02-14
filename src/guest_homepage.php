<?php
session_start();
$cookie_name = "user";
$cookie_value = "";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30 * 12), "/");
session_unset();
?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="../js/jquery-3.2.1.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <link href="../css/guest_homepage.css" rel="stylesheet" type="text/css" />
    <script src="../js/guest_homepage.js"></script>
    <script src="../js/footer.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <title>Guest Homepage</title>
</head>
<body>
  <nav class="navbar navbar-expand-md"> <!-- black: navbar-dark bg-dark -->
    <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="../index.php">
        <img src="../img/logo.png" alt="logo">
      </a>
    </div>
    <div class="nav-guest-items ml-md-auto" style="display: inline-block;">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="fas fa-bars" style="font-size:30px;color:#017cff"></i></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mr-3">
            <a id="loginButton" class="nav-link" href="#">Accedi</a>
          </li>
          <li class="nav-item mr-3">
            <a id="registerButton" class="nav-link" href="#">Registrati</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  </nav>
  <section>
    <h1>Ordina online i tuoi piatti preferiti!</h1>
      <p>Migliaia di ristoranti a portata di tap!</p>
      <div class="row">
        <div class="col-12">
          <i class="fas fa-map-marker-alt" style="font-size: 35px;"></i> Consegna nella tua università
        </div>
        <div class="col-12">
          <img id="campus" src="../img/campus.png" alt="Campus">
        </div>
      </div>
    </section>

  <div class="user-modal">
    <div class="user-modal-content">
      <span class="modal-close">&times;</span>
      <div class="breadcrumb-container">
      </div>
      <h2></h2>
      <p></p>
      <div id="popupInput"></div>
      <h4 id="avanti"><i class="fas fa-arrow-circle-down fa-4x"></i></h4>
    </div>
  </div>

  <div class="login-modal">
    <div class="login-modal-content">
      <span class="login-modal-close">&times;</span>
      <div class="breadcrumb-container-login">
      </div>
      <h2></h2>
      <p></p>
      <div id="loginPopupInput"></div>
      <h4 id="loginAvanti"><i class="fas fa-arrow-circle-down fa-4x"></i></h4>
    </div>
  </div>
</body>

<?php include_once("footer.php") ?>
</html>
