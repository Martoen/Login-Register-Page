<!-- Setup for localhost, change it if you want to use it with a hosting provider -->
<?php
session_start();

$dbServername = "localhost"; 
$dbUsername = "root";
$dbPassword = "";
$dbName = 'login_page'; 

try {
    $conn = new PDO("mysql:host=".$dbServername.";dbname=".$dbName, $dbUsername, $dbPassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}