<?php
$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

    $stmt = $conn->prepare("DELETE FROM prodotto WHERE idProdotto = ?");
    $stmt->bind_param("i", $_POST['id']);
    if($stmt->execute()){
      echo "ok";
    }
    $stmt->close();
  $conn->close();

?>
