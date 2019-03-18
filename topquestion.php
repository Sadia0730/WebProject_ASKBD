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
    content_id integer,
    FOREIGN KEY ( Username ) REFERENCES Regi (Username) on delete cascade,
    FOREIGN KEY ( content_id ) REFERENCES textarea_value (id) on delete cascade
    )";
       mysqli_query($conn,$sql); 

 $sql="CREATE TABLE IF NOT EXISTS downvote
  ( 
    id integer auto_increment primary key,
    Username varchar(30),
    content_id integer,
    FOREIGN KEY ( Username ) REFERENCES Regi (Username) on delete cascade,
    FOREIGN KEY ( content_id ) REFERENCES textarea_value (id) on delete cascade
    )";
    mysqli_query($conn,$sql);

    $uname=$_SESSION['un'];
   
if(isset($_POST['submit']))
{
    $textareaValue = trim($_POST['content']);
    $region=trim($_POST['region']);
    
    $sql = "insert into textarea_value (Username,textarea_content,region,postdate) values ('$uname','$textareaValue','$region',now())";
    $rs = mysqli_query($conn,$sql);
    $affectedRows = mysqli_affected_rows($conn);

    if($affectedRows == 1)
    {
        
        echo "<script type='text/javascript'>alert('Record has been saved successfully')</script>";
        
    }
 
}

