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

  $idOrdine = 0;
  $stmt = $conn->prepare("SELECT idOrdine FROM ordine
                          ORDER BY idOrdine DESC LIMIT 1");
  $stmt->execute();
  $result=$stmt->get_result();
  if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()) {
      $MaxProdotto = $row["idOrdine"];
    }
    $idOrdine = $MaxProdotto + 1;
  }
  echo $idOrdine;
  $stmt->close();
  $conn->close();

  ?>
