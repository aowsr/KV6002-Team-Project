<?php

// Include config file
require_once('default/errorFunctions.php');
require_once('default/connect.php');

//making sure the code is obtained from the redirect link
if (!isset($_GET["code"])) {
    header("location: welcome.php");
    exit("can not find page!");
}

//store the unique code
$code = $_GET["code"];

//load users email from the unique code
$emailQuery = "SELECT email FROM resetPasswords WHERE code='$code'";
$stmtEmail = $pdo->prepare($emailQuery);
$stmtEmail->execute();

//condition incase no code is linked - incase it has expired
if ($stmtEmail->rowCount() == 0) {
    header("location: welcome.php");
    echo "Error no matching email found in resetPasswords";
}

// Processing form data when form is submitted
if (isset($_POST["password"])) {

    $password = $_POST["password"];

    $param_password = password_hash($password, PASSWORD_DEFAULT);

    $row = $stmtEmail->fetch();

    $email = $row["email"];

    // Prepare an update statement
    $query = "UPDATE users SET password = :password WHERE email='$email'";

    if ($queryStmt = $pdo->prepare($query)) {
        // Bind variables to the prepared statement as parameters
        $queryStmt->bindParam(":password", $param_password, PDO::PARAM_STR);

        // Attempt to execute the prepared statement
        if ($queryStmt->execute()) {

            $deleteSQL = "DELETE FROM resetPasswords WHERE code='$code'";
            $deleteStmt = $pdo->prepare($deleteSQL);

            if ($deleteStmt->execute()) {
                header("location: Index.php");
            }
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Travel Site</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</head>
<!-- Navabr -->
<header>
    <nav class="navbar navbar-expand-md bg-light navbar-light sticky-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav pull-right mr-auto">
                <a class="navbar-brand" href="welcome.php">TravelSite</a>
            </ul>
        </div>
    </nav>
</header>
<body>
<!-- form to allow user to update password -->
<div class="container mt-4 d-flex justify-content-center">
    <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Enter your new password.</p>
        <form method="post">

            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-secondary" name="submit" value="Update Password">
                <a class="btn btn-dark" href="welcome.php">Cancel</a>
            </div>

        </form>
    </div>
</div>
</body>
</html>