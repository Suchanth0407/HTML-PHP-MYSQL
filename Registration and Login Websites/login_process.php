<?php
if(!isset($_POST['submit']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $con=mysqli_connect("localhost:3308","root","","register");
    $sql="SELECT * from login WHERE username='$username' AND password='$password'";
    $result=mysqli_query($con,$sql);
    $resultcheck=mysqli_num_rows($result);
    if($resultcheck>0){
        header("location:user.php");
    }
    else{
        echo "Username or Password Incorrect";
    }
}
?>