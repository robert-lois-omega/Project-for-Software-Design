<?php
$Username = urldecode($_GET['username']);
$name_search = urldecode($_GET['name_search']);

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
    <link rel="stylesheet" href="./profile.css">
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


.first{
    display: flex;
    align-items: center; /* Center vertically */
}

.button_sub {
    align-items: center; /* Center vertically */
    display: flex;
    margin-top: 10px;
}

#back {
    width: 60px;
    height: 60px;
    margin-right: 10px;
    background-image: url('../images/icon_back.png');
    background-size: cover;
    background-color: #187180;
    border: none;

}

#back:hover{
    width: 62px;
    height: 62px;
    
}

.profile_name{
    margin-top: 10px;
    margin-right: 30rem;
    width: 500px;
    height: 80px;
}

.profile_name h3{
    margin: 20px 0 0 20px;
    font-size: 24px;
    color: white;
}

.profile_name h4{
    margin: 0 0 0 20px;
    font-size: 12px;
    color: white;
}

</style>
<body>
    <div class="report">
        <div class="first">
            <div class="profile_name">
                <h3><?php echo $name_search?></h3>
                <h4>Student</h4>
            </div>
            <div class="button_sub">
                <input type="hidden" name="username" value="<?php echo $Username?>">   
                <button id="back" onclick="goBack()"></button>
                <h5>Go Back</h5>
            </div>
        </div>
        <div class="context_box">
            <div class="context_main">
                <table id="record_table">
                    <tr>
                        <th><h2>Offense</h2></th>
                        <th><h2>Degree</h2></th>
                        <th><h2></h2></th>
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

                        if (isset($_GET['name_search'])){
                        // Query to select all rows from the 'hubs' table
                            $sql = "SELECT rr.offense_type, COUNT(*) as occurrence_count
                                FROM report_records rr
                                WHERE rr.student_name = '$name_search'
                                GROUP BY rr.offense_type
                                ORDER BY occurrence_count DESC"; 
                            $result = $conn->query($sql);

                            // Check if there are rows in the result set
                            if ($result->num_rows > 0) {
                                // Loop through each row
                                while ($row = $result->fetch_assoc()) {
                                    // Access each column value using the column name
                                    $offense_type = $row['offense_type'];
                                    $times = $row["occurrence_count"];
    
    
                                    echo "<tr>";
                                    echo "<th><h5>$offense_type</h5></th>";
                                    echo "<th><h5>$times</h5></th>";
                                    echo "<th><a href='./report_details.php?username=$Username&name_search=$name_search&offense_type=$offense_type'>View</a></th>";
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
        <a href="../guidance_statistics/index.php?username=<?php echo $Username?>">View Statistics</a>
        <a href="../login/">Logout</a>
    </div>

<script>
    function goBack() {
    window.history.back();
    }
</script>
</body>
</html>