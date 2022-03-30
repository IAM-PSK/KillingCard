<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Content-Type');

	include("db_connect.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$content = file_get_contents('php://input');
		$employee = json_decode($content, true);

		$cus_id = $employee['cus_id'];
		$name = $employee['name'];
		$phone = $employee['phone'];
		$address = $employee['address'];
		$birthdate = $employee['birthdate'];
		$urole_id = $employee['urole'];
		$email = $employee['email'];
		$password = $employee['password'];
    

		// check duplicate email
		$sql = "SELECT * FROM tb_users_log WHERE email = '$cus_id'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
				echo json_encode(['status'=>'error','message'=>'ไม่สามารถลงทะเบียนได้เนื่องจาก  ID นี้มีผู้ใช้งานแล้ว']);
	} 

	else{
			// insert data
			$sql = "INSERT INTO tb_users_log (`email`,`password`,`urole_id`,`id_status_users`)
					VALUES('$email','$password','$urole_id','1')";
       
	$result = $conn->query($sql);
			$sql2 = "INSERT INTO tb_users (`cus_id`,`name`,`phone`,`address`,`email_address`,`birthdate`)
					VALUES('$cus_id','$name','$phone','$address','$email','$birthdate')";
         
    $result2 = $conn->query($sql2);

			if($result2){ // success
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