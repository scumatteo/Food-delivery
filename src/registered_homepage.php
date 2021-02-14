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
  <link href="../css/registered_homepage.css" rel="stylesheet" type="text/css" />
  <script src="../js/sidebar-cart.js"></script>
  <script src="../js/registered_homepage.js"></script>
  <script src="../js/footer.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <title>Registered Homepage</title>
</head>
<body>
  <!-- REGISTERED NAVBAR -->
  <nav class="navbar navbar-expand-md"> <!-- black: navbar-dark bg-dark -->
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="../index.php">
          <img src="../img/logo.png" alt="logo">
        </a>
      </div>
      <div class="nav-guest-items ml-3 ml-md-auto"> <!-- for registered user -->
        <ul class="navbar-nav">
          <li class="nav-item ml-3 dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" href="#"> <!-- trigger button -->
              <i id="notification-bell" class="far fa-bell" title="bell image for notification"></i>
              <span class="badge"></span> <!-- Nr notifications -->
            </a>
            <div id="notification-list" class="dropdown-content"> <!-- dropdown -->
            </div>
          </li>
          <li id ="accountList" class="nav-item ml-3 dropdown">
            <a id="accountButton" class="nav-link d-none d-md-block" href="#">Bentornato <?php echo $_SESSION["nome"] ?>!</a>
            <a class="nav-link d-block d-md-none" href="#"><i class="far fa-user" title="user image for logout"></i></a>
            <div id="account-menu" class="dropdown-content">
              <a class="dropdown-item" href="guest_homepage.php">Esci</a>
            </div>
          </li>
          <li class="nav-item ml-3">
            <a id="cartButton" class="nav-link" href="#"><i class="fas fa-shopping-cart" title="cart item for shopping"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-3 mt-4 mb-3 shortcuts">
        <nav class="nav nav-pills flex-row" id="navbar-categories">
        </nav>
      </div>
      <div class="col-12 col-sm-3 mt-4 mb-2 manufacters" data-spy="scroll" data-offset="0">
        <div class="card-group">
        </div>
      </div>
    </div>
  </div>
</body>
<div class="sidebar-cart" id="menu-cart">
  <a href="javascript:void(0)" class="closebtn">X</a>
  <p class="h4" id="label-cart">
    Carrello
  </p>
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
