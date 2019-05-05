<?php
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

    <title>Travel Site</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="travel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>


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

</body>
</html>
