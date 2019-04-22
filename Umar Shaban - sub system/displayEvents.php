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

</head>

<body>
<script src=instantSearch.js></script>
<!-- Nav Bar -->
<div id="Search">
    <div id="Nav">
        <ul id="navList">
            <li class="navItem"><a href="do_logout.php">Logout</a></li>
            <li class="navItem"><a href="#">Contact</a></li>
            <li class="navItem"><a href="#">Forum</a></li>
            <li class="navItem"><a href="profilePage.php">Profile </a></li>
            <li class="navItem"><a href="Index.php">Home</a></li>
        </ul>
    </div>

    <!-- Main Section With Search bar -->
    <div id="searchContainer">

        <form action="" method="POST">
            <input id="searchBar" name="search" type="text" size="100" placeholder="Search for your next adventure..." onkeyup="searchq();">
            <button id="submit" name="submit" type="submit"><i class="fa fa-search"></i></button>
        </form>



        <div id="output">

        </div>
    </div>
    <img src="Media/backdropv5.jpg" alt="img">
</div>

<div id="hotSpots">

    <div id="hotSpotsTitle">
        <h1 id="hotSpotsTitleText">Hot Spots</h1>
    </div>

</div>


<?php

//Connect to database and retrieve data from events table
try{
require_once("functions.php");
$con = getConnection();
$sql = "SELECT eventTitle, eventDescription, location, eventStartDate,
eventEndDate, eventPrice FROM events
ORDER BY eventTitle";

// If the connection is unsuccessful then display error message
$queryResult = $con->query($sql);
if($queryResult === false) {
    echo "<p>Query failed: " .$con->error. "</p>\n</body>\n</html>";
    exit;
}
// If the connection is successful then display the relevant data
else {

    while($rowObj = $queryResult->fetchObject()) {
        $eventTitle = $rowObj->eventTitle;
        $eventDescription = $rowObj->eventDescription;
        $location = $rowObj->location;
        $eventStartDate = $rowObj->eventStartDate;
        $eventEndDate = $rowObj->eventEndDate;
        $eventPrice = $rowObj->eventPrice;
        echo "<div class='title'> <span class='event'> $eventTitle</span> <span class='eventDescription'> $eventDescription</span> 
<span class='location'>$location</span> <span class='eventStartDate'>$eventStartDate</span>  <span class='eventEndDate'>
 $eventEndDate</span> <span class='eventPrice'>$eventPrice<br><br></span></div>";
    }
    }
}
//This will catch an exception
catch (Exception $e) {
    echo "<p>Query failed: " . $e->getMessage() . "</p>\n";
}

?>