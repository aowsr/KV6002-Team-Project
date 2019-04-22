<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
  	<title>ChooseEvent.php</title>
</head>
<body>
<h1>All Events</h1
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
        echo "<div class='event'>\n
<span class='event Title'><a href='editEvent.php?eventID={$rowObj->eventID}'>{$rowObj->eventTitle}</a></span>\n
				   <span class='Location'>{$rowObj->location}</span>\n
				   <span class='eventPrice'>{$rowObj->eventPrice}</span>\n
			  </div>\n";
	}
}

//This will catch an exception
catch (Exception $e){
	echo "<p>Query failed: ".$e->getMessage()."</p>\n";
}

//Allow the user to return back to the home page
echo "<p>Click to return to <a href='Index.php'>Home</a></p>";
?>









