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

	// Reading ID arduino
	if (isset($_GET['idarduino']) && is_numeric($_GET['idarduino'])) {
		$id_arduino = $_GET['idarduino'];
	} else {
		die("Missing ID");
	}
	// Reading Sensor Temperature 1
	if (isset($_GET['temp1']) && is_numeric($_GET['temp1'])) {
		$temp1 = $_GET['temp1'];
	} else {
		$temp1 = 0;
	}
	// Reading Sensor Temperature 2
	if (isset($_GET['temp2']) && is_numeric($_GET['temp2'])) {
		$temp2 = $_GET['temp2'];
	} else {
		$temp2 = 0;
	}
	// Reading Sensor Temperature 3
	if (isset($_GET['temp3']) && is_numeric($_GET['temp3'])) {
		$temp3 = $_GET['temp3'];
	} else {
		$temp3 = 0;
	}
	// Reading Sensor Temperature 4
	if (isset($_GET['temp4']) && is_numeric($_GET['temp4'])) {
		$temp4 = $_GET['temp4'];
	} else {
		$temp4 = 0;
	}
	// Reading Sensor Temperature 5
	if (isset($_GET['temp5']) && is_numeric($_GET['temp5'])) {
		$temp5 = $_GET['temp5'];
	} else {
		$temp5 = 0;
	}
	// Reading Ambient Temperature 1
	if (isset($_GET['ta1']) && is_numeric($_GET['ta1'])) {
		$ta1 = $_GET['ta1'];
	} else {
		$ta1 = 0;
	}
	// Reading Ambient Temperature 2
	if (isset($_GET['ta2']) && is_numeric($_GET['ta2'])) {
		$ta2 = $_GET['ta2'];
	} else {
		$ta2 = 0;
	}	

	// Reading Ambient Light LDR 1
	if (isset($_GET['ldr1']) && is_numeric($_GET['ldr1'])) {
		$ldr1 = $_GET['ldr1'];
	} else {
		$ldr1 = 0;
	}	
	// Reading Ambient Light LDR 2
	if (isset($_GET['ldr2']) && is_numeric($_GET['ldr2'])) {
		$ldr2 = $_GET['ldr2'];
	} else {
		$ldr2 = 0;
	}	
	// Reading Ambient Light LDR 3
	if (isset($_GET['ldr3']) && is_numeric($_GET['ldr3'])) {
		$ldr3 = $_GET['ldr3'];
	} else {
		$ldr3 = 0;
	}	
	// Reading Ambient Light LDR 4
	if (isset($_GET['ldr4']) && is_numeric($_GET['ldr4'])) {
		$ldr4 = $_GET['ldr4'];
	} else {
		$ldr4 = 0;
	}	
	
	// Reading Laser Light LDR 1
	if (isset($_GET['laser1']) && is_numeric($_GET['laser1'])) {
		$laser1 = $_GET['laser1'];
	} else {
		$laser1 = 0;
	}	
	
	// Reading Laser Light LDR 2
	if (isset($_GET['laser2']) && is_numeric($_GET['laser2'])) {
		$laser2 = $_GET['laser2'];
	} else {
		$laser2 = 0;
	}	
	
	// Reading Laser Light LDR 3
	if (isset($_GET['laser3']) && is_numeric($_GET['laser3'])) {
		$laser3 = $_GET['laser3'];
	} else {
		$laser3 = 0;
	}		


	try {
		// First of all, let's begin a transaction
		$mysqli->begin_transaction();
	
		// A set of queries; if one fails, an exception should be thrown
		$mysqli->query("INSERT INTO temp1_data(temp, sensor_id) VALUES ('" . $temp1 . "', '" .$id_arduino. "')");
		$mysqli->query("INSERT INTO temp2_data(temp, sensor_id) VALUES ('" . $temp2 . "', '" .$id_arduino. "')");
		$mysqli->query("INSERT INTO temp3_data(temp, sensor_id) VALUES ('" . $temp3 . "', '" .$id_arduino. "')");
		$mysqli->query("INSERT INTO temp4_data(temp, sensor_id) VALUES ('" . $temp4 . "', '" .$id_arduino. "')");
		$mysqli->query("INSERT INTO temp5_data(temp, sensor_id) VALUES ('" . $temp5 . "', '" .$id_arduino. "')");
		// Ambient Temperature
		$mysqli->query("INSERT INTO ta1_data(temp, sensor_id) VALUES ('" . $ta1 . "', '" .$id_arduino. "')");
		$mysqli->query("INSERT INTO ta2_data(temp, sensor_id) VALUES ('" . $ta2 . "', '" .$id_arduino. "')");
		// Ambient Light LDR
		$mysqli->query("INSERT INTO lux1_data(temp, sensor_id) VALUES ('" . $ldr1 . "', '" .$id_arduino. "')");
		$mysqli->query("INSERT INTO lux2_data(temp, sensor_id) VALUES ('" . $ldr2 . "', '" .$id_arduino. "')");	
		$mysqli->query("INSERT INTO lux3_data(temp, sensor_id) VALUES ('" . $ldr3 . "', '" .$id_arduino. "')");		
		$mysqli->query("INSERT INTO lux4_data(temp, sensor_id) VALUES ('" . $ldr4 . "', '" .$id_arduino. "')");		
		// Laser Light LDR
		$mysqli->query("INSERT INTO laser1_data(temp, sensor_id) VALUES ('" . $laser1 . "', '" .$id_arduino. "')");
		$mysqli->query("INSERT INTO laser2_data(temp, sensor_id) VALUES ('" . $laser2 . "', '" .$id_arduino. "')");
		$mysqli->query("INSERT INTO laser3_data(temp, sensor_id) VALUES ('" . $laser3 . "', '" .$id_arduino. "')");
	
		// If we arrive here, it means that no exception was thrown
		// i.e. no query has failed, and we can commit the transaction
		$mysqli->commit();
	} catch (Exception $e) {
		// An exception has been thrown
		// We must rollback the transaction
		$mysqli->rollback();
		echo "ERROR";
	}



/*
	$sql = "INSERT INTO temp1_data(temp, sensor_id) VALUES ('" . $temp1 . "', '" .$id_arduino. "')"; 
		
		
	if (!$resultado = $mysqli->query($sql)) {
		echo "Error: La ejecución de la consulta falló debido a: \n";
		echo "Query: " . $sql . "<br>";
		echo "Errno: " . $mysqli->errno . "<br>";
		echo "Error: " . $mysqli->error . "<br>";
		exit;
	}		
	else
	{
		echo "OK";		
	}		

*/
	echo "OK";

?>