<?php
include 'generate_charts.php';
$Username = $_GET['username'];

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ticketing_system';

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
    $name = $row['Name'];
    $role = $row['role'];
} 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./statistics.css">
    <link href="https://fonts.cdnfonts.com/css/norwester" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&family=Nixie+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
</head>
<style>
.report{
    width: 65rem;
    height: 60rem;
    position: absolute;
    margin-left: 330px;
    font-size: 24px;
    color: Black;
    border-radius: 10px;
    background-color: #ffffff;
    border: 5px solid black;
    border-radius: 5px;
}
</style>
<body>
    <div class="report">
    <h3>Statistics</h3>
        <div class="context_box">
            <div class="context_main">
                <img src="../images/overall_offense_frequency.png" width="60%"  height="400px" alt="offense daily report">
                <br>
                <br>
                <img src="../images/offense_daily_report.png" width="50%" height="400px" alt="offense daily report">
            </div>
        </div>
    </div>
    <div class="header">
        <div class="logo">
            <img src="../images/school_logo.png" alt="school_logo">
        </div>
        <div class="name_role">
        <?php
            echo "<h3>$name</h3>";
            echo "<h4>$role</h4>";
            ?>
        </div>
    </div>
    <div class="options">
        <h2>Options</h2>
        <div class="line">

        </div>
        <a href="../guidance_search_student/index.php?username=<?php echo $Username?>">Search a Student</a>
        <a href="../guidance_manage_accounts/index.php?username=<?php echo $Username?>">Manage Accounts</a>
        <a href="../guidance_view_records/index.php?username=<?php echo $Username?>">Check Records</a>
        <a href="../guidance_statistics/index.php?username=<?php echo $Username?>">View Statistics</a>
        <a href="../login/">Logout</a>
    </div>
    <div class="button_sub">
        <button>Update Remarks</button>
    </div>
</div>
</body>
</html>