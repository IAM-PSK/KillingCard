<?php
 
session_start();
require_once 'config/db.php';
if (!isset($_SESSION['user_login'])) {
  $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
  header('location: signin.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>QuillingCardShop</title>
  <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/icon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/testtemplate.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
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
                            <a class="nav-link" href="index.php">หน้าหลัก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">ร้านค้า</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">เกี่ยวกับเรา</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color:#a97049" href="history.php">ประวัติการสั่งซื้อ</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="contact.php">ติดต่อเราได้</a>
                        </li> -->
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

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div style="display:<?php if (isset($_SESSION['showAlert'])) {
  echo $_SESSION['showAlert'];
} else {
  echo 'none';
} unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><?php if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
} unset($_SESSION['showAlert']); ?></strong>
        </div>
        <div class="container py-5">
          <div class="row">
            <h1 class="text-center text-info m-0">ประวัติการสั่งซื้อ</h1>
        <div class="table-responsive mt-2">
          <table class="table table-bordered table-striped text-center">
            <thead>
              <tr>
                <th>หมายเลขการสั่งซื้อ</th>
                <th>ที่อยู่ที่จัดส่ง</th>
                <th>จำนวนสินค้าที่ซื้อ</th>
                <th>ราคาทั้งหมด</th>
                <th>สถานะ</th>
                <th>สินค้า</th>
                <!-- <th>การชำระเงิน</th> -->

                <th></th>
                <!-- <th>
                  <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;ล้างตะกร้า</a>
                </th> -->
              </tr>
            </thead>
            <tbody>
              <?php
                require 'config.php';
                $id = $_SESSION['id'];
                $sql = "SELECT *,(SELECT sum(total_price) FROM order_details where order_id = orders.order_id) as amount_paid,(SELECT sum(qty) FROM order_details where order_id = orders.order_id) as qty FROM orders left join tb_users on orders.cus_id = tb_users.cus_id left join tb_address on tb_users.cus_id = tb_address.cus_id LEFT JOIN tb_status on orders.status_id = tb_status.status_id where orders.cus_id = '".$id."' order by orders.status_id = '1' DESC , orders.order_id ASC";
                $stmt = $conn->query($sql);
                $grand_total = 0;
                while ($row = $stmt -> fetch_assoc()){
              ?>
              <tr>
                <td><?= $row['order_id'] ?></td>
                <td><?= $row['address'] ?></td>
                <td><?= $row['qty'] ?></td>
                 <!-- <td><?= $row['pmode'] ?></td> -->
                <td>

                  <?= number_format($row['amount_paid'],2); ?> บาท</td>


                <td><?= $row['status'] ?></td>
                <td><button class="btn btn-success"><a href="historydetail.php?id=<?= $row['order_id'] ?>" >ดูรายละเอียด</a></button></td>

                <td>
                <?php if($row['status_id'] == '1'){ ?>  
                <a href="payment.php?id=<?= $row['order_id'] ?>&total=<?= $row['amount_paid'] ?>" ><button class="btn btn-danger">เเจ้งชำระเงิน</button></a></td>
                <?php }else{ ?>

                <?php } ?>
                <!-- <td>
                  <a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
                </td> -->
              </tr>
              <?php } ?>
              <!-- <tr>
                <td colspan="3">
                  <a href="shop.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;เลือกสินค้าเพิ่ม</a>
                </td>
                <td colspan="2"><b>ยอดรวมทั้งหมด</b></td>
                <td><b>&nbsp;&nbsp;<?= number_format($grand_total,2); ?> บาท</b></td>
                <td>
                  <a href="checkout.php" class="btn btn-int <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;ยืนยันการสั่งซื้อ</a>
                </td> -->
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Change the item quantity
    $(".itemQty").on('change', function() {
      var $el = $(this).closest('tr');

      var pid = $el.find(".pid").val();
      var pprice = $el.find(".pprice").val();
      var qty = $el.find(".itemQty").val();
      location.reload(true);
      $.ajax({
        url: 'action.php',
        method: 'post',
        cache: false,
        data: {
          qty: qty,
          pid: pid,
          pprice: pprice
        },
        success: function(response) {
          console.log(response);
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
</body>

</html>