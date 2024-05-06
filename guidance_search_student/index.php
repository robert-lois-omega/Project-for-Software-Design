<?php
$Username = urldecode($_GET['username']);
// $name_search = urldecode($_GET['name_search']);

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
    <link rel="stylesheet" href="./guidance_search_student.css">
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
    margin-left: 450px;
}

.search_bar {
    margin-right: 5px; /* Adjust as needed */
}

.search_button button {
    vertical-align: middle; /* Align button vertically with text */
}


.first{
    display: flex;
    align-items: center; /* Center vertically */
}
</style>
<body>
    <div class="report">
        <div class="first">
            <h3>Student List</h3>
            <form action="index.php" method="get">
                <div class="button_sub">
                    <div class='search_bar'>
                        <input type="text" name="name_search" placeholder="Student Name" id="name_search">
                        <input type="hidden" name="username" value="<?php echo $Username?>">            
                    </div>
                    <div class="search_button">
                        <button>Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="context_box">
            <div class="context_main">
                <table id="record_table">
                    <tr>
                        <th><h2>Student Names</h2></th>
                        <th><h2>Offense Count</h2></th>
                        <th><h2>Profile</h2></th>
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
                            $sql = "SELECT rr.student_name, COUNT(*) as occurrence_count
                                FROM report_records rr
                                INNER JOIN remarks rm ON rr.report_ID = rm.report_ID
                                WHERE rr.student_name = '$name_search' OR rr.student_name LIKE '$name_search%'
                                GROUP BY rr.student_name
                                ORDER BY occurrence_count DESC";
                                
                            $result = $conn->query($sql);
                            // Check if there are rows in the result set
                            if ($result->num_rows > 0) {
                                // Loop through each row
                                while ($row = $result->fetch_assoc()) {
                                    // Access each column value using the column name
                                    $student_name = $row['student_name'];
                                    $times = $row["occurrence_count"];
    
    
                                    echo "<tr>";
                                    echo "<th><h5>$student_name</h5></th>";
                                    echo "<th><h5>$times</h5></th>";
                                    echo "<th><a href=''>View...</a></th>";
                                    echo "</tr>";
                                }
                            }
                    
                        } else if (empty($name_search)) {
                        // Query to select all rows from the 'hubs' table
                            $sql = "SELECT rr.student_name, COUNT(*) as occurrence_count
                                FROM report_records rr
                                INNER JOIN remarks rm ON rr.report_ID = rm.report_ID
                                GROUP BY rr.student_name
                                ORDER BY occurrence_count DESC"; 
                            $result = $conn->query($sql);

                            // Check if there are rows in the result set
                            if ($result->num_rows > 0) {
                                // Loop through each row
                                while ($row = $result->fetch_assoc()) {
                                    // Access each column value using the column name
                                    $student_name = $row['student_name'];
                                    $times = $row["occurrence_count"];
    
    
                                    echo "<tr>";
                                    echo "<th><h5>$student_name</h5></th>";
                                    echo "<th><h5>$times</h5></th>";
                                    echo "<th><a href=''>View...</a></th>";
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
        <a href="../guidance_search_student/index.php?username=<?php echo $Username?>">Search a Student</a>
        <a href="../guidance_manage_accounts/index.php?username=<?php echo $Username?>">Manage Accounts</a>
        <a href="../guidance_view_records/index.php?username=<?php echo $Username?>">Check Records</a>
        <a href="../login/">Logout</a>
    </div>
</body>
</html>