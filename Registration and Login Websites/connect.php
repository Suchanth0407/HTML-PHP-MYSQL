<?php
$con=new mysqli('localhost:3308','root','','register');
if(!$con){
    die(mysqli_error($con));
}
?>