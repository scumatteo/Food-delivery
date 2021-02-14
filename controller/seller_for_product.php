<?php

session_start();

$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
  $stmt = $conn->prepare("SELECT email FROM listino WHERE idListino = (
                            SELECT idListino FROM prodotto WHERE idProdotto = (
                            SELECT idProdotto FROM prodotto_in_carrello WHERE idCarrello = ? LIMIT 1))");
  $stmt->bind_param("i", $_SESSION["idCarrello"]);
  $stmt->execute();
    $result = $stmt->get_result();
    $output = array();
    while($row = $result->fetch_assoc()) {
      $output[] = $row;
    }
    echo json_encode($output);
    $stmt->close();


  //Invio query

  //Chiusura connessione con db

  $conn->close();

?>
