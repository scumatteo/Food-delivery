<?php

session_start();

$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$prodotti = array();
$prodotti_in_carrello = array();
$final_product = array();

$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
  $stmt = $conn->prepare("SELECT * FROM prodotto_in_carrello WHERE idCarrello = ?");
  $stmt->bind_param("i", $_SESSION["idCarrello"]);
  $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
      $output = array();
      while($row = $result->fetch_assoc()) {
        $output[] = $row;
      }
	  foreach ($output as $key => $value) {
      $prodotto = array();
			$prodotto['idProdotto'] = $output[$key]['idProdotto'];
			$prodotto['porzioni'] = $output[$key]['porzioni'];
      $prodotto['prezzo_tot'] = $output[$key]['prezzo_tot'];
      $prodotti_in_carrello[$key] = $prodotto;
    }
    $stmt->close();

		foreach ($prodotti_in_carrello as $key => $value) {
			$stmt = $conn->prepare("SELECT * FROM prodotto WHERE idProdotto = ?");
		  $stmt->bind_param("i", $prodotti_in_carrello[$key]['idProdotto']);
		  $stmt->execute();
		    $result = $stmt->get_result();
		    if($result->num_rows > 0){
		      $output = array();
		      while($row = $result->fetch_assoc()) {
		        $output[] = $row;
		      }
		    }
		    foreach ($output as $key => $value) {
		      $prodotto = array();
					$prodotto['idProdotto'] = $output[$key]['idProdotto'];
					$prodotto['immagine'] = $output[$key]['immagine'];
		      $prodotto['nome'] = $output[$key]['nome'];
					$prodotto['tipo'] = $output[$key]['tipo'];
		      $prodotto['descrizione'] = $output[$key]['descrizione'];
		      array_push($prodotti, $prodotto);
		    }
		    $stmt->close();
		}

				foreach ($prodotti_in_carrello as $key => $value) {
					$prodotto = array();
					$prodotto['idProdotto'] = $prodotti[$key]['idProdotto'];
					$prodotto['immagine'] = $prodotti[$key]['immagine'];
		      $prodotto['nome'] = $prodotti[$key]['nome'];
					$prodotto['tipo'] = $prodotti[$key]['tipo'];
		      $prodotto['descrizione'] = $prodotti[$key]['descrizione'];
					$prodotto['porzioni'] = $prodotti_in_carrello[$key]['porzioni'];
		      $prodotto['prezzo_tot'] = $prodotti_in_carrello[$key]['prezzo_tot'];
					array_push($final_product, $prodotto);
				}

				echo json_encode($final_product);
    }

    




  //Invio query

  //Chiusura connessione con db

  $conn->close();

?>
