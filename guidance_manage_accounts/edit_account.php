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
    $Role = $row['role'];
} 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="edit_account.css">
    <link href="https://fonts.cdnfonts.com/css/norwester" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&family=Nixie+One&display=swap" rel="stylesheet">
</head>
<style>
.report{
    width: 70%;
    height: 40rem;
    position: absolute;
    margin-left: 330px;
    margin-top: 0px;
    font-size: 24px;
    color: white;
    border-radius: 10px;
    background-color: #f2f2f2;
    border: 2px solid black;
    
}
</style>
<body>
    <div class="report">
        <h3>Edit an Account</h3>
        <div class="context_box">
            <div class="context_main">
                <form action="apply_edit.php?USERNAME=<?php echo $Username?>" method="post">
                    <?php
                        $Username = $_GET['Username'];
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

                        // Check if the query was successful
                        if ($result) {
                            // Fetch the result as an associative array
                            $row = $result->fetch_assoc();
                            $Name = $row['Name'];
                            $Username = $row['username'];
                            $password = $row['password'];
                            $email = $row['email'];
                            $role = $row['role'];
                            echo "<h4>Name</h4>";
                            echo "<input type='text' name='Name' value='$Name'></input>";
                            echo "<input type='hidden' name='username' value='$Username'></input>";
                            echo "<h4>Password</h4>";
                            echo "<input type='text' name='password' value='$password'></input>";
                            echo "<h4>Email</h4>";
                            echo "<input type='email' name='email' value='$email'></input>";
                            echo "<h4>Role</h4>";
                            echo "<select type='text' name='role' value='$role'>";
                            echo " <option value='Admin'>Admin</option>";
                            echo " <option value='Teacher'>Teacher</option>";
                            echo "</select>";

                        }
                        ?>
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


</body>
</html>