<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: Content-Type');
include ('db_connect.php');
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $dir = 'imgs/';//folder ที่จะย้ายไปอยู่ในxampp
    $split = explode(".",$_FILES['myFile']['name']);//เอาชื่อไฟล์ที่ได้มามาจับแยกสกุลไฟล์อีกที เช่น 1.jpg ก็เป็น array[0] = '1' , array[1] = 'jpg'
        $time_stamp = time().'_';
        $name_tar = $time_stamp.$_POST['new_name'].".".$split[1];//อันนี้ตั้งชื่อไฟล์ใหม่
        move_uploaded_file($_FILES['myFile']['tmp_name'],"$dir$name_tar");//ฟังก์ชั่นย้ายไฟล์
        $sql = "INSERT INTO `tb_image`(`image_id`, `imgs_proname`) VALUES (0,'$dir$name_tar')";//insert path เข้าฐานข้อมูล
        $result = $conn->query($sql);
        $sql2= "SELECT * FROM tb_image WHERE imgs_proname = '$dir$name_tar'";
        $result2 = $conn->query($sql2);
        if($result2){
            $img_id=$result2->fetch_array(MYSQLI_ASSOC);
            
        }
        echo json_encode(['img_id'=>$img_id['image_id']]);
}
?>