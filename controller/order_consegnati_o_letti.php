<?php

session_start();

$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$ordini = array();
$clienti = array();
$cliente = array();
$aula = array();
$ordine = array();

$stato1 = "consegnato";
$stato2 = "letto";

$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}


      $stmt = $conn->prepare("SELECT * FROM ordine WHERE fornitore_email = ?
                              AND fattorino_email = ? AND stato = ? OR stato = ? ");
      $stmt->bind_param("ssss", $_SESSION['forn_email'], $_SESSION['email'], $stato1, $stato2);
      $stmt->execute();
        $result = $stmt->get_result();

        $output = array();
        while($row = $result->fetch_assoc()) {
          $output[] = $row;
        }
        foreach ($output as $key => $value) {
					$ordini[$key] = $output[$key]['idOrdine'];
          $aula[$key]= $output[$key]['idAula'];

          $clienti[$key] = $output[$key]['cliente_email'];


        }
        $stmt->close();



    foreach ($clienti as $key => $value) {
      $stmt = $conn->prepare("SELECT * FROM cliente WHERE email = ?");
      $stmt->bind_param("s", $clienti[$key]);
      $stmt->execute();
        $result = $stmt->get_result();

        $output = array();
        while($row = $result->fetch_assoc()) {
          $output[] = $row;
        }
        foreach ($output as $key => $value) {

          array_push($cliente, $output[$key]);
        }


        $stmt->close();
    }


    foreach ($ordini as $key => $value) {
      $arr = array();
      $arr['idOrdine'] = $ordini[$key];
      $arr['idAula'] = $aula[$key];
      $arr['cliente'] = $cliente[$key];
      $ordine[$key] = $arr;
    }

    echo json_encode($ordine);





  //Invio query

  //Chiusura connessione con db

  $conn->close();

?>
