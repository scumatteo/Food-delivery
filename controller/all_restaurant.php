<?php
$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$sellers = array();

$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
  $stmt = $conn->prepare("SELECT * FROM fornitore");
  $stmt->execute();
    $result = $stmt->get_result();

    $output = array();
    while($row = $result->fetch_assoc()) {
      $output[] = $row;
    }
    foreach ($output as $key => $value) {
      $seller = array();
      $seller['ristorante'] = $output[$key]['ristorante'];
      $seller['immagine'] = $output[$key]['immagine'];
      $seller['email'] = $output[$key]['email'];
      $seller['telefono'] = $output[$key]['telefono'];
      $seller['descrizione'] = $output[$key]['descrizione'];
      $sellers[$key] = $seller;
    }
    echo json_encode($sellers);
    $stmt->close();


  //Invio query

  //Chiusura connessione con db

  $conn->close();

?>
