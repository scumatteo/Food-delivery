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
  <script src="../js/messenger_page.js" type="text/javascript"></script>
      <script src="../js/footer.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <title>EatALot</title>
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
          <li id ="accountList" class="nav-item ml-3 dropdown">
            <a id="accountButton" class="nav-link d-none d-md-block" href="#">Bentornato <?php echo $_SESSION["nome"] ?>!</a>
            <a class="nav-link d-block d-md-none" href="#"><i class="far fa-user" title="user image for logout"></i></a>
            <div id="account-menu" class="dropdown-content">
              <a class="dropdown-item" href="guest_homepage.php">Esci</a>
            </div>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="container-fluid todo">
      <a href="#">Scegli un ordine per iniziare</a>
      <div id="todo" class="card-group">
      </div>
    </div>
    <div class="container-fluid todo">
      <a href="#">In consegna</a>
      <div id="shipping" class="card-group">
      </div>
    </div>
    <div class="container-fluid todo">
      <a href="#">Consegnati</a>
      <ul id='shipped' class="list-group">
      </ul>
    </div>

  </body>
    <?php include_once("footer.php") ?>
    </html>
