<?php 
    session_start();
    require("includes/check_if_logged_in.php");
    include("includes/header.php");    
    include_once("db.php");
    $pid = $_SESSION["del_post_id"];

    if (isset($_GET["del_id"])) {
        $del_id = $_GET["del_id"];
        $sql0 = "DELETE FROM posts WHERE id = '$del_id';
                 DELETE FROM post_comments WHERE post_id = '$del_id'";
        $res0 = mysqli_query($conn, $sql0) or die("Error: " . mysqli_error($conn));
    }
    
?>
<div id="main-feed">
<p id="demo"></p>
    <?php 
        $sql = "SELECT * FROM posts ORDER BY id DESC";

        $res = mysqli_query($conn, $sql);

        $posts = "";       
        $id_array = [];
        if (mysqli_num_rows($res) > 0) {
            while($row = mysqli_fetch_assoc($res)) {
                $id = $row["id"];

                $id_array[] = $id;

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
<script>
    'use strict';

    const COMM_BTNS = document.getElementsByClassName("comments-btn");
    const COMM_SECT = document.getElementsByClassName("post-bot-section");
    const TEST_POSTS = document.getElementsByClassName("test-post");
    const SUBMIT_BTNS = document.querySelectorAll("button[name=submit]");

    function getRequest(obj, id, limit, position) { // XMLHTTPREQUEST for showing more comments

        fetch("comments.php?post_id=" + id + "&limit=" + limit)
            .then(response => response.text())
            .then(body => obj.insertAdjacentHTML(position, body));

    }

    Object.values(COMM_BTNS).forEach(function(btn, i) { //adds event listener for every "show more button"
        btn["limit"] = 3; //sets attribute to manipulate with limit
        btn.addEventListener("click", function(event) {
            if (COMM_SECT[i].firstElementChild.tagName != "FORM") {
                getRequest(COMM_SECT[i].firstElementChild, parseInt(TEST_POSTS[i].id), this.limit, "afterbegin");
                this.limit += 3; //adds limit after every click
            }
        });
    });


    window.addEventListener("load", function(event) {
        Object.values(document.getElementsByClassName("comment-section")).forEach(function(section, i) {
            getRequest(section, parseInt(TEST_POSTS[i].id), 0, "beforeend"); //creates first 3 comments everytime index.php loads
        });
    });
</script>

<?php include("includes/dirm.php"); ?>
<?php include("includes/footer.php"); ?>
