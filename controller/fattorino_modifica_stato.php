<?php

session_start();
$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$stato = $_POST['stato'];

$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

    $stmt = $conn->prepare("UPDATE notifiche SET stato = ? WHERE idOrdine = ?");
    $stmt->bind_param("si", $_POST['stato'], $_POST['idOrdine']);
    if($stmt->execute()){
      echo "ok";
    }
    $stmt->close();
		if($stato == "in consegna"){
			$stmt = $conn->prepare("UPDATE ordine SET stato = ?, fattorino_email = ? WHERE idOrdine = ?");
	    $stmt->bind_param("ssi", $_POST['stato'], $_SESSION['email'], $_POST['idOrdine']);
	    if($stmt->execute()){
	      echo "ok";
	    }
	    $stmt->close();
		}
		else{
			$stmt = $conn->prepare("UPDATE ordine SET stato = ? WHERE idOrdine = ?");
	    $stmt->bind_param("si", $_POST['stato'], $_POST['idOrdine']);
	    if($stmt->execute()){
	      echo "ok";
	    }
	    $stmt->close();
		}

  $conn->close();

?>
