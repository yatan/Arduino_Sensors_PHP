<?php
    include("connect.php");
    date_default_timezone_set('Europe/Madrid');

    $data = $_POST['data'];
    
    if(!isset($_POST['data']) || $data == "")
        die('Falta data');

    
    $mysqli = new mysqli($server, $user, $pass, $db);
	
	if ($mysqli->connect_errno) 
	{
		echo "Error: Fallo al conectarse a MySQL debido a: \n";
		echo "Errno: " . $mysqli->connect_errno . "\n";
		echo "Error: " . $mysqli->connect_error . "\n";
		exit;
	}

    $data1 = date( "Y-m-d", strtotime($data));
    $data2 = date( "Y-m-d", strtotime($data .' +1 day'));

	$sql = "SELECT data, temp FROM temp_data WHERE data BETWEEN '$data1' AND '$data2'";
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