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
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.cdnfonts.com/css/norwester" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&family=Nixie+One&display=swap" rel="stylesheet">
</head>
<body>
    <div class="report">
        <h3>CREATE A REPORT</h3>
        <div class="context_box">
            <div class="context_main">
                <form action="submit_report.php?username=<?php echo $Username?>" method="post">
                <input type="text" name="name" id="student_name" placeholder="Student Name">
                <select name="offense" id="options">
                    <option value="Unexcused Absences">Unexcused Absences</option>
                    <option value="Tardiness">Tardiness</option>
                    <option value="Cutting Classes">Cutting Classes</option>
                    <option value="Loitering">Loitering</option>
                    <option value="Not Wearing Proper Uniform">Not Wearing Proper Uniform</option>
                    <option value="Wearing of Jewelry">Wearing of Jewelry</option>
                    <option value="Not Wearing I.D.">Not Wearing I.D.</option>
                    <option value="Unauthorized Use of Gadgets">Unauthorized Use of Gadgets</option>
                    <option value="Unauthorized Use of Vehicles">Unauthorized Use of Vehicles</option>
                    <option value="Cheating">Cheating</option>
                    <option value="Stealing">Stealing</option>
                    <option value="Smoking and Drinking Alcoholic Drinks">Smoking and Drinking Alcoholic Drinks</option>
                    <option value="Use of Illegal Drugs">Use of Illegal Drugs</option>
                    <option value="Gambling">Gambling</option>
                    <option value="Fist Fights(Sparring), Causing Injury to others">Fist Fights(Sparring), Causing Injury to others</option>
                    <option value="Forging of Signatures">Forging of Signatures</option>
                    <option value="Vandalism">Vandalism</option>
                    <option value="Immoral Conduct of Idecency">Immoral Conduct of Idecency</option>
                    <option value="Risky Social Media Behavior">Risky Social Media Behavior</option>
                    <option value="Unauthorized formation of Groups(Fraternities, Gangs, Sororities)">Unauthorized formation of Groups(Fraternities, Gangs, Sororities)</option>
                    <option value="Possesion of Deadly Weapons">Possesion of Deadly Weapons</option>
                    <option value="Threats and Assults on School Personnel">Threats and Assults on School Personnel</option>
                </select>
                <input type="datetime-local" id="date_time" name="datetime">
                <textarea name="details" id="further_detailes" cols="30" rows="10" placeholder="Further Detailes..."></textarea>
                <input type="submit" id="submit_btn">
            </form>
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