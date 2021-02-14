<?php
$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$aule = array();

$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
  $stmt = $conn->prepare("SELECT * FROM aula");
  $stmt->execute();
    $result = $stmt->get_result();

    $output = array();
    while($row = $result->fetch_assoc()) {
      $output[] = $row;
    }
    foreach ($output as $key => $value) {
      $aula = array();
			$aula['idAula'] = $output[$key]['idAula'];
      $aula['locazione'] = $output[$key]['locazione'];
      $aule[$key] = $aula;
    }
    echo json_encode($aule);
    $stmt->close();


  //Invio query

  //Chiusura connessione con db

  $conn->close();

?>
