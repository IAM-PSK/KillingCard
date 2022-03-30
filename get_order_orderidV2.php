<?php

header('Access-Control-Allow-Origin: *');
include("db_connect.php");

$sql = "SELECT
a.order_id,
a.cus_id,
b.name,
a.email,
a.phone,
a.address,
a.pmode,
a.amount_paid,
c.status, 
a.date,
a.tracking,
p.totalprice,
d.product_code,
d.product_name,
d.qty,
d.product_price,
d.total_price,
p.image

FROM orders as a

LEFT JOIN 
tb_users as b 
on a.cus_id = b.cus_id

LEFT JOIN 
tb_status as c
on a.status_id = c.status_id

LEFT JOIN 
payment as p
on a.order_id = p.order_id

LEFT JOIN
order_details = d
on a.order_id = d.order_id

";

if(isset($_GET['order_id'])) {
$sql .="WHERE a.order_id = '".$_GET['order_id']."'";
}

elseif(isset($_GET['cus_id'])) {
$sql .="WHERE c.cus_id = '".$_GET['cus_id']."'";
}

elseif(isset($_GET['keyword'])) {
	$sql .= "	WHERE c.status_id = 1 AND (a.order_id like '%".$_GET['keyword']."%'
				OR b.name like '%".$_GET['keyword']."%'
				OR c.status like '%".$_GET['keyword']."%')

				";
}
else {
	$sql .= " WHERE c.status_id = 1";
} 


$result = $conn->query($sql);
$arr = array();
if ($result->num_rows > 0){
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