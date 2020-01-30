<?php 
    session_start();
    if(isset($_POST["signin"])) {
        if ($_POST["password-1st"] == $_POST["password-2nd"]) {
            include_once("db.php");
            $new_username = strip_tags($_POST["name"]);
            $password = strip_tags($_POST["password-1st"]);

            $new_username = stripslashes($new_username);
            $password = stripslashes($password);

            $new_username = mysqli_real_escape_string($conn, $new_username);
            $password = mysqli_real_escape_string($conn, $new_username);

            $password = md5($_POST["password-1st"]);



            $sql = "SELECT * FROM users WHERE username = '$new_username'";

            $res1 = mysqli_query($conn, $sql) or die("Error" . mysqli_error($conn));
            $row = mysqli_fetch_assoc($res1);
            $test_username = $row["username"];
            if (mysqli_num_rows($res1) == 0) {
                echo "cant run query";
                $sql1 = "INSERT INTO users (username, password, type) VALUES ('$new_username', '$password', 'u')";
                $res2 = mysqli_query($conn, $sql1);
                header("Location: login.php");
            } else {
                echo "Choode different name";
            }
        } else {
            echo "Passwords must match!";
        }
    }
?>


<!DOCTYPE html5>

<html>
    <head>
        <title>Fake instagram</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="static/css/styles.css">
    </head>
    <body>
        <div id="main-container">
            <div class="cont">
                <h3 class="text-center">Instagram</h3>
                <p class="text-center">You can register here</p>
                <form id="reg-form" action="register.php" method="post">
                    <input class="reg-input" name="name" type="text" placeholder="Name: ">
                    <input class="reg-input" name="password-1st" type="password" placeholder="Password: ">
                    <input class="reg-input" name="password-2nd" type="password" placeholder="Repeat password: ">
                    <input type="submit" name="signin">
                </form>
            </div>
            <div id="if-reg" class="cont">
                <p>Are you already registered?<a href="login.php">Log in</a></p>
            </div>
        </div>
    </body>
</html>
