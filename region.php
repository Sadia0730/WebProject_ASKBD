<?php 
session_start();
$conn = mysqli_connect('localhost','root','');
 
if(!$conn)
{
    die(mysqli_error());
}
mysqli_query($conn,"CREATE DATABASE IF NOT EXISTS OpinionDB");
 mysqli_select_db($conn,"OpinionDB");
  $sql="CREATE TABLE IF NOT EXISTS textarea_value
  ( 
   id integer auto_increment primary key,
    Username varchar(30),
    textarea_content varchar(300),
    region varchar(50),
    count integer default 0,
    postdate datetime,
    FOREIGN KEY ( Username ) REFERENCES Regi (Username) on delete cascade
    )";
    mysqli_query($conn,$sql);//creating database

$sql="CREATE TABLE IF NOT EXISTS upvote
  ( 
    id integer auto_increment primary key,
    Username varchar(30),
    content_id integer
    
    )";
       mysqli_query($conn,$sql); 

 $sql="CREATE TABLE IF NOT EXISTS downvote
  ( 
    id integer auto_increment primary key,
    Username varchar(30),
    content_id integer
    
    )";
    mysqli_query($conn,$sql);

    $uname=$_SESSION['un'];
   

     $link=$_GET['link'];

if($link=='rateup' )
{
    if($_SESSION['un'])
    {
    /* echo "<script type='text/javascript'>alert('count has been saved successfully')</script>";*/
$sql="CREATE TABLE IF NOT EXISTS upvote
  ( 
    id integer auto_increment primary key,
    Username varchar(30),
    content_id integer
    
    )";
    mysqli_query($conn,$sql);
     $uid=$_SESSION['un'];
     $user=$_GET['user'];
     $mess= $_GET['message'];
     $content_id= $_GET['id'];
     $query = mysqli_query($conn,"SELECT * from upvote where Username='$uid' AND content_id='$content_id'") or die("error query1");
     $affectedRows = mysqli_affected_rows($conn);
      
      if(!$affectedRows)
      {
        
        $query = mysqli_query($conn,"INSERT INTO UPVOTE (Username,content_id) VALUES ('$uid','$content_id')") or die("error query2");
         $querydown = mysqli_query($conn,"SELECT * from downvote where Username='$uid' AND content_id='$content_id'") or die("error query3");
        if( $querydown)
        {
            mysqli_query($conn,"DELETE FROM DOWNVOTE where content_id='$content_id' AND Username='$uid'") or die("error query4");
        }
        $query = mysqli_query($conn,"SELECT * from textarea_value where id='$content_id'") or die("errorrrrr query");
        $rw=mysqli_fetch_array($query);
    
     if($rw)
     {
        
        $count=$rw['count'];
        $count=$count+1;
       $sql="UPDATE textarea_value  SET count = $count where textarea_content='$mess'"; 
       mysqli_query($conn,$sql);    
     }
     else
     {
        echo "NOT FOUND";
     }
   }  
   else
   {
     echo"<script type='text/javascript'>alert('You can't upvote more than once')</script>";
   }
}
   else
   {
    echo"<script type='text/javascript'>alert('You can't upvote without login')</script>";
   }  
}
if($link=='ratedown')
{
if($_SESSION['un'])
{
    $sql="CREATE TABLE IF NOT EXISTS downvote
  ( 
    id integer auto_increment primary key,
    Username varchar(30),
    content_id integer
    
    )";
    mysqli_query($conn,$sql);
     $uid=$_SESSION['un'];
     $user=$_GET['user'];
     $mess= $_GET['message'];
     $content_id= $_GET['id'];
     $query = mysqli_query($conn,"SELECT * from downvote where Username='$uid' AND content_id='$content_id'") or die("error query");
     $affectedRows = mysqli_affected_rows($conn);
     
      
      if(!$affectedRows)
      {
        
        $query = mysqli_query($conn,"INSERT INTO DOWNVOTE (Username,content_id) VALUES ('$uid','$content_id')") or die("error query");
         $queryup = mysqli_query($conn,"SELECT * from upvote where Username='$uid' AND content_id='$content_id'") or die("error query");
         if( $queryup)
        {
            mysqli_query($conn,"DELETE FROM UPVOTE where content_id='$content_id' AND Username='$uid'") or die("error query");
        }
        $query = mysqli_query($conn,"SELECT * from textarea_value where id='$content_id'") or die("errorrrrr query");
        $rw=mysqli_fetch_array($query);
    
     if($rw)
     {
        
        $count=$rw['count'];
        $count=$count-1;
       $sql="UPDATE textarea_value  SET count = $count where textarea_content='$mess'"; 
       mysqli_query($conn,$sql);    
     }
     else
     {
        echo "NOT FOUND";
     }
   }  
   else
   {
    echo "<script type='text/javascript'>alert('You can't downvote more than once')</script>";
   }
 }
 else{
    echo "<script type='text/javascript'>alert('You can't downvote without login')</script>";
 }    
}

