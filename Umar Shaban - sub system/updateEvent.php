
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>updateEvent.php</title>
</head>
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

echo
"<p>Click to return to <a href='chooseEvent.php'>Choose Events</a></p>
<br>
<p>Click to return to <a href='Index.php'>Home</a></p>
</body>
</html>";

























/**
 * Created by PhpStorm.
 * User: w16015928
 * Date: 26/10/2017
 * Time: 13:40
 */