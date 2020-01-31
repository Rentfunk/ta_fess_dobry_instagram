<?php 
    session_start();
    require("includes/check_if_logged_in.php");
    require("db.php");
    include_once("includes/header.php");
    $pid = $_GET["pid"];
    $sql = "SELECT * FROM posts WHERE id = '$pid'";

    $res = mysqli_query($conn, $sql) or die("Select error: ". mysqli_error($conn));

    $row = mysqli_fetch_assoc($res);

    $name = $row["post_name"];
    $content = $row["post_text"];

    $date = $row["date"];
    $date = strip_tags($date);
    $date = mysqli_real_escape_string($conn, $date);

    if (isset($_POST["post"])) {
        global $pid;
        $name = $_POST["name"];
        $content = $_POST["content"];

        $name = strip_tags($name);
        $content = strip_tags($content);

        $name = mysqli_real_escape_string($conn, $name);
        $content = mysqli_real_escape_string($conn, $content);

        $edit_date = date("jS F Y H:i:s");

        $sql1 = "UPDATE posts SET post_name = '$name', post_text = '$content', date = '$date', edit_date = '$edit_date' WHERE id = '$pid'";
        $res1 = mysqli_query($conn, $sql1) or die("Update error:" . mysqli_error($conn));

        header("Location: index.php");
    }
    

?>

<div id="main-feed">
    <form action="edit_post.php?pid=<?php echo htmlspecialchars($pid);?>" method="post" id="add-post-form">
        <input id="name" type="text" name="name" placeholder="Name: " value="<?php echo htmlspecialchars($name); ?>">
        <textarea id="textarea" type="text" name="content" rows="18" placeholder="Your post here..."><?php echo $content; ?></textarea>
        <input type="submit" name="post" value="Submit">
    </form>
</div>

<?php 

    include("includes/dirm.php");
    include("includes/footer.php");
?>
