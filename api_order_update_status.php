<?php
	header('Access-Control-Allow-Origin: *');
	include("db_connect.php");
	$sql = "";
	$feedback = array(
		"status" => "Error",
		"message" => "NO id to delete"
	);

	if(isset($_GET['order_id'])&&isset($_GET['status'])) {
		$sql = "UPDATE orders SET status_id = '".$_GET['status']."' 
				WHERE order_id = '".$_GET['order_id']."'";
	
		if ($conn->query($sql) == TRUE) {
			if($conn ->affected_rows > 0) {
			$feedback["status"] = "Success";
			$feedback["message"] = "เปลี่ยนการใช้งานแล้ว";
		} 
		else {
			$feedback["status"] = "Error";
			$feedback["message"] = "Delete record not successfully";
		}
	}
	else {
			$feedback["status"] = "Error";
			$feedback["message"] = $conn->error;
		}
	}
	echo json_encode($feedback);
	$conn->close();
?>