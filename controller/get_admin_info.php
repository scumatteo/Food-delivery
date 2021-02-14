<?php

session_start();

$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$admin = array();

$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
  $stmt = $conn->prepare("SELECT * FROM amministratore");
  $stmt->execute();
    $result = $stmt->get_result();

    $output = array();
    while($row = $result->fetch_assoc()) {
      $output[] = $row;
    }
    $admin = $output;
    echo json_encode($admin);
    $stmt->close();


  //Invio query

  //Chiusura connessione con db

  $conn->close();

?>
