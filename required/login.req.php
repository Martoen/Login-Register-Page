<?php
if (isset($_POST['submit'])) {
    require_once 'database.php';
    require_once 'functions.php';

    $username = $_POST['uid'];  
    $pwd = $_POST['password']; 

    if (emptyInputLogin($username, $pwd) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $pwd);
} else {
    header("Location: ../login.php?error=loginerror");
    exit(); 
}