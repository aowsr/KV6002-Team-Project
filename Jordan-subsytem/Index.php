<?php
session_start();
// Include config file
require_once "default/connect.php";
// Set session search variables to be empty when returning to this page
$_SESSION["ageSearch"] = '';
$_SESSION["nationalitySearch"] = '';
$_SESSION["favouriteSearch"] = '';
$_SESSION["aboutSearch"] = '';
$_SESSION["imgPathSearch"] = '';


// If Text has been entered into the search box and the search button is clicked
if (isset($_POST['submit']) && isset($_POST['search'])){

    //Send search to next page
    $_SESSION['searchQurey'] = $_POST['search'];
    header("location:searchResults.php");
}
//}
/*
if($_SESSION["suspension"] == true){
   header("location: suspensionPage.php");
    exit;
}
*/

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
<script src=instantSearch.js></script>
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
                <li class="navItem"><a href="default.asp">Contact</a></li>
                <li class="navItem"><a href="news.asp">Forum</a></li>
                <li class="navItem"><a href="profilePage.php">Profile </a></li>
                <li class="navItem"><a href="Index.php">Home</a></li>
            <?php
            };
            ?>
        </ul>
    </div>

    <!-- Main Section With Search bar -->
        <div id="searchContainer">
            <?php
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            ; ?>
                <h1> Loggin or sign up to access this websites features</h1>

                <?php
            }
            else{ ?>
            <form action="" method="POST">
                <input id="searchBar" name="search" type="text" size="100" placeholder="Search for your next adventure..." onkeyup="searchq();">
                <button id="submit" name="submit" type="submit"><i class="fa fa-search"></i></button>
            </form>
                <?php
            };
            ?>

            <div id="output">

            </div>
        </div>
        <img src="Media/backdropv5.jpg" alt="img">
</div>

<div id="hotSpots">

    <div id="hotSpotsTitle">
        <h1 id="hotSpotsTitleText">Hot Spots</h1>
    </div>

</div>

</body>
</html>
