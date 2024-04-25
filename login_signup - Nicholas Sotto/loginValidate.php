<!-- PHP File for the Log In Page -->

<!-- NEED TO SET UP CONNECTION TO THE DATA BASE -->
<?php
	$host = 'localhost';
	$username = 'team_6';
	$password = 'a06h1ld3';
	$dbname = 'team_6';

	

	if ($conn->connect_error) {
		die("Connection Failed: " . $conn->connect_error);
	}
?>



<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="login_signup_style.css">
	<title>Forums Login</title>
</head>

<body>
	<header class = "CSUSM_Header">
	<div class="csusm-logo">
		<img href="" src="https://www.csusm.edu/communications/images/branding-images/csusmlogo_textonlyinitials_blue.jpg"
        alt="CSUSM logo" class="logo">
	</div>
	
	<div class = "header-title">
	<h1>// Login</h1>
		</div>
	</header>
	
	
	<?php
		//retriving data input from login page
		// username and password
		$User_name = $_GET['user'];
		$Pswd = $_GET['pswd'];
		//checking to see if any of the text box is empty
		if (empty($User_name) || empty($Pswd))
			exit("<p> Please enter an email and password to login. Please go back to return to the login page.</p>");
		try {
			$conn = new mysqli($host, $username, $password, $dbname);
		} catch (Exception $exc) {
			$connerror = $exc->getMessage();
			$connerrno = $exc->getCode();
		}
		
		$TableName = "User";
		$SQLstring = "SELECT * FROM $TableName WHERE Username='$User_name'"; //AND Password='$Pswd'
		$QueryResult = $conn->query($SQLstring);
		if($QueryResult->num_rows == 0)
			die("<p>You must enter a valid username. Please try again.</p>");
		
	?>
</body>
</html>