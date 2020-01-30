<?php 
    session_start();
    if ($_SESSION["type"] == "a") {
        $admin = true;
    } else {
        $admin = false;
    }
    
    function create_post($id, $username, $date, $content, $admin=false) {
        $display = $admin ? "flex" : "none";
        return "<div class='test-post'>
                    <div class='post-btns' style='display: $display;'>
                        <div class='edit'><a href='edit_post.php?pid=$id'>Edit</a></div>
                        <div class='edit'><a href='#'>Delete</a></div>
                    </div>
                    <h3 class='test-header'><a href='view_post.php?pid=$id'>$username</a></h3>
                    <br>
                    <h4 class='test-header'>$date</h4>
                    <div>$content</div>
                </div>";
    }
?>
