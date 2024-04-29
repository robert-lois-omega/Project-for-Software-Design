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
<body>
    <div class="report">
        <h3>Manage Accounts</h3>
        <div class="context_box">
            <div class="context_main">
                <table id="record_table">
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
                                echo "<th><a href='www.y8.com/?username=$username'>Edit</a></th>";
                                echo "</tr>";
                            }
                        }
                        ?>
                </table>
                <button id="add_account_btn">Add New Account</button>
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
        <a href="">Manage Accounts</a>
        <a href="../guidance_view_records">Check Records</a>
        <a href="../login/">Logout</a>
    </div>


</body>
</html>