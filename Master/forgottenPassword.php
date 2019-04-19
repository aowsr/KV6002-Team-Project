<?php
// Initialize the session
session_start();


// Include config file
require_once('default/connect.php');

// Validate credentials
if(isset($_POST) & !empty($_POST)) {

$sqlEmail = "SELECT email FROM users WHERE email = :email";

if($stmtEmail = $pdo->prepare($sqlEmail)) {
// Bind variables to the prepared statement as parameters
    $stmtEmail->bindParam(":email", $param_email, PDO::PARAM_STR);

// Set parameters
    $param_email = trim($_POST["email"]);

// Attempt to execute the prepared statement
    if ($stmtEmail->execute()) {
        if ($stmtEmail->rowCount() == 1) {
            $email_err = "This email is already registered.";
        } else {
            $emailTo = trim($_POST["email"]);
        }
    }
}
    $code = uniqid(true);

    $query = "INSERT INTO resetPasswords(code, email) VALUES('$code', '$emailTo')";

    $stmt = $pdo->prepare($query);

    if ($stmt->execute()) {
        $url = "http://". $_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/resetPassword.php?code=$code";
        $to = $emailTo;
        $subject = "Your Password Reset Link";

        $message = "Your requested password reset link. Click the link to proceed. $url";

        $headers = "From : neetan.briah@northumbria.ac.uk";
        if (mail($to, $subject, $message, $headers)) {
            echo "Your Password has been sent to your registered email";
        } else {
            echo "Failed to Recover your password, try again";
        }
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

<header>
    <nav class="navbar navbar-expand-md bg-light navbar-light sticky-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav pull-right mr-auto">
                <a class="navbar-brand" href="Index.php">TravelSite</a>
            </ul>
            <ul class="navbar-nav pull-right ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<body>
<div class="container mt-4 d-flex justify-content-center">
<div class="wrapper">
    <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
    <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
    <form class="form-group" method="POST">
        <h2 class="form-signin-heading">Forgotten Password</h2>
        <div class="form-group">
            <p>Recovery email will be sent.</p>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-secondary" value="Forgot Password">
            <a class="btn btn-dark" href="welcome.php">Cancel</a>
        </div>
        <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
        <p>Go back? <a href="login.php">Login page</a>.</p>
    </form>
</div>
</div>

</body>


</html>