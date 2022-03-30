<?php

header('Access-Control-Allow-Origin: *');
include("db_connect.php");

$sql = "SELECT 
a.product_code, 
a.name, 
a.quantity, 
a.price, 
b.imgs_proname, 
b.image_id 
FROM tb_product as a 

LEFT JOIN tb_image as b 
on a.image_id = b.image_id
";

if(isset($_GET['pro_id'])) {
$sql .="WHERE a.product_code = '".$_GET['pro_id']."'";
}

else if(isset($_GET['keyword'])) {
	$sql .= " WHERE a.product_code like '%".$_GET['keyword']."%'
				OR a.name like '%".$_GET['keyword']."%'
				OR a.quantity like '%".$_GET['keyword']."%'
				OR a.price like '%".$_GET['keyword']."%'
				";
}

$result = $conn->query($sql);
$arr = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	  array_push($arr,$row);
    
	  }
	} 
	else {
	  echo "";
	}

	echo json_encode($arr);
	$conn->close();
	?>