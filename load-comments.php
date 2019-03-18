<?php
        $conn = mysqli_connect('localhost','root','');
 
        if(!$conn)
        {
           die(mysqli_error());
        }
        $db = mysqli_select_db($conn,"OpinionDB") or die("error"); // Selecting Database
        //MySQL Query to read data

        $postNewCount=$_POST['postNewCount'];
        echo $postNewCount;
        $query = mysqli_query($conn,"SELECT * from textarea_value LIMIT  $postNewCount") or die("error query");
        
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
                            echo "<div class='col-2  ' ><a href='topquestion.php?user=$uname&message=$msg&link=rateup&id=$content_id'><i class='fa fa-chevron-up  upvote fa-4x' name='rateup' ></i></a><span class='count'>$count</span><a href='topquestion.php?user=$uname&message=$msg&link=ratedown&id=$content_id'><i class='fa fa-chevron-down downvote fa-4x' name='ratedown'></i></a><a href='vote.php?content_id=$content_id'  style='position:absolute; left:10px;bottom:0px;'>View votes</a></div>";
                            echo "<div class='col-10 ' id='post' style='background-color:#f2f2f2; padding-top:30px; padding-left:30px;'>";
                            echo "<article><p><h3 class='text-dark' >$msg</h3></p></article><br><br><br><br>";
                            echo "<h5 >Posted by <a href='viewprofile.php?theuser=$uname'><b>$uname</b></a></h5>";
                            echo"<h6>Posted on <b style='color:red'>$datetime</b></h6>";
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