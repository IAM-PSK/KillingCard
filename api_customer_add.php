<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Content-Type');

	include("db_connect.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$content = file_get_contents('php://input');
		$customer = json_decode($content, true);

		$cus_id = $customer['cus_id'];
		$name = $customer['name'];
		$phone = $customer['phone'];
		$address = $customer['address'];
		$email_address = $customer['email_address'];
		$birthdate = $customer['birthdate'];

		// check duplicate email
		$sql = "SELECT * FROM tb_customer WHERE email_address = '$email_address'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
				echo json_encode(['status'=>'error','message'=>'ไม่สามารถลงทะเบียนได้เนื่องจาก  e-mail นี้มีผู้ใช้งานแล้ว']);
	} 

	else{
			// insert data
			$sql = "INSERT INTO tb_customer (`cus_id`,`name`,`phone`,`address`,`email_address`,`birthdate`)
					VALUE('$cus_id','$name','$phone','$address','$email_address','$birthdate')";
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