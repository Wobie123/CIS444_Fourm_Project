<!-- PHP File for the Sign Up Page -->


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
	
	<form id = "signup" action="../HomePage/HomePage.html" class = "login-background" method = "get">
<!-- NEED TO SET UP CONNECTION TO THE DATA BASE -->
<?php
	
	// taking values from the html form of signup 
	$FirstName = $_GET['Fname'];
	$LastName = $_GET['Lname'];
	$User_Name = $_GET['Usrname'];
	$Email = $_GET['email'];
	$Password = $_GET['initialPSWD'];
	$Password_Confirm = $_GET['secondPSWD'];
	
	session_start();
	$_SESSION['email'] = '$Email';

	//SECTION BELOW WILL BE CHECK FOR ANY BLANK, ERRORS, MISMATCH PASSOWRDS, AND PASSWORD LENGTH
	//checking to see if any values are empty
	if (empty($FirstName) || empty($LastName) 
		|| empty($User_Name ) || empty($Email)
		|| empty($Password) || empty($Password_Confirm))
		//returns the following message if any are empty
		exit ("<p> All fields must be filled to sign up. Please go back to return to the sign up page</p>");

	//checking to see if an email is valid
	else if (!preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/", $Email ))
		//returns the following message if the email is not valid
		exit ("<p> A valid email must be entered. Please go back to return to the sign up page</p>");
	
	//check to see if passwords match
	else if ($Password != $Password_Confirm)
		//returns the following message if the passwords do not match
		exit("<p> Your passwords did not match. Please go back to return to the sign up page</p>");
	
	else if (strlen($Password) < 8)
		exit("<p> Your password must be at least 8 characters. Please go back to return to the sign up page</p>");

	ini_set("display_errors", 1);
	error_reporting(E_ALL);


	//CONNECTING TO THE DATABASE AND RETURNING ANY ERRORS IF THE CONNECTION DOES NOT WORK
	$servername = "localhost";
	$username = "team_6";
	$password = "a06h1ld3";
	$database = "team_6";

	// create connection
	$conn = new mysqli($servername, $username, $password, $database);

	// check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} else {
		//echo "Connection success";
		//return;
	}


	
	//grabs table from the db
	$TableName = "User";
	//creating a string to use for sql
	$sqlcheck = "SELECT * FROM $TableName";

	//checking to see if any rows are returned
	$QueryResult = $conn->query($sqlcheck);
	if($QueryResult->num_rows > 0) {
		$Row = $QueryResult->fetch_row();
		do {
			if (in_array($Email, $Row)) 
			exit("<p>The email address you entered is already in use. Please go back to return to the sign up page</p>");
			$Row = $QueryResult->fetch_row();
		} while ($Row);
		$QueryResult->free_result();
	}


	// performing insert query if there is no matching email in database
	// order of values (Email, FirstName, LastName, Username, Password)
	$sqlinsert = "INSERT INTO $TableName (Email, FirstName, LastName, Username, Password)
			Values ('$Email','$FirstName','$LastName','$User_Name','$Password')";
	//entering the sqlinsert into the database query
	$QueryResult = $conn->query($sqlinsert);
	$conn->close();

?>
	
	<h2> Welcome to the CSUSM Forums!</h2>
	<!--
	<p> <input type = "hidden" name="user" value =""</p> -->
		<input type ="submit" value = "Continue to Homepage" /> </p>
	</form>
</body>
</html>
