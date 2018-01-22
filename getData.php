<?php 

// {
  // "cols": [
        // {"id":"","label":"Any","pattern":"","type":"string"},
        // {"id":"","label":"Temperatura","pattern":"","type":"number"}
      // ],
  // "rows": [
        // {"c":[{"v":"23/12/1957","f":null},{"v":24,"f":null}]},
        // {"c":[{"v":"23/12/1957","f":null},{"v":21,"f":null}]},
        // {"c":[{"v":"23/12/1957","f":null},{"v":21,"f":null}]},
        // {"c":[{"v":"23/12/1957","f":null},{"v":22,"f":null}]},
        // {"c":[{"v":"23/12/1957","f":null},{"v":20,"f":null}]}
      // ]
// }

	include("connect.php");
	
	$mysqli = new mysqli($server, $user, $pass, $db);
	
	if ($mysqli->connect_errno) 
	{
		echo "Error: Fallo al conectarse a MySQL debido a: \n";
		echo "Errno: " . $mysqli->connect_errno . "\n";
		echo "Error: " . $mysqli->connect_error . "\n";
		exit;
	}
	
	$myObj = (object)array();

	$myObj->cols = array(
		array("id" => "", "label" => "Any", "pattern" => "", "type" => "string"),
		array("id" => "", "label" => "Temperatura", "pattern" => "", "type" => "number")
	);
	$myObj->rows = array();
	
	
	$sql = "SELECT * FROM (SELECT data, temp FROM temp_data ORDER BY 1 DESC LIMIT 500) AS a ORDER BY 1 ASC";
	$result = $mysqli->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			
			$temp = array("c" => array(
				array("v" => $row["data"], "f" => null),
				array("v" => $row["temp"], "f" => null)
				)
			);
			array_push($myObj->rows, $temp);
			
		}
	} else {
		echo "0 results";
	}
	$mysqli->close();

	// Model JSON Data
	// $temp = array("c" => array(
				// array("v" => "2018-01-01", "f" => null),
				// array("v" => 22, "f" => null)
				// )
			// );
			
	// array_push($myObj->rows, $temp);
	// array_push($myObj->rows, $temp);
	// array_push($myObj->rows, $temp);



	$myJSON = json_encode($myObj);

	echo $myJSON;

?>