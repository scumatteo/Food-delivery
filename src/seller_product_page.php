<?php
session_start();
?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="../css/seller_product_page.css" rel="stylesheet" type="text/css" />
  <link href="../css/registered_homepage.css" rel="stylesheet" type="text/css" />
    <script src="../js/seller_product_page.js"></script>
        <script src="../js/footer.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <title>Seller Product Page</title>
</head>
<body>
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
        <a class="nav-link d-block d-md-none" href="#"><i class="far fa-user" title="user icon to go back to homepage or to logout"></i></a>
        <div class="dropdown-content">
          <a href="seller_homepage.php">Homepage</a>
          <a href="guest_homepage.php">Esci</a>
        </div>
      </li>
    </ul>
    </div>
  </div>
  </nav>
  <div class="inserisci-prodotto">
    <div id="insertProd">
      <h2>Inserisci nuovo prodotto</h2>
    </div>
  </div>
  <div class="container-fluid">
    <div class="container-fluid list">
      <p class="h3">Lista dei tuoi prodotti</p>
      <div id="lista" class="card-group">
      </div>
    </div>
    </div>
  <div class="product-modal">
    <div class="product-modal-content">
      <span class="product-modal-close">&times;</span>
      <h2></h2>
      <div class="product-modal-container">
        <div class="edit-product">
          <div class="edit-product-item"><p>Id Prodotto:</p></div>
          <div class="edit-product-item"><input for="id" type="text" placeholder=""></div>
        </div>
          <div class="edit-product">
            <div class="edit-product-item"><p>Immagine:</p></div>
            <div class="edit-product-item"><input for="image" type="text" placeholder="url http://www."></div>
          </div>
          <div class="edit-product">
            <div class="edit-product-item"><p>Nome:</p></div>
            <div class="edit-product-item"><input for="name" type="text" placeholder=""></div>
          </div>
          <div class="edit-product">
            <div class="edit-product-item"><p>Prezzo:</p></div>
            <div class="edit-product-item"><input for="price" type="text" placeholder="00.00"></div>
          </div>
          <div class="edit-product">
            <div class="edit-product-type"><p>Tipo:</p></div>
            <div class="edit-product-type edit-type"><select></select></div>
          </div>
          <div class="edit-product">
            <div class="edit-product-item"><p>Descrizione:</p></div>
            <div class="edit-product-item"><input for="description" type="text" placeholder=""></div>
          </div>
          <div id="salva" class="button">
            <a href="#" class="btn btn-success">Salva <i class="fas fa-check"></i></a>
          </div>
      </div>


    </div>
  </div>
  <div class="trash-modal">
    <div class="trash-modal-content">
      <span class="trash-modal-close">&times;</span>
      <h2></h2>
      <div class="trash-modal-container">
        <div class="trash-product">
          <div class="trash-product-item"><p>Id Prodotto:</p></div>
        </div>
          <div class="trash-product">
            <div class="trash-product-item"><p>Immagine:</p></div>
          </div>
          <div class="trash-product">
            <div class="trash-product-item"><p>Nome:</p></div>
          </div>
          <div class="trash-product">
            <div class="trash-product-item"><p>Prezzo:</p></div>
          </div>
          <div class="trash-product">
            <div class="trash-product-item"><p>Tipo:</p></div>
          </div>
          <div class="trash-product">
            <div class="trash-product-item"><p>Descrizione:</p></div>
          </div>
          <div id="elimina" class="button">
            <a href="#" class="btn btn-danger">Elimina <i class="fas fa-trash-alt"></i></a>
          </div>
        </div>


    </div>
  </div>

  <div class="insert-modal">
    <div class="insert-modal-content">
      <span class="insert-modal-close">&times;</span>
      <h2>Inserisci</h2>
      <div class="insert-modal-container">
        <div class="insert-product">
          <div class="insert-product-item"><p>Immagine</p></div>
          <div class="insert-product-item"><input for="image" type="text" placeholder="url http://www."></div>
        </div>
        <div class="insert-product">
          <div class="insert-product-item"><p>Nome</p></div>
          <div class="insert-product-item"><input for="name" type="text" placeholder=""></div>
        </div>
        <div class="insert-product">
          <div class="insert-product-item"><p>Prezzo</p></div>
          <div class="insert-product-item"><input for="price" type="text" placeholder="00.00"></div>
        </div>
        <div class="insert-product">
          <div class="insert-product-type"><p>Tipo</p></div>
          <div class="insert-product-type insert-type"><select></select></div>
        </div>
        <div class="insert-product">
          <div class="insert-product-item"><p>Descrizione</p></div>
          <div class="insert-product-item"><input for="description" type="text" placeholder=""></div>
        </div>
        <div id="inserisci" class="button">
          <a href="#" class="btn btn-primary">Inserisci <i class="fas fa-upload"></i></a>
        </div>
      </div>


    </div>
  </div>
</body>

  <?php include_once("footer.php") ?>
</html>
