<?php
$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$types = array();

$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
  $stmt = $conn->prepare("SELECT tipo FROM prodotto");
  $stmt->execute();
    $result = $stmt->get_result();

    $output = array();
    while($row = $result->fetch_assoc()) {
      $output[] = $row['tipo'];
    }

    echo json_encode($output);
    $stmt->close();


  //Invio query

  //Chiusura connessione con db

  $conn->close();

?>
