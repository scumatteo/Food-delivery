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
  <link href="../css/checkout.css" rel="stylesheet" type="text/css" />
  <script src="../js/checkout.js"></script>
  <script src="../js/footer.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <title>Choose Product</title>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
        <span class="navbar-toggler-icon"><i class="fas fa-bars" title="hamburger icon for menu" style="font-size:30px;color:#017cff"></i></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item ml-3">
            <a class="nav-link d-none d-md-block" href="#">Bentornato <?php echo $_SESSION["nome"] ?>!</a>
            <a class="nav-link d-block d-md-none" href="registered_homepage.php"><i class="far fa-user" title="user icon to back to homepage"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  </nav>

  <div class="main-container">
    <div class="products-container" id="filtersSupportedContent">
      <h2>Riepilogo</h2>
    </div>
    <div class="checkout-container">
      <h2>Termina il checkout</h2>
      <p>Scegli quando</p>
      <div id='datepicker'></div>
	  <p>Inserisci un orario per la consegna</p>
	  <div class="choose-hour">
        <input placeholder="00:00"></input>
      </div>
      <p>Scegli un'aula per la consegna</p>
      <div class="choose-place">
        <select></select>
      </div>
      <p>Scegli un metodo di pagamento</p>
      <div class="payment">
        <label for="paymentPaypal"><input id="paymentPaypal" type="radio" name="payment" value="paypal"> PayPal</label><br>
        <label for="paymentVisa"><input id="paymentVisa" type="radio" name="payment" value="visa"> Visa</label><br>
        <label for="paymentMastercard"><input id="paymentMastercard" type="radio" name="payment" value="mastercard"> Mastercard</label><br>
        <label for="paymentCash"><input id="paymentCash" type="radio" name="payment" value="contanti"> Contanti</label><br>
      </div>
      <button class="checkout-button btn btn-success" type="button">Termina Checkout!</button>
    </div>
  </div>

  <?php include_once("footer.php") ?>
</html>
