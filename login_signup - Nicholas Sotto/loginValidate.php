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
<html lang = "en">
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
	
		session_start();
		$Email = $_GET['email'];
		$_SESSION['email'] = $Email;
		//retriving data input from login page
		// username and password
		$User_name = $_GET['user'];
		$Pswd = $_GET['pswd'];
		//checking to see if any of the text box is empty
		if (empty($User_name) || empty($Pswd)) 
			//checks to see if the username or password have been entered
			
			exit("<p> Please enter an email and password to login. Please go back to return to the login page.</p>"); 
			//displays this message to go back to attept to sign in
	
		//attept to connec to database
		try {
			$conn = new mysqli($host, $username, $password, $dbname);
		}
		//will display the error message and code if it the database does not connect
		catch (Exception $exc) {
			$connerror = $exc->getMessage();
			$connerrno = $exc->getCode();
		}
		
		//check database to see if username and password match
		$TableName = "User";
		$sqlvalidate = "SELECT * FROM $TableName WHERE Username ='$User_name' 
					AND Password='$Pswd'";
		$QueryResult = $conn->query($SQLstring);
	
		//if number of rows = 0, results return none so will display the message below
		if($QueryResult->num_rows == 0)
			die("<p>You must enter a valid username. Please try again.</p>");
		//successful to match a row, will close the database
		else $username = $Row[0];
		$conn->close();
	?>
	
	
	<form action="NEED PHP FOR HOME PAGE.php" class = "login-background" method = "get">
	<h2> Welcome back, <? $username ?> !</h2>
	<p> <input type = "hidden" name="user" value ="<?= $username ?>"</p>
		<input type ="submit" value = "Continue to Homepage" /> </p>
	</form>
</body>
</html>
