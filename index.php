<?php 
    session_start();
    require("includes/check_if_logged_in.php");
    include("includes/header.php");    
    include_once("db.php");
    $pid = $_SESSION["del_post_id"];

    if (isset($_GET["del_id"])) {
        $del_id = $_GET["del_id"];
        $sql0 = "DELETE FROM posts WHERE id = '$del_id'";
        $res0 = mysqli_query($conn, $sql0) or die("Error: " . mysqli_error($conn));
    }
?>
<div id="main-feed">
    <?php 
        $sql = "SELECT * FROM posts ORDER BY id DESC";

        $res = mysqli_query($conn, $sql);

        $posts = "";       

        if (mysqli_num_rows($res) > 0) {
            while($row = mysqli_fetch_assoc($res)) {
                $id = $row["id"];
                $post_name = $row["post_name"];
                $date = $row["date"];
                $content = $row["post_text"];
                $edit_date = $row["edit_date"];
                $post_user = $row["post_user"];

                $posts .= create_post($id, $post_name, $date, $content, $post_user, $admin, $edit_date);
            }
            
            echo $posts;
        } else {
            echo "There's noting to print";
        }
    ?>
</div>

<?php include("includes/dirm.php"); ?>
<?php include("includes/footer.php"); ?>
