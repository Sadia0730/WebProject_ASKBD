<?php 
session_start();
$conn = mysqli_connect('localhost','root','');
 
if(!$conn)
{
    die(mysqli_error());
}

mysqli_select_db($conn,"OpinionDB");
$sql="CREATE TABLE IF NOT EXISTS comment
 ( 
    id integer auto_increment primary key,
    Username varchar(30),
    content_id integer,
    reply varchar(300),
    postdate datetime,
    FOREIGN KEY ( Username ) REFERENCES Regi (Username) on delete cascade,
    FOREIGN KEY ( content_id ) REFERENCES textarea_value ( content_id ) on delete cascade
 )";

 mysqli_query($conn,$sql);

 $uname=$_SESSION['un'];
 $admin=$_SESSION['admin'];
 if (isset($_SESSION['un'])) {

 
	if(isset($_POST['submit']))
	{
   		$reply = trim($_POST['comment_content']);
    	$content_id=$_GET['content_id'];
    	$sql = "insert into comment (Username,content_id,reply,postdate) values ('$uname','$content_id','$reply',now())";
    	$rs = mysqli_query($conn,$sql);
    	$affectedRows = mysqli_affected_rows($conn);

    	if($affectedRows == 1)
    		{
        
        		echo "<script type='text/javascript'>alert('Comment has been saved successfully')</script>";
        
   		   }
 
	}

}else if (isset($_SESSION['admin'])) {

 
	if(isset($_POST['submit']))
	{
   		$reply = trim($_POST['comment_content']);
    	$content_id=$_GET['content_id'];

    	$sql = "insert into comment (Username,content_id,reply,postdate) values ('$admin','$content_id','$reply',now())";
    	$rs = mysqli_query($conn,$sql);
    	$affectedRows = mysqli_affected_rows($conn);

    	if($affectedRows == 1)
    		{
        
        		echo "<script type='text/javascript'>alert('Comment has been saved successfully')</script>";
        
   		   }
 
	}
}else{
	if(isset($_POST['submit'])){

		echo "<script type='text/javascript'>alert('Please!! Log in first')</script>";
	}
}

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
             $("#footer").load("footer.php"); 
            });
    </script>
    <style type="text/css">

         .flex-container
         {
            position: absolute;
            top:70px;
            left: 140px;
            min-height: 2000px;
            display: flex;
            flex-direction: column;
            
        }
        .flex-container :nth-child(1){ order: 1; }
        .flex-container :nth-child(2){ order: 2; }
        .flex-container :nth-child(3){ order: 3; }
    	#posted
    	{	
    		
    		background-color: #f1f1f1;
    		width: 1000px;
    		font-size: 20px;
    		padding: 10px;
    		min-height: 50px;
            margin: 10px;
            
    	}
        #form
        {
             margin:10px;
             width: 1000px;
        }
        
    	#comment_form
    	{
    		
            width: 800px;
    	}
    	#content
    {
        
       /* position: relative;
        top: 0px;
        left: 75px;*/
        width: 900px;
        min-height: 40px;
        margin-top:10px; 
        padding: 20px;
        border-bottom:40px solid;
        border-color: white;
        
        box-sizing: border-box;
        
    }
    #post
	{  
		/*position: relative;
		top: 0px;*/
		width: 100%;
		min-height: 1000px;
		margin:30px 140px;		
	}
    </style>
</head>
<body>
	<div id="header"></div>
    <div class="flex-container">
	<div id="posted">
		<?php
			$content_id=$_GET['content_id'];
			mysqli_select_db($conn,"OpinionDB");
			$sql="SELECT * FROM textarea_value WHERE id='$content_id'";
			$query=mysqli_query($conn,$sql);
			$num=mysqli_num_rows($query);
			if($num==1)
			{
				$row=mysqli_fetch_array($query);
				$uname=$row['Username'];
				echo $row['textarea_content'];
				echo "<br><br>";
				echo "<small>Posted by </small>";
				echo "<a href='viewprofile.php?theuser=$uname'><i style='color:blue;'>".$row['Username']."</i></a>";
			}
		?>

	</div>

<div id="form">
        <form method="POST" id="comment_form">
    
             <div class="form-group">
                     <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Reply" rows="5" required></textarea>
             </div>
             <div class="form-group">
                    <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
            </div>
        </form>

</div>


   <div id="post">
   	<?php
   			 $db = mysqli_select_db($conn,"OpinionDB") or die("error"); // Selecting Database
        //MySQL Query to read data
   			 
            $query = mysqli_query($conn,"SELECT * from comment WHERE content_id='$content_id' ") or die("error query");
    
            $numberofrows=mysqli_num_rows($query);
       
        
        
             if($numberofrows > 0)
             {
                    while ($row=mysqli_fetch_array($query)) {
                            $uname=$row['Username'];
                            $reply=$row['reply'];
                            $datetime=$row['postdate'];
                            $comment_id=$row['id'];
                            echo "<div class='row' id='content'>";
                            echo "<div class='col-2 text-center' >";
                            	if ($uname=='admin') {
                            		echo"<h5><b>$uname</b></h5>";
                            	}
                            	else{
                            		echo"<h5><a href='viewprofile.php?theuser=$uname'><b>$uname</b></a></h5>";
                            	}
                            echo"</div>";
                            echo "<div class='col-10 ' style='background-color:#f2f2f2; padding-top:30px; padding-left:30px;'>";
                            echo "<article><p><h3 class='text-dark'  >$reply</h3></p></article><br>";
                            echo"<h6>Posted On: <b style='color:red'>$datetime</b></h6>";
                            echo "<br>";
                           
                            echo "<br>";
                            echo"</div>"; 

            				if(isset($_SESSION['admin']))
            				{
                             echo "<button class='btn btn-dark text-white' style='position:relative;top:0px;left:140px;width:84%;height:35px;' ><a href='deleteComment.php?comment_id=$comment_id&content_id=$content_id' style='width:83%;height:35px;' >Delete This Reply</a></button>"; 
           					}

                            echo"</div>";
                            
                    }
            }

   	?>
   	  
   </div>

</div>
</body>
</html>