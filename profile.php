<?php 
    
    session_start();
    require_once 'config/db.php';
   ?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>QuillingCardShop</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/icon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/testtemplate.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">siwapoom@hotmail.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">092-261-6441</a>
                                    </div>
                                    <div>
                    <a class="text-light" href="https://facebook.com/" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                
                    <?php 
                    if (isset($_SESSION['user_login'])) {
                        $user_id = $_SESSION['user_login'];
                        $stmt = $conn->query("SELECT * FROM tb_users WHERE email_address = '".$user_id."'");
                        while ($row = $stmt->fetch_assoc()){
                            echo  "welcome ". $row['name'] . ' ' ."   ";
                            echo '<a href="profile.php" class="btn btn-dark">โปรไฟล์</a>';
                            echo '<a href="logout.php" class="btn btn-danger">Logout</a>';
                        }
                    } else if (isset($_SESSION['admin_login'])) {
                                $admin_id = $_SESSION['admin_login'];
                                $stmt = $conn->query("SELECT * FROM tb_users WHERE email_address = '".$admin_id."'");
                            
                              while  ($row = $stmt->fetch_assoc()){
                                echo  "welcome ". $row['name'] . ' ' ."   ";
                                echo '<a href="logout.php" class="btn btn-danger">Logout</a>';
                              }
                               
                    } else {
                                    echo '<a class="navbar-sm-brand text-light text-decoration-none" href="signin.php">สมัครสมาชิก | เข้าสู่ระบบ</a>';
                            }
                ?>

                </div>
            </div>
        </div>
    </nav>
    
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">
        
            <a class="i" href="index.php"><img src="assets/img/Logo.png" style="width:150;height:90px;"></a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" style="color:#a97049" href="index.php">หน้าหลัก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">ร้านค้า</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">เกี่ยวกับเรา</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="history.php">ประวัติการสั่งซื้อ</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <!-- search icon -->
                    <!-- <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-black mr-2"></i>
                    </a> -->
                    
                    <a class="nav-item">
            <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
          </a>
                    
                    
                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->

    <!-- Modal -->
    <div class="container">
        <div class="row">
            <div class="col-2">

            </div>
            <div class="col">
                <br>
                <h1 align="center">P R O F I L E</h1>
                <br>
                <form>
            <div class="form-group row">
                <?php
                $sql = "select * from tb_users left join tb_users_log on tb_users.email_address = tb_users_log.email WHERE tb_users.cus_id = '".$_SESSION['id']."' ";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc()
                ?>
            <label for="inputphone" class="col-sm-2 col-form-label">ชื่อ - นามสกุล</label>
            <div class="col-sm-10"> <input type="text" class="form-control" id="inputphone" name="formtel" require
               value="<?php echo $row['name'] ?>" placeholder="โปรดใส่เบอร์โทรศัพท์ของคุณ"  > </div>
          </div>

          <div class="form-group row">
            <label for="inputorder" class="col-sm-2 col-form-label">อีเมลล์</label>
            <div class="col-sm-10"><input value="<?php echo $row['email_address'] ?>"  type="text"  class="form-control" id="inputorder"name="formnum"   require placeholder="โปรดใส่หมายเลขการสั่งซื้อ">
          </div>
        <div>
          <br>
          <div class="form-group row">
            <label for="inputtotal" class="col-sm-2 col-form-label">รหัสผ่าน</label>
            <div class="col-sm-10"> <input value="<?php echo $row['password'] ?>" type="password"   class="form-control" id="inputtotal" name="formprice"  required placeholder="โปรดใส่จำนวนเงินของคุณ"> </div>
          </div> 
          <div class="form-group row">
            <label for="inputtotal" class="col-sm-2 col-form-label">เบอร์โทรศัพท์</label>
            <div class="col-sm-10"> <input type="text" value="<?php echo $row['phone'] ?>"   class="form-control" id="inputtotal" name="formprice"  required placeholder="โปรดใส่จำนวนเงินของคุณ"> </div>
          </div> 
          <div class="form-group row">
            <label for="inputtotal" class="col-sm-2 col-form-label">วันเกิด</label>
            <div class="col-sm-10"> <input type="date" value="<?php echo $row['birthdate'] ?>"   class="form-control" id="inputtotal" name="formprice"  required placeholder="โปรดใส่จำนวนเงินของคุณ"> </div>
          </div> 
          <div class="form-group row">
            <label for="inputtotal" class="col-sm-2 col-form-label">ที่อยู่</label>
            <div class="col-sm-10"> <a href="address_detail.php"><button type="button" class="btn btn-primary">จัดการที่อยู่</button></a></div>
          </div> 
          <button class="btn btn-primary btn-block float-right">แก้ไข้</button>
          </form>
                </div>
                <div class="col-2">
                
                </div>
        </div>
    </div>
</body>

</html>