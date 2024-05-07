<?php
// Include the database connection
include 'config.php';

// Start the session
session_start();

// Get the user's email from the session
//$user_email = $_SESSION['email'];
$user_email = "ha134@csusm.edu";//for testing
$user_data = array();

$sql = "SELECT * FROM User WHERE Email = '$user_email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, fetch data
    $row = $result->fetch_assoc();
    $user_data['FirstName'] = $row['FirstName'];
    $user_data['LastName'] = $row['LastName'];
    $user_data['Username'] = $row['Username'];
    $user_data['IsAnonymous'] = $row['IsAnonymous'];
    $user_data['Email'] = $row['Email'];
} else {
    // User not found or error occurred
    $user_data['error'] = "User data not found.";
}

// Close the database connection
$conn->close();

// Return user data as JSON
echo json_encode($user_data);
?>

