<?php
session_start();

$con = mysqli_connect("localhost","root","");
 
if(!$con){
        die("Connection Failed :" + mysqli_connect_error());
}
        
 mysqli_select_db($con,"OpinionDB");
            
        

if(isset($_SESSION['un'])&&isset($_SESSION['pw']))
{
	//we need the session actually running here before we can destroy it
    session_unset();
    session_destroy();
    //echo "<script>window.open('../index.php',_self)</script>";
echo "<script type='text/javascript'>window.open('homepage.html','_self')</script>";
echo "<script type='text/javascript'>window.alert('Logged out','_self')</script>";
exit();
}

if(isset($_SESSION['admin'])&&isset($_SESSION['adpw']))
{
	//we need the session actually running here before we can destroy it
    session_unset();
    session_destroy();
    //echo "<script>window.open('../index.php',_self)</script>";
echo "<script type='text/javascript'>window.open('homepage.html','_self')</script>";
echo "<script type='text/javascript'>window.alert('Logged out','_self')</script>";
exit();
}
?>