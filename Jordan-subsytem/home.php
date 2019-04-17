<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if($_SESSION["userType"] == 'Admin'){
    header("location: home_admin.php");
    exit;
}

if($_SESSION["suspension"] == true){
    header("location: suspensionPage.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<div class="page-header">
    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p><b><?php echo htmlspecialchars($_SESSION["firstname"]); ?></p>
    <p><b><?php echo htmlspecialchars($_SESSION["surname"]); ?></p>
    <p><b><?php echo htmlspecialchars($_SESSION["email"]); ?></p>
    <p><b><?php echo htmlspecialchars($_SESSION["userType"]); ?></p>
</div>
<p>
    <a href="passwordReset.php" class="btn btn-warning">Reset Your Password</a>
    <a href="emailAll.php" class="btn btn-warning">Email Users</a>
    <a href="do_logout.php" class="btn btn-danger">Sign Out of Your Account</a>
</p>
</body>
</html>