<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <title>Arts&Events</title>
    <link href="viewEvents.css" rel="stylesheet" type="text/css">
    <link href="Index.css" rel="stylesheet" type="text/css"



    <!--link to my css sheet is above -->
</head>
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

/**
 * Created by PhpStorm.
 * User: w16015928
 * Date: 04/04/2017
 * Time: 13:12
 */






