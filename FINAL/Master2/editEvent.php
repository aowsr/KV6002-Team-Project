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
                    <a class="nav-link" href="#">Forum</a>
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

    $eventID = filter_has_var(INPUT_GET, 'eventID') ? $_GET['eventID'] : null;
//If the event ID is empty then the user will be given a link to back to the event list
    if (empty($eventID)) {
        echo "<p> Please <a href='chooseEvent.php'>choose</a> an event. </p>\n";
    } //This will connect to the database to retrieve the details about the event
    else {
        try {
            require_once("functions.php");
            $con = getConnection();

            $sqlQuery = "select eventID, eventTitle, eventDescription, location , eventStartDate, eventEndDate,
        eventPrice FROM events
        WHERE eventID = $eventID";
            $queryResult = $con->query($sqlQuery);
            $rowObj = $queryResult->fetchObject();


            // This will print out all the current details of an event where a user can update the fields
            echo "
		<h1>Edit '{$rowObj->eventTitle}'</h1>
		<form id='editEvent' action='updateEvent.php' method='get'>
			<p>Event ID<input ='eventID' value='$eventID' readonly name='eventID'/></p>
			<p>Event Title <input type='text' name='eventTitle' maxlength='70' value='{$rowObj->eventTitle}' /></p>
			<p>Event Description <input type='text' name='eventDescription' maxlength='250' required value='{$rowObj->eventDescription}' /></p>
			<p>Location<input type='text' name='location' required value='{$rowObj->location}'/></p>
			<p>Event Start Date<input type='text' name='eventStartDate' min='2019-05-01' max='2021-12-12' required value='{$rowObj->eventStartDate}'/></p>
			<p>Event End Date<input type='text' name='eventEndDate' min='2019-05-01' max='2021-12-12' required value='{$rowObj->eventEndDate}'/></p>
			<p>Event price<input type='number' name='eventPrice' min='1' max='200' required value='{$rowObj->eventPrice}'/></p>
			<p><input type='submit' name='submit' value='Update Event'></p>
		</form>
		";
//This will catch an exception
        } catch (Exception $e) {
            echo "<p>Event details not found: " . $e->getMessage() . "</p>\n";
        }

    }
}

?>

</body>
<footer class="container mt-8">
    <br/>
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>&copy; 2018-2019 Northumbria University &middot; Final Year Group Project</p>
</footer>
</html>