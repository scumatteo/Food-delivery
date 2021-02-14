<?php

session_start();

$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$stato = "consegnato";
$ordine = array();
$ordini = array();

$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
  $stmt = $conn->prepare("SELECT idOrdine FROM notifiche WHERE cli_email = ? AND stato = ?");
  $stmt->bind_param("ss", $_SESSION["email"], $stato);
  $stmt->execute();
    $result = $stmt->get_result();
    $output = array();
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
	      $output[] = $row;
	    }
		}

    foreach ($output as $key => $value) {
      $ordine[$key] = $output[$key];
    }

    foreach ($ordine as $key => $value) {
      $stmt2 = $conn->prepare("SELECT * FROM ordine WHERE idOrdine = ?");
      $stmt2->bind_param("i", $ordine[$key]['idOrdine']);
      $stmt2->execute();
        $result2 = $stmt2->get_result();
        $output2 = array();
        while($row2 = $result2->fetch_assoc()) {
          $output2[] = $row2;
        }
        foreach ($output2 as $key => $value) {
          $arr = array();
          $arr[$key] = $output2[$key];
          array_push($ordini, $arr);
        }
				$stmt2->close();
    }
    echo json_encode($ordini);

    $stmt->close();









  //Invio query

  //Chiusura connessione con db

  $conn->close();

?>
