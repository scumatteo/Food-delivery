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
  <link href="../css/admin_page.css" rel="stylesheet" type="text/css" />
  <script src="../js/admin.js" type="text/javascript">

  </script>
      <script src="../js/footer.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <title>Admin Page</title>
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
        <a class="nav-link d-block d-md-none" href="#"><i class="far fa-user" title="user icon to logout"></i></a>
        <div class="dropdown-content">
          <a href="guest_homepage.php">Esci</a>
        </div>
      </li>
    </ul>
    </div>
  </div>
  </nav>
  <div class="modify-utente">
    <div id="modifica-utente">
      <h2>Modifica i dati di un utente</h2>
    </div>
  </div>
  <button class="edit-account-button btn btn warning">Modifica Account</button>
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-3 mt-4 mb-2 insert-button">
        <div id="insertAula">
          <h2>Inserisci nuova aula</h2>
        </div>
        <button class="add-aula-button btn btn-success">Inserisci Aula</button>
      <div class="col-12 col-sm-3 mt-4 mb-3 aule-list">
        <nav class="nav nav-pills flex-row" id="aula-list">
        </nav>
      </div>
      </div>
        </div>
      </div>

      <div class="edit-modal">
        <div class="edit-modal-content">
          <span class="edit-modal-close">&times;</span>
          <h2>Modifica</h2>
          <div class="edit-modal-container">
            <div class="edit">
              <div class="edit-item"><p>Email</p></div>
              <div class="edit-item"><input for="image" type="email" placeholder=""></div>
            </div>
            <div class="edit">
              <div class="edit-item"><p>Nuova email</p></div>
              <div class="edit-item"><input for="image" type="email" placeholder=""></div>
            </div>
            <div class="edit">
              <div class="edit-item"><p>Nuova password</p></div>
              <div class="edit-item"><input for="name" type="text" placeholder=""></div>
            </div>
            <div class="edit">
              <div class="edit-item"><p>Nome</p></div>
              <div class="edit-item"><input for="image" type="text" placeholder=""></div>
            </div>
            <div class="edit">
              <div class="edit-item"><p>Cognome</p></div>
              <div class="edit-item"><input for="image" type="text" placeholder=""></div>
            </div>
            <div class="edit">
              <div class="edit-item"><p>Tipo</p></div>
              <div class="edit-item"><select><option selected disabled></option><option value="cliente">Cliente</option><option value="fornitore">Fornitore</option><option value="fattorino">Fattorino</option></select></div>
            </div>
            <div id="edit-person" class="button">
              <a href="#" class="btn btn-success">Salva <i class="fas fa-check"></i></a>
            </div>
          </div>
        </div>
      </div>

          <div class="insert-modal">
            <div class="insert-modal-content">
              <span class="insert-modal-close">&times;</span>
              <div class="insert-modal-container">
                <h2>Inserisci</h2>
                <div class="insert-aula">
                  <div class="insert-aula-item"><p>Numero</p></div>
                  <div class="insert-aula-item"><input for="image" type="text" placeholder=""></div>
                </div>
                <div class="insert-aula">
                  <div class="insert-aula-item"><p>Locazione</p></div>
                  <div class="insert-aula-item"><input for="name" type="text" placeholder="Piano"></div>
                </div>
                <div id="inserisci-aula" class="button">
                  <a href="#" class="btn btn-primary">Inserisci <i class="fas fa-upload"></i></a>
                </div>
              </div>
            </div>
          </div>

  </body>

  <?php include_once("footer.php") ?>
</html>
