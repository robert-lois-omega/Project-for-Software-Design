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
    <link rel="stylesheet" href="guidance_manage_accounts.css">
    <link href="https://fonts.cdnfonts.com/css/norwester" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&family=Nixie+One&display=swap" rel="stylesheet">
</head>

<style>
.loading-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 999;
    display: none;
}

.loading-icon {
    background-color: white;
    border-radius: 5px;
    margin-top: 200px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 200px;
    border: 3px solid green; 
}
.loader {
  border: 8px solid #f3f3f3;
  border-radius: 50%;
  border-top: 8px solid pink;
  border-bottom: 8px solid pink;
  width: 40px;
  height: 40px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

<body>
    <div class="report">
        <h3>Manage Accounts</h3>
        <div class="context_box">
            <div class="context_main">
                <form action="./add_new_account.php?username=<?php echo $Username ?>" method="post">
                <table id="record_table">
                    <input type="hidden" name="username" value="<?php $_GET['username'] ?>">
                    <tr>
                        <th><h2>Name</h2></th>
                        <th><h2>Username</h2></th>
                        <th><h2>Password</h2></th>
                        <th><h2>Role</h2></th>
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

                        // Query to select all rows from the 'hubs' table
                        $sql = "SELECT * FROM accounts WHERE 1";
                        $result = $conn->query($sql);

                        // Check if there are rows in the result set
                        if ($result->num_rows > 0) {
                            // Loop through each row
                            while ($row = $result->fetch_assoc()) {
                                // Access each column value using the column name
                                $Name = $row['Name'];
                                $username = $row['username'];
                                $password = $row['password'];
                                $role = $row['role'];
                                echo "<tr>";
                                echo "<th><h5>$Name</h5></th>";
                                echo "<th><h5>$username</h5></th>";
                                echo "<th><h5>$password</h5></th>";
                                echo "<th><h5>$role</h5></th>";
                                echo "<th><hr><a href='edit_account.php?Username=$username&username=$Username'>Edit</a> <hr> <a href='#' onclick='confirmDelete(\"$username\");'>Delete</a><hr></th>";
                                echo "</tr>";
                            }
                        }
                        ?>
                </table>
                <button id="add_account_btn">Add New Account</button>
                <br>
                <br>
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

    <div class="loading-screen" id="loadingScreen">
    <div class="loading-icon">
        <div class="loader">

        </div>
        <div>
            <h2 style="font-family: 'Dancing Script', cursive; font-size: 18px; font-weight: bold; margin-left: 20px; color: black;">Processing your document...</h2>
        </div>
    </div>

</div>
<script>
function confirmDelete(username) {
    // Show a confirmation dialog to the user
    const confirmation = confirm("Are you sure you want to delete this account?");
    
    // If the user confirms deletion
    if (confirmation) {
        // Redirect to another page
        window.location.href = './delete_account.php?username=<?php echo $Username?>' + '&to_delete=' + username;
    }
}

function hideLoadingScreen() {
    const loadingScreen = document.getElementById("loadingScreen");
    loadingScreen.style.display = "none";
}
</script>
</body>
</html>