<?php 
    session_start();
    require("includes/check_if_logged_in.php");
    require("db.php");
    include_once("includes/header.php");
    $pid = $_GET["pid"];
    
    $sql = "SELECT * FROM posts WHERE id = '$pid'";

    $res = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($res);
    $name = $row["post_name"];
    $content = $row["post_text"];
    

?>

<div id="main-feed">
    <?php echo $pid;?>
    <form action="edit_post.php" method="post" id="add-post-form">
        <input id="name" type="text" name="name" placeholder="Name: " value="<?php echo htmlspecialchars($name); ?>">
        <textarea id="textarea" type="text" name="content" rows="18" placeholder="Your post here..."><?php echo $content; ?></textarea>
        <input type="submit" name="post" value="Submit">
    </form>
</div>

<?php 
    if (isset($_POST["post"])) {
        $name = $_POST["name"];
        $content = $_POST["content"];
        $sql1 = "UPDATE posts SET post_name = '$name', post_text = '$content' WHERE id = '$pid'";

        $res1 = mysqli_query($conn, $sql1) or die("Error:" . mysqli_error($conn));
    }

    include("includes/dirm.php");
    include("includes/footer.php");
?>
