<?php
session_start();
        $urerr = $eerr = $perr = $cperr = $fnerr =  " ";
        $urname = $email = $passwd = $fname = $lname ="";
    
        $boolen  = false;
       
    
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            if(empty($_POST["urname"])){
               $urerr = "Username Required...!";
                $boolen  = false;
            }else{
                $boolen  = true;
            
            $urname = validate_input($_POST["urname"]);
            }
            
            if(empty($_POST["email"])){
                $eerr = "Email Required...!";
                $boolen  = false;
            }elseif(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
                $eerr = "Invalid Email...!";
                $boolen  = false;
            }else{
                  if($boolen){
                $boolen  = true;
                 
            }
            $email = validate_input($_POST["email"]);
            }
            
            $lenght = strlenght($_POST["passwd"]);
            
            if(empty($_POST["passwd"])){
                $perr = "Password Field Required...!";
                $boolen  = false;
            }elseif($lenght){
                $perr = $lenght;
                $boolen  = false;
                
            }else{
                  
                  if($boolen){
                $boolen  = true;
                  
            }
            
            }
             $passwd = validate_input($_POST["passwd"]);

            if(empty($_POST["cpasswd"])){
                $cperr = "Confirm Password Required...!";
                $boolen  = false;
            }
            if($_POST["cpasswd"]!=$passwd){
               $cperr = "Password Not Match...!";
               $cperr=$passwd;
                $boolen  = false;
                   
            }
            
            if(empty($_POST["fname"]) || empty($_POST["lname"])){
                  
                $fnerr = "First &amp; Last Name both Required...!";
                $boolen  = false;
            }else{
                  if($boolen){
                $fname = validate_input($_POST["fname"]);
                $lname = validate_input($_POST["lname"]);
                $boolen  = true;
                 
            }
            }
            
           
            
        
     } 
        function strlenght($str){
            $ln = strlen($str);
            if($ln >15){
                return "Passwod should less than 15 charecter";
            }elseif($ln <=3 && $ln >= 1){
                return "Password should greater then 3 charecter";
            }
            return;
        }
        function validate_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
     
    echo $boolen;
        if($boolen){
        
             
                $con = mysqli_connect("localhost","root","");
 
            if(!$con){
                    die("Connection Failed :" + mysqli_connect_error());
                }
            mysqli_query($con,"CREATE DATABASE IF NOT EXISTS OpinionDB");
         mysqli_select_db($con,"OpinionDB");
                $sql = "CREATE TABLE IF NOT EXISTS regi (
          Username VARCHAR(30)  PRIMARY KEY, 
          email VARCHAR(50) NOT NULL,
          firstname VARCHAR(30) NOT NULL,
          lastname VARCHAR(30) NOT NULL,
          password VARCHAR(30) NOT NULL,
          Gender VARCHAR(12),
          Contact VARCHAR(11)
          )";
          if (mysqli_query($con, $sql)) {
                 echo "Table Regi created successfully";
          } else {
                 echo "Error creating table: " . mysqli_error($con);
          }

            
           function NewUser(){
                $sql = "INSERT INTO regi (Username,email,firstname,lastname,password,Gender,Contact) VALUES ('$_POST[urname]','$_POST[email]','$_POST[fname]','$_POST[lname]','$_POST[passwd]','NULL','NULL')";
                
                $query = mysqli_query($GLOBALS['con'],$sql);

                $uname=$_POST["urname"];
                $fname=$_POST["fname"];
                $lname=$_POST["lname"];
                $email=$_POST["email"];
                $pass=$_POST["passwd"];

                if($query){
                     
                 
                mysqli_select_db($GLOBALS['con'],"OpinionDB");     
                $sql="CREATE TABLE IF NOT EXISTS profile
                ( 
                    id integer auto_increment primary key,
                    Username varchar(30),
                    status integer ,
                    FOREIGN KEY ( Username ) REFERENCES Regi (Username) on delete cascade
                 )";
                $query=mysqli_query($GLOBALS['con'],$sql);
                if ($query) {
                       $sql = "INSERT INTO profile (Username,status) VALUES ('$_POST[urname]',0)";
                       $query = mysqli_query($GLOBALS['con'],$sql);

                      $_SESSION['un']= $uname;
                      $_SESSION['fn']=$fname;
                      $_SESSION['ln']=$lname;
                      $_SESSION['em']=$email;
                      $_SESSION['pw']= $pass;
                
                       echo "<script>alert ('Record Inserted Successfully...!')</script>";
                       echo "<script type='text/javascript'>window.open('topquestion.php','_self')</script>";
                }
                    
                }
            }
            
           function SignUP(){
                $sql = "SELECT * FROM regi WHERE Username = '$_POST[urname]' AND email = '$_POST[email]'";
                
                $result = mysqli_query($GLOBALS['con'],$sql);
              
                $row = mysqli_fetch_array($result);
                if(!$row){
                    NewUser();
                }else{
                    echo "<script>
                        alert ('You Are Already Registered User......!');
                    </script>";
                }
            }
            
            if(isset($_POST["submit"])){
                
                SignUp();
               /* $sql = "SELECT * FROM regi WHERE Username = '$_POST[urname]' AND email = '$_POST[email]'";
                
                $result = mysqli_query($con,$sql) or die(mysqli_error($con));
              
                $row = mysqli_num_rows($result);
                if($row){
                    echo "<script>
                        alert ('You Are Already Registered User......!');
                    </script>";
                }
                else{
                     $sql = "INSERT INTO regi (Username,email,firstname,lastname,password) VALUES ('$_POST[urname]','$_POST[email]','$_POST[fname]','$_POST[lname]','$_POST[passwd]')";
                
                $query = mysqli_query($con,$sql);
                
                if($query){
                    echo "<script>;
                        alert ('Record Inserted Successfully...!');
                    </script>";
                }
                }

                mysqli_close($con);*/
                mysqli_close($GLOBALS["con"]);
                $boolen = false;
            }    
        }
    ?>
