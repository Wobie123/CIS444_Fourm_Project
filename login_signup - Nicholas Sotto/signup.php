<!doctype html>
<html lang = "en"><head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="login_signup_style.css">
	<title>CSUSM Forum Sign Up</title>
</head>

<body>
	<header class = "CSUSM_Header">
	<div class="csusm-logo">
        <img src="../images/csusmlogo.png" alt="CSUSM logo" class="logo">
	</div>
	
	<div class = "header-title">
	<h1>// Sign Up</h1>
		</div>
	</header>
	
		

	<form id = "signup" action = "signupregister.php" class = "login-background" method = "get">
		<h2> Sign Up </h2>
		
		<label> First Name <br>
			<input type = "text" name = "Fname" size = "25" />
		</label>
		
		<br> <br>
		<label> Last Name <br>
			<input type = "text" name = "Lname" size = "25" />
		</label>

		<br> <br>
		<label> Username <br>
			<input type = "text" name = "Usrname" size = "25" />
		</label>
		
		<br> <br>
		<label> CSUSM Email <br>
			<input type = "text" name = "email" size = "25" />
		</label>


		<br> <br>
		<label> Password <br>
			<input type = "password" name = "initialPSWD" size = "25" />
		</label>

		<br> <br>
		<label> Re-enter Password <br>
			<input type = "password" name = "secondPSWD" size = "25" />
		</label>

		<br> <br>
		<input type = "submit" value = "Sign Up" class = "signbutton" />
		<br><br>
	</form>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

</body>
</html>
