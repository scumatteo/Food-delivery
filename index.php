<?php

$servername="localhost";
$username ="root";
$password ="";
$database = "applicazione";


$empty = "";

$conn =new mysqli($servername, $username, $password, $database);
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}

	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	
	if($_COOKIE['user'] == ""){
		header('Location: '.$uri.'/src/guest_homepage.php');
	}
	else{
		$stmt = $conn->prepare("SELECT * FROM session WHERE email = ?");
        $stmt->bind_param("s", $_COOKIE['user']);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
          while($row = $result->fetch_assoc()) {
			if($row['tipo'] == "fornitore"){
				$_SESSION["email"] = $row["email"];
				$_SESSION["tipo"] = $row["tipo"];
				$_SESSION["nome"] = $row["nome"];
				$_SESSION["idListino"] = $row["IDLISTINO"];
				header('Location: '.$uri.'/src/seller_homepage.php');
			}
			else if($row['tipo'] == "cliente"){				
				$_SESSION["email"] = $row["email"];
				$_SESSION["tipo"] = $row["tipo"];
				$_SESSION["nome"] = $row["nome"];
				$_SESSION["idCliente"] = $row["IDCLIENTE"];
				header('Location: '.$uri.'/src/registered_homepage.php');
			}
			else if($row['tipo'] == "fattorino"){				
				$_SESSION["email"] = $row["email"];
				$_SESSION["tipo"] = $row["tipo"];
				$_SESSION["nome"] = $row["nome"];
				$_SESSION["email_forn"] = $row["Dis_email"];
				header('Location: '.$uri.'/src/messenger_page.php');
			}
			else{
				$_SESSION["email"] = $row["email"];
				$_SESSION["tipo"] = $row["tipo"];
				$_SESSION["nome"] = $row["nome"];
				header('Location: '.$uri.'/src/admin_page.php');
			}
		  }
		}
        $stmt->close();	
	}
	exit;
?>