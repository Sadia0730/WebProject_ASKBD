<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>

	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script type="text/javascript">
	$(function(){
    $("#header").load("header.php"); 
    $("#footer").load("footer.php"); 
    });
    </script>
    <style type="text/css"> /*profile style*/
   body{  
    height: 1500px; 
    width: 100%;
    background:url(back.jpg);
    }
       #pro
    {
        height: 500px;
        width:300px;
        position: relative;
        top: 100px;
        left: 0px;
        margin: 9px;
        padding: 4px;
        box-sizing: border-box;
        font-size:16px;


    }
     #img
    {
        height: 300px;
        width:290px;
        position: relative;
        top: 0px;
        left: 0px;
        box-sizing: border-box;
        margin: 1px;
        margin-bottom: 20px;
    }
	.profile{
		position: absolute;
		top: calc(30% - 75px);
		left: calc(30% - 50px);
		height: 800px;
		width: 700px;
		padding: 10px;
		/*z-index: -1;*/
		

	}

	.profile input[type=text]{
		width: 600px;
		height: 30px;
		background: #F4F4F4;
		border: 1px solid rgba(255,255,255,0.6);
		border-radius: 2px;
		color:#124191;
		font-family: 'Antic';
		font-size: 16px;
		font-weight: 400;
		padding: 4px;
		margin-top: 20px;
		margin-bottom: 20px;
	}
.profile input[type=radio]{
		width: 20px;
		height: 20px;
		background: #F4F4F4;
		border: 1px solid rgba(255,255,255,0.6);
		border-radius: 2px;
		color:#124191;
		font-family: 'Antic';
		font-size: 16px;
		font-weight: 400;
		padding: 4px;
		margin-top: 20px;
		margin-bottom: 20px;
		margin-right: 70px;
		margin-left: 70px;
		
	}
	.profile input[type=password]{
		width: 600px;
		height: 30px;
		background: #F4F4F4;/*background color for password input field*/
		border: 1px solid rgba(255,255,255,0.6);
		border-radius: 2px;
		color:#124191;
		font-family: 'Antic';
		font-size: 16px;
		font-weight: 400;
		padding: 4px;
		margin-top: 20px;
		margin-bottom: 20px;
	}
	.profile input[type=tel]{
		width: 600px;
		height: 30px;
		background: #F4F4F4;/*background color for password input field*/
		border: 1px solid rgba(255,255,255,0.6);
		border-radius: 2px;
		color:#124191;
		font-family: 'Antic';
		font-size: 16px;
		font-weight: 400;
		padding: 4px;
		margin-top: 20px;
		margin-bottom: 20px;
	}
	.profile select{
		width: 600px;
		height: 30px;
		background: #F4F4F4;/*background color for password input field*/
		border: 1px solid rgba(255,255,255,0.6);
		border-radius: 2px;
		color:#124191;
		font-family: 'Antic';
		font-size: 16px;
		font-weight: 400;
		padding: 4px;
		margin-top: 20px;
		margin-bottom: 20px;
	}
	.profile button[type=submit]{
		width: 600px;
		height: 45px;
		background: #d0183b;
		border: 1px solid #fff;
		cursor: pointer;
		border-radius: 2px;
		color: #fff;
		font-family: 'Antic';
		font-size: 16px;
		font-weight: 400;
		padding: 6px;
		margin-top: 30px;
		margin-bottom: 20px;
	}

	.profile button:hover
	{
		background-color: #d2b236;
	}

	.profile form
	{
		color: black;
		font-family: antic;
		font-size: 20px;
		padding-left: 30px;
	   box-sizing: border-box;
	}
	#footer{
		position:relative;
		bottom: 0px;
		left: 0px;
		width: 100%;
	}

</style>
</head>
<body>
	<div id="header"></div>
 <div id="pro" style="float: left;">
<?php
	$uname=$_SESSION['un'];
	$fname=$_SESSION['fn'];
	$lname=$_SESSION['ln'];
	$em=$_SESSION['em'];
	$contact=$_SESSION['cn'];
	$gender=$_SESSION['gn'];

  	$conn = mysqli_connect('localhost','root','');
 
	if(!$conn)
	{
    die(mysqli_error());
	}
  mysqli_select_db($conn,"OpinionDB");
  $query=mysqli_query($conn,"SELECT * FROM profile where Username='$uname'");
  $row=mysqli_fetch_array($query);
  $id=$row['id'];
  $st=$row['status'];
  if($st==0)
  {
     echo'<div id="img"><img src=/pictures/default.png style="height: 250px;width: 250px;"></div>';
  }
  else
  {	

    echo"<div id='img'><img src='pictures/profile".$id.".jpg' style='height: 300px;width: 290px;'></div>";
    
  }
  ?>

 <form action="photo.php" method="post" enctype="multipart/form-data" >        
         <input type="file" name="uploadImage" accept="image/*" style="margin-top:20px;">
         <input type="submit" name="submit" style="margin-top:20px;margin-bottom: 20px;">
 </form>         
        <br>
        
</div>	

<div class="profile" >
	
	
	<form method="post" action="processProfileUpdate.php" style="float: right;">
	  <h6 style="font-family: 'Antic';color: red;">The fields marked with * must be filled</h6>
  	  Username<b style="color:red;">*</b><input type="text" value= "<?php echo htmlspecialchars($uname); ?>" name="username" class="grad"><br>
  	  First Name <input type="text" value="<?php echo htmlspecialchars($fname); ?>" name="fname"><br>
  	  Last Name <input type="text" value="<?php echo htmlspecialchars($lname); ?>" name="lname"><br>
  	  Email <input type="text" value="<?php echo htmlspecialchars($em); ?>" name="email"><br>
  	  Gender<br><input type="text" name="gender" value="<?php echo htmlspecialchars($gender); ?>"><br>
  	 
  	  Contact<br><input type="tel" name="contact" maxlength="11" pattern="[0-9]{11}" value="<?php echo htmlspecialchars($contact); ?>"><br>
  	  Old Password<b style="color:red;">*</b> <input type="text" name="oldpassword" autocomplete="off"><br>
  	  New Password <input type="text" name="newpassword" autocomplete="off" placeholder="Leave empty if you don't want to change"><br>
  	  <button type="submit" class="btn" name="reg_user">Update</button>
  	</form>;
</div>		
    
    <div id="footer"></div>
</body>
</html>
