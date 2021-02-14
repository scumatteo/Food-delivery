<?php

?>

<!DOCTYPE html>
<html lang="it">
<script src="../js/jquery-3.2.1.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../css/help.css" rel="stylesheet" type="text/css" />
  <script src="../js/footer.js"></script>
  <script src="../js/help_page.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <title>Help Page</title>
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
          <span class="navbar-toggler-icon retry"><i class="fas fa-arrow-left" style="font-size:30px;color:#017cff"></i></span>
        </button>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mr-3">
              <a class="nav-link active retry" href="#">Back</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <section>
    <div class="title">
      <h1>Come funziona</h1>
    </div>
    <h2>Non sei ancora registrato? Corri a iscriverti!</h2>
    <p>Bastano poche semplici mosse per poter ordinare un ottimo pasto a domicilio.</p>
    <h2>Sei un utente registrato? Effettua il login!</h2>
    <p>Puoi cercare e aggiungere al carrello centinaia di prodotti diversi! Ti basterà scorrere l'elenco
      dei listini e aggiungere al carrello i prodotti di tuo interesse. Una volta fatto ciò potrai pagare con i metodi di pagamento
      troverai in fondo alla pagina. Selezionando il luogo di consegna, ti verranno recapitati i prodotti che hai scelto in quel luogo
      in pochissimo tempo! Provare per credere.</p>
      <h2>Metodi di pagamento</h2>
      <div class="payment">
        <i class="fab fa-cc-visa" title="visa card"style="font-size: 30px;"></i>
        <i class="fab fa-paypal" title="paypal" style="font-size: 30px;"></i>
        <i class="fab fa-cc-mastercard" title="mastercard"style="font-size: 30px;"></i>
        <i class="fas fa-money-bill" title="money bill" style="font-size: 30px;"></i>
      </div>
    </section>
  </body>
  <?php include_once("footer.php") ?>
  </html>
