<?php 
    include "function.php";
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $log = new Admin;
        $res = $log->admin_login($email, $password);
        if ($res == TRUE){
            $_SESSION['admin_login'] = TRUE;
            header("location:addDetails.php");
            exit();
            
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            background: #8999A8;
            }
    </style>
    <style>
        .container{
	position:absolute;
	left:22%;
	top:35%;
	margin:-75px 0 0 -135px;
        width: 75%;
        height: 75%;
}
    </style>
</head>
<body class="blurBg-false">
    
    <!-- Start login form-->
    <link rel="stylesheet" href="login_files/formoid1/formoid-solid-blue.css" type="text/css" />
    <script type="text/javascript" src="login_files/formoid1/jquery.min.js"></script>
    <div class ="container">
        <form class="formoid-solid-blue"  style="background-color:#FFFFFF;font-size:17px;font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;max-width:500px;min-width:150px" method="post"><div class="title"><h2>Login</h2></div>
            <div class="element-email"><label class="title"></label><div class="item-cont"><input class="large" type="email" name="email" value="" placeholder="Email"/><span class="icon-place"></span></div></div>
            <div class="element-password"><label class="title"></label><div class="item-cont"><input class="large" type="password" name="password" value="" placeholder="Password"/><span class="icon-place"></span></div></div>
            <div class="submit"><input type="submit" value="Submit"/></div>
        </form>
        <p class="frmd"><a href="http://formoid.com/v29.php">online form</a> Formoid.com 2.9</p>
        <script type="text/javascript" src="login_files/formoid1/formoid-solid-blue.js"></script>
        <!-- Stop login form-->
    </div>
</body>
</html>
