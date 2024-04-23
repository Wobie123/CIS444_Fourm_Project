<?php
include 'config.php';

// Read
function getForumName()
{
    global $conn;
    // query
    $sql = "SELECT ForumName FROM Forums WHERE ForumID = ...";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["ForumName"];
    } else {
        return "";
    }
}
