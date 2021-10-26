<?php 
    require_once('required/database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Index Page</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
        <?php 
            if (isset($_SESSION["useruid"])) {
                echo "<h1>Welcome " . $_SESSION["useruid"] . "!</h1>";
            }
            else {
                echo "<h1>Welcome Page!</h1>";
            }
        ?>

        <ul>
            <li><a href="login.php"><button>Login Page</button></a></li>
            <li><a href="signup.php"><button>Signup Page</button></a><li>
            <?php
            if (isset($_SESSION["useruid"])) {
                echo "<li><a href='logout.php'><button>Logout</button></a><li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>