?>



<!DOCTYPE html>
<html>
<head>
	<title></title><!-- Latest compiled and minified CSS -->
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
             $("#footer").load("footer.php"); 
            });
        </script>
	<style type="text/css">
	#post
	{
		position: absolute;
		top: 100px;
		width: 80%;
		min-height: 1000px;
		margin: 0px 140px;
		
		
	}
	  #content
    {
        
        position: relative;
        left: 75px;
        width: 900px;
        min-height: 100px;
        margin-top:20px; 
        padding: 20px;
        border-bottom:40px solid;
        border-color: white;
        background-color:;
        overflow: auto;
        box-sizing: border-box;
        
    }
	  .upvote
    { 
        position: relative;
        top: 20%;
        left: 5%;
        
    }
	.upvote:active
    {
        color:yellow;
    }
    .upvote:hover
    {
        opacity: 0.7;
    }
    .count
    {
        position: relative;
        top: 32%;
        left: -30%;
        font-weight: bold;
        font-size: 27px;
        height: 5px;
        margin: 2px;
    }
    .downvote
    {
        position: relative;
        top: 30%;
        left: 5%;
        
    }
    .downvote:hover
    {
        opacity: .7;

    }
    #showMore
    {
        color: blue;

    }
    #showMore:hover
    {   
        color: navy;
        font-size: 20px;
        opacity: 0.7;
    }
	</style>
</head>
<body>

<div id="header"></div>

<div id="post">
<?php  
	$region=$_GET['region'];
	
	$conn = mysqli_connect('localhost','root','');
 
if(!$conn)
{
    die(mysqli_error());
}
mysqli_select_db($conn,"OpinionDB");
$sql="SELECT * FROM textarea_value WHERE region='$region'" or die("jjh");
$query=mysqli_query($conn,$sql);
$num=mysqli_num_rows($query);

if($num)
{
	while ($row=mysqli_fetch_array($query)) {
                            $uname=$row['Username'];
                            $msg=$row['textarea_content'];
                            $region=$row['region'];
                            $datetime=$row['postdate'];
                            $content_id=$row['id'];
                            $count=$row['count'];

                            echo "<div class='row' id='content'>";
                            echo "<div class='col-2  ' ><a   href='region.php?user=$uname&message=$msg&link=rateup&id=$content_id&region=$region'><i class='fa fa-chevron-up upvote fa-4x' name='rateup' ></i></a><span class='count'>$count</span><a href='region.php?user=$uname&message=$msg&link=ratedown&id=$content_id&region=$region'><i class='fa fa-chevron-down downvote fa-4x' name='ratedown'></i></a><a href='vote.php?content_id=$content_id'  style='position:absolute; left:10px;bottom:0px;'>View votes</a></div>";
                            echo "<div class='col-10 ' style='background-color:#f2f2f2; padding-top:30px; padding-left:30px;'>";
                            echo "<article><p><h3 class='text-dark' >$msg</h3></p></article><br><br><br><br>";
                            echo "<h5 >Posted by : <a href='viewprofile.php?theuser=$uname'><b>$uname</b></a></h5>";
                            echo"<h6>Posted on : <b style='color:red'>$datetime</b></h6>";
                            echo "<br>";
                            echo"<h6> in <i style='color:red'>$region</i></h6>";

                            echo "<a href='comment.php?content_id=$content_id' style='position:absolute; right:15px;bottom:10px;'>Reply</a>";
                            echo "<br><br>";
                            echo"</div>";  
            if(isset($_SESSION['admin']))
            {
                             echo "<button class='btn btn-dark text-white' style='position:relative;top:0px;left:140px;width:84%;height:35px;' ><a href='delete.php?id=$content_id' style='width:83%;height:35px;' >Delete This Post</a></button>"; 
            }

            echo"</div>";

            } 

}
else{
	echo "<div class='row  bg-dark text-white' id='content'>";
	echo "<div class='col-4'></div>";
	echo "<div class='col-4'>";
	echo "<strong >No Posts Are Available!!</strong>";
	echo "</div>";
	echo "<div class='col-4'></div>";
	echo "</div>";
}
?>
</div>
 
<div id="footer"></div>
</body>
</html>