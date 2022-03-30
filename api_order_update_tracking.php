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
		$order = json_decode($content, true);

	if(isset($order['order_id']) && isset($order['tracking'])) {
		$sql = "UPDATE orders
				SET tracking = '".$order['tracking']."' WHERE order_id = ".$order['order_id'];
	
				$result = $conn->query($sql);

				if ($result) {
					
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