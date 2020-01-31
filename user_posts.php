<?php
    session_start();
    require("includes/check_if_logged_in.php");
    include_once("includes/header.php");
    require("db.php");
    include("config.php");
?>

<div id="main-feed">
    <?php 
        $post_user_id = $_SESSION["id"];
        $sql = "SELECT * FROM posts WHERE post_user_id = '$post_user_id'";

        $res = mysqli_query($conn, $sql) or die("Error: " . mysqli_error($conn));
        
        $posts = "";

        if(mysqli_num_rows($res) > 0) {

            while($row = mysqli_fetch_assoc($res)) {
                $id = $row["id"];
                $post_name = $row["post_name"];
                $content = $row["post_text"];
                $date = $row["date"];
                $edit_date = $row["edit_time"];

                $posts .= create_post($id, $post_name, $date, $content, $admin, $edit_post);
            }

            echo $posts;

        } else {

            echo "You haven't posted anything yet. :D";
        }
    ?>
</div>

<?php 
    include("includes/dirm.php");
    include("includes/footer.php");
?>
