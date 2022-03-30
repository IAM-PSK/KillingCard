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
		$customer = json_decode($content, true);

		// $cus_id = $customer['cus_id'];
		// $name = $customer['name'];
		// $phone = $customer['phone'];
		// $address = $customer['address'];
		// $email_address = $customer['email_address'];
		// $birthdate = $customer['birthdate'];

	if(isset($customer['cus_id']) && isset($customer['name']) && isset($customer['phone']) && isset($customer['address']) && isset($customer['email']) && isset($customer['birthdate'])&& isset($customer['password']) && isset($customer['urole']) ) {
		$sql = "UPDATE tb_users
				SET name = '".$customer['name']."', phone = '".$customer['phone']."', address = '".$customer['address']."', email_address = '".$customer['email'].
				"', birthdate = '".$customer['birthdate']."'WHERE cus_id = ".$customer['cus_id'];
	
				$result = $conn->query($sql);
				$sql2 = "UPDATE tb_users_log
					SET  password = '".$customer['password']."', urole_id = '".$customer['urole']."'
					WHERE email = '".$customer['email']."'";
				
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