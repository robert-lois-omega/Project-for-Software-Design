<?php
if(isset($_POST['Name']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {
    $USERNAME = $_GET['USERNAME'];
    $Name = $_POST['Name'];
    $Username = $_POST['username'];
    $Password = $_POST['password'];
    $role = $_POST['role'];

    if($Name !== null && $Username !== null && $Password !== null && $role !== null) {
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

        // Update query
        $sql = "UPDATE `accounts` SET `Name`='$Name',`password`='$Password',`role`='$role' WHERE `username`='$Username'";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            header("Location: ../guidance_manage_accounts/index.php?username=$USERNAME");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $conn->close(); // Close the connection
    } else {
        echo "All fields are required.";
    }
} else {
    echo "All fields are required.";
}
?>
