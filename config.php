<?php 
    session_start();
    include("db.php");
    $admin = ($_SESSION["type"] == "a") ? true : false;

    function create_post($id, $username, $date, $content, $admin=false, $edit_date="") {
        $_SESSION["del_post_id"] = $id;
        $display_admin = $admin ? "flex" : "none";
        $display_edit = (!$edit_date) ? "none" : "block";
        return "<div class='test-post'>
                    <div class='post-btns' style='display: $display_admin;'>
                        <div class='edit'><a href='edit_post.php?pid=$id'>Edit</a></div>
                        <div class='edit'><a href='index.php?del_id=$id'>Delete</a></div>
                    </div>
                    <h3 class='test-header'><a href='view_post.php?pid=$id'>$username</a></h3>
                    <br>
                    <h5 class='test-header'>Posted on: $date <span style='display: $display_edit;'>Edited on: $edit_date</span></h5>
                    <div>$content</div>
                </div>";
    }

?>
