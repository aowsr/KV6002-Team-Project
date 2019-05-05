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
$eventID = filter_has_var(INPUT_GET, 'eventID') ? $_GET['eventID'] : null;
$eventTitle = filter_has_var(INPUT_GET, 'eventTitle') ? $_GET['eventTitle'] : null;
$eventDescription = filter_has_var(INPUT_GET, 'eventDescription') ? $_GET['eventDescription'] : null;
$location = filter_has_var(INPUT_GET, 'location') ? $_GET['location'] : null;
$eventStartDate = filter_has_var(INPUT_GET, 'eventStartDate') ? $_GET ['eventStartDate'] : null;
$eventEndDate = filter_has_var(INPUT_GET, 'eventEndDate') ? $_GET['eventEndDate'] : null;
$eventPrice = filter_has_var(INPUT_GET, 'eventPrice') ? $_GET['eventPrice'] : null;

//To sanitize the event title variable
$eventTitle = filter_var($eventTitle, FILTER_SANITIZE_STRING,
    FILTER_FLAG_NO_ENCODE_QUOTES);
$eventTitle = filter_var($eventTitle, FILTER_SANITIZE_SPECIAL_CHARS);

//To sanitize the event description variable
$eventDescription = filter_var($eventDescription, FILTER_SANITIZE_STRING,
    FILTER_FLAG_NO_ENCODE_QUOTES);
$eventDescription = filter_var($eventDescription, FILTER_SANITIZE_SPECIAL_CHARS);

//To sanitize the location variable
$location = filter_var($location, FILTER_SANITIZE_STRING,
    FILTER_FLAG_NO_ENCODE_QUOTES);
$location = filter_var($location, FILTER_SANITIZE_SPECIAL_CHARS);

//To sanitize the start date and end date variables
$eventStartDate = filter_var($eventStartDate, FILTER_SANITIZE_STRING,
    FILTER_FLAG_NO_ENCODE_QUOTES);
$eventStartDate = filter_var($eventStartDate, FILTER_SANITIZE_SPECIAL_CHARS);

$eventEndDate = filter_var($eventEndDate , FILTER_SANITIZE_STRING,
    FILTER_FLAG_NO_ENCODE_QUOTES);
$eventEndDate  = filter_var($eventEndDate , FILTER_SANITIZE_SPECIAL_CHARS);




//To ensure that the event price field can only contain numbers
$eventPrice = filter_var($eventPrice, FILTER_SANITIZE_NUMBER_INT);


$errors = false;

//if the event title is empty, print out message to the user
if (empty($eventTitle)) {
    echo "<p>Your Event Title is empty.</p>\n";
    $errors = true;
}
//if the event description is empty, print out message to the user
if (empty($eventDescription)) {
    echo "<p>Your Event Description is empty.</p>\n";
    $errors = true;
}


//if the location name is empty, print out message to the user
if (empty($location)) {
    echo "<p>Your Location is empty.</p>\n";
    $errors = true;
}
//if the start date is empty, print out message to the user
if (empty($eventStartDate)) {
    echo "<p>Your Start date is empty.</p>\n";
    $errors = true;
}
//if the end date is empty, print out message to the user
if (empty($eventEndDate)) {
    echo "<p>Your End Date is empty.</p>\n";
    $errors = true;
}
//if the event price is empty, print out message to the user
if (empty($eventPrice)) {
    echo "<p>Your Event Price is empty.</p>\n";
    $errors = true;
}

else{
    try{
        //connect to the database
        require_once 'functions.php';
        $con = getConnection();
        $eventTitle = $con->quote($eventTitle);
        $eventDescription = $con->quote($eventDescription);
        $location = $con->quote($location);
        $eventStartDate = $con->quote($eventStartDate);
        $eventEndDate = $con->quote($eventEndDate);
        $eventPrice = $con->quote($eventPrice);
        $eventID = $con->quote($eventID);
        //This is a query which has been implemented to update the relevant details in the event database
        $updateSQL = "UPDATE events
                  SET eventTitle=$eventTitle, eventDescription=$eventDescription, location = $location, eventStartDate = $eventStartDate, eventEndDate=$eventEndDate, eventPrice=$eventPrice
                  WHERE eventID=$eventID";
        //connect to the database and update the event
            $result = $con->query($updateSQL);
            $message = "Event Updated";
            //print an error message if a problem has occurred
        } catch (Exception $e) {
            $message = '<h1>Error updating your record</h1>\n<p>$sqlQuery</p>';
            $message .= $e->getMessage();
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