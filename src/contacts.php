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
  <link href="../css/contacts.css" rel="stylesheet" type="text/css" />
  <script src="../js/help_page.js"></script>
  <script src="../js/footer.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <title>Contacts Page</title>
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
          <span class="navbar-toggler-icon retry"><i class="fas fa-arrow-left" title="icon to go back" style="font-size:30px;color:#017cff"></i></span>
        </button>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mr-3">
              <a class="nav-link active retry" href="guest_homepage.php">Back</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <section>
    <h1>Chi siamo</h1>
    <p>Le nostre cucine sono selezionate in seguito a ispezioni e test da parte di esperti nel settore.
      Tutte devono rispettare norme igieniche precise.</p>
    </section>
    <section>
      <h1>Contatti</h1>
      <div class="row">
        <div class="col-12">
          <div class="evelope-img">
            <a href="mailto:eatalot@gmail.com"><i class="fas fa-envelope" title="icon of a envelope to send email" style="font-size: 30px;"></i></a>
            eatalot@gmail.com
          </div>
          <div class="telephone-img">
            <i class="fas fa-phone" title="phone number" style="font-size: 30px;"></i>
            3313704612
          </div>
        </div>
      </div>
    </section>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
  <?php include_once("footer.php") ?>
  </html>
