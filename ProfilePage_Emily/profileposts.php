<?php
// Include the database connection
include 'config.php';

// Start the session
session_start();

// Get the user's email from the session
//$user_email = $_SESSION['email'];
$user_email = "ha134@csusm.edu";//for testing

// Initialize an empty array to store user posts
$user_posts = array();

// SQL query to retrieve posts belonging to the user
$sql = "SELECT * FROM Post WHERE PostOwnerEmail = '$user_email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through each row to fetch post data
    while ($row = $result->fetch_assoc()) {
        // Extract post information
        $post_id = $row["PostID"];
        $title = $row["Title"];
        $post_date = $row["PostDate"];

        // Format the post date
        $formatted_date = date("Y-m-d", strtotime($post_date));

        // Build an array containing post data
        $post_data = array(
            "id" => $post_id,
            "title" => $title,
            "date" => $formatted_date
        );

        // Push the post data to the user_posts array
        $user_posts[] = $post_data;
    }
}

// Close the database connection
$conn->close();

// Return user posts as JSON
echo json_encode($user_posts);
?>

