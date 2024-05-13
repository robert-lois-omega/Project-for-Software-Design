<?php
$currentDateTime = date('Y-m-d H:i:s');
$Username = $_POST['username'];
$email = $_POST['email'];

function generateRandomString($length = 8) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}



$randomVar = generateRandomString();

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ticketing_system';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Query to select all rows from the 'hubs' table
$sql = "INSERT INTO `auth_tokens`(`TOKEN`, `datetime`) VALUES ('$randomVar','$currentDateTime')";
$result = $conn->query($sql);



$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Query to select all rows from the 'hubs' table
$sql = "SELECT * FROM accounts WHERE username='$Username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User exists, you can proceed with login
    $row = $result->fetch_assoc();
    $email = $row['email'];

    // Execute Python script with properly formatted arguments
    $command = "python send_email.py $email $randomVar $Username";
    exec($command, $output);
    header("Location: ../forgot_password/confirm_code.php?username=$Username");
} 



?>