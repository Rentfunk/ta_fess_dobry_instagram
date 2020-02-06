<?php 
    session_start();
    require("includes/check_if_logged_in.php");
    include("includes/header.php");    
    include_once("db.php");
    $pid = $_SESSION["del_post_id"];
    $admin = ($_SESSION["type"] == "a");

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
        
        $post_array = [];

        if (mysqli_num_rows($res) > 0) {
            while($row = mysqli_fetch_assoc($res)) {
                array_push($post_array, $row);
            }
        }
    ?>
    
    <?php foreach($post_array as $row): 
        $edit_display = ($row["edit_date"]) ? "block" : "none";
        $admin_display = ($admin) ? "flex" : "none";
    ?>
    <div class="test-post" id=<?=$row["id"]?>>
    <div class="post-btns" style="display: <?=$admin_display?>;">
            <div class="edit"><a href="edit.php?pid=<?=$row["id"]?>">Edit</a></div>
            <div class="edit"><a href="index.php?del_id=<?=$row["id"]?>">Delete</a></div>
        </div>    
        <h3 class="test-header"><a href="view_post.php?pid=<?=$row["id"]?>"><?=$row["post_name"]?></a></h3>
        <br>
        <h5 class="test-header">Posted on: <?=$row["date"]?> 
            <span style="display: <?=$edit_display?>;">Edited on: <?=$row["edit_date"]?></span>
        </h5>
        <h5 class="test-header">Posted by: <?=$row["post_user"]?></h5>
        <hr>
        <div class="post-content"><?=$row["post_text"]?></div>
        <hr>
        <div class="comments-btn">Show more</div>
        <div class="post-bot-section">
            <div class="comment-section"></div>
            <form class="comments-form" action=<?php echo $_SERVER["PHP_SELF"]; ?> method="post">
                <input name="comment" type="text" placeholder="Comments here...">
                <input class="comment-submit-btn" name="submit" type="button" value="Submit">
            </form> 
        </div>
    </div>
    <?php endforeach; ?>
</div>
<script>
    'use strict';

    const COMM_BTNS = document.querySelectorAll(".comments-btn");
    const TEST_POSTS = document.querySelectorAll(".test-post");
    const SUBMIT_BTNS = document.querySelectorAll("input[name=submit]");
    const SUBMIT_INPUTS = document.querySelectorAll("input[name=comment]");
    const COMMENTS_SECTION = document.querySelectorAll(".comment-section");

    function getRequest(obj, id, limit, position, insert=0, comment="") { // XMLHTTPREQUEST for showing more comments

        fetch("comments.php?post_id=" + id + "&limit=" + limit + "&insert=" + insert + "&comment=" + comment)
            .then(response => response.text()) 
            .then(body => obj.insertAdjacentHTML(position, body));

    }

    Object.values(COMM_BTNS).forEach(function(btn, i) { //adds event listener for every "show more button"
        btn["limit"] = 3; //sets attribute to manipulate with limit
        btn.addEventListener("click", function(event) {
            getRequest(COMMENTS_SECTION[i], parseInt(TEST_POSTS[i].id), this.limit, "afterbegin");
            this.limit += 3; //adds limit after every click
        });
    });

    Object.values(SUBMIT_BTNS).forEach((btn, i) => {
        btn.addEventListener("click", (event) => {
            let comment = SUBMIT_INPUTS[i].value; //PRIDAJ DESTROY FUNKCIU!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            console.log(comment);
            getRequest(COMMENTS_SECTION[i], parseInt(TEST_POSTS[i].id), COMM_BTNS[i].limit, "beforeend", 1, comment);
        });
    });
    

    window.addEventListener("load", function(event) {
        Object.values(COMMENTS_SECTION).forEach(function(section, i) {
            getRequest(section, parseInt(TEST_POSTS[i].id), 0, "beforeend"); //creates first 3 comments everytime index.php loads
        });
    });
    


</script>

<?php include("includes/dirm.php"); ?>
<?php include("includes/footer.php"); ?>
