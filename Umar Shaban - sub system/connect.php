<?php
$con=mysqli_connect('localhost','unn_w16028251','Montybriah3');
mysqli_select_db($con,'unn_w16028251');
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'unn_w16028251');
define('DB_PASSWORD', 'Montybriah3');
define('DB_NAME', 'unn_w16028251');

$sql = "INSERT INTO events (eventTitle, eventDescription, location, eventStartDate,
eventEndDate, eventPrice )
VALUES ('$eventTitle','$eventDescription','$location', '$eventStartDate','$eventEndDate','$eventPrice' )";

if ($con->query($sql) === true) {
    echo "New record created successfully";
}
else {
    echo "Error: " .$sql . "<br>" . $con->error;
}



/* Attempt to connect to MySQL database */
try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>