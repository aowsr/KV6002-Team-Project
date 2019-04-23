<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Event Created</title>
</head>
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
    echo "<p>Problem when saving: ".$dbConn->error.". Try again</p>\n</body>\n</html>";
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
    echo "<p> Go back to the <a href='createEvent.html'>form</a></p>\n";
}
//close the connection
$con->close();
?>
</body>
</html>









