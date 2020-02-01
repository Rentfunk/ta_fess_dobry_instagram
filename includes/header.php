<?php 
    include("config.php");

    $admin_display = $admin ? "block" : "none";
    $user_display = $admin ? "none" : "block";
?>

<!DOCTYPE html5>

<html>
<head>
    <title>Djanstagram</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="static/css/index_styles.css">
</head>
<body>
    <div class="insta-body">
        <div id="navbaru">
            <div id="insta-logo">
                <img src="static/pictures/instagram-logo.png" alt="instagram lgog" height="60px" width="60px">
            </div>
            <div class="nav-item" id="dd-item">
                <a href="#">Your profile</a>
                <div class="dropdown">
                    <a href="logout.php">Logout</a>
                    <a href="user_posts.php" style="display: <?php echo htmlspecialchars($user_display);?>">Your posts</a>
                    <a href="user_settings.php" style="display: <?php echo htmlspecialchars($user_display);?>">Settings</a>
                    <a href="admin_home_page.php" style="display: <?php echo htmlspecialchars($admin_display);?>">Admin page</a>
                </div>
            </div>
            <div class="nav-item"><a href="index.php">Feed</a></div>
            <div class="nav-item"><a href="add_post.php">Add photo</a></div>
            <div id="dm-btn" class="nav-item"><a href="#">DM</a></div>
        </div>