/*------------------------------------------------UPVOTE--------------------------------------------------------------------*/


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
     FOREIGN KEY ( Username ) REFERENCES Regi (Username) on delete cascade,
     FOREIGN KEY ( content_id ) REFERENCES textarea_value (id) on delete cascade
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
    
        $sql="UPDATE textarea_value  SET count = $count where id='$content_id'" or die("nnnn"); 
        mysqli_query($conn,$sql) or die("update fail");    
     }
     else
     {
        echo "NOT FOUND";
     }

    }else{
     
        echo "<script type='text/javascript'>alert('Sorry!! You can upvote once')</script>";

   }
}else{

        echo "<script type='text/javascript'>alert('Please Log in first!!')</script>";

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
     FOREIGN KEY ( Username ) REFERENCES Regi (Username) on delete cascade,
    FOREIGN KEY ( content_id ) REFERENCES textarea_value (id) on delete cascade
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
       $sql="UPDATE textarea_value  SET count = $count where id='$content_id'"; 
       mysqli_query($conn,$sql);    
     }
     else
     {
        echo "NOT FOUND";
     }
   }  
   else
   {
    echo "<script type='text/javascript'>alert('Sorry!! You can downvote once')</script>";
   }
 }
 else{
     echo "<script type='text/javascript'>alert('Please Log in first!!')</script>";
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

     <script>
       $(document).ready(function(){

            var postCount = 4;

            $("button").click(function(){

                postCount = postCount + 2;
                $("#post").load("load-comments.php", {

                        postNewCount: postCount
                     });
                });
            }); 
    </script>

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
   /* body {
    margin: 0;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    font-size: 100px;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: left;
    background-color: #fff;
}*/
    .con
    {  
        width: 900px;
        position: relative;
        top: 30px;
        left: 30px;

    }
    .selector
    {
        height: 40px;

    }
    #footer
    {
       
        width: 100%
    }
    .flexbox
    {
        
        position: relative;
        top: 50px;
        min-height: 2800px;
        
        
    }
    .rowsetting
    {
        min-height: 2000px;
        width: 100%;
        position: relative;
        top: 0px;
        
    }
    #pro
    {
        height: 500px;
        width:300px;
        position: relative;
        top: 15px;
        left: 0px;
        margin: 9px;
        padding: 4px;
        box-sizing: border-box;
        

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
   .rowsetting1
    {
        position: relative;
        top: 4px;
        height: 300px;
        
    }
    .btn{
        float: right;
        margin-right:20px;

    }
     .rowsetting2
    {
        min-height: 2400px;
        position: relative;
        top: 0px;
        
        background-color: ;
    }
    #content
    {
        
        position: relative;
        left: 75px;
        width: 900px;
        min-height: 80px;
        margin-top:20px; 
        padding: 20px;
        border-bottom:40px solid;
        border-color: white;
        background-color:;
    
        box-sizing: border-box;
        
    }
     .upvote
    { 
        position: relative;
        top: 20%;
        left: 5%;
        
    }
    
    .upvote:hover
    {
        opacity: 0.7;
    }
    .count
    {
        position: relative;
        top: 30%;
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
<div id="header" ></div>

    
  <div class="flexbox">
<div class="row rowsetting">

<?php
if(isset($_SESSION['un']))
{ 
    echo'<div class="col-lg-3 col-md-3 col-sm-3  d-block m-auto" style="height: 2740px; position: fixed;
        top: 55px;" >

  <div id="pro">';
  $u=$_SESSION['un'];
  $query=mysqli_query($conn,"SELECT * FROM profile where Username='$u'");
  $row=mysqli_fetch_array($query);
  $id=$row['id'];
  $st=$row['status'];
  if($st==0)
  {
     echo'<div id="img"><img src="pictures/default.png" style="height: 250px; width: 250px;"></div>';
  }
  else
  {
    
    echo"<div id='img'><img src='pictures/profile".$id.".jpg' style='height:300px; width:290px;'></div>";
    
  }
     echo'<form action="photo.php" method="post" enctype="multipart/form-data" >        
         <input type="file"  name="uploadImage" accept="image/*" style="margin-top:20px;">
         <input type="submit"  name="submit" style="margin-top:20px;margin-bottom: 20px;">
     </form>         
        <br>
        <a href="profile.php" style="color:#d0183b; font-size:20px; position:relative; left:100px;top:-22px;" >View Profile</a>

  </div>
</div>';
}
?>
   
<div class="col-lg-9 col-md-9 col-sm-9 d-block  m-auto" style="height: 2740px; position: relative; top: 5px;left: 150px;">  

<?php

    if(isset($_SESSION['un']))
    { 
  echo'<div class="row rowsetting1" style="z-index: 1">


    <div class="con">
    
        <form action="topquestion.php" method="post">           
            <div class="form-group">
                     <label for="comment" class="font-weight-bold "><h3>Express Your Thoughts:</h3></label>
                     <textarea class="form-control" rows="5" id="comment" name="content" required></textarea>
             </div>
             <select name="region" required class="selectpicker font-weight-bold selector">
               <optgroup label="Region">
                     <option value="Dhaka">Dhaka</option>
                     <option value="Chattogram">Chattogram</option>
                     <option value="Khulna">Khulna</option>
                     <option value="Rajshahi">Rajshahi</option>
                      <option value="Mymensingh">Mymensingh</option>
                     <option value="Rangpur">Rangpur</option>
                     <option value="Barishal">Barishal</option>
                     <option value="Sylhet">Sylhet</option>
               </optgroup>
             </select>
            <input class="btn btn-danger" type="submit" name="submit" value="Submit">
        
        </form>
    
    </div>

</div>';
}
    ?>


     <div class="row rowsetting2" id="post">


            <?php
        $db = mysqli_select_db($conn,"OpinionDB") or die("error"); // Selecting Database
        //MySQL Query to read data
        $query = mysqli_query($conn,"SELECT * from textarea_value  LIMIT 4 ") or die("error query");
     /*   $row=mysqli_fetch_array($query);*/
        $numberofrows=mysqli_num_rows($query);
        $x=1;
        
        if($numberofrows > 0)
        {
            while ($row=mysqli_fetch_array($query)) {
                            $uname=$row['Username'];
                            $msg=$row['textarea_content'];
                            $region=$row['region'];
                            $datetime=$row['postdate'];
                            $content_id=$row['id'];
                            $count=$row['count'];

                            echo "<div class='row' id='content'>";
                            echo "<div class='col-2  ' ><a   href='topquestion.php?user=$uname&message=$msg&link=rateup&id=$content_id'><i class='fa fa-chevron-up upvote fa-4x' name='rateup' ></i></a><span class='count'>$count</span><a href='topquestion.php?user=$uname&message=$msg&link=ratedown&id=$content_id'><i class='fa fa-chevron-down downvote fa-4x' name='ratedown'></i></a><a href='vote.php?content_id=$content_id'  style='position:absolute; left:10px;bottom:0px;'>View votes</a></div>";
                            echo "<div class='col-10 ' style='background-color:#f2f2f2; padding-top:30px; padding-left:30px;'>";
                            echo "<article><p><h3 class='text-dark'  >$msg</h3></p></article><br><br><br><br>";
                            echo "<h5 >Posted By : <a href='viewprofile.php?theuser=$uname'><b>$uname</b></a></h5>";
                            echo"<h6>Posted On: <b style='color:red'>$datetime</b></h6>";
                            echo "<br>";
                            echo"<h6> in <i style='color:red'>$region</i></h6>";
                            echo "<br><br>";
                            
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
        
      ?>  
        
      </div>
       <button id="showMore"  style="height: 35px; width:450px;position:relative;top:0px;left: 350px;margin-bottom: 40px; ">Show More Posts</button> 

  </div>


</div>

</div>

<!-- <div id="footer" style="position:relative;bottom:0px;left:0px;"></div>-->
</body>

</html>
