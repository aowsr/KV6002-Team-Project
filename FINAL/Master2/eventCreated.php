<?php
session_start();
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


//if the event title is empty, print out message to the user
$eventTitle = isset($_REQUEST['eventTitle']) ? $_REQUEST['eventTitle']: null;
if (empty($eventTitle)){
    echo "<p>You have not typed in a title. Please try again.</p>\n";
}
else if (!preg_match("/^[a-zA-Z ]*$/",$eventTitle)) {
    $eventTitle = "Only letters and white space allowed";
}
//if the event description is empty, print out message to the user
$eventDescription = isset($_REQUEST['eventDescription']) ? $_REQUEST['eventDescription']: null;
if (empty($eventDescription)){
    echo "<p>You have not typed in a description. Please try again.</p>\n";
}
else if (!preg_match("/^[a-zA-Z ]*$/",$eventDescription)) {
    $eventDescription = "Only letters and white space allowed";
}

//if the location is empty, print out message to the user
$location = isset($_REQUEST['location']) ? $_REQUEST['location']: null;
if (empty($location)){
    echo "<p>You have not typed in a location. Please try again.</p>\n";
}
else if (!preg_match("/^[a-zA-Z ]*$/",$location)) {
    $location = "Only letters and white space allowed";
}

//if the event start date is empty, print out message to the user
$eventStartDate = isset($_REQUEST['eventStartDate']) ? $_REQUEST['eventStartDate']: null;
if (empty($eventStartDate)){
    echo "<p>You have not typed in a start date. Please try again.</p>\n";
}

//if the event end date is empty, print out message to the user
$eventEndDate = isset($_REQUEST['eventEndDate']) ? $_REQUEST['eventEndDate']: null;
if (empty($eventEndDate)){
    echo "<p>You have not typed in a end date. Please try again.</p>\n";
}

//if the event price is empty, print out message to the user
$eventPrice = isset($_REQUEST['eventPrice']) ? $_REQUEST['eventPrice']: null;
if (empty($eventPrice)){
    echo "<p>You have not typed in a price. Please try again.</p>\n";
}

//connect to the database
include 'connect.php';

//insert new information into the events table
$sql = "INSERT INTO events(eventTitle, eventDescription, location, eventStartDate, eventEndDate,
eventPrice)
VALUES('$eventTitle',
'$eventDescription',
'$location',
'$eventStartDate',
'$eventEndDate',
'$eventPrice')";





$result = $con->query($sql);
//If an error occurs,display error message
if ($result === false) {
    echo "<p>Problem when saving: ".$con->error.". Try again</p>\n</body>\n</html>";
    exit();
}

//print out the updated information to display to the admin
else {
    echo "<section>\n";
    echo "\t<h2>Your new Event Details</h2>\n";
    echo "\t<p>Event Title:$eventTitle</p>\n";
    echo "\t<p>Event Description:$eventDescription</p>\n";
    echo "\t<p>Location:$location</p>\n";
    echo "\t<p>Event Start Date:$eventStartDate</p>\n";
    echo "\t<p>Event End Date:$eventEndDate</p>\n";
    echo "\t<p>Event Price:$eventPrice</p>\n";
    echo "</section>\n";
    echo "<p>Thanks for inputting the details</p>\n";
    echo "<p> Go back to the <a href='createEvent.php'>form</a></p>\n";
}
//close the connection
$con->close();
?>
</body>
<footer class="container mt-8">
    <br/>
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>&copy; 2018-2019 Northumbria University &middot; Final Year Group Project</p>
</footer>
</html>









