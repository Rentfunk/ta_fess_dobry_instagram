<?php
    session_start();
    require("includes/check_if_logged_in.php");
    include("includes/header.php");
    include("db.php");
    
    $pid = $_GET["pid"];
    $sql = "SELECT * FROM posts WHERE id = '$pid'";

    $res = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($res);

    $username = $row["post_name"];
    $date = $row["date"];
    $content = $row["post_text"];
?>

<div id="main-feed">
    <?php echo create_post($pid, $username, $date, $content, $admin); ?>
</div>

<?php
    include("includes/dirm.php");
    include("includes/footer.php");
?>
