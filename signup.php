<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up Page</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
        <form action="required/signup.req.php" method="POST">
            <h1>Sign Up</h1>
            <input type="text" name="name" placeholder="Full Name"> 
            <input type="e-mail" name="e-mail" placeholder="E-mail">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="pwd_repeat" placeholder="Repeat Password">
            <button type="submit" name="submit">Sign Up</button>
            <h2>Already have an account? Login <a href="login.php"><span>here</span></a>!</h2>
            <?php
                if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<p>Fill in all fields!</p>";
                }
                else if ($_GET["error"] == "invaliduid") {
                    echo "<p>Fill in a valid username!</p>";
                }
                else if ($_GET["error"] == "invalidemail") {
                    echo "<p>Choose a valid e-mail!</p>";
                }
                else if ($_GET["error"] == "pwddontmatch") {
                    echo "<p>Your passwords do not match!</p>";
                }
                else if ($_GET["error"] == "uidtaken") {
                    echo "<p>The username or e-mail is taken!</p>";
                }
                else if ($_GET["error"] == "stmtfailed") {
                    echo "<p>Something went wrong, try again!</p>";
                }
                else if ($_GET["error"] == "none") {
                    echo "<h3>Signed up succesfully!</h3>";
                }
            }
            ?>
        </form>
    </div>
</body>
</html>