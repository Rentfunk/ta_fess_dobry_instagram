<?php 
    include("db.php");
    $admin = ($_SESSION["type"] == "a") ? true : false;

    function insert_comment($id) {
        include("db.php");
        $comm_username = $_SESSION["username"];
        $comment = $_POST["comment"];
        $comm_sql = "INSERT INTO post_comments (post_id, comm_username, comment) VALUES ('$id', '$comm_username', '$comment')";
        $res = mysqli_query($conn, $comm_sql) or die("Error with inserting comment" . mysqli_error($conn));
    }

    function create_comments($post_id) { // to create comments 
        include("db.php");
        $post_name = "post" . $post_id;
        if (isset($_POST[$post_name])) {
            insert_comment($post_id);    
        }
        $sql = "SELECT * FROM post_comments WHERE post_id = '$post_id'";
        $res = mysqli_query($conn, $sql) or die("Error with comments: " . print_r(mysqli_error_list($conn), true));
        
        $comments = "<div class='post-bot-section'>";

        if (mysqli_num_rows($res) > 0) {
            $comments .= "<div class='comment-section'>";
            while ($row = mysqli_fetch_assoc($res)) {
                $comm_username = $row["comm_username"];
                $comment = $row["comment"];
                $comments .= "<div class='comments'>
                                <span class='comm-user'><strong>$comm_username</strong></span>
                                <div>$comment</div>  
                              </div>";
            }
            $comments .= "</div>";
        } else {
            $comments .= "No comments here yet";
        }
        $current_page = $_SERVER["PHP_SELF"];
        $comments .= "<form class='comments-form' action='$current_page' method='post'>
                        <input name='comment' type='text' placeholder='Comment here'>
                        <input class='comment-submit-btn' name='$post_name' type='submit' value='Submit'>
                      </form></div>";
        return $comments;
    }

    function create_post($id, $post_name, $date, $content, $post_user, $admin=false, $edit_date="") { //to create posts
        $_SESSION["del_post_id"] = $id;
        $display_admin = $admin ? "flex" : "none";
        $display_edit = (!$edit_date) ? "none" : "block";
        $post = "<div class='test-post'>
                    <div class='post-btns' style='display: $display_admin;'>
                        <div class='edit'><a href='edit_post.php?pid=$id'>Edit</a></div>
                        <div class='edit'><a href='index.php?del_id=$id'>Delete</a></div>
                    </div>
                    <h3 class='test-header'><a href='view_post.php?pid=$id'>$post_name</a></h3>
                    <br>
                    <h5 class='test-header'>Posted on: $date <span style='display: $display_edit;'>Edited on: $edit_date</span></h5>
                    <h5 class='test-header'>Posted by: $post_user </h5>
                    <hr>
                    <div class='post-content'>$content</div>
                    <hr>
                    <div class='comments-btn'>Comments</div>";
        $post .= create_comments($id) . "</div>";
        return $post;
    }


?>
