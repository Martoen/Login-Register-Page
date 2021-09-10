<!-- Setup for localhost, change it if you want to use it with a hosting provider -->
<?php
$dbServername = "localhost"; 
$dbUsername = "root";
$dbPassword = "";
$dbName = 'login_page'; 

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName); 

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}