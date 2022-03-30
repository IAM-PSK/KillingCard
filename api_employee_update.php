<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: *');
	header('Access-Control-Allow-Headers: Content-Type');
	include("db_connect.php");
	$sql = "";
	$feedback = array(
		"status" => "Error",
		"message" => "No data to update"
	);
	if($_SERVER["REQUEST_METHOD"] == "PUT"){
		$content = file_get_contents('php://input');
		$employee = json_decode($content, true);

		// $cus_id = $employee['cus_id'];
		// $name = $employee['name'];
		// $phone = $employee['phone'];
		// $address = $employee['address'];
		// $birthdate = $employee['birthdate'];
		// $urole = $employee['urole'];
		// $email = $employee['email'];
		// $password = $employee['password'];

	if(isset($employee['cus_id']) && isset($employee['name']) && isset($employee['phone']) && isset($employee['address']) && isset($employee['email']) && isset($employee['birthdate'])&& isset($employee['password']) && isset($employee['urole']) ) {
		$sql = "UPDATE tb_users
				SET name = '".$employee['name']."', phone = '".$employee['phone']."', address = '".$employee['address']."', email_address = '".$employee['email'].
				"', birthdate = '".$employee['birthdate']."'WHERE cus_id = ".$employee['cus_id'];
				
		$result = $conn->query($sql);
		$sql2 = "UPDATE tb_users_log
				SET  password = '".$employee['password']."', urole_id = '".$employee['urole']."'
				WHERE email = '".$employee['email']."'";
		
		$result2 = $conn->query($sql2);
		
		if ($result2||$result) {
			
			$feedback["status"] = "Success";
			$feedback["message"] = "Update record successfully";
		} 
			else {
			$feedback["status"] = "Error";
			$feedback["message"] = "Update record not successfully";
			}
		}
		
	
}
	echo json_encode($feedback);
	$conn->close();

?>