<?php
	session_start();
	include 'config.php';

	// Add products into the cart table
	if (isset($_POST['pid'] ) && $_POST['check'] == 'insert') {
	  $cusid = $_SESSION['id'];
	  $pid = $_POST['pid'];
	  $pname = $_POST['pname'];
	  $pprice = $_POST['pprice'];
	  $pimage = $_POST['pimage'];
	  $pcode = $_POST['pcode'];
	  $pqty = $_POST['pqty'];
	  $total_price = $pprice * $pqty;

	  $stmt = $conn->prepare('SELECT product_code FROM cart WHERE product_code=?');
	  $stmt->bind_param('s',$pcode);
	  $stmt->execute();
	  $res = $stmt->get_result();
	  $r = $res->fetch_assoc();
	  $code = $r['product_code'] ?? '';

	  if (!$code) {
	    $sql = "INSERT INTO cart VALUES ('','".$pqty."','".$pid."','".$cusid."')";
	    $result = $conn->query($sql);
	    echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your cart!</strong>
						</div>';
	  } else {
	    echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your cart!</strong>
						</div>';
	  }
	}

	// Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	  $stmt = $conn->prepare('SELECT * FROM cart');
	  $stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;

	  echo $rows;
	}

	// Remove single items from cart
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	  $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:cart.php');
	}

	// Remove all items at once from cart
	if (isset($_GET['clear'])) {
	  $stmt = $conn->prepare('DELETE FROM cart');
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the cart!';
	  header('location:cart.php');
	}

	// Set total price of the product in the cart table
	if (isset($_POST['qty'])) {
	  $qty = $_POST['qty'];
	  $pid = $_POST['pid'];
	  $pprice = $_POST['pprice'];

	  $tprice = $qty * $pprice;

	  $sql = "UPDATE cart SET qty='".$qty."' WHERE id='".$pid."' ";
	  echo $sql;
	  $conn->query($sql);

	}

	// Checkout and save customer info in the orders table
	if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
	  $order_id = $_POST['order_id'];
	  $cus_id = $_POST['cus_id'];
	  $name = $_POST['name'];
	  $email = $_POST['email'];
	  $phone = $_POST['phone'];
	  $products = $_POST['products'];
	  $grand_total = $_POST['grand_total'];
	  $address = $_POST['address'];
	  $data = '';
	
	  $sql= "INSERT INTO orders VALUES ('', '".$cus_id."','1','','','112','','1')";

	  $stmt = $conn->query($sql);
	  
				
		$sql2 ="SELECT * FROM cart left JOIN tb_product on cart.product_code =  tb_product.product_code WHERE cus_id = '".$_SESSION['id']."' ";
	  	$stm3 = $conn->query($sql2);
		  $price = 0;
                while ($row = $stm3->fetch_assoc()){
					 $pcode = $row['product_code'];
					 $pprice = $row['price'];
					 $pqty = $row['qty'];
					 $price += $pprice * $pqty;

					$sql= "INSERT INTO order_details 
					VALUES ('', '".$pqty."','".$pprice*$pqty."',(SELECT max(order_id) from Orders),'".$pcode."')";
					$stmt = $conn->query($sql);

					
				}


	  $stmt2 = $conn->prepare('DELETE FROM cart');
	  $stmt2->execute();
	  $sql2 = "select * from orders ";
		$result = $conn->query($sql2);
		while ($row = $result->fetch_assoc()) {

  
	}
	$sql2 ="SELECT max(order_id) as id from Orders";
	$stm3 = $conn->query($sql2);
	$row = $stm3->fetch_assoc();
	$id = $row['id'];
	  $data .= '<div class="jumbotron p-3 mb-2 text-center">
	  		<br>
	  			<h1 class="display-4 mt-2 text-danger">ขอขอบคุณที่ใช้บริการ</h1>
	  				<h2 class="text-success">คำสั่งซื้อของคุณสำเร็จเเล้ว</h2>
	  					
						<br>
						
							<a class="btn btn-danger" href="payment.php?id='.$id.'&total='.$price.'"> เเจ้งชำระเงิน </a> 
							
						  </div>';
						 
	  echo $data;
	  
	}

?>


	