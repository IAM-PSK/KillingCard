<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['signin'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

      
        if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: signin.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: signin.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: signin.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: signin.php");
        } else {
            

                $check_data = $conn->query("SELECT * FROM tb_users_log left join tb_users on tb_users_log.email = tb_users.email_address WHERE email = '".$email."'");
                if ($check_data->num_rows > 0) {
                while ($row = $check_data->fetch_assoc()){

                

                    if ($email == $row['email']) {
                        if (($password == $row['password'])) {
                            if ($row['id_status_users'] == '1') {
                                if ($row['urole_id'] == '1') {
                                    header("location: http://localhost:4200/dashboard ");
                                } else {
                                    $_SESSION['user_login'] = $row['email'];
                                    $_SESSION['id'] = $row['cus_id'];

                                    header("location: /quillingcards/index.php"); ///quellingcard/index.php
                                }
                            } else {
                                $_SESSION['error'] = 'บัญชีนี้ถูกระงับการใช้งาน';
                                header("location: signin.php");
                            }
                        } else {
                            $_SESSION['error'] = 'รหัสผ่านผิด';
                            header("location: signin.php");
                        }
                    } else {
                        $_SESSION['error'] = 'อีเมลผิด';
                        header("location: signin.php");
                    }
                }
                } else {
                    $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                    header("location: signin.php");
                }

            
        }
    }


?>