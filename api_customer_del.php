<?php
	header('Access-Control-Allow-Origin: *');
	include("db_connect.php");
	$sql = "";
	$feedback = array(
		"status" => "Error",
		"message" => "NO id to delete"
	);

	if(isset($_GET['cus_id'])&&isset($_GET['status'])) {
		$sql = "UPDATE tb_users_log SET id_status_users = '".$_GET['status']."' 
				WHERE email = '".$_GET['cus_id']."'";
	
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