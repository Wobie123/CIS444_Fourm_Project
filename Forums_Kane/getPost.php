<?php
include 'config.php';


function getPost()
{
    global $conn;

    $sql = "SELECT * FROM Post";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["Post"];
    } else {
        return "";
    }
}
