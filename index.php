<title>Sensors</title>
<a href="view.html">VISITA DADES</a><br><br>

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

	
	$sql = "SELECT data, temp FROM temp_data";
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