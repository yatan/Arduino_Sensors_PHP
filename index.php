<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<META NAME="author" CONTENT="Fran Romero https://github.com/yatan">
	<META NAME="keywords" CONTENT="arduino, sensors, spirulina">
	<META NAME="description" CONTENT="Get data, process and visualize arduino sensors">
	<title>Sensors</title>
	<link rel="stylesheet" href="estil.css">
</head>

<a id="boto1" class="button" href="seleccio.html">Selecció Dades</a>
<a id="boto2" class="button" href="view.html">Vista Gràfica</a><br><br>

<?php
	include("connect.php");
	
	$mysqli = new mysqli($server, $user, $pass, $db);
	
	if ($mysqli->connect_errno) 
	{
		echo "Error: Fallo al conectarse a MySQL debido a: \n";
		echo "Errno: " . $mysqli->connect_errno . "\n";
		echo "Error: " . $mysqli->connect_error . "\n";
		exit;
	}

	
	$sql = "SELECT data, temp FROM temp_data ORDER BY 1 DESC";
	$result = $mysqli->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "Data: " . $row["data"]. " - Temperatura: " . $row["temp"]. "<br>";
		}
	} else {
		echo "0 results";
	}
	$mysqli->close();

?>