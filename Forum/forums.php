<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="forum-style.css">

    <title>Forums v2</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<body>
    <header>
        <div class="header-logo-container">
            <span class="header-logo">
                <a href="../HomePage/HomePage.html">
                    <img src="../images/csusmlogo.png" alt="csusm-logo-blue">
                    <div class="logo-title">
                        <h1>Forums</h1>
                    </div>
                </a>
            </span>
        </div>
        <div class="header-search-container">
            <span>Q</span>
            <input type="text" placeholder="Search Forums...">
        </div>
        <div class="header-icon-container">
            <span class="profile-icon">
                <a href="../ProfilePage/profilepage.html"><img src="images/bell-svgrepo-com.svg" alt=""></a>
                <a href="../ProfilePage/profilepage.html"><img src="images/profile-pic.png" alt=""></a>
            </span>
        </div>
    </header>
    <div class="content-panel-container">
        <div class="content-panel">
            <span class="panel-title">
                <!-- -->
                <?php

		include 'config.php';

		if (isset($_GET['ForumName'])) {
    		$forum_name = $_GET['ForumName'];
    
    		$stmt = $conn->prepare("SELECT ForumName FROM Forum WHERE ForumName =?");
    		$stmt->bind_param("s", $forum_name);
    		$stmt->execute();
    		$result = $stmt->get_result();

   		 if ($result->num_rows > 0) {
        		$row = $result->fetch_assoc();
        		$insert_this = $row["ForumName"];
        		echo "<h1 id='forum-name'>// $insert_this</h1>";

    		} else {
        		echo "error 1";
    		}

		} else {
			echo "error getting forum name";
    		
		}

		$conn->close();
		?>
            </span>
            <span class="panel-filter">
                <!--<form> ?? idk-->
                <label for="post-filter">Filter By:</label>
                <select name="post-filter" id="post-filter">...
                    <option value="">Date</option>
                    <option value="">Views</option>
                    <option value="">Replies</option>
                </select>
            </span>

<?php

// populate posts
include 'config.php';

if (isset($_GET['ForumName'])) {
    $forumName = $_GET['ForumName'];
    $stmt = $conn->prepare("SELECT ForumName FROM Forum WHERE ForumName =?");
    $stmt->bind_param("s", $forumName);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $insert_this = $row["ForumName"];
        $stmt = $conn->prepare("SELECT p.PostID, p.Title, p.Body, p.PostDate, GROUP_CONCAT(t.TagName) AS TagNames 
                                FROM Post p 
                                LEFT JOIN PostTag pt ON p.PostID = pt.PostID 
                                LEFT JOIN Tag t ON pt.TagName = t.TagName 
                                WHERE p.ForumName =?
                                GROUP BY p.PostID, p.Title, p.Body, p.PostDate");

        $stmt->bind_param("s", $forumName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='post-container'>";
                echo "<a href='../ForumView/forumview.html?PostID={$row['PostID']}' class='post-link'>";
                echo "<div class='post'>";
                echo "<div class='post-image'><img src='images/profile-pic.png' alt=''></div>";
                echo "<div class='post-content'>";

                $tagNames = explode(',', $row['TagNames']);
                echo "<div class='post-tag' style=''>";

                foreach ($tagNames as $tagName) {
                    if (!empty($tagName)) {
                        echo "<p id='TagName'>{$tagName}</p>";
                    }
                }
                echo "</div>";
                echo "<h4 id='Title'>". htmlspecialchars($row["Title"]). "</h4>";
                echo "<p id='Body'>". htmlspecialchars($row["Body"]). "</p>";
                echo "<div class='post-date'>";
                echo "<p id='PostDate'>Posted: ". date_format(date_create($row["PostDate"]), 'm/d/y'). "</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</a>";
                echo "</div>";
            }
        } else {
            echo "No posts found.";
        }
    } else {
        echo "error 1";
    }
} else {
    echo "error getting forum name";
}

$conn->close();

?>		
                         
                        </div>
                    </div>
                </a>
            </div>

            
            <div class="page-nav">
                <!-- to do: add nav -->
            </div>
        </div>
    </div>
    <!--end content panel-->
    <footer>

    </footer>
</body>

</html>