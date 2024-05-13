<?php

$Username = $_GET['username'];
$new_password = $_GET['password2'];

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ticketing_system';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Query to select all rows from the 'hubs' table
$sql = "UPDATE `accounts` SET `password`='$new_password' WHERE username='$Username'";
$result = $conn->query($sql);

header("Location: ../forgot_password/password_change_confirm.html")


?>