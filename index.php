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

	// Reading from Temp1 to Temp5
	for($i=1;$i<=5;$i++)
	{
		echo '<div style="float:left; padding-right:50px;"> Temperatura '.$i.'<br>';

		$sql = "SELECT data, temp, sensor_id FROM temp".$i."_data ORDER BY 1 DESC";
		$result = $mysqli->query($sql);
	
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "Data: " . $row["data"]. " - Temperatura: " . $row["temp"]. " - Arduino: ".$row["sensor_id"]."<br>";
			}
		} else {
			echo "0 results";
		}

		echo '</div>';
	}

	// Reading from Ambient Temperature 1 and 2
	for($i=1;$i<=2;$i++)
	{
		echo '<div style="float:left; padding-right:50px;"> Temperatura ambient '.$i.'<br>';

		$sql = "SELECT data, temp, sensor_id FROM ta".$i."_data ORDER BY 1 DESC";
		$result = $mysqli->query($sql);
	
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "Data: " . $row["data"]. " - Temperatura: " . $row["temp"]. " - Arduino: ".$row["sensor_id"]."<br>";
			}
		} else {
			echo "0 results";
		}

		echo '</div>';
	}
	



	$mysqli->close();

?>