<?php
	$conn = mysqli_connect('localhost','root','');
 
if(!$conn)
{
    die(mysqli_error());
}
mysqli_select_db($conn,"OpinionDB");
 $content_id= $_GET['id'];
 echo $content_id;
$q=mysqli_query($conn,"DELETE FROM textarea_value WHERE id='$content_id'")or die("kkjkjkj");
if($q)
{
	
	echo "<script type='text/javascript'>alert('Content is deleted')</script>";
	echo "<script type='text/javascript'>window.open('topquestion.php','_self')</script>";
}

?>