<?php

header('Access-Control-Allow-Origin: *');
include("db_connect.php");

$sql = "SELECT a.cus_id, 
a.name, 
a.phone, 
a.address, 
a.email_address, 
a.birthdate,
u.password,
l.urole_id,
l.urole,
s.id_status_users,
s.users_status
FROM tb_users as a 

LEFT JOIN 
tb_users_log as u 
on a.email_address = u.email

LEFT JOIN 
tb_users_urole as l
on u.urole_id = l.urole_id

LEFT JOIN 
tb_users_status as s 
on u.id_status_users = s.id_status_users


";

if(isset($_GET['cus_id'])) {
	$sql .="WHERE a.cus_id = '".$_GET['cus_id']."'";
}

else if(isset($_GET['keyword'])) {
	$sql .= " WHERE l.urole_id = 3 AND (a.cus_id like '%".$_GET['keyword']."%'
				OR a.name like '%".$_GET['keyword']."%'
				OR a.phone like '%".$_GET['keyword']."%'
				OR a.address like '%".$_GET['keyword']."%'
				OR a.email_address like '%".$_GET['keyword']."%'
				OR a.birthdate like '%".$_GET['keyword']."%'
				OR l.urole like '%".$_GET['keyword']."%'
				OR s.users_status like '%".$_GET['keyword']."%')
				AND NOT u.id_status_users = 1";
}
else {
	$sql .= " WHERE l.urole_id = 3
	AND NOT u.id_status_users = 1";
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