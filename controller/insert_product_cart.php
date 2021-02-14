<?php

session_start();

$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$idProdotto_in_carrello = 0;

$conn =new mysqli($servername, $username, $password, $database);
  //Check della connessione
  if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
  }

  $stmt = $conn->prepare("SELECT idProdotto_in_carrello FROM prodotto_in_carrello
                          WHERE idCarrello = ?
                          ORDER BY idProdotto_in_carrello DESC LIMIT 1");
  $stmt->bind_param("i", $_SESSION["idCarrello"]);
  $stmt->execute();
  $result=$stmt->get_result();
  if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()) {
      $MaxProdotto = $row["idProdotto"];
    }
    $idProdotto_in_carrello = $MaxProdotto + 1;
  }
  $stmt->close();

$stmt = $conn->prepare("INSERT INTO prodotto_in_carrello VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param('iiidi', $_SESSION['idCarrello'], $idProdotto_in_carrello,
  $_POST['quantità'], $_POST['prezzo'], $_POST['id']);
  if ($stmt->execute()) {
        echo "ok";
  }
  else{
    echo $stmt->execute();
  }

  //Chiusura connessione con db
  $stmt->close();
  $conn->close();

?>
