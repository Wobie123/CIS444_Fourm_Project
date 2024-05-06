<?php
// Include the database connection
include 'config.php';
session_start();
// Email of the user
//$user_email = "ha134@csusm.edu";//for testing
$user_email = $_SESSION['email'];
if (isset($_GET['postId'])) {
    // Sanitize the postId parameter to prevent SQL injection
    $postId = mysqli_real_escape_string($conn, $_GET['postId']);
    

    // Remove the post from starred posts
    $sql_delete = "DELETE FROM UserStarredPost WHERE Email = '$user_email' AND PostID = $postId";
    $result = $conn->query($sql_delete);

    if (!$result) {
        echo "Error removing post from starred: " . $conn->error;
    }
}
// SQL query to retrieve starred posts for the given user along with their tags
$sql = "SELECT Post.*, GROUP_CONCAT(Tag.TagName) AS Tags
        FROM Post
        INNER JOIN UserStarredPost ON Post.PostID = UserStarredPost.PostID
        LEFT JOIN PostTag ON Post.PostID = PostTag.PostID
        LEFT JOIN Tag ON PostTag.TagName = Tag.TagName
        WHERE UserStarredPost.Email = '$user_email'
        GROUP BY Post.PostID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div style="height: 400px; overflow-y: scroll;">';//container for overflow
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        // Extracting post information
        $post_id = $row["PostID"];
        $title = $row["Title"];
        $body = $row["Body"];
        $post_date = $row["PostDate"];
        $tags = $row["Tags"];

        // Formatting date
        $formatted_date = date("m/d/y", strtotime($post_date));

        // Outputting HTML for each post
        echo '<div class="post">';
        echo '<a href="../Forum_View/forumview.html" class="post-link">';
        echo '<div class="post-container" id="">';
        echo '<div class="post-image"><img src="images/profile-pic.png" alt=""></div>';
        echo '<div class="post-content">';
        echo '<div class="post-tag">';
        echo "<p>$tags</p>"; // Displaying all tags associated with the post
        echo '</div>';
        echo '<div class="post-header">';
        echo "<h4 id='post-title'>$title</h4>";//tittle of the discription
        echo '</div>';
        echo "<p id='post-description'>$body</p>";//body of the discription
        echo '<div class="post-date">';
        echo "<p>Posted: $formatted_date</p>";//display posted date with format
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</a>';
        echo "<input type='checkbox' id='star-checkbox' onclick='removeStarredPost($post_id)'>";
        echo "<label for='star-checkbox' class='star-checkbox'>></label>";
        echo '</div>';
    }
    echo '</div>';//end of starredpost container
} else {
    echo "you have no starred posts";
}

$conn->close();
?>

<script>
    function removeStarredPost(postId) {
        if(confirm('Are you sure you want to remove this post from starred?')) {
            window.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>?postId=' + postId;
        }
    }
</script>

