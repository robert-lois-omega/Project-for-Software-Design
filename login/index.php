<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.cdnfonts.com/css/norwester" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&family=Nixie+One&display=swap" rel="stylesheet">
</head>
<body>
    <div class="portal">
        <div class="header">
            <div class="image">
                <img src="../images/school_logo.png" alt="school logo">
            </div>
            <div class="text">
                <h1>Login Portal</h1>
            </div>
        </div>
        <form action="./index.php" method="post">
        <div class="credentials">
            <input type="text" placeholder="Username" name="Username">
            <input type="password" placeholder="Password" name="Password">
        </div>
        <div class="submition">
            <input id="submit_btn" type="submit">
        </div>
        </form>
        <a href="">Forgot Password?</a>
    </div>
</body>
</html>
<?php
if (isset($_POST['Username']) && isset($_POST['Password'])){
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
        if ($role == 'Admin'){
            header("Location: ../guidance/index.php?username=$Username");
        die();
        } else{
            header("Location: ../teacher/index.php?username=$Username");
            die();
        }
    } else {
        // User doesn't exist or credentials are incorrect
        echo "<script>alert('Invalid Username or Password!');a</script>";
    }

    // Close connection
    $conn->close();
}
?>