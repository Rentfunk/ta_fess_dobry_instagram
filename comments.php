<?php 
    session_start();
    include("db.php");
    $post_id = $_GET["post_id"];
    $limit = $_GET["limit"];
    $insert_comm = ($_GET["insert"]);
    $comment = $_GET["comment"];
    $comm_username = $_SESSION["username"];

    //getting amount of comments of the selected post
    function getCount($post_id) {
        include("db.php");
        $count_sql = "SELECT COUNT(*) FROM post_comments WHERE post_id='$post_id'";
        $count_res = mysqli_query($conn, $count_sql);
        $row = mysqli_fetch_assoc($count_res);
        $count = $row["COUNT(*)"];
        return $count;
    }

    $count = getCount($post_id);
    echo $count;

    $init_comm = true; 
    if ($insert_comm) { //inserting and printing comment //OPRAV TOTO QUERY!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!  
        $comm_insert_sql = "INSERT INTO post_comments (post_id, comm_username, comment) VALUES ('$post_id', '$comm_username', '$comment')";
        $comm_insert_res = mysqli_query($conn, $comm_insert_sql) or die("Error with inserting comments" . mysqli_error($conn));
        $sql = "SELECT * FROM (SELECT * FROM post_comments WHERE post_id = '$post_id' ORDER BY id DESC) t ORDER BY id ASC LIMIT $limit";

    } else if ($limit < 3) { //creating comments onload
        $sql = "SELECT * FROM (SELECT * FROM post_comments WHERE post_id = '$post_id' ORDER BY id DESC LIMIT 3) t ORDER BY id ASC";
        $init_comm = true;

    } else if ($limit + 3 < $count) { //creating comments if the limit is not greater than amount of comments
        $end_limit = $limit + 3;
        $sql = "SELECT * FROM 
                (SELECT * FROM post_comments 
                WHERE post_id = '$post_id' ORDER BY id DESC LIMIT $end_limit) t ORDER BY id ASC LIMIT $limit";
        $init_comm = false;

    } else { //creating comments on all other conditions
        $end_limit = $limit + 3;
        $limit_amount = $count - ($limit);
        $sql = "SELECT * FROM 
                (SELECT * FROM post_comments 
                WHERE post_id = '$post_id' ORDER BY id DESC LIMIT $end_limit) t ORDER BY id ASC LIMIT $limit_amount";
    }

    if ($limit > $count) { //stopping when limit is greater than amount of comments
        exit();
    }

    $res = mysqli_query($conn, $sql) or die("Error: " . mysqli_error($conn));
    $comment = "";
    
    $id_array = [];

    //creating comments

    while ($row = mysqli_fetch_assoc($res)) {
        $comment .= "<div class='comments'>";
        $comm_user = $row["comm_username"];
        $content = $row["comment"];
        $row_id = $row["id"];
        if (!$init_comm) {
            $id_array[] = $row["id"];
        }
        $comment .= "<span class='comm-user'><strong>$comm_user</strong></span><div>$content,$row_id</div></div>";
    }
    

    echo $comment;

   
 ?>
