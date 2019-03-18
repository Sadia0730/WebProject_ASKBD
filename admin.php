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
            if(isset($_POST["submit"])){
             

         $uname=$_POST['username'];
         $pass=$_POST['password'];
       
         if($uname=='admin')//if login successful store login informations into session variables
          {
            if ($pass=='admin') {
                    $_SESSION['admin']=$uname;
                    $_SESSION['adpw']=$pass;
                     header('location:topquestion.php');
                    echo "<script type='text/javascript'>alert('Welcome to your account')</script>";
            }else{
               echo "<script type='text/javascript'>alert('Invalid password!')</script>";
            }
          
            
       /*  echo "<script type='text/javascript'>window.open('slide.php','_self')</script>";*/

           
          }else{
              echo "<script type='text/javascript'>alert('Invalid User name!')</script>";
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
  <legend><h1 class="hone">Admin Login </h1></legend>
  <div class ="loginbox">
    <form action="admin.php" method="post" id="form">
      <p>User name</p>
       <input type="text" name="username" placeholder="Enter your username to login" id="loginEmail" >
<br><br>
        <span id="span" style="color: red;"><?php echo $urerr; ?></span>
         <br><br>

       <p>Password</p>
       <input type="password" name="password" placeholder="Enter your password to login" id="loginPassword" ><br><br>
        <span id="span" style="color: red;"><?php echo $perr; ?></span>
        
       <br><br>

      <input type="submit" name="submit" value="login"><br>
     

    </form>

      
    
  </div> 
   </fieldset> 
</body>
</html>