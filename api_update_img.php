<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: Content-Type');
include("db_connect.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
        unlink($_POST['img_path']);
        $date = time()."_";
        $dir = 'imgs/';
        $pro_img = $_POST['img_new_name'];
        $split = explode(".",$_FILES['myFile']['name']);
        $name_tar = $pro_img.".".$split[1];
        $sql ="UPDATE `tb_image` SET `imgs_proname`='$dir$date$name_tar' WHERE image_id =  '".$_POST['img_id']."'";
        move_uploaded_file($_FILES['myFile']['tmp_name'],"$dir$date$name_tar");
        $conn->query($sql);
        echo json_encode(['img_path'=>$dir.$date.$name_tar]);
     
}
?>