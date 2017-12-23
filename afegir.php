<?php
	include("connect.php");
	
	$mysqli = new mysqli($server, $user, $pass, $db);
	
	if ($mysqli->connect_errno) 
	{
		echo "Error: Fallo al conectarse a MySQL debido a: <br>";
		echo "Errno: " . $mysqli->connect_errno . "<br>";
		echo "Error: " . $mysqli->connect_error . "<br>";
		exit;
	}

	
	if (isset($_GET['value']) && is_numeric($_GET['value'])) {
		$valor = $_GET['value'];
	} else {
		$valor = 0;
	}
	$sql = "INSERT INTO temp_data(temp) VALUES ('" . $valor . "')"; 
		
		
	if (!$resultado = $mysqli->query($sql)) {
		echo "Error: La ejecución de la consulta falló debido a: \n";
		echo "Query: " . $sql . "<br>";
		echo "Errno: " . $mysqli->errno . "<br>";
		echo "Error: " . $mysqli->error . "<br>";
		exit;
	}		
	else
	{
		echo "Valor afegit: " . $valor . "\n";		
	}		


?>