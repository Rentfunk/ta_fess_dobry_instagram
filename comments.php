<?php 
    include("db.php");
    $post_id = $_GET["post_id"];
    $limit = $_GET["limit"];
    $comm_count = $_GET["comm_count"];

    $count_sql = "SELECT COUNT(*) FROM post_comments WHERE post_id='$post_id'";
    $count_res = mysqli_query($conn, $count_sql);
    $row = mysqli_fetch_assoc($count_res);
    $count = $row["COUNT(*)"];


    $init_comm = true;
    if($limit < 3) {
        $sql = "SELECT * FROM (SELECT * FROM post_comments WHERE post_id = '$post_id' ORDER BY id DESC LIMIT 3) t ORDER BY id ASC";
        $init_comm = true;
    } else if ($limit + 3 < $count) {
        $end_limit = $limit + 3;
        $sql = "SELECT * FROM 
                (SELECT * FROM post_comments 
                WHERE post_id = '$post_id' ORDER BY id DESC LIMIT $end_limit) t ORDER BY id ASC LIMIT $limit";
        $init_comm = false;
    } else {
        $end_limit = $limit + 3;
        $limit_amount = $count - ($limit);
        $sql = "SELECT * FROM 
                (SELECT * FROM post_comments 
                WHERE post_id = '$post_id' ORDER BY id DESC LIMIT $end_limit) t ORDER BY id ASC LIMIT $limit_amount";
    }
    if ($limit > $count) {
        exit();
    }
    $res = mysqli_query($conn, $sql) or die("Error: " . mysqli_error($conn));
    $comment = "";
    /*
    $id_array = [];

    while ($row = mysqli_fetch_assoc($res)) {
        $id_array[] = $row["id"];
    } 

    
    $new_id_array = array_slice($id_array, -(count($id_array)), count($id_array)-3);

    $start = end($new_id_array);
    $end = $new_id_array[0];

    $sql1 = "SELECT * FROM post_comments WHERE post_id = '$post_id' AND id BETWEEN $start AND $end";
    $res1 = mysqli_query($conn, $sql1) or die("Error with between" . mysqli_error($conn));
    

    while ($row1 = mysqli_fetch_assoc($res1)) {
        $comment .= "<div class='comments'>";
        $comm_user = $row1["comm_username"];
        $content = $row1["comment"];
        $comment .= "<span class='comm-user'>$comm_user</span><div>$content</div></div>";
    } 
    */
    
    $id_array = [];

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
