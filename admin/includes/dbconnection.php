<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$con=mysqli_connect("localhost", "root", "", "club_db");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}

  ?>
