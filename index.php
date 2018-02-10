<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<META NAME="author" CONTENT="Fran Romero https://github.com/yatan">
	<META NAME="keywords" CONTENT="arduino, sensors, spirulina">
	<META NAME="description" CONTENT="Get data, process and visualize arduino sensors">
	<title>Sensors</title>
	<link rel="stylesheet" href="estil.css">

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

	<script>

	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});

	$( function() {
		$( "#tabs" ).tabs();
	} );
  </script>
</head>

<body>
<div class="se-pre-con"></div>


<a id="boto1" class="button" href="seleccio.html">Selecció Dades</a>
<a id="boto2" class="button" href="view.html">Vista Gràfica</a><br><br>

<div id="tabs">
  <ul>
    <li><a href="#temp-1">Temp 1</a></li>
	<li><a href="#temp-2">Temp 2</a></li>
	<li><a href="#temp-3">Temp 3</a></li>
	<li><a href="#temp-4">Temp 4</a></li>
	<li><a href="#temp-5">Temp 5</a></li>

    <li><a href="#ambient-1">Temp Ambient 1</a></li>
    <li><a href="#ambient-2">Temp Ambient 2</a></li>

	<li><a href="#lux-1">Lux Ambient 1</a></li>
	<li><a href="#lux-2">Lux Ambient 2</a></li>
	<li><a href="#lux-3">Lux Ambient 3</a></li>
	<li><a href="#lux-4">Lux Ambient 4</a></li>

	<li><a href="#laser-1">Laser 1</a></li>
	<li><a href="#laser-2">Laser 2</a></li>
	<li><a href="#laser-3">Laser 3</a></li>
	
  </ul>


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
		echo '<div id="temp-'.$i.'">';
		//echo '<div style="float:left; padding-right:50px;"> Temperatura '.$i.'<br>';

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

		//echo '</div>';
		echo '</div>';
	}

	// Reading from Ambient Temperature 1 and 2
	for($i=1;$i<=2;$i++)
	{
		echo '<div id="ambient-'.$i.'">';
		//echo '<div style="float:left; padding-right:50px;"> Temperatura ambient '.$i.'<br>';

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
		//echo '</div>';
	}


	// Reading ambiental lux 1 to 4
	for($i=1;$i<=4;$i++)
	{
		echo '<div id="lux-'.$i.'">';

		echo '</div>';
	}

	// Reading laser lux 1 to 3
	for($i=1;$i<=3;$i++)
	{
		echo '<div id="laser-'.$i.'">';

		echo '</div>';
	}



	$mysqli->close();

?>

</div>
</body>
</html>