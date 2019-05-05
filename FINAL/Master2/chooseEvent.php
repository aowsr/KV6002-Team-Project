<?php
session_start();

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                        <a class="nav-link active" href="chooseEvent.php">Edit Events</a>
                    </div>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="emailAll.php">Message All</a>
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
<div class="container mt-4 d-flex justify-content-center">
    <h1>All Events</h1>
</div>

<?php
// Connect to the database and obtain the data from events table
try {
    require_once("functions.php");
    $dbConn = getConnection();

    $sqlQuery = "SELECT  eventID, eventTitle, eventDescription, location, eventStartDate, eventEndDate, eventPrice FROM events
                 ORDER BY eventTitle";
    $queryResult = $dbConn->query($sqlQuery);

    //Once connected, display the current events available
    while ($rowObj = $queryResult->fetchObject()) {
        echo "<div class='container mt-4 d-flex justify-content-center'><div class='event '>\n
<span class='event Title'><a href='editEvent.php?eventID={$rowObj->eventID}'>{$rowObj->eventTitle}</a></span>\n
				   <span class='Location'>{$rowObj->location}</span>\n
				   <span class='eventPrice'>{$rowObj->eventPrice}</span>\n
			  </div></div>\n";
    }
} //This will catch an exception
catch (Exception $e) {
    echo "<p>Query failed: " . $e->getMessage() . "</p>\n";
}


?>

</body>
<footer class="container mt-8">
    <br/>
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>&copy; 2018-2019 Northumbria University &middot; Final Year Group Project</p>
</footer>
</html>
