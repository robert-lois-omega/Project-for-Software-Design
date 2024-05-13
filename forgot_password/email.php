<?php
$Username = $_POST['username'];

function hideEmailMiddle($email) {
    // Split email into local part and domain part
    list($local, $domain) = explode('@', $email);

    // Get the length of the local part
    $localLength = strlen($local);

    // Determine the number of characters to keep visible
    $visibleChars = 2;

    // Hide characters between the visible characters and the "@" symbol
    $hiddenChars = $localLength - ($visibleChars * 2);

    // Replace characters in the local part with asterisks
    $hiddenPart = str_repeat('*', $hiddenChars);

    // Combine the visible part, hidden part, and domain part to form the masked email
    $maskedEmail = substr($local, 0, $visibleChars) . $hiddenPart . substr($local, $localLength - $visibleChars) . '@' . $domain;

    return $maskedEmail;
}


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
    $email = $row['email'];
    $maskedEmail = hideEmailMiddle($email);
} else{
    header("Location: ../forgot_password/error.html");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <title>Forgot Password</title>
</head>
<style>
.form-gap {
    padding-top: 70px;
}
</style>
<body>
<div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>Kindly provide the email <b><?php echo $maskedEmail?></b></p>
                  <div class="panel-body">
    
                    <form id="register-form" action="submit.php" role="form" autocomplete="off" class="form" method="post">
    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="email" placeholder="Email" class="form-control"  type="email" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Send" type="submit">
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                      <input type="hidden" name="username" value="<?php echo $Username?>">
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
</body>
</html>