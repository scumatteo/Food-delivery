<?php

session_start();

$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";

$prodotto_tot = array();
$prodotti = array();
$clienti = array();
$ordini = array();
$informazioni = array();

$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
  $stmt = $conn->prepare("SELECT * FROM ordine WHERE fornitore_email = ?");
  $stmt->bind_param("s", $_SESSION["email"]);
  $stmt->execute();
    $result = $stmt->get_result();

    $output = array();
    while($row = $result->fetch_assoc()) {
      $output[] = $row;
    }
    foreach ($output as $key => $value) {
      $ordine = array();
			$ordine['idOrdine'] = $output[$key]['idOrdine'];
			$ordine['Data'] = $output[$key]['data'];
      $ordine['Ora'] = $output[$key]['ora'];
      $ordine['Prezzo totale'] = $output[$key]['prezzo_tot'];
      $ordine['Aula'] = $output[$key]['idAula'];
      $ordine['Cliente'] = $output[$key]['cliente_email'];
      $ordine['Stato'] = $output[$key]['stato'];
      $ordini[$key] = $ordine;
    }

    $stmt->close();

    foreach ($ordini as $key => $value) {
      $stmt = $conn->prepare("SELECT * FROM prodotto_ordinato WHERE idProdotto_ordinato = ?");
      $stmt->bind_param("i", $ordini[$key]['idOrdine']);
      $stmt->execute();
        $result1 = $stmt->get_result();

        $output1 = array();
        while($row1 = $result1->fetch_assoc()) {
          $output1[] = $row1;
        }
        foreach ($output1 as $key1 => $value) {
          $prodotto = array();
          $prodotto['idProdotto'] = $output1[$key1]['idProdotto'];
          $prodotto['nome'] = $output1[$key1]['nome'];
          $prodotto['descrizione'] = $output1[$key1]['descrizione'];
          $prodotto['porzioni'] = $output1[$key1]['porzioni'];
          $prodotto['prezzo'] = $output1[$key1]['prezzo_tot'];
          $prodotti[$key1] = $prodotto;
        }
          $prodotto_tot[$key] = $prodotti;
        $stmt->close();

        $stmt=$conn->prepare("SELECT * FROM cliente WHERE email = ?");
        $stmt->bind_param("s", $ordini[$key]['Cliente']);
        $stmt->execute();
          $result1 = $stmt->get_result();

          $output1 = array();
          while($row1 = $result1->fetch_assoc()) {
            $output1[] = $row1;
          }
          foreach ($output1 as $key2 => $value) {
            $cliente = array();
            $cliente['nome'] = $output1[$key2]['nome'];
            $cliente['cognome'] = $output1[$key2]['cognome'];
            $clienti[$key] = $cliente;
          }
          $stmt->close();
    }

    foreach ($ordini as $key => $value) {
      $info = array();
      $info['Cliente'] = $ordini[$key]['Cliente'];
      $info['idOrdine'] = $ordini[$key]['idOrdine'];
      $info['Data'] = $ordini[$key]['Data'];
      $info['Ora'] = $ordini[$key]['Ora'];
      $info['Prezzo_totale'] = $ordini[$key]['Prezzo totale'];
      $info['Aula'] = $ordini[$key]['Aula'];
      $info['Stato'] = $ordini[$key]['Stato'];
      $info['Nome'] = $clienti[$key]['nome'];
      $info['Cognome'] = $clienti[$key]['cognome'];
      $info['Prodotti'] = $prodotto_tot[$key];
      $informazioni[$key] = $info;
    }

    echo json_encode($informazioni);





  //Invio query

  //Chiusura connessione con db

  $conn->close();

?>
