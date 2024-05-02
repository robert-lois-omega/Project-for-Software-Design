<?php
$Username = $_GET['username'];
$report_ID = $_POST['report_ID'];
$Guardians_Name = $_POST['Guardians_Name'];
$Guardians_Address = $_POST['Guardians_Address'];

// Escape each argument for safe use in a shell command
$report_ID = escapeshellarg($report_ID);
$Guardians_Name = escapeshellarg($Guardians_Name);
$Guardians_Address = escapeshellarg($Guardians_Address);

// Execute Python script with properly formatted arguments
$command = "python generate_letter.py $report_ID $Guardians_Name $Guardians_Address";
exec($command, $output);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style2.css">
    <link href="https://fonts.cdnfonts.com/css/norwester" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@0;1&family=Nixie+One&display=swap" rel="stylesheet">
</head>
<body>
    <div class="portal">
    <form action="../guidance/index.php?username=<?php echo $Username ?>" method="post">
        <a  href="./letters/<?php echo $output[0].'.pdf'?>" download>
            <h4>Download <?php echo $output[0]?>.pdf</h4>
        </a> 
        <button class="button-74" role="button">Go Back to Home</button>
    </div>
</body>
</html>
