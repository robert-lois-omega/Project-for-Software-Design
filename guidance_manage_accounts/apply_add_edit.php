<?php
if(isset($_POST['Name'], $_POST['username'], $_POST['password'], $_POST['role'])) {
    $Name = $_POST['Name'];
    $Username = $_POST['username'];
    $Password = $_POST['password'];
    $Role = $_POST['role'];

    // Check if any of the fields are empty
    if(empty($Name) || empty($Username) || empty($Password) || empty($Role)) {
        header('Location: ../guidance_manage_accounts');
        exit(); // Terminate script execution after redirect
    }

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'ticketing_system';


    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO `accounts`(`Name`, `username`, `password`, `role`) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $Name, $Username, $Password, $Role);

    // Execute prepared statement
    if ($stmt->execute()) {
        // Redirect upon successful insertion
        header("Location: ../guidance_manage_accounts?username=$Username");
    } else {
        header("Location: ../guidance_manage_accounts?username=$Username");
    }

    // Close connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: ../guidance_manage_accounts?username=$Username");
}
?>
