<?php

session_start();

$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$query_select_prodotto="SELECT idProdotto FROM prodotto ORDER BY idProdotto DESC LIMIT 1";

$conn =new mysqli($servername, $username, $password, $database);
  //Check della connessione
  if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
  }

  $idProdotto = 0;

  $result=$conn->query($query_select_prodotto);
  if($result!==FALSE){
    if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
        $MaxProdotto = $row["idProdotto"];
      }
      $idProdotto = $MaxProdotto + 1;
    }
  }

$stmt = $conn->prepare("INSERT INTO prodotto VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param('issdssi', $idProdotto, $_POST['immagine'], $_POST['nome'], $_POST['prezzo'],
                $_POST['tipo'], $_POST['descrizione'], $_SESSION['idListino']);

if(isset($_POST['immagine']) && isset($_POST['nome']) && isset($_POST['prezzo']) && isset($_POST['tipo'])
&& isset($_POST['descrizione']) && !empty($_POST['immagine']) && !empty($_POST['nome']) &&
!empty($_POST['prezzo']) && !empty($_POST['tipo']) && !empty($_POST['descrizione'])){

    if ($stmt->execute()) {
        echo "ok";
    }
  }
  else{
    echo "err";
  }

  //Chiusura connessione con db
  $stmt->close();
  $conn->close();

?>
