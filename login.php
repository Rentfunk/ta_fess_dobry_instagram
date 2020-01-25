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
                    <input id="fess-btn" type="submit">
                </form>
                <?php 
                    if ($_POST["username"] == "Rene" && $_POST["password"] == "serusmore")
                        header("Location:/complete_instagram");
                ?>
            </div>
            <div id="if-reg" class="cont">
                <p>Do you want to <a href="signin.html">Sign in</a>?</p>
            </div>
        </div>
    </body>
</html>
