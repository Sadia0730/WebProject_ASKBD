<?php
	$conn = mysqli_connect('localhost','root','');
 
if(!$conn)
{
    die(mysqli_error());
}
mysqli_select_db($conn,"OpinionDB");
 $comment_id= $_GET['comment_id'];
 $content_id= $_GET['content_id'];
 echo $comment_id;
$q=mysqli_query($conn,"DELETE FROM comment WHERE id='$comment_id'")or die("kkjkjkj");
if($q)
{
	
	echo "<script type='text/javascript'>alert('Comment is deleted')</script>";
	echo "<script type='text/javascript'>window.open('comment.php?content_id=$content_id','_self')</script>";
}

?>