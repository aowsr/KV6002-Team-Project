<?php
session_start();

// require the class definition file
require_once('default/setPath.php');
require_once('default/errorFunctions.php');
require_once('default/connect.php');
//get unique user id
$id = $_GET['id'];
//update suspension on user then redirect to admin page
$query = 'UPDATE users SET suspension = False WHERE id=:id';
$statement = $pdo->prepare($query);
if ($statement->execute([':id' => $id])) {
    header("Location: home_admin.php");
}