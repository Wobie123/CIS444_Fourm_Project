<?php
// Include the database connection
include 'config.php';

session_start();
// Get the user's email from the session
//$user_email = $_SESSION['email'];
$user_email = "ha134@csusm.edu";//for testing
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an array to store potential errors
    $errors = array();

    // Check if the first name is provided
    if (isset($_POST['firstName']) && !empty(trim($_POST['firstName']))) {
        $first_name = mysqli_real_escape_string($conn, trim($_POST['firstName']));
        $update_query = "UPDATE User SET FirstName = '$first_name' WHERE Email = '$user_email'";
        $result = $conn->query($update_query);
        if (!$result) {
            $errors[] = "Error updating first name: " . $conn->error;
        }
    }

    // Check if the last name is provided
    if (isset($_POST['lastName']) && !empty(trim($_POST['lastName']))) {
        $last_name = mysqli_real_escape_string($conn, trim($_POST['lastName']));
        $update_query = "UPDATE User SET LastName = '$last_name' WHERE Email = '$user_email'";
        $result = $conn->query($update_query);
        if (!$result) {
            $errors[] = "Error updating last name: " . $conn->error;
        }
    }

    // Check if the username is provided
    if (isset($_POST['userName']) && !empty(trim($_POST['userName']))) {
        $username = mysqli_real_escape_string($conn, trim($_POST['userName']));
        $update_query = "UPDATE User SET Username = '$username' WHERE Email = '$user_email'";
        $result = $conn->query($update_query);
        if (!$result) {
            $errors[] = "Error updating username: " . $conn->error;
        }
    }

    // Check if the isAnonymous checkbox is checked
    $isAnonymous = isset($_POST['isAnonymous']) ? 1 : 0;
    $update_query = "UPDATE User SET IsAnonymous = $isAnonymous WHERE Email = '$user_email'";
    $result = $conn->query($update_query);
    if (!$result) {
        $errors[] = "Error updating isAnonymous: " . $conn->error;
    }

    // Check if there are any errors
    if (empty($errors)) {
        // Redirect to a success page or display a success message
        header("Location: profilepage.html");
        exit();
    } else {
        // Display error messages
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>
