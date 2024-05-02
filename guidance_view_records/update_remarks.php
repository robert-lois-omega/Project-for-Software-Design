<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $radioButtonData = array();

    // Iterate through the $_POST array to collect radio button data
    foreach ($_POST as $name => $value) {
        // Check if the input is a radio button
        echo $name;

        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'ticketing_system';

        $conn = new mysqli($host, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Query to select all rows from the 'hubs' table
        $sql = "UPDATE `remarks` SET `remarks`='$value' WHERE report_ID='$name'";
        $conn->query($sql);
    }

    // Redirect back to the page where the form was submitted
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
} else{
    // Redirect back to the page where the form was submitted
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
}
?>