<?php
if (isset($_POST['submit'])) {
    require_once 'database.php';
    require_once 'functions.php';

    $name = mysqli_real_escape_string($conn, $_POST['name']);  
    $email = mysqli_real_escape_string($conn,$_POST['e-mail']);
    $uid = mysqli_real_escape_string($conn,$_POST['username']); 
    $pwd = mysqli_real_escape_string($conn,$_POST['password']);
    $pwdRepeat = mysqli_real_escape_string($conn,$_POST['pwd_repeat']);

    if (emptyInputSignup($name, $email, $uid, $pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    } 

    if (invalidUid($uid) !== false) {
        header("location: ../signup.php?error=invaliduid");
        exit();
    } 

    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    } 

    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=pwddontmatch");
        exit();
    } 

    if (uidExists($conn, $uid, $email) !== false) {
        header("location: ../signup.php?error=uidtaken");
        exit();
    } 

    createUser($conn, $name, $email, $uid, $pwd); 

    $sql = "INSERT INTO users (user_first, user_last, user_mail, user_uid, user_pwd)
	    VALUES (?, ?, ?, ?, ?);"; 

    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL Statement failed"; 
    } else {
        mysqli_stmt_bind_param($stmt, "sssss", $first, $last, $mail, $uid, $pwd); 
        mysqli_stmt_execute($stmt);  
    }

    header("Location: ../signup.php?error=none");
} 
else {
    header("Location: ../signup.php?error=signuperror");
    exit(); 
}