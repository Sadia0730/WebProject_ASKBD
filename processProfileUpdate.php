<?php
	session_start();	
	    $con = mysqli_connect("localhost","root","");
 
            if(!$con){
                    die("Connection Failed :" + mysqli_connect_error());
                }
        
               

	$currentUname=$_SESSION['un'];
    $newUname=$_POST[username];
	$fanme=$_POST[fname];
	$lanme=$_POST[lname];
	$em=$_POST[email];
	$passOld=$_POST[oldpassword];
	$passNew=$_POST[newpassword];
	$gender=$_POST[gender];
	$contact=$_POST[contact];


	 mysqli_select_db($con,"OpinionDB");
	$query="SELECT * FROM regi WHERE Username='".$currentUname."'";
    $result=mysqli_query($con,$query) or die("result");
    $row=mysqli_fetch_array($result) or die("row");

   
    if($passNew=='')
    { 
    	
    	$passNew=$passOld;
    	

    }

    if($newUname=='')
    {
    	echo "<script type='text/javascript'>alert('You must enter a valid username')</script>";
    	echo "<script type='text/javascript'>window.open('profile.php','_self')</script>";
    	exit();
    }
    
    if($row['password']!=$passOld)
    {
    	echo "<script type='text/javascript'>alert('Please enter correct current password')</script>";
    	echo "<script type='text/javascript'>window.open('profile.php','_self')</script>";
    	exit();
    }

   

	//if everthing so far is ok then update
	$sql="UPDATE regi SET firstname = '$_POST[fname]' WHERE Username='$currentUname'";
	if (!mysqli_query($con,$sql)){die('Error: ' . mysql_error());}
		$sql="UPDATE regi SET lastname = '$_POST[lname]' WHERE Username='$currentUname'";
	if (!mysqli_query($con,$sql)){die('Error: ' . mysql_error());}
	$sql="UPDATE regi SET Email = '$_POST[email]' WHERE Username='$currentUname'";
	if (!mysqli_query($con,$sql)){die('Error: ' . mysql_error());}
	$sql="UPDATE regi SET Password = '$passNew' WHERE Username='$currentUname'";
	if (!mysqli_query($con,$sql)){die('Error: ' . mysql_error());}
	
	$sql="UPDATE regi SET Gender = '$_POST[gender]' WHERE Username='$currentUname'";
	if (!mysqli_query($con,$sql)){die('Error: ' . mysql_error());}
	
	$sql="UPDATE regi SET Contact = '$_POST[contact]' WHERE Username='$currentUname'";
	if (!mysqli_query($con,$sql)){die('Error: ' . mysql_error());}
	$sql="UPDATE regi SET Username = '$_POST[username]' WHERE Username='$currentUname'";
	if (!mysqli_query($con,$sql)){die('Error: ' . mysql_error());}	
	else{
		$sql="SELECT * FROM textarea_value WHERE Username='$currentUname'";
		$query=mysqli_query($con,$sql);
		if($num=mysqli_num_rows($query))
		{
		$sql="UPDATE textarea_value SET Username = '$_POST[username]' WHERE Username='$currentUname'";
		mysqli_query($con,$sql);
		}

		$sql="SELECT * FROM upvote WHERE Username='$currentUname'";
		$query=mysqli_query($con,$sql);
		if($num=mysqli_num_rows($query))
		{
		$sql="UPDATE upvote SET Username = '$_POST[username]' WHERE Username='$currentUname'";
		mysqli_query($con,$sql);
		}

		$sql="SELECT * FROM downvote WHERE Username='$currentUname'";
		$query=mysqli_query($con,$sql);
		if($num=mysqli_num_rows($query))
		{
		$sql="UPDATE downvote SET Username = '$_POST[username]' WHERE Username='$currentUname'";
		mysqli_query($con,$sql);
		}

		$sql="SELECT * FROM profile WHERE Username='$currentUname'";
		$query=mysqli_query($con,$sql);
		if($num=mysqli_num_rows($query))
		{
		$sql="UPDATE profile SET Username = '$_POST[username]' WHERE Username='$currentUname'";
		mysqli_query($con,$sql);
		}
	}	

 	
	$_SESSION['un']=$newUname;
	$_SESSION['fn']=$fanme;
	$_SESSION['ln']=$lanme;
	$_SESSION['em']=$em;
	$_SESSION['pw']=$passNew;
	$_SESSION['cn']=$contact;
	$_SESSION['gn']=$gender;

   	echo "<script type='text/javascript'>alert('Your informations are successfully updated.')</script>";
  	echo "<script type='text/javascript'>window.open('profile.php','_self')</script>";

	mysqli_close($con);
?>
