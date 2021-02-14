<?php

session_start();

$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$fatt_email = "";
$stato = "non confermato";

$conn =new mysqli($servername, $username, $password, $database);
  //Check della connessione
  if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
  }

$stmt = $conn->prepare("INSERT INTO ordine VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param('ississsds', $_POST['idOrdine'], $_POST['data'], $_POST['ora'],
                $_POST['prezzo'], $_POST['forn_email'], $_SESSION['email'],
                $fatt_email, $_POST['idAula'], $stato);
  if ($stmt->execute()) {
        echo "ok";
  }
  else{
    echo "err";
  }

  //Chiusura connessione con db
  $stmt->close();
  $conn->close();

?>
