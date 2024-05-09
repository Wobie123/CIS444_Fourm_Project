<?php
session_start();

// db info
$servername = "localhost";
$username = "team_6";
$password = "a06h1ld3";
$database = "team_6";

// create connection
$conn = new mysqli($servername, $username, $password, $database);

// check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header('Location:../login_signup/login.html'); // Redirect to the login page if not logged in
    exit;
}

// Get the user's email from the session variable
$email = $_SESSION['email'];

// create_post.php
// Validate and sanitize user input
$forumName = $_POST['forumName'];
$title = $_POST['title'];
$body = $_POST['body'];
$tags = $_POST['tags'];

// Validate forum name
if (empty($forumName)) {
    $error = 'Forum name is required';
    header('Location: CreatePost.php?error='. urlencode($error));
    exit;
}

// Validate title
if (empty($title)) {
    $error = 'Title is required';
    header('Location: CreatePost.php?error='. urlencode($error));
    exit;
}

// Validate body
if (empty($body)) {
    $error = 'Body is required';
    header('Location: CreatePost.php?error='. urlencode($error));
    exit;
}

// Create a prepared statement to insert the post
$stmt = $conn->prepare('INSERT INTO Post (PostOwnerEmail, ForumName, Title, Body) VALUES (?,?,?,?)');
$stmt->bind_param('ssss', $email, $forumName, $title, $body);
if (!$stmt->execute()) {
    echo "Error inserting post: ". $stmt->error;
    exit;
}

// Get the inserted post ID
$postID = $stmt->insert_id;

// Insert tags
$tagsArray = explode(',', $tags);
foreach ($tagsArray as $tag) {
    // Remove any leading or trailing spaces from the tag
    $tag = trim($tag);

    // Check if the tag already exists
    $stmt = $conn->prepare('SELECT 1 FROM Tag WHERE TagName =?');
    $stmt->bind_param('s', $tag);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        // Tag doesn't exist, insert it into the Tag table
        $stmt = $conn->prepare('INSERT INTO Tag (TagName) VALUES (?)');
        $stmt->bind_param('s', $tag);
        if (!$stmt->execute()) {
            echo "Error inserting tag: ". $stmt->error;
            exit;
        }
    }

    // Insert the post-tag relationship into the PostTag table
    $stmt = $conn->prepare('INSERT INTO PostTag (PostID, TagName) VALUES (?,?)');
    $stmt->bind_param('is', $postID, $tag);
    if (!$stmt->execute()) {
        echo "Error inserting post-tag relationship: ". $stmt->error;
        exit;
    }
}

// Redirect to the Homepage
header('Location:../HomePage/HomePage.html');
exit;

// Close the database connection
$conn->close();
?>
