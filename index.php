<?php 
    session_start();
    require("includes/check_if_logged_in.php");
    include("includes/header.php");    
    include_once("db.php");
?>
        <div id="main-feed">
            <?php 
                $sql = "SELECT * FROM posts ORDER BY id DESC";

                $res = mysqli_query($conn, $sql);

                $posts = "";       

                if (mysqli_num_rows($res) > 0) {
                    while($row = mysqli_fetch_assoc($res)) {
                        $id = $row["id"];
                        $username = $row["post_name"];
                        $date = $row["date"];
                        $content = $row["post_text"];


                        $posts .= "<div class='test-post'>
                                    <div class='post-btns'>
                                        <div class='edit'><a href='#'>Edit</a></div>
                                        <div class='edit'><a href='#'>Delete</a></div>
                                    </div>
                                    <h3 class='test-header'><a href='view_post.php?pid=$id'>$username</a></h3><br>
                                    <h4 class='test-header'>$date</h4>
                                    <div>$content</div>
                                  </div>";
                    }
                    echo $posts;
                } else {
                    echo "There's noting to print";
                }
            ?>
        </div>
    </div>
    <?php include("includes/dirm.php"); ?>
<?php include("includes/footer.php"); ?>
