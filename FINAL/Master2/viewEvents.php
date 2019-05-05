
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
<header>
    <!-- this is a heading -->
    <h1>Arts & Events</h1>

</header>

<main>
    <div>

        <nav class=".note">

            <ul>
                <!-- Below are my links in the navigation menu -->
                <li><a href="Index.html">Home</a></li>
                <li><a href="viewEvents.php">View Events</a></li>
                <li><a href="Index.html">Admin</a></li>
                <li><a href="Index.html">Credits</a></li>
                <li><a href="Wireframe.pdf">Wireframe</a></li>
            </ul>
        </nav>
    </div>
<div class=".event">


    <?php
include 'database_conn.php';

$sql = "SELECT eventTitle, catDesc, venueName, eventStartDate,
eventEndDate, eventPrice FROM AE_events
INNER JOIN AE_category
ON AE_category.catID = AE_events.catID 
INNER JOIN AE_venue
ON AE_venue.venueID = AE_events. venueID
ORDER BY eventTitle";


$queryResult = $dbConn->query($sql);
if($queryResult === false) {
    echo "<p>Query failed: " .$dbConn->error. "</p>\n</body>\n</html>";
    exit;
}
else {

    while($rowObj = $queryResult->fetch_object()) {
        $eventTitle = $rowObj->eventTitle;
        $catDesc = $rowObj->catDesc;
        $venueName = $rowObj->venueName;
        $eventStartDate = $rowObj->eventStartDate;
        $eventEndDate = $rowObj->eventEndDate;
        $eventPrice = $rowObj->eventPrice;
        echo "<div class='title'> <span class='event'> $eventTitle</span> <span class='category'> $catDesc</span> 
<span class='venue'>$venueName</span> <span class='startDate'>$eventStartDate</span>  <span class='endDate'>
 $eventEndDate</span> <span class='price'>$eventPrice<br></span></div>";
    }
}
$queryResult->close();
$dbConn->close();
?>
</div>







