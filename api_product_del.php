<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: *');
	include("db_connect.php");
	$sql = "";
	

	if($_SERVER['REQUEST_METHOD']=="GET") {
		$pro_id = $_GET['pro_id'];
		$pro_path =$_GET['path'];
		$feedback = array(
		"status" => "Error",
		"message" => $_GET['pro_id']
	);
		$sql = "DELETE FROM tb_product
				WHERE image_id = ".$pro_id;
		$result = $conn->query($sql);
		if ($result){
			unlink($pro_path);
			
			$sql2 =  "DELETE FROM tb_image
				WHERE imgs_proid = ".$pro_id;
			$result2 = $conn ->query($sql2);
			if($result2){
				$feedback["status"] = "Success";
				$feedback["message"] = "ลบข้อมูลสำเร็จ";
			}
		}
	}
	else {
			$feedback["status"] = "Error";
			$feedback["message"] = $conn->error;
		}
	
	echo json_encode($feedback);
	$conn->close();
?>