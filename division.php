<!DOCTYPE html>
<html>
<head>
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
    html{
        background-color: #f1f1f1;
    }
        .row
        {
            position: absolute;
            top: 120px;
            width: 100%
        }
        #footer
        {
            width: 100%;
            position: absolute;
            bottom: 0px;
            left: 0px;
        }
        #listed:hover{
            background-color: #343a40;
            color: white;
        }
    </style>
</head>
<body>
<div id="header"></div>
<div class="row">
<div class="col-5 firstCol m-auto">
       
  <h2>Select questions from your region!!!</h2>
  <div class="list-group" >
    <a href="region.php?region=Dhaka" class="list-group-item list-group-item-action" id="listed">Dhaka</a>
    <a href="region.php?region=Chattogram" class="list-group-item list-group-item-action" id="listed">Chattogram</a>
    <a href="region.php?region=Khulna" class="list-group-item list-group-item-action" id="listed">Khulna</a>
    <a href="region.php?region=Barishal" class="list-group-item list-group-item-action" id="listed">Barishal</a>
    <a href="region.php?region=Rajshahi" class="list-group-item list-group-item-action" id="listed">Rajshahi</a>
    <a href="region.php?region=Sylhet" class="list-group-item list-group-item-action" id="listed">Sylhet</a>
    <a href="region.php?region=Rangpur" class="list-group-item list-group-item-action" id="listed">Rangpur</a>
    <a href="region.php?region=Mymensingh" class="list-group-item list-group-item-action" id="listed">Mymensingh</a>

  </div>

    </div>
    <div class="col-5  m-auto"><img src="map-bangladesh.PNG" style="height: 450px; width: 80%;"></div>
</div>
<div id="footer"></div>
</body>
</html>