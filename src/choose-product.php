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
  <script src="../js/sidebar-cart.js"></script>
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
            <a class="nav-link d-none d-md-block" href="#">Bentornato <?php echo $_SESSION["nome"] ?>!</a>
            <a class="nav-link d-block d-md-none" href="registered_homepage.php"><i class="far fa-user" title="user icon to go back to homepage"></i></a>
          </li>
          <li class="nav-item ml-3">
            <a id="cartButton" class="nav-link" href="#"><i class="fas fa-shopping-cart" title="cart icon for shopping"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  </nav>

  <div class="main-container">
    <div class="filters-container" id="filtersSupportedContent">
      <h2>Filtri<i class="arrow down"></i></h2>
    </div>
    <div class="products-container">
      <h2>Scegli i prodotti</h2>
    </div>
  </div>
</body>
  <div class="sidebar-cart" id="menu-cart">
    <a href="javascript:void(0)" class="closebtn">X</a>
    <div id='cart-cards' class='card-group'>
      <!-- Cart card products here from sidebar-cart.js -->
    </div>
      <div class="container-fluid">
        <div class="control-cart-btns row">
        <button type="button" id="delete-cart" class="btn btn-secondary ml-auto">Delete All</button>
        <button type="button" id="ok-cart" class="btn btn-success ml-auto">Check out</button>
        </div>
      </div>
  </div>

  <?php include_once("footer.php") ?>
</html>
