<?php
$Username = $_POST['Username'];
$Password = $_POST['Password'];

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ticketing_system';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to select user from the database
$sql = "SELECT * FROM accounts WHERE username = '$Username' AND password = '$Password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User exists, you can proceed with login
    $row = $result->fetch_assoc();
    $name = $row['Name'];
    $role = $row['role'];
    
    echo "Welcome, $name! Your role is $role.";
} else {
    // User doesn't exist or credentials are incorrect
    echo "Invalid username or password.";
}

// Close connection
$conn->close();
?>
