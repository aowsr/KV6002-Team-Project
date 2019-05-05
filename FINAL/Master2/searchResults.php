<?php
session_start();
// Include config file
require_once "default/connect.php";

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

if (isset($_SESSION['searchQurey'])){
    $results = $_SESSION['searchQurey'];
    //Setting what symbols can be used for the search
    $results = preg_replace("#[^0-9a-z]#i", "", $results);
    $qurey = "SELECT * FROM users WHERE firstname like '%$results%' OR surname like '%$results%' OR username like '%$results%'";
    $eventQurey = "SELECT * FROM events WHERE eventTitle like '%$results%' OR location like '%$results%' OR eventStartDate like '%$results%'";
    if ($stmt = $pdo->prepare($qurey)) {
        // Execute prepared statement
        if ($stmt->execute()) {
            if ($stmt->rowCount() == 0) {
            } else {
                $output = '<ul ="dropdown">';
                $output = '<h1 class="searchHeadings"> People </h1>';
                while ($row = $stmt->fetch()) {
                    $fname = $row['firstname'];
                    $lname = $row['surname'];
                    $_SESSION["firstnameSearch"] = $row['firstname'];
                    $_SESSION["surnameSearch"] = $row['surname'];
                    $username = $row['username'];
                    $_SESSION['searchID'] = $row['id'];
                    $searchID = $_SESSION['searchID'];
                    $output .= '<a id="' . $searchID . '" class="searchResult" href="otherUserViewProfile.php?id=' . $searchID . '"><li> ' . $fname . ' ' . $lname . '</li></a>';
                }
            }
        }
    }
    if ($stmtEvent = $pdo->prepare($eventQurey)) {
        $output .= '<h1 class="searchHeadings"> Events </h1>';
        // Execute prepared statement
        if ($stmtEvent->execute()) {
            while ($row = $stmtEvent->fetch()) {
                $eventName = $row['eventTitle'];
                $eventLoc = $row['location'];
                $eventDate = $row['eventStartDate'];
                $searchedEventId = $row['eventID'];

                //Prepare output for results
                $output .= '<a id="' . $searchedEventId . '" class="searchResult" href="otherUserViewProfile.php?id=' . $searchedEventId . '"><li> ' . $eventName . ' ' . $eventLoc . '</li></a>';
            }
        }
    }
    $output .= '</ul>';
}
else{
    // If no results are found
    $output = '<h1 class="searchHeadings"> No Results Found </h1>';
}
?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Travel Site</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="travel.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="js/instantSearch.js"></script>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src=js/instantSearch.js></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/profileCustomization.js"></script>
</head>

<body>

<!-- Nav Bar -->
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
                <li class="nav-item">
                    <a class="nav-link" href="#">Create Event</a>
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
<div id="Search">
    <div id="searchResults">
        <div id="searchTop">
            <h1 id="searchTitle">Search Results</h1>
        </div>

        <div id="searchMain">

            <!-- Display search results -->
            <?php
            echo($output);
            ?>
        </div>

    </div>
</div>
</body>
</html>