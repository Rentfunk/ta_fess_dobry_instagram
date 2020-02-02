<?php 
    session_start();
    require("includes/check_if_logged_in.php");
    include_once("includes/header.php");
    require("db.php");
    if (isset($_POST["post"])) {
        $postname = strip_tags($_POST["name"]);
        $content = strip_tags($_POST["content"]);

        $postname = mysqli_real_escape_string($conn, $postname);
        $content = mysqli_real_escape_string($conn, $content);

        $date = date("jS F Y H:i:s");
        $post_user = $_SESSION["username"];

        $sql = "INSERT INTO posts (post_name, post_text, date, post_user) VALUES ('$postname', '$content', '$date', '$post_user')";

        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        header("Location: index.php");
        
    }
?>

<div id="main-feed">
    <form action="add_post.php" method="post" id="add-post-form">
        <input id="name" type="text" name="name" placeholder="Name: ">
        <textarea id="textarea" type="text" name="content" rows="18" placeholder="Your post here..."></textarea>
        <input type="submit" name="post" value="Submit">
    </form>
</div>
<?php include("includes/dirm.php"); ?>
<?php include("includes/footer.php"); ?>
