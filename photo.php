<?php
session_start();
$conn = mysqli_connect('localhost','root','');
 
if(!$conn)
{
    die(mysqli_error());
}
 mysqli_select_db($conn,"OpinionDB");
$uname=$_SESSION['un'];
   $query=mysqli_query($conn,"SELECT * FROM profile WHERE Username='$uname'");
   $row=mysqli_fetch_array($query);
$id=$row['id'];
echo $id;
echo $uname;
if(isset($_POST['submit']))
{
  $file= $_FILES['uploadImage'];
 
  $fileName= $_FILES['uploadImage']['name'];
  $fileTmpName= $_FILES['uploadImage']['tmp_name'];
  $fileSize= $_FILES['uploadImage']['size'];
  $fileError= $_FILES['uploadImage']['error'];
  $fileType= $_FILES['uploadImage']['type'];

  $fileExt= explode('.', $fileName);
  $fileActualExt=strtolower(end($fileExt));

  $allowed=array('jpg','jpeg','png','pdf');

  if (in_array($fileActualExt, $allowed)) {
   if ($fileError==0) {
    if ($fileSize<1000000) {
      $fileNameNew="profile".$id.".". $fileActualExt;
      $fileDestination='pictures/'. $fileNameNew;
      move_uploaded_file($fileTmpName,  $fileDestination); 
      $sql="UPDATE profile set status = 1 WHERE Username='$uname'";
      $result=mysqli_query($conn,$sql);
      echo"<script type='text/javascript'>window.open('profile.php','_self')</script>";
    }else{
      echo "Your file is too big to upload";
    }
   }else{
       echo "You can not upload this file because of error";
   }
  }
  else{
    
    
    echo "You can not upload this type of file";
  }
 
}
?>