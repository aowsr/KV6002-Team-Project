<?php
session_start();

// require the class definition file
require_once('default/setPath.php');
require_once('default/errorFunctions.php');
require_once('default/connect.php');

//retrieve user id
$id = $_GET['id'];
//sqls statment to delte the specific user
$sql = 'DELETE FROM users WHERE id=:id';
$statement = $pdo->prepare($sql);
//if statement executes, redirect back to admin page
if ($statement->execute([':id' => $id])) {
    header("Location: home_admin.php");
}