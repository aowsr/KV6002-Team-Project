<?php
//Starting a session path to restrict functionality


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Edit event</title>
</head>
<body>
<?php
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
			<p>Event Title <input type='text' name='eventTitle' size='50' value='{$rowObj->eventTitle}' /></p>
			<p>Event Description <input type='text' name='eventDescription' value='{$rowObj->eventDescription}' /></p>
			<p>Location<input type='text' name='location' value='{$rowObj->location}'/></p>
			<p>Event Start Date<input type='text' name='eventStartDate' value='{$rowObj->eventStartDate}'/></p>
			<p>Event End Date<input type='text' name='eventEndDate' value='{$rowObj->eventEndDate}'/></p>
			<p>Event price<input type='number' name='eventPrice' value='{$rowObj->eventPrice}'/></p>
			<p><input type='submit' name='submit' value='Update Event'></p>
			<p><a href='chooseEvent.php'>Go Back</a></p>
		</form>
		";
//This will catch an exception
    } catch (Exception $e) {
        echo "<p>Event details not found: " . $e->getMessage() . "</p>\n";
    }

}


?>
</body>
</html>