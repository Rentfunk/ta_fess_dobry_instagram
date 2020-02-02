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
    $edit_post = $row["edit_post"];
    $post_user = $_SESSION["username"];
?>

<div id="main-feed">
    <?php echo create_post($pid, $username, $date, $content, $post_user, $admini, $edit_post); ?>
</div>

<?php
    include("includes/dirm.php");
    include("includes/footer.php");
?>
