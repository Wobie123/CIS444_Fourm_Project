<?php
// db info
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
	// connection succuessful
	
}
?>
