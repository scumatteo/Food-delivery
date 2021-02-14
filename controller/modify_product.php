<?php
$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

    $stmt = $conn->prepare("UPDATE prodotto SET immagine = ?, nome = ?, prezzo = ?, tipo = ?,
														descrizione = ? WHERE idProdotto = ?");
    $stmt->bind_param("ssdssi", $_POST['immagine'], $_POST['nome'], $_POST['prezzo'],
		 									$_POST['tipo'], $_POST['descrizione'], $_POST['id']);
    if($stmt->execute()){
      echo "ok";
    }
    $stmt->close();
  $conn->close();

?>
