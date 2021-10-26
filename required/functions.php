<!-- These functions will check for certain errors -->
<!-- Only touch this if you know what you're doing! -->

<?php
function emptyInputSignup($name, $email, $uid, $pwd, $pwdRepeat)
{
    if (empty($name) || empty($email) || empty($uid) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUid($uid)
{
    if (!preg_match('/^[a-z\d_]{2,20}$/i', $uid)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat)
{
    if ($pwd !== $pwdRepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function uidExists($conn, $uid, $email)
{
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_uid = :user_uid OR user_mail = :user_mail");
    $stmt->execute(array(
        ":user_uid" => $uid,
        ":user_mail" => $email
    ));
    $users = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row = $users) {
        return $row;
    } else {
        return false;
    }
}

function createUser($conn, $name, $email, $uid, $pwd)
{
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (user_name, user_mail, user_uid, user_pwd) VALUES (:user_name, :user_mail, :user_uid, :user_pwd);");
    $stmt->execute(array(
        ":user_name" => $name,
        ":user_mail" => $email,
        ":user_uid" => $uid,
        ":user_pwd" => $hashedPwd
    ));

    header("Location: ../signup.php?error=none");
    exit();
}

function emptyInputLogin($username, $pwd)
{
    if (empty($username) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd)
{
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("Location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["user_pwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("Location: ../login.php?error=incorrectpwd");
        exit();
    } elseif ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["user_id"];
        $_SESSION["useruid"] = $uidExists["user_uid"];
        header("Location: ../index.php");
        exit();
    }
}
