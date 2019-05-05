<?php
// Initialize the session
session_start();


// Include config file
require_once('default/connect.php');

// Define variables and initialize with empty values
$email = $email_err = $emailTo = '';

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Check if username is empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter a valid email.";
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty($email_err)) {


        $sqlEmail = "SELECT email FROM users WHERE email = :email";

        if ($stmtEmail = $pdo->prepare($sqlEmail)) {
// Bind variables to the prepared statement as parameters
            $stmtEmail->bindParam(":email", $param_email, PDO::PARAM_STR);

// Set parameters
            $param_email = $email;

// Attempt to execute the prepared statement
            if ($stmtEmail->execute()) {
                if ($stmtEmail->rowCount() !== 1) {
                    $email_err = "This email is not registered.";
                } else {
                    $emailTo = $email;
                }
            }
        }
        //unique code is created and then inseted to sql
        $code = uniqid(true);

        $query = "INSERT INTO resetPasswords(code, email) VALUES('$code', '$emailTo')";

        $stmt = $pdo->prepare($query);
        //if it excutes the email is generated with the unique code to be redirected for user
        if ($stmt->execute()) {
            $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/resetPassword.php?code=$code";
            $to = $emailTo;
            $subject = "Your Password Reset Link";

            $headers .= "From:<neetan.briah@northumbria.ac.uk>" . PHP_EOL;
            $headers  = "MIME-Version: 1.0" . PHP_EOL;
            $headers .= "Content-Type: text/html; charset=ISO-8859-1" . PHP_EOL;
            $headers .= "X-Mailer: PHP/" . phpversion();

            $message = "Your requested password reset link. Click the link to proceed. $url";

            if (mail($to, $subject, $message, $headers)) {
                header("location: welcome.php");
                echo "Your Password reset link has been sent to your registered email";
            } else {
                echo "Failed to Recover your password, try again";
            }
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
<!-- Navabr -->
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
<!-- form for users to enter their emails to recover password -->
<div class="container mt-4 d-flex justify-content-center">
    <div class="wrapper">
        <h2>Forgotten Password</h2>
        <p>Recovery email will be sent.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-secondary" value="Forgot Password">
                <a class="btn btn-dark" href="welcome.php">Cancel</a>
            </div>
            <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
            <p>Forgot your password? <a href="forgottenPassword.php">Reset Password</a>.</p>
        </form>
    </div>
</div>

</body>

</html>