<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
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

    <script> 
        $(function(){
             $("#header").load("header.php");  
            });
    </script>
    <style type="text/css">
    	#content
    	{
    		min-height: 700px;
        width: 2000px;
      background-color: ;
    		position: relative;
    		top: 30px;
    	}
    	#field
    	{
    	
    		
    		position: relative;
    		top: 20px;
    		left: 10%;
    		/*border:30px white solid;*/
    		min-height: 700px;
    		padding-left: 10px;
    		width: 1000px;
    		font-size: 25px;
    	}
    	#legend
    	{
    		font-size: 42px;
    		font-weight: bold;
    		color:white;
        background-color: black;
        padding: 15px;
        box-sizing: border-box;


    	}
    	#legend i
    	{
    		font-size: 42px;
    		text-transform:uppercase; 
    		color:#d0183b;
    	}
      #post
      {
        background-color: #f1f1f1;
        padding: 10px;
        border-top:5px solid white;
        border-bottom:5px solid white;
      }
    	#footer{
    		position: relative;
    		bottom: 0px;
    	}
    </style>
 </head>
 <body>
  <div id='header'></div>
<?php
$conn = mysqli_connect('localhost','root','');
 
if(!$conn)
{
    die(mysqli_connect_error());
}
 mysqli_select_db($conn,"OpinionDB");
$u=$_GET['theuser'] or die("conn");
echo $u;

 $sql="SELECT * FROM regi WHERE Username='$u'";
  
      $result=mysqli_query($conn,$sql);
      $resultCheck=mysqli_num_rows($result);
      $row=mysqli_fetch_array($result);
      echo $resultCheck;
      $uname=$row['Username'];
      $fname=$row['firstname'];
      $lname=$row['lastname'];
      $email=$row['email'];
      $gender=$row['Gender'];
      $contact=$row['Contact'];
      $space=" ";
$query="SELECT * FROM textarea_value WHERE Username='$u'";  
$res=mysqli_query($conn,$query);
$row2=mysqli_fetch_array($res);
$num=mysqli_num_rows($res);
 $x=1;
 $summ=0;
        
        
      if($resultCheck=1)
      {

echo "<div id='content'>
    <div id='field'>
    <div id='legend'>Welcome to<i> $uname</i> 's profile</div>
      <div id='post'>
        <b>Name : </b>$fname$space$lname     
      </div>

      <div id='post'>
        <b>Email : </b>$email        
      </div>

      <div id='post'>
        <b>Gender: </b>$gender
      </div>

      <div id='post'>
        <b>Contact: </b>$contact
      </div>

      <div id='post'>
        <b>Total Post: </b>$num
      </div>";

       while($x<=$num)
        {
          $count=$row2['count'];
          $msg=$row2['textarea_content'];
          $date=$row2['postdate'];
          $space="       ";
          echo "<div id='post'>";
          echo "<b>POST ".$x." : </b>";
        
          echo $msg;
          echo$space;
          echo"<b>Posted On:".$date."</b>";
          echo$space;
          echo "<b> Vote: ".$count."</b>";
          echo"<br>";
          echo "</div>";
          $row2=mysqli_fetch_array($res);
          $x++;
        }
      

      echo"<br><br>
    </div>
  </div>";
 
      }

?>
 
 	
 </body>