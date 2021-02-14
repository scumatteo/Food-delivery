<?php
session_start();
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
  <link href="../css/choose-product.css" rel="stylesheet" type="text/css" />
  <script src="../js/choose-product.js"></script>
      <script src="../js/footer.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <title>Choose Product</title>
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
          <li class="nav-item ml-3">
            <a class="nav-link" href="#"><i class="far fa-bell"></i></a>
          </li>
          <li class="nav-item ml-3">
            <a class="nav-link d-none d-md-block" href="#">Bentornato <?php echo $_SESSION["nome"] ?>!</a>
            <a class="nav-link d-block d-md-none" href="#"><i class="far fa-user"></i></a>
          </li>
          <li class="nav-item ml-3">
            <a id="cartButton" class="nav-link" href="#"><i class="fas fa-shopping-cart"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  </nav>

  <div class="main-container">
    <div class="filters-container" id="filtersSupportedContent">
      <h2>Filtri</h2>
    </div>
    <div class="products-container">
      <h2>Scegli i prodotti</h2>
    </div>
  </div>

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
</body>

  <?php include_once("footer.php") ?>
</html>
