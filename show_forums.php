<?php
// Include the database configuration file
require_once 'config.php';

// SQL query to select all forum names
$sql = "SELECT ForumName FROM Forum";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    echo "<h1>Forum Names</h1>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row["ForumName"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No forums found";
}

// Close the database connection
$conn->close();
?>
