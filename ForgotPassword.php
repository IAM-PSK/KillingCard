<html>
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

    <form name="form1" method="post" action="SendPassword.php">

    Forgot your password? (Input Username or Email)<br><br>

<table border="1" style="width: 300px">

<tbody>

<tr>

<td> &nbsp;Username</td>

<td>

<input name="txtUsername" type="text" id="txtUsername">

</td>

</tr>

<tr>

<td> &nbsp;Email</td>

<td><input name="txtEmail" type="text" id="txtEmail">

</td>

</tr>

</tbody>

</table>

<br>

<input type="submit" name="btnSubmit" value="Send Password">

<br>

<div class="jumbotron p-3 mb-2 text-center">

								<h1 class="display-4 mt-2 text-danger">ขอขอบคุณที่ใช้บริการครับ</h1>
								<h2 class="text-success">ออเดอร์ของคุณได้สั่งซื้อสำเร็จเเล้ว</h2>
								<h4 class=" text-danger rounded p-2">สินค้า : ' . $products . '</h4>
								<h4>ชื่อผู้สั่ง : ' . $name . '</h4>
								<h4>อีเมลล์ ของคุณ : ' . $email . '</h4>
								<h4>เบอร์โทรศัพท์ : ' . $phone . '</h4>
								<h4>จำนวนเงินทั้งหมด : ' . number_format($sum,2) . ' บาท</h4>
								<h4>การชำระเเบบ : ' . $pmode . '</h4>
						  </div>';
</form>

</body>

</html>