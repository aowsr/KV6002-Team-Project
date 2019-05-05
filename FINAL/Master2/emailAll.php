<?php
session_start();
// Include config file
require_once('default/setPath.php');
require_once('default/errorFunctions.php');
require_once('default/connect.php');

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if (($_SESSION["userType"] == 'Admin')) {
    header("location: home_admin.php");
    exit;
}

if ($_SESSION["suspension"] == true) {
    header("location: suspensionPage.php");
    exit;
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
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="categories.php">Forum</a>
                </li>
                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Events
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="nav-link" href="createEvent.php">Create Event</a>
                        <div class="dropdown-divider"></div>
                        <a class="nav-link" href="chooseEvent.php">Edit Events</a>
                    </div>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item active" href="emailAll.php">Message All</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="passwordReset.php">Reset Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="do_logout.php">Sign Out</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="profilePage.php"><?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<body>
<?php
if (($_SESSION["userType"] !== 'Committee Member')) {
    ?>

    <div class="jumbotron jumbotron-fluid">
        <h1 class="display-4 text-center">Upgrade Today!</h1>
        <hr class="my-4">
        <p class="lead text-center">This feature is only for our Committee Members.</p>
    </div>
    <?php
} else {

    $ops = '';

    $sql = "SELECT email FROM users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $ops .= "<option value='" . $row['email'] . "'>" . $row['email'] . "</option>";
    }

    if (isset($_POST) & !empty($_POST)) {

        $to2 = ($_POST["to"]);

        $messageAll = trim($_POST["message"]);
        $subject2 = "Email from a Committe Member @ TravelSite";

        $to = "$to2";
        $subject = $subject2;

        $headers .= "From:<neetan.briah@northumbria.ac.uk>" . PHP_EOL;
        $headers = "MIME-Version: 1.0" . PHP_EOL;
        $headers .= "Content-Type: text/html; charset=ISO-8859-1" . PHP_EOL;
        $headers .= "X-Mailer: PHP/" . phpversion();

        $message = $messageAll;

        if (mail($to, $subject, $message, $headers)) {
            header("location: Index.php");
        } else {
            echo "Message failed, try again";
        }
    }


    ?>

    <div class="container mt-4 d-flex justify-content-center">
        <div class="wrapper">
            <h2>Message All Users</h2>
            <form method="post">
                <div class="form-group">
                    <label for="userType">To</label>
                    <select name="to">
                        <?php echo $ops; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Message: </label>
                    <input type="text" name="message" class="form-control" style="height: 200px;" required>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-secondary" name="submit" value="Message">
                    <a class="btn btn-dark" href="Index.php">Cancel</a>
                </div>

            </form>
        </div>
    </div>

    <?php
}
?>

</body>
<footer class="container mt-8">
    <br/>
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>&copy; 2018-2019 Northumbria University &middot; Final Year Group Project</p>
</footer>
</html>