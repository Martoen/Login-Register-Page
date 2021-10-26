<?php 
    require_once('required/database.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Page</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div>
        <form action="required/login.req.php" method="POST">
            <h1>Login</h1>
            <input type="text" name="uid" placeholder="Username/E-mail">
            <input type="password" name="password" placeholder="Password">
            <button type="submit" name="submit">Log in</button>
            <h2>Don't have an account? Create one <a href="signup.php"><span>here</span></a>!</h2>
            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<p>Fill in all fields!</p>";
                } else if ($_GET["error"] == "wronglogin") {
                    echo "<p>Incorrect login information!</p>";
                } else if ($_GET["error"] == "incorrectpwd") {
                    echo "<p>Incorrect password!</p>";
                }
            }
            ?>
        </form>
    </div>
</body>

</html>