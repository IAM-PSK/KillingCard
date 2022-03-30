<?php
	$conn = new mysqli("localhost","root","","quilling_card");
	if($conn->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}
	date_default_timezone_set("Asia/Bangkok");
?>