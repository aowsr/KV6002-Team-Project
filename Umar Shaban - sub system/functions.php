<?php
function getConnection() {
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'unn_w16028251');
    define('DB_PASSWORD', 'Montybriah3');
    define('DB_NAME', 'unn_w16028251');
    try {
        $con = new PDO("mysql:host=localhost;dbname=unn_w16028251",
            "unn_w16028251", "Montybriah3");
        $con->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);
        return $con;
    } catch (Exception $e) {
        /* We should log the error to a file so the developer can look at any logs. However, for now we won't */
        throw new Exception("Connection error ". $e->getMessage(), 0, $e);
    }

}
?>
