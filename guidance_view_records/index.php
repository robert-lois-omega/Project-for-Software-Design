<?php
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
    <link rel="stylesheet" href="./style.css">
    <link href="https://fonts.cdnfonts.com/css/norwester" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&family=Nixie+One&display=swap" rel="stylesheet">
</head>
<body>
    <div class="report">
    <form action="update_remarks.php" method="post">
    <h3>Check Records</h3>
        <div class="context_box">
            <div class="context_main">
                <table id="record_table">
                    <tr>
                        <th><h2>Date and Time</h2></th>
                        <th><h2>Student Name</h2></th>
                        <th><h2>Offense Made</h2></th>
                        <th><h2>Reporter</h2></th>
                        <th><h2>Remarks</h2></th>
                        <th><h2>Generate Letter</h2></th>
                    </tr>
                    <?php

                        $host = 'localhost';
                        $username = 'root';
                        $password = '';
                        $database = 'ticketing_system';

                        $conn = new mysqli($host, $username, $password, $database);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Query to select all rows from the 'hubs' table
                        $sql = "SELECT rr.report_ID, rr.date_time, rr.student_name, rr.offense_type, rr.reporter, rm.remarks 
                                FROM report_records rr
                                INNER JOIN remarks rm ON rr.report_ID = rm.report_ID
                                ORDER BY rr.date_time DESC"; 
                        $result = $conn->query($sql);

                        // Check if there are rows in the result set
                        if ($result->num_rows > 0) {
                            // Loop through each row
                            while ($row = $result->fetch_assoc()) {
                                // Access each column value using the column name
                                $report_ID = $row['report_ID'];
                                $date_time = $row['date_time'];
                                $student_name = $row['student_name'];
                                $offense_type = $row['offense_type'];
                                $reporter = $row['reporter'];
                                $remarks = $row['remarks'];

                                echo "<tr>";
                                echo "<th><h5>$date_time</h5></th>";
                                echo "<th><h5>$student_name</h5></th>";
                                echo "<th><h5>$offense_type</h5></th>";
                                echo "<th><h5>$reporter</h5></th>";
                                if ($remarks == 1){
                                    echo "<th><hr><label style='font-size: 12px; text-align: left;'><input type='radio' name='$report_ID' value='1' checked>Done</label>";
                                    echo "<hr>";
                                    echo "<label style='font-size: 12px;'><input type='radio' name='$report_ID' value='0'>Undone</label><hr>";
                                } else{
                                    echo "<th><hr><label style='font-size: 12px;'><input type='radio' name='$report_ID' value='1'>Done</label>";
                                    echo "<hr>";
                                    echo "<label style='font-size: 12px;'><input type='radio' name='$report_ID' value='0' checked>Undone</label><hr>";
                                }
                                echo "<th><a href='../guidance_generate_letter/index.php?username=$Username&report_ID=$report_ID'>$report_ID</a></th>";
                                echo "</tr>";
                            }
                        }
                        ?>
                </table>
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
        <a href="../login/">Logout</a>
    </div>
    <div class="button_sub">
        <button>Update Remarks</button>
    </div>
</form>

</body>
</html>