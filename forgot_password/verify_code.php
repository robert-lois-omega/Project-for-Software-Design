<?php
$code = $_POST['code'];
$Username = $_POST['username'];
$currentDateTime = date('Y-m-d H:i:s');

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ticketing_system';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Query to select all rows from the 'hubs' table
$sql = "SELECT * FROM `auth_tokens` WHERE TOKEN='$code'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User exists, you can proceed with login
    $row = $result->fetch_assoc();
    $TOKEN = $row['TOKEN'];
    $datetime = $row['datetime'];

    // Convert the datetime strings to DateTime objects
    $start_time = new DateTime($datetime);
    $end_time = new DateTime($currentDateTime);

    // Calculate the difference between the two datetime values
    $time_difference = $end_time->diff($start_time);

    // Define a DateInterval representing one minute
    $one_minute = new DateInterval('PT1M'); // PT1M stands for 1 minute

    // Compare the time difference with one minute
    if ($time_difference > $one_minute) {
        header("Location: ../forgot_password/error2.html");
    } else {
            header("Location: ../forgot_password/change_password.php?username=$Username");
    }

} else{
    header("Location: ../forgot_password/error2.html");
}





?>