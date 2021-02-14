<?php

session_start();

$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$stato = "confermato";
$fattorini = array();

$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

    $stmt = $conn->prepare("UPDATE ordine SET stato = ? WHERE idOrdine = ?");
    $stmt->bind_param("si", $stato, $_POST['idOrdine']);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO notifiche VALUES (?, ?, ?, ?)");
    $stmt->bind_param('isss', $_POST['idOrdine'], $_SESSION['email'], $_POST['Cliente'],
     $stato);

     if ($stmt->execute()) {
         echo "ok";
     }
     else{
       echo "err";
     }
     $stmt->close();
  $conn->close();

?>
