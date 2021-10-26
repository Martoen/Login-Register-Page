<?php
if (isset($_POST['submit'])) {
    require_once 'database.php';
    require_once 'functions.php';

    $name = $_POST['name'];
    $email = $_POST['e-mail'];
    $uid = $_POST['username'];
    $pwd = $_POST['password'];
    $pwdRepeat = $_POST['pwd_repeat'];

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

    header("Location: ../signup.php?error=none");
} else {
    header("Location: ../signup.php?error=signuperror");
    exit();
}
