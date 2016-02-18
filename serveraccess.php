<?php

//template to create Mysql Connection object
include "config.php";

$Conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

if (!$Conn){
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";

?>