<html>
<head>
 <style type="text/css">
 html
 {
   background-color:#343a40;
   height: 1000px;
 }
 
#span
{
  height:4px;
  width: 150px;
  padding: 10px 0px;
  box-sizing: border-box;
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
.loginbox input[type="text"],input[type="password"],input[type="email"]
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
  height:40px;
  background:#d0183b;
  border-radius: 20px; 
  color:#fff;
  font-size: 18px;
  margin-top:30px;

}
.loginbox input[type="submit"]:hover
{
  cursor: pointer;
  background:#d2b236;
  color:#000;
}



fieldset
{
  width:450px;
  height: 730px;
  color:#fff;
  top:50%;
  left: 50%;
  position:absolute;
  transform: translate(-45%,-35%);
  box-sizing: border-box;
  padding: 20px;

}
.loginbox
{
  padding:20px 20px;
}
.loginbox p
{
   margin: 5px;
   color: white;
   font-size: 18px;
   font-weight: bold;
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

</style>


</head>

 <body>

<fieldset>
  <legend><h1 class="hone" >Register here</h1></legend>
  <div class ="loginbox">
    <form action="signup.php" method="post" id="form">
         <p>User Name:</p>
         <input type="text" id="txtuser" name="urname" placeholder="Username">
         <span id="span" style="color: red;"><?php echo $urerr;?></span>

          <p>Email Address:</p>
          <input type="text" id="txtemail" name="email" placeholder="Email Address">
          <span id="span" style="color: red;"><?php echo $eerr;?></span>

          <p>First Name &amp; Last Name:</p>
          <input type="text" id="txtfname" name="fname" placeholder="First Name" pattern="[A-Z]*[a-z ]*" title="Letters and space can be used" style="width: 160px;">
          <input type="text" id="txtlname" name="lname" placeholder="Last Name" pattern="[A-Z]*[a-z ]*" title="Letters and space can be used" style="float: right;width: 160px;"><br>
          <span id="span" style="color: red;"><?php echo $fnerr;?></span>

          <p>Password:</p>
          <input type="password" id="txtpass" name="passwd" placeholder="Password">
          <span id="span" style="color: red;"><?php echo $perr;?></span>

          <p>Confirm Password:</p>
          <input type="password" id="txtcpass" name="cpasswd" placeholder="Confirm Password">
          <span id="span" style="color: red;"><?php echo $cperr;?></span>  
          <br><br>

         <input type="submit" name="submit" id="btnsub" value="Submit"><br>
     

    </form>

      <button onclick="window.location.href = 'homepage.html'">Back to home?</button><br>
      <button id="bttn" onclick="window.location.href = 'login.php'" >Want to sign in?</button>
  
</div> 
   </fieldset> 
   
</body>
</html>