<?php

session_start();

$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";


$empty = "";

$conn =new mysqli($servername, $username, $password, $database);
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}
$stmt = $conn->prepare("SELECT * FROM utente WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $_POST['email'], $_POST['password']);
if($stmt->execute()){
  $result = $stmt->get_result();
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()) {
      $cookie_name = "user";
      $cookie_value = $row["email"];
      setcookie($cookie_name, $cookie_value, time() + (86400 * 30 * 12), "/");
      $_SESSION["email"] = $row["email"];
      if($row["FORNITORE"] != ""){
        $_SESSION["tipo"] = $row["FORNITORE"];
        $stmt_2 = $conn->prepare("SELECT * FROM fornitore WHERE email = ?");
        $stmt_2->bind_param("s", $row['email']);
        $stmt_2->execute();
        $result_fornitore = $stmt_2->get_result();
        if($result_fornitore->num_rows > 0){
          while($row_fornitore = $result_fornitore->fetch_assoc()) {
            $_SESSION["nome"] = $row_fornitore["nome"];
          }
        }
        $stmt_2->close();

        $stmt_2 = $conn->prepare("SELECT idListino FROM listino WHERE email = ?");
        $stmt_2->bind_param("s", $row['email']);
        $stmt_2->execute();
        $result_list = $stmt_2->get_result();
        if($result_list->num_rows > 0){
          while($row_list = $result_list->fetch_assoc()) {
            $_SESSION["idListino"] = $row_list["idListino"];
          }
        }
        $stmt_2->close();

        $stmt_2 = $conn->prepare("INSERT INTO session VALUES (?, ?, ?, ?, ?, ?)");
        $stmt_2->bind_param("ssssss", $_SESSION["email"], $_SESSION["tipo"],
                  $_SESSION["nome"],$empty, $_SESSION["idListino"], $empty);
        $stmt_2->execute();
        $stmt_2->close();

      }
      else if($row["CLIENTE"] != ""){
        $_SESSION["tipo"] = $row["CLIENTE"];
        $stmt_2 = $conn->prepare("SELECT nome FROM cliente WHERE email = ?");
        $stmt_2->bind_param("s", $row['email']);
        $stmt_2->execute();
        $result_cli = $stmt_2->get_result();
        if($result_cli->num_rows > 0){
          while($row_cli = $result_cli->fetch_assoc()) {
            $_SESSION["nome"] = $row_cli["nome"];
          }
        }
        $stmt_2->close();

        $stmt_2 = $conn->prepare("SELECT idCarrello FROM carrello WHERE email = ?");
        $stmt_2->bind_param("s", $row['email']);
        $stmt_2->execute();
        $result_carr = $stmt_2->get_result();
        if($result_carr->num_rows > 0){
          while($row_carr = $result_carr->fetch_assoc()) {
            $_SESSION["idCarrello"] = $row_carr["idCarrello"];
          }
        }
        $stmt_2->close();

        $stmt_2 = $conn->prepare("INSERT INTO session VALUES (?, ?, ?, ?, ?, ?)");
        $stmt_2->bind_param("ssssss", $_SESSION["email"], $_SESSION["tipo"],
                  $_SESSION["nome"], $empty, $empty, $_SESSION["idCarrello"]);
        $stmt_2->execute();
        $stmt_2->close();
      }
      else if($row["FATTORINO"] != ""){
        $_SESSION["tipo"] = $row["FATTORINO"];
        $stmt_2 = $conn->prepare("SELECT * FROM fattorino WHERE email = ?");
        $stmt_2->bind_param("s", $row['email']);
        $stmt_2->execute();
        $result_fatt = $stmt_2->get_result();
        if($result_fatt->num_rows > 0){
          while($row_fatt = $result_fatt->fetch_assoc()) {
            $_SESSION["nome"] = $row_fatt["nome"];
            $_SESSION["forn_email"] = $row_fatt["Dis_email"];
          }
        }
        $stmt_2->close();

        $stmt_2 = $conn->prepare("INSERT INTO session VALUES (?, ?, ?, ?, ?, ?)");
        $stmt_2->bind_param("ssssss", $_SESSION["email"], $_SESSION["tipo"],
                  $_SESSION["nome"], $_SESSION["forn_email"], $empty, $empty);
        $stmt_2->execute();
        $stmt_2->close();
      }
      else{
        $_SESSION["tipo"] = "admin";
        $_SESSION["nome"] = "amministratore";
        $stmt_2 = $conn->prepare("INSERT INTO session VALUES (?, ?, ?, ?, ?, ?)");
        $stmt_2->bind_param("ssssss", $_SESSION["email"], $_SESSION["tipo"],
                  $_SESSION["nome"], $empty, $empty, $empty);
        $stmt_2->execute();
        $stmt_2->close();
      }
    }

    echo $_SESSION["tipo"];
  }
  else{
    echo "err";
  }
}
else{
  echo "Errore: " . $query_check . "<br>" . $conn->error;
}


  $conn->close();

?>
