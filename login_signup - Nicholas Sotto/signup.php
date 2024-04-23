<!-- PHP File for the Sign Up Page -->


<!-- NEED TO SET UP CONNECTION TO THE DATA BASE -->
<?php
	$host = 'localhost';
	$username = 'team_6';
	$password = 'a06h1ld3';
	$dbname = 'team_6';

	$conn = new mysqli($host, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection Failed: " . $conn->connect_error);
	}

	// taking values from the html form of signup 
	$FirstName = $_REQUEST["Fname"];
	$LastName = $_REQUEST["Lname"];
	$User_Name = $_REQUEST["Usrname"];
	$Email = $_REQUEST["email"];
	$Password = $_REQUEST["secondPSWD"]
		
		
	// performing insert query
	// order of values (Email, FirstName, LastName, Username, Password)
	$sql = "INSERT INTO User (Email, FirstName, LastName, Username, Password)
			Values ('$Email','$FirstName','$LastName','$User_Name','$Password')";
?>


<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="login_signup_style.css">
	<title>Sign Up</title>
</head>

<body>
	<header class = "CSUSM_Header">
	<div class="csusm-logo">
		<img href="" src="https://www.csusm.edu/communications/images/branding-images/csusmlogo_textonlyinitials_blue.jpg"
        alt="CSUSM logo" class="logo">
	</div>
	
	<div class = "header-title">
	<h1>// Sign Up</h1>
		</div>
	</header>
</body>
</html>