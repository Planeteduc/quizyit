<?php // Database connection settings 
$link = mysqli_connect("localhost", "root", ""); 
if (!$link) { 
    die("Connection failed: " . mysqli_connect_error()); 
} 
mysqli_select_db($link, "admin"); 
