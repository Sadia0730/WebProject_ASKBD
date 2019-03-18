<?php
        session_start();
        $urerr = $eerr = $perr = $cperr = $fnerr ="";
        $uname = $pass ="";
    
        $boolen  = false;
       
    
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            if(empty($_POST["username"])){
               $urerr = "Username Required...!";
                $boolen  = false;
            }else{
               $uname = $_POST["username"];
                $boolen  = true;
            }

             if(empty($_POST["password"])){
                $perr = "Password Field Required...!";
                $boolen  = false;
            }else{
              if($boolen){
                $pass = $_POST["password"];
                $boolen = true;
              }
            }
        }
         if($boolen){
          
            
                $con = mysqli_connect("localhost","root","");
 
            if(!$con){
                    die("Connection Failed :" + mysqli_connect_error());
                }
        
                mysqli_select_db($con,"OpinionDB");
            
        
            
            if(isset($_POST["submit"])){
              
              /*  $sql = "SELECT * FROM regi WHERE Username = '$_POST[username]'";
                echo $count;
                $result = mysqli_query($con,$sql) or die(mysqli_error($con));
                $count=mysqli_num_rows($result) or die(mysqli_error($con)); 
                if($count==1)
                { 
                  $sql = "SELECT * FROM regi WHERE Username = '$_POST[username]'"; 
                  $result = mysqli_query($con,$sql) or die(mysqli_connect_error($con));
                  $row=mysqli_fetch_assoc($result) or die("ERROR"+ mysqli_connect_error($con));
                                  $uname=$_POST['username'];
                                  $pass=$_POST['password'];
                                 if(!($row['password']==$pass)){
                                        echo "<script>alert ('Password did not mstch...!');</script>";
                                         echo "<script type='text/javascript'>window.open('slide.php','_self')</script>";
                                         exit();
                                  }else{
                                         $_SESSION['un']=$row['Username'];
                                         $_SESSION['fn']=$row['firstname'];
                                         $_SESSION['ln']=$row['lastname'];
                                         $_SESSION['em']=$row['email'];        
                                         $_SESSION['pw']=$row['password'];
                                         echo "<script>alert ('Welcome to your account...!');</script>";
                                         echo "<script type='text/javascript'>window.open('homepage.php','_self')</script>";
                                         exit();
                                  }
                }elseif($count==0){
                    echo "<script type='text/javascript'>alert('Invalid login information')</script>";
                    echo "<script type='text/javascript'>window.open('homepage.php','_self')</script>";
                    exit();
                 }
                mysqli_close($con);
                $boolen = false;*/


         $uname=$_POST['username'];
         $pass=$_POST['password'];
       $sql="SELECT * FROM regi WHERE Username='$uname'";
      //$resultCheck=$result;
      $result=mysqli_query($con,$sql);
      $resultCheck=mysqli_num_rows($result);
      if($resultCheck<1)//if no rows selected
      {
        echo "<script type='text/javascript'>alert('Invalid login information')</script>";
       /*  header('location: slide.php');*/
       echo "<script type='text/javascript'>window.open('login.php','_self')</script>";
        exit();
      }
      else
      {
        if($row=mysqli_fetch_assoc($result))
        {
          $query="SELECT * FROM regi WHERE Username='".$uname."' AND password='".$pass."'";
          $result=mysqli_query($con,$query);
          $row=mysqli_fetch_array($result);
          
            
          if(!($row['password']==$pass))//if the input password does not match with the database-stored password
          {  
            /* header('location: slide.php');*/
             echo "<script type='text/javascript'>alert('Invalid password')</script>";
             echo "<script type='text/javascript'>window.open('login.php','_self')</script>";
             exit();
          }
          else if($row['password']==$pass)//if login successful store login informations into session variables
          {
            //echo "accessed into session";
            $_SESSION['un']=$row['Username'];
            $_SESSION['fn']=$row['firstname'];
            $_SESSION['ln']=$row['lastname'];
            $_SESSION['em']=$row['email'];
            $_SESSION['pw']=$row['password'];
            $_SESSION['cn']=$row['Contact'];
            $_SESSION['gn']=$row['Gender'];
            if($_POST["checkbox"]=='1'||$_POST["checkbox"]=='on')
            {
              
              $hour=time() + 30;
              setcookie('username',$uname,$hour);
              setcookie('password',$pass,$hour);
            }
             header('location: topquestion.php');
             echo "<script type='text/javascript'>alert('Welcome to your account')</script>";
       /*  echo "<script type='text/javascript'>window.open('slide.php','_self')</script>";*/

           
          }
        }
      }
            }    
        }
    ?>
<html>
<head>
 <style type="text/css">
 body
 {
   background-color:#343a40;
 }
 
#span
{
  height:4px;
}
.loginbox p
{

  margin:0;
  padding: 0;
  font-weight: bold;

}
.loginbox input
{
  width:100%;
  margin-bottom: 15px;

}
.loginbox input[type="text"],input[type="password"]
{
  border:none;
  border-bottom: 1px solid;
  background:transparent;
  outline: none;
  height:30px;
  color:white;
  font-size: 15px;

}
.loginbox input[type="submit"]
{
  border:none;
  outline: none;
  height:35px;
  background:#d0183b;
  border-radius: 20px; 
  color:#fff;
  font-size: 18px;

}
.loginbox input[type="submit"]:hover
{
  cursor: pointer;
  background:#d2b236;
  color:#000;
}
.loginbox button
{
  text-decoration: none;
  color:white;
  line-height: 20px;
  border-style: none;
  background-color: transparent;

}
.loginbox button:hover
{
  cursor: pointer;
  background:transparent;
  color:#d2b236;
  border-style: none;
}
#check
{
  left-border:1px;
  width: 10px;
  height: 20px;
}
#label
{
 color:#dfd4d8;
 font-size: 14px;
}
fieldset
{
   width:400px;
  height: 500px;
  color:#fff;
  top:50%;
  left: 50%;
  position:absolute;
  transform: translate(-50%,-50%);
  box-sizing: border-box;
  padding-top: 20px;

}
.loginbox
{
  background-color: ;
  padding:20px 20px;
}
.loginbox p
{
  color: white;
  font-size: 18px;
}
</style>


</head>

 <body>
<fieldset>
  <legend><h1 class="hone">Login here</h1></legend>
  <div class ="loginbox">
    <form action="login.php" method="post" id="form">
      <p>User name</p>
       <input type="text" name="username" placeholder="Enter your username to login" id="loginEmail" value="<?php echo $_COOKIE['username'];?>">
        <span id="span" style="color: red;"><?php echo $urerr; ?></span>
       <p>Password</p>
       <input type="password" name="password" placeholder="Enter your password to login" id="loginPassword" value="<?php echo $_COOKIE['password'];?>">
        <span id="span" style="color: red;"><?php echo $perr; ?></span>
         <label id="label">
             <input type="checkbox" name="checkbox" id="check">Remember me
         </label>
       <br><br>

      <input type="submit" name="submit" value="login"><br>
     

    </form>

      <button onclick="window.location.href = 'homepage.html'">Back to home?</button><br>
      <button id="bttn" onclick="window.location.href = 'signup.php'" >Don't have an account?</button>
    
  </div> 
   </fieldset> 
</body>
</html>