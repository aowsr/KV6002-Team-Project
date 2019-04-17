<?php
session_start();
// Include config file
require_once "default/connect.php";
$results = $_SESSION['searchQurey'];


    //Setting what symbols can be used for the search
    $results = preg_replace("#[^0-9a-z]#i", "", $results);

    // Prepare statement
    $qurey = "SELECT * FROM users WHERE firstname like '%$results%' OR surname like '%$results%' OR username like '%$results%' ";

    if ($stmt = $pdo->prepare($qurey)) {

        // Execute prepared statement
        if ($stmt->execute()) {

            if ($stmt->rowCount() == 0) {
                $output = "No results Found!";
            }
            else{
                $output = '<div class="searchResults>';
                $output .= '<ul ="dropdown">';

                while ($row = $stmt->fetch()){
                    $fname = $row['firstname'];
                    $lname = $row['surname'];
                    $_SESSION["firstnameSearch"] = $row['firstname'];
                    $_SESSION["surnameSearch"] = $row['surname'];
                    $username = $row['username'];

                    $_SESSION['searchID'] = $row['id'];

                    $searchID = $_SESSION['searchID'];


                    $output .= '<a id="'.$searchID.'" class="searchResult" href="otherUserViewProfile.php?id='.$searchID.'"><li> '.$fname.' '.$lname.'</li></a>';

                }
                $output .= '</ul>';
                $output .= '</div>';
            }
        }
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

    <link rel="stylesheet" href="style/travel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body>
<script src=js/instantSearch.js></script>
<!-- Nav Bar -->
<div id="Search">
    <div id="Nav">
        <ul id="navList">
            <?php
            // Check if the user is logged in, if not then redirect him to login page
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                ; ?>
                <li class="navItemSignUp"><a href="signup.php">Sign Up</a></li>
                <li class="navItem"><a href="login.php">Login</a></li>
                <?php
            } // End of If statement start of else statement
            else{ ?>
                <li class="navItem"><a href="do_logout.php">Logout</a></li>
                <li class="navItem"><a href="#">Contact</a></li>
                <li class="navItem"><a href="#">Forum</a></li>
                <li class="navItem"><a href="profilePage.php">Profile </a></li>
                <li class="navItem"><a href="Index.php">Home</a></li>
                <?php
            };
            ?>
        </ul>
    </div>

    <?php

    echo($output);
    ?>

    <script>
    console.log(<?= json_encode($searchID); ?>);
    </script>