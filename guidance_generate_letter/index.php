<?php
$report_ID = $_GET['report_ID'];
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
    $Role = $row['role'];
} 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./guidance_generate_letter.css">
    <link href="https://fonts.cdnfonts.com/css/norwester" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&family=Nixie+One&display=swap" rel="stylesheet">
</head>
<body>
    <div class="report">
        <h3>GENERATE LETTER</h3>
        <div class="context_box">
            <div class="context_main" method="post">
            <form action="./generate_letter.php?username=<?php echo $Username ?>" method="post" onsubmit="return showLoadingScreen();">
            <input type="hidden" name='report_ID' value="<?php echo $report_ID?>">
                <input type='text' name='Guardians_Name' placeholder='Guardian Name' id='search_id'>
                <input type="text" name="Guardians_Address" placeholder="Address" id="search_id">
                <input type="submit" id="submit_btn" value="Generate">
                </form>
            </div>
            
            <div class="footer_note">
                <h1>Kindly type the name of the Guardian and the Address</h1>
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
            echo "<h4>$Role</h4>";
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

    <div class="loading-screen" id="loadingScreen">
        <div class="loading-icon">
            <div class="loader"></div>
            <div>
                <h2 style="font-family: 'Dancing Script', cursive; font-size: 18px; font-weight: bold; margin-left: 20px; color: black;">Generating Letter...</h2>
            </div>
        </div>
    </div>

    <script>
        function showLoadingScreen() {
            const loadingScreen = document.getElementById("loadingScreen");
            loadingScreen.style.display = "block";
        }

        function hideLoadingScreen() {
            const loadingScreen = document.getElementById("loadingScreen");
            loadingScreen.style.display = "none";
        }
    </script>

</body>
</html>