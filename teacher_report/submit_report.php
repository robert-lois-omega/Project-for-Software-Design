<?php

function generateRandomString($length = 8) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

$Username = $_GET['username'];
if(isset($_POST['name'], $_POST['offense'], $_POST['datetime'], $_POST['details'])) {
    $name = $_POST['name'];
    $offense = $_POST['offense'];
    $datetime = $_POST['datetime'];
    $details = $_POST['details'];
    $prof_name = $_POST['prof_name'];
    
    $randomVar = generateRandomString();

    // Check if any of the fields are empty
    if(empty($name) || empty($offense) || empty($datetime) || empty($details)) {
        header("Location: ../teacher/index.php?username=$Username");
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

    $sql = "INSERT INTO `report_records`(`report_ID`, `date_time`, `student_name`, `offense_type`, `further_details`, `reporter`) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $randomVar, $datetime, $name, $offense, $details, $prof_name);
    $stmt->execute();
    // Close connection
    $stmt->close();
    $conn->close();
    // ---------------------------------------------------------------------
    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $default_val = '0';

    $sql = "INSERT INTO `remarks`(`report_ID`, `remarks`) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $randomVar, $default_val);

    // Execute prepared statement
    if ($stmt->execute()) {
        // Redirect upon successful insertion
        header("Location: ../teacher/index.php?username=$Username");
    } else {
        header("Location: ../teacher/index.php?username=$Username");
    }

    // Close connection
    $stmt->close();
    $conn->close();

} else {
    header("Location: ../teacher/index.php?username=$Username");
}
?>
