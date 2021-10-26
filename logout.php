<?php 
require_once 'required/database.php'; 
session_destroy(); 
header('Location: login.php'); 
?>