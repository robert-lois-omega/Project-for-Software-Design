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
    $Name = $row['Name'];
    $Role = $row['role'];
} 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="edit_account2.css">
    <link href="https://fonts.cdnfonts.com/css/norwester" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&family=Nixie+One&display=swap" rel="stylesheet">
</head>
<body>
    <div class="report">
        <h3>Add New Account</h3>
        <div class="context_box">
            <div class="context_main">
                <form action="apply_add_edit.php?username=<?php echo $Username?>" method="post">
                    <h4>Name</h4>
                    <input type='text' name='Name' placeholder="Name"></input>
                    <h4>Username</h4>
                    <input type='text' name='username' placeholder="Username"></input>
                    <h4>Password</h4>
                    <input type='text' name='password' placeholder="Password"></input>
                    <h4>Role</h4>
                    <select type='text' name='role'>
                    <option value='Admin'>Admin</option>
                    <option value='Teacher'>Teacher</option>
                    </select>

                    <button id="edit_account_btn">Submit</button>
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
            echo "<h3>$Name</h3>";
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
    <?php
    echo "<h1>$Username</h1>";

    ?>

</body>
</html>