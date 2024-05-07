<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./forumSyle.css">

    <title>Forums v2</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<body>
    <header>
        <div class="header-logo-container">
            <span class="header-logo">
                <a href="../HomePage/HomePage.html">
                    <img src="images/csusm-logo-blue.png" alt="csusm-logo-blue">
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
                <a href="../My_Page"><img src="images/bell-svgrepo-com.svg" alt=""></a>
                <a href="../My_Page"><img src="images/profile-pic.png" alt=""></a>
            </span>
        </div>
    </header>
    <div class="content-panel-container">
        <div class="content-panel">
            <span class="panel-title">
                <!-- -->
                <?php
                include './config.php';

                try {
                    $sql = "SELECT * FROM Forum";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<h1 id='forum-name'>" . $row['ForumName'] . "</h1";
                        }
                    } else {
                        echo "No data available";
                    }
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
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

            <!--EXAMPLE POST-->
            <div class="post-container">
                <a href="../Forum_View/forumview.html" class="post-link">
                    <div class="post" id="">
                        <div class="post-image"><img src="images/profile-pic.png" alt=""></div>
                        <div class="post-content">
                            <div class="post-tag">
                                <p id="TagName">Post Tag</p>
                            </div>

                            <?php
                            include './config.php';

                            try {
                                $sql = "SELECT * FROM Post";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<h4 id='Title'>" . $row['Title'] . "</h4>";
                                        echo "<p id='Body'>" . $row['Body'] . "</p>";
                                        echo "<div class='post-date'><p id='PostDate'>" . $row['PostDate'] . "</p></div>";
                                    }
                                } else {
                                    echo "No data available";
                                }
                            } catch (Exception $e) {
                                echo "Error: " . $e->getMessage();
                            }
                            $conn->close();
                            ?>

                            <!--
                            <h4 id="Title">Title</h4>
                            <p id="Body">Body</p>
                            <div class="post-date">
                                <p id="PostDate">Posted: 10/20/24</p>
                            </div>
                            -->
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

    </script>
</body>

</html>