<?php
$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$query_select_listino="SELECT idListino FROM listino ORDER BY idListino DESC LIMIT 1";
$query_select_carrello="SELECT idCarrello FROM carrello ORDER BY idCarrello DESC LIMIT 1";

$conn =new mysqli($servername, $username, $password, $database);
  //Check della connessione
  if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
  }

  $result=$conn->query($query_select_listino);
  if($result!==FALSE){
    if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
        $MaxListino = $row["idListino"];
      }
      $idListino = $MaxListino + 1;
    }
    else{
        $idListino = 00000000;
    }
  }

  $result=$conn->query($query_select_carrello);
  if($result!==FALSE){
    if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
        $MaxCarrello = $row["idCarrello"];
      }
      $idCarrello = $MaxCarrello + 1;
    }
    else{
        $idCarrello = 00000000;
    }
  }

  $response = "";

if($_POST['type'] == 'cliente'){
  $forn = "";
  $fatt = "";
  $stmt = $conn->prepare("INSERT INTO cliente VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $_POST['email'], $_POST['name'], $_POST['surname']);
  if($stmt->execute()){
      $response .= "ok";
  }
  $stmt = $conn->prepare("INSERT INTO utente VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $_POST['email'], $_POST['password'], $fatt, $forn, $_POST['type']);
  if($stmt->execute()){
      $response .= "ok";
  }
  $stmt = $conn->prepare("INSERT INTO carrello VALUES (?, ?)");
  $stmt->bind_param("is", $idCarrello, $_POST['email']);
  if($stmt->execute()){
      $response .= "ok";
  }
}

if($_POST['type'] == 'fornitore'){
  $cli = "";
  $fatt = "";
  $stmt = $conn->prepare("INSERT INTO fornitore VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssssss", $_POST['email'], $_POST['name'], $_POST['surname'],
                            $_POST['cf'], $_POST['piva'], $_POST['tel'],
                            $_POST["ristorante"], $_POST["immagine"], $_POST["descrizione"]);
  if($stmt->execute()){
    $response .= "ok";
  }
  $stmt = $conn->prepare("INSERT INTO utente VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $_POST['email'], $_POST['password'], $fatt, $_POST['type'], $cli);
  if($stmt->execute()){
      $response .= "ok";
  }
  $stmt = $conn->prepare("INSERT INTO listino VALUES (?, ?)");
  $stmt->bind_param("is", $idListino, $_POST['email']);
  if($stmt->execute()){
      $response .= "ok";
  }
}

if($_POST['type'] == 'fattorino'){
  $cli = "";
  $forn = "";
  $stmt= $conn->prepare("INSERT INTO fattorino VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $_POST['email'], $_POST['name'], $_POST['surname'],
                      $_POST["email_forn"]);
  if($stmt->execute()){
      $response .= "ok";
  }
  $stmt = $conn->prepare("INSERT INTO utente VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $_POST['email'], $_POST['password'], $_POST['type'], $forn, $cli);
  if($stmt->execute()){
      $response .= "ok";
  }
  $response .= "ok";
}

  echo $response;


  $stmt->close();
  $conn->close();

?>
