<?php
    $conn = mysqli_connect("localhost", "root", "root", "test_database");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } 

?>
