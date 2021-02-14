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

$stmt = $conn->prepare("UPDATE utente SET email = ?, password = ? WHERE email = ?");
$stmt->bind_param('sss', $_POST['new_email'], $_POST['password'], $_POST['email']);
if($stmt->execute()){
  echo "ok";
}
else {
  echo "err";
}
  $stmt->close();
if($_POST['tipo'] == "cliente"){
  $stmt = $conn->prepare("UPDATE cliente SET email = ?, nome = ?, cognome = ? WHERE email = ?");
  $stmt->bind_param('ssss', $_POST['new_email'], $_POST['nome'], $_POST['cognome'], $_POST['email']);
  if($stmt->execute()){
    echo "ok";
  }
  else{
    echo "err";
  }
    $stmt->close();
}

else if($_POST['tipo'] == "fornitore"){
    $stmt = $conn->prepare("UPDATE cliente SET email = ?, nome = ?, cognome = ? WHERE email = ?");
  $stmt->bind_param('ssss', $_POST['new_email'], $_POST['nome'], $_POST['cognome'], $_POST['email']);
  if($stmt->execute()){
    echo "ok";
  }
  else{
    echo "err";
  }
    $stmt->close();
}

else if($_POST['tipo'] == "fattorino"){
    $stmt = $conn->prepare("UPDATE cliente SET email = ?, nome = ?, cognome = ? WHERE email = ?");
  $stmt->bind_param('ssss', $_POST['new_email'], $_POST['nome'], $_POST['cognome'], $_POST['email']);
  if($stmt->execute()){
    echo "ok";
  }
  else{
    echo "err";
  }
    $stmt->close();
}




  $conn->close();

?>
