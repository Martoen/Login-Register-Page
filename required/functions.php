<!-- These functions will check for certain errors -->
<!-- Only touch this if you know what you're doing! -->

<?php 
function emptyInputSignup($name, $email, $uid, $pwd, $pwdRepeat) {
    if (empty($name) || empty($email) || empty($uid) || empty($pwd) || empty($pwdRepeat)) {
        $result = true; 
    } 
    else {
        $result = false; 
    }
    return $result; 
}

function invalidUid($uid) {
    if (!preg_match('/^[a-zA-Z0-9]*$/', $uid)) {
        $result = true; 
    } 
    else {
        $result = false; 
    }
    return $result; 
}

function invalidEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true; 
    } 
    else {
        $result = false; 
    }
    return $result; 
}

function pwdMatch($pwd, $pwdRepeat) {
    if ($pwd !== $pwdRepeat) {
        $result = true; 
    } 
    else {
        $result = false; 
    }
    return $result; 
}

function uidExists($conn, $uid, $email) {
    $sql = "SELECT * FROM users WHERE user_uid=? OR user_mail=?;"; 

    $stmt = mysqli_stmt_init($conn); 

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "ss", $uid, $email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt); 

        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row; 
        }
        else { 
            return false; 
        }

        mysqli_stmt_close($stmt);
    }
}

function createUser($conn, $name, $email, $uid, $pwd) {
    $sql = "INSERT INTO users (user_name, user_mail, user_uid, user_pwd) VALUES (?, ?, ?, ?);"; 

    $stmt = mysqli_stmt_init($conn); 

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); 

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $uid, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../signup.php?error=none"); 
    exit(); 
}

function emptyInputLogin($username, $pwd) {
    if (empty($username) || empty($pwd)) {
        $result = true; 
    } 
    else {
        $result = false; 
    }
    return $result; 
}

function loginUser($conn, $username, $pwd) {
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("Location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["user_pwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("Location: ../login.php?erorr=incorrectpwd");
        exit();
    } 
    elseif ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["user_id"];
        $_SESSION["useruid"] = $uidExists["user_uid"];
        header("Location: ../index.php");
        exit();
    }
}