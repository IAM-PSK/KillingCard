<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: *');
	header('Access-Control-Allow-Headers: Content-Type');
	include("db_connect.php");
	if($_SERVER["REQUEST_METHOD"] == "PUT"){
		$content = file_get_contents('php://input');
		$product = json_decode($content, true);
		$pro_id = $product['pro_id'];
		$name = $product['name'];
		$quantity = $product['quantity'];
		$price = $product['price'];
		$sql = "UPDATE tb_product
				SET name = '".$name."', quantity = '".$quantity ."',
				 price = '".$price ."'
				WHERE product_code= ".$pro_id;
		$res = $conn->query($sql);
	
		if ($res) {
			
			$feedback["status"] = "Success";
			$feedback["message"] = "Update record successfully";
			echo json_encode($feedback);
			$conn->close();
		}
		else {
			$feedback["status"] = "Error";
			$feedback["message"] = "Update record not successfully";
			echo json_encode($feedback);
			$conn->close();
		}
	
	
}
	
	

?>