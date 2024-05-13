<?php
$username = urldecode($_GET['username']);
$to_delete = urldecode($_GET['to_delete']);


if (strcmp($username, $to_delete) == 0){
    echo "<script>
    alert('You are not allowed to delete your own account!');
    </script>";
} else{
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'ticketing_system';
    
    $conn = new mysqli($host, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Query to select all rows from the 'hubs' table
    $sql = "DELETE FROM `accounts` WHERE username='$to_delete'";
    $result = $conn->query($sql);
}



?>