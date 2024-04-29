<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="guidance_view_records.css">
    <link href="https://fonts.cdnfonts.com/css/norwester" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&family=Nixie+One&display=swap" rel="stylesheet">
</head>
<body>
    <div class="report">
        <h3>Check Records</h3>
        <div class="context_box">
            <div class="context_main">
                <table id="record_table">
                    <tr>
                        <th><h2>Report ID</h2></th>
                        <th><h2>Date and Time</h2></th>
                        <th><h2>Student Name</h2></th>
                        <th><h2>Offense Made</h2></th>
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
                        $sql = "SELECT * FROM report_records ORDER BY date_time;";
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
                                echo "<tr>";
                                echo "<th><h5>$report_ID</h5></th>";
                                echo "<th><h5>$date_time</h5></th>";
                                echo "<th><h5>$student_name</h5></th>";
                                echo "<th><h5>$offense_type</h5></th>";
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
            <h3>Guidance</h3>
            <h4>Admin</h4>
        </div>
    </div>
    <div class="options">
        <h2>Options</h2>
        <div class="line">

        </div>
        <a href="">Generate Letter</a>
        <a href="">Create Remarks</a>
        <a href="../guidance_manage_accounts">Manage Accounts</a>
        <a href="../guidance_view_records">Check Records</a>
        <a href="../login/">Logout</a>
    </div>


</body>
</html>