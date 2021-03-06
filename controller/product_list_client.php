<?php
session_start();

$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$prodotti = array();

$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
  $stmt = $conn->prepare("SELECT * FROM prodotto WHERE idListino = (
                          SELECT idListino FROM listino WHERE email = ?)");
  $stmt->bind_param("s", $_POST['email']);
  $stmt->execute();
    $result = $stmt->get_result();

    $output = array();
    while($row = $result->fetch_assoc()) {
      $output[] = $row;
    }
    foreach ($output as $key => $value) {
      $prodotto = array();
			$prodotto['immagine'] = $output[$key]['immagine'];
      $prodotto['id'] = $output[$key]['idProdotto'];
      $prodotto['nome'] = $output[$key]['nome'];
      $prodotto['prezzo'] = $output[$key]['prezzo'];
      $prodotto['tipo'] = $output[$key]['tipo'];
      $prodotto['descrizione'] = $output[$key]['descrizione'];
      $prodotti[$key] = $prodotto;
    }
    echo json_encode($prodotti);
    $stmt->close();


  //Invio query

  //Chiusura connessione con db

  $conn->close();

?>
