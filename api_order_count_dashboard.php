<?php

header('Access-Control-Allow-Origin: *');
include("db_connect.php");

$sql = "SELECT * FROM orders
";

$result = $conn->query($sql);
$arr = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	  array_push($arr,$row);
    
	  }
	} 
	else {
	  echo "";
	}

	echo json_encode($arr);
	$conn->close();
	?>