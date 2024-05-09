<!-- PHP File for the Log In Page -->

<!-- NEED TO SET UP CONNECTION TO THE DATA BASE -->

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
	<img src="../images/csusmlogo.png" alt="CSUSM logo" class="logo">
	</div>
	
	<div class = "header-title">
	<h1>// Login</h1>
		</div>
	</header>
	
	<form id = "login" action="../HomePage/HomePage.html" class = "login-background" method = "get">
	<?php
		session_start();
		//$_SESSION['email'] = 'email';
		//echo("Session variable is an email and is set to " . $_SESSION['email'] . ".");
		$User_name = $_GET['user'];
		$Pswd = $_GET['pswd'];
		//checking to see if any of the text box is empty
		if (empty($User_name) || empty($Pswd)) 
			//checks to see if the username or password have been entered
			
			exit("<p> Please enter an username and password to login. Please go back to return to the login page.</p>"); 
			//displays this message to go back to attept to sign in
	
		//attept to connect to database
		//db info
		$servername = "localhost";
		$username = "team_6";
		$password = "a06h1ld3";
		$database = "team_6";

		// create connection
		$conn = new mysqli($servername, $username, $password, $database);

		// check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}else{
			//echo("<p>inside Connection Successful</p>");
			//return;
		}
		
		
		//check database to see if username and password match
		$TableName = "User";
		$sqlvalidate = "SELECT * FROM $TableName WHERE Username ='$User_name'"; 
		//AND Password='$Pswd'";
		$QueryResult = $conn->query($sqlvalidate);
		
		//if number of rows = 0, results return none so will display the message below
		if($QueryResult->num_rows == 0)
			die("<p>You must enter a valid username. Please go back to return to the login page.</p>");
		//Grabs the row numbers of teh matched user
		$Row = $QueryResult->fetch_row();
		if ($Pswd != $Row[4])
			die("<p>The username and password do not match. Please go back to return to the login page.");
		//successful to match a row, will close the database
		else //echo("<p> Username and Password matched! </p>");

		$sqlemail = "SELECT Email FROM $TableName WHERE Username = '$User_name'";
		$QueryResult = $conn->query($sqlemail);
		if ($QueryResult ->num_rows > 0) {
 		while($row = $QueryResult ->fetch_assoc()) {
    		//echo "Email: " . $row["Email"]. "<br>";
		$_SESSION['email'] = $row["Email"];
  		}
		} else {
		  echo "0 results";
		}
		$conn->close();  
		

		$conn->close();  
		
	?>
	
	<h2> Welcome back, <?= $User_name ?>!</h2>
	<p>
		<input type ="submit" value = "Continue to Homepage" />
	</p>
	</form>	
</body>
</html>
