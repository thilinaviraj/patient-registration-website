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
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>  
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>  
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"> </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="http://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script src="js/vendor/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/vendor/jquery.sortelements.js" type="text/javascript"></script>
        <script src="js/jquery.bdt.js" type="text/javascript"></script>
    <style>
        body{
            //background: #8999A8;
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
    <nav class="navbar navbar-default">
        <div class="navbar-header">
            <ul class="nav navbar-nav navbar-left"><li><img src="image/logo.jpg" height=50 width=250 align="left"></li></ul>
       </div>
        
    </nav>
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
