<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Content-Type');

	include("db_connect.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$content = file_get_contents('php://input');
		$product = json_decode($content, true);

		
		$name = $product['name'];
		$quantity = $product['quantity'];
		$price = $product['price'];
		$imgs_proname = $product['img_id'];

		// check duplicate email
		$sql = "SELECT * FROM tb_product WHERE name = '$name'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
				echo json_encode(['status'=>'error','message'=>'ไม่สามารถเพิ่มสินค้าได้เนื่องจากมีสินค้านี้นแล้ว']);
	} 

	else{
			// insert data
			$sql = "INSERT INTO tb_product (`product_code`,`name`,`quantity`,`price`,`image_id`)	VALUES('','$name','$quantity','$price','$imgs_proname')";
			$result = $conn->query($sql);
			if($result){ // success
					echo json_encode(['status'=>'success', 'message'=>'บันทึกข้อมูลสำเร็จ']);
			}
			else{ //error
				echo json_encode(['status'=>'error', 'message'=>$sql]);
				}
			}	
		}
		else{
			echo json_encode(['status'=>'error', 'message'=>'เกิดข้อผิดพลาด']);
		}	
		$conn->close();
	?>