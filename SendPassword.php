<html>

<head>

<title>ThaiCreate.Com Tutorials</title>

</head>

<body>

<?php


    mysqli_connect("localhost","root","");

    mysqli_select_db('quilling_cards');

    $strSQL = "SELECT * FROM member WHERE Username = '".trim($_POST['txtUsername'])."'

    OR Email = '".trim($_POST['txtEmail'])."' ";

$objQuery = mysqli_query($strSQL);

$objResult = mysqli_fetch_array($objQuery);

if(!$objResult)

{

echo "Not Found Username or Email!";

}

else

{

echo "Your password send successful.<br>Send to mail : ".$objResult["Email"];    

 

$strTo = $objResult["txtEmail"];

$strSubject = "Your Account information username and password.";

$strHeader = "Content-type: text/html; charset=windows-874\n"; // or UTF-8 //

$strHeader .= "From: webmaster@thaicreate.com\nReply-To: webmaster@thaicreate.com";

$strMessage = "";

$strMessage .= "Welcome : ".$objResult["Name"]."<br>";

$strMessage .= "Username : ".$objResult["Username"]."<br>";

$strMessage .= "Password : ".$objResult["Password"]."<br>";

$strMessage .= "=================================<br>";

$flgSend = mail($strTo,$strSubject,$strMessage,$strHeader);

 

}

mysqli_close();

?>

</body>

</html>