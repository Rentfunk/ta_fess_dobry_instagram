<?php 
    session_start();
    if (isset($_POST["fess-btn"])) {
        include_once("db.php");
        $username = strip_tags($_POST["username"]);
        $password = strip_tags($_POST["password"]);

        $username = stripslashes($username);
        $password = stripslashes($password);

        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $username);

        $password = md5($_POST["password"]);


        $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";

        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) != 0) {
            $row = mysqli_fetch_assoc($res);
            $id = $row["id"];
            $db_password = $row["password"];
            $type = $row["type"];

            if ($password == $db_password) {
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;
                $_SESSION["type"] = $type;
                header("Location: index.php");
            
            } else {
                $pass_error = "Wrong password!";
            }
        
        } else {
            $pass_error = "Username doesn't exist!";
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
                <p class="text-center">You can login here</p>
                <form id="reg-form" action="login.php" method="post">
                    <input class="reg-input" type="text" placeholder="Name" name="username" >
                    <input class="reg-input" type="password" placeholder="Password" name="password">
                    <input id="fess-btn" type="submit" name="fess-btn">
                </form>
            </div>
            <div id="if-reg" class="cont">
                <p>Do you want to <a href="register.php">Sign in</a>?</p>
            </div>
            <div class="error-div"><?php echo $pass_error;?></div>
        </div>
    </body>
</html>
