<?php

session_start();

$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$conn =new mysqli($servername, $username, $password, $database);
  //Check della connessione
  if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
  }

$stmt = $conn->prepare("INSERT INTO aula VALUES (?, ?)");
$stmt->bind_param('ds', $_POST['idAula'], $_POST['locazione']);
  if ($stmt->execute()) {
        echo "ok";
  }
  else{
    echo $stmt->execute();
  }

  //Chiusura connessione con db
  $stmt->close();
  $conn->close();

?>
