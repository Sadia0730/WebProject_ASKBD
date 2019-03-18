<?php 
session_start();
?>
<head>
  
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1">

 
  
</head>
<style type="text/css">
  body{
  height: 56px;
  }
 
</style>
<body>
  <header>
<?php
    
        if(isset($_SESSION['un']))//available for loggid in users
        {
          echo '<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
        <div class="container">
          <a href="" class="navbar-brand text-danger font-weight-bold">Ask BD</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsenavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse text-center" id="collapsenavbar" >
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a href="homepage.html" class="nav-link text-white bg-dark" >Home</a>
              </li>
              <li class="nav-item">
                <a href="topquestion.php" class="nav-link text-white bg-dark">Top Question</a>
              </li>
              <li class="nav-item">
                <a href="homepage.html#about" class="nav-link text-white bg-dark">About</a>
              </li>
              <li class="nav-item">
                <a href="profile.php" class="nav-link text-white bg-dark">Profile</a>
              </li>
              <li class="nav-item">
                <a href="division.php" class="nav-link text-white bg-dark">Divisions</a>
              </li>
              <li class="nav-item">
                <a href="logout.php" class="nav-link text-white bg-dark">Log Out</a>
              </li>
              
            </ul>
            
          </div>
        </div>
        
      </nav>
';
        }
         else if(isset($_SESSION['admin']))//available for loggid in users
        {
          echo '<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
        <div class="container">
          <a href="" class="navbar-brand text-danger font-weight-bold">Ask BD</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsenavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse text-center" id="collapsenavbar" >
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a href="division.php" class="nav-link text-white bg-dark" >Divisions</a>
              </li>
              <li class="nav-item">
                <a href="topquestion.php" class="nav-link text-white bg-dark">Top Question</a>
              </li>
              <li class="nav-item">
                <a href="logout.php" class="nav-link text-white bg-dark">Log Out</a>
              </li>
              
            </ul>
            
          </div>
        </div>
        
      </nav>
';
        }
        else //available for not-loggid in users
        {
          echo '<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
        <div class="container">
          <a href="" class="navbar-brand text-danger font-weight-bold">Ask BD</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsenavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse text-center" id="collapsenavbar" >
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a href="homepage.html" class="nav-link text-white bg-dark" >Home</a>
              </li>
              <li class="nav-item">
                <a href="topquestion.php" class="nav-link text-white bg-dark">Top Question</a>
              </li>
              <li class="nav-item">
                <a href="homepage.html#about" class="nav-link text-white bg-dark">About</a>
              </li>
              <li class="nav-item">
                <a href="division.php" class="nav-link text-white bg-dark">Divisions</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white bg-dark" href="#drop" data-toggle="dropdown">Sign in</a>
                  <div class="dropdown-menu bg-dark" id="drop">
                       <a class="dropdown-item text-white bg-dark"  href="login.php">as user</a>
                       <a class="dropdown-item text-white bg-dark" href="admin.php">as admin</a>
                  </div>
              </li>
              <li class="nav-item">
                <a href="signup.php" class="nav-link text-white bg-dark">Sign Up</a>
              </li>
              
            </ul>
            
          </div>
        </div>
        
      </nav>
';
  }
   
  ?>
</header>
  </body>