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
	
	html
	{
		background-color: #f1f1f1;
	}
		.flexbox
		{
			display: flex;
			position: absolute;
			top: 120px;
			width: 100%

		}
		.flex1{
			flex: 1;
			
			padding: 30px;
			border-right: 10px solid black;

		}
		.flex2{
			flex: 1;
			padding: 30px;
			border-left: 10px solid black;
		}

	</style>
</head>
<body>
	<div id="header"></div>
	<div class="flexbox">
<?php 

$conn = mysqli_connect('localhost','root','');
 
if(!$conn)
{
    die(mysqli_error());
}

mysqli_select_db($conn,"OpinionDB");

$content_id=$_GET['content_id'];

$sql="SELECT * FROM upvote WHERE content_id='$content_id'";
$query=mysqli_query($conn,$sql);
$num= mysqli_num_rows($query);
if($num > 0)
{
	
			
echo '<div class="flex1">';
echo '<table style="width:100%;">';
echo'<tr style="font-weight:bold;background-color:black; color:white;height:25px;border:3px solid #f1f1f1;"><td style="padding:5px">'.$num.' upvotes </td></tr>';

	while ($row=mysqli_fetch_array($query)) {
		echo'<tr style="background-color:white;height:25px;border:3px solid #f1f1f1;">';
		echo'<td style="padding:5px">';
		echo $row['Username'];
		echo'</td>';
		echo'</tr>';		
	}

echo '</table>';
echo '</div>';
}else{

	echo '<div class="flex1">';
	echo '<table style="width:100%;">';
	echo'<tr style="font-weight:bold;background-color:black;height:25px; color:white;border:3px solid #f1f1f1;"><td style="padding:5px">'.$num.' upvote </td></tr>';
	echo '</table>';
	echo '</div>';

	}



$sql="SELECT * FROM downvote WHERE content_id='$content_id'";
$query=mysqli_query($conn,$sql);
$num= mysqli_num_rows($query);
if($num > 0)
{
	
			
echo '<div class="flex2">';
echo '<table style="width:100%;">';
echo'<tr style="font-weight:bold;background-color:black;height:25px; color:white;border:3px solid #f1f1f1;"><td style="padding:5px">'.$num.' downvotes </td></tr>';
	while ($row=mysqli_fetch_array($query)) {
		echo'<tr style="background-color:white;height:25px;border:3px solid #f1f1f1;">';
		echo'<td style="padding:5px">';
		echo $row['Username'];
		echo'</td>';
		echo'</tr>';
		
	}
	

echo '</table>';
echo '</div>';
}
else{

	echo '<div class="flex2">';
	echo '<table style="width:100%;">';
	echo'<tr style="font-weight:bold;background-color:black;height:25px; color:white;border:3px solid #f1f1f1;"><td style="padding:5px">'.$num.' downvote </td></tr>';
	echo '</table>';
	echo '</div>';

	}
?>
</div>
</body>
</html>


