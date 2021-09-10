<?php
if (isset($_POST['submit'])) {
    require_once 'database.php';
    require_once 'functions.php';

    $username = mysqli_real_escape_string($conn, $_POST['uid']);  
    $pwd = mysqli_real_escape_string($conn, $_POST['password']); 

    if (emptyInputLogin($username, $pwd) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $pwd);
} else {
    header("Location: ../login.php?erorr=loginerror");
    exit(); 
}