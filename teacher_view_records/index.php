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
    <link rel="stylesheet" href="teacher_view_records.css">
    <link href="https://fonts.cdnfonts.com/css/norwester" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&family=Nixie+One&display=swap" rel="stylesheet">
</head>

<style>
    input#name_search{
    width: 200px;
    height: 50px;
    border-radius: 5px;
    border: 2px solid black;
    font-size: 24px;
    display: inline-block;
    padding-left: 10px;

}



.button_sub {
    display: flex; /* Use flexbox */
    align-items: center; /* Center vertically */
    margin-left: 590px;
}

.search_bar {
    margin-right: 5px; /* Adjust as needed */
}

.search_button{
    vertical-align: middle; /* Align button vertically with text */
}

#name_search{
    width: 700px;
    height: 30px;
    border-radius: 5px;
    border: 2px solid black;
    font-size: 24px;
    display: inline-block;
}

.button_sub button{
    align-items: center;
    background-clip: padding-box;
    background-color: #187180;
    border: 2px solid black;
    border-radius: .25rem;
    box-shadow: rgba(0, 0, 0, 0.02) 0 1px 3px 0;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-flex;
    font-family: system-ui,-apple-system,system-ui,"Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 16px;
    font-weight: 700;
    justify-content: center;
    line-height: 1.25;
    margin: 0;
    min-height: 3rem;
    padding: calc(.875rem - 1px) calc(1.5rem - 1px);
    position: relative;
    transition: all 250ms;
    touch-action: manipulation;
    vertical-align: baseline;
    width: auto;
}

.button_sub button:hover{
    min-height: 3.5rem;
    color: yellow;
    
}


.first{
    display: flex;
    align-items: center; /* Center vertically */
}
</style>

<body>
    <div class="report">
    <div class="first">
            <h3>Check Records</h3>
            <form action="index.php" method="get">
                <div class="button_sub">
                    <div class='search_bar'>
                        <input type="text" name="name_search" placeholder="Student Name" id="name_search">
                        <input type="hidden" name="username" value="<?php echo $Username?>">            
                    </div>
                    <div class="search_button">
                        <button id="search_button_style">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="context_box">
            <div class="context_main">
                <table id="record_table">
                    <tr>
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

                        if(isset($_GET['name_search'])){
                            $name_search = urldecode($_GET['name_search']);
                            $sql = "SELECT rr.student_name, rr.date_time, rr.offense_type
                                FROM report_records rr
                                WHERE rr.student_name = '$name_search' OR rr.student_name LIKE '%$name_search%'
                                ORDER BY rr.date_time DESC";
                                
                            $result = $conn->query($sql);
                            // Check if there are rows in the result set
                            if ($result->num_rows > 0) {
                                // Loop through each row
                                while ($row = $result->fetch_assoc()) {
                                    // Access each column value using the column name
                                    $date_time = $row['date_time'];
                                    $student_name = $row['student_name'];
                                    $offense_type = $row['offense_type'];
                                    echo "<tr>";
                                    echo "<th><h5>$date_time</h5></th>";
                                    echo "<th><h5>$student_name</h5></th>";
                                    echo "<th><h5>$offense_type</h5></th>";
                                    echo "</tr>";
                                }
                            }
                    
                        } else if (empty($name_search)) {
                        // Query to select all rows from the 'hubs' table
                            $sql = "SELECT rr.student_name, rr.date_time, rr.offense_type
                                    FROM report_records rr
                                    ORDER BY rr.date_time DESC"; 
                            $result = $conn->query($sql);

                            // Check if there are rows in the result set
                            if ($result->num_rows > 0) {
                                // Loop through each row
                                while ($row = $result->fetch_assoc()) {
                                    // Access each column value using the column name
                                    $date_time = $row['date_time'];
                                    $student_name = $row['student_name'];
                                    $offense_type = $row['offense_type'];
                                    echo "<tr>";
                                    echo "<th><h5>$date_time</h5></th>";
                                    echo "<th><h5>$student_name</h5></th>";
                                    echo "<th><h5>$offense_type</h5></th>";
                                    echo "</tr>";
                                }
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
        <a href="../teacher_view_records/index.php?username=<?php echo "$Username"?>">Check Records</a>
        <a href="../teacher_report/index.php?username=<?php echo "$Username"?>">Create a Report</a>
        <a href="../login/">Logout</a>
    </div>


</body>
</html>