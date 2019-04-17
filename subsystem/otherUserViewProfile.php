<?php
session_start();

$id = $_GET['id'];

//If searching for your own profile redirect the main profile page
if($id == $_SESSION['id']){
    header("location:profilePage.php");
}
// Include config file
require_once "default/connect.php";

// Prepare SQL statment
$sql = "SELECT * FROM user_info WHERE id =$id ";

if($stmt = $pdo->prepare($sql)) {

    // Execute prepared statement
    if ($stmt->execute()) {

        if ($stmt->rowCount() == 1) {
            // Store the results into temp variables
            if ($row = $stmt->fetch()) {
                $id = $row["id"];
                $ageTemp = $row["age"];
                $nationalityTemp = $row["country"];
                $favouriteTemp = $row["favourite"];
                $aboutTemp = $row["bio"];
                $colourTemp = $row["colour"];
                $imgTemp = $row["imgPath"];

                // If these temp variables have all been set then bind there values to session variables
                if(isset($ageTemp, $nationalityTemp, $favouriteTemp, $aboutTemp)){

                    $_SESSION["ageSearch"] = $ageTemp;
                    $_SESSION["nationalitySearch"] = $nationalityTemp;
                    $_SESSION["favouriteSearch"] = $favouriteTemp;
                    $_SESSION["aboutSearch"] = $aboutTemp;
                    $colour = $row["colour"];

                    $_SESSION["imgPathSearch"] = $imgTemp;
                }
            }
        }
    }

}

// Prepare SQL statment
$sqlGetName = "SELECT * FROM users WHERE id =$id ";

if($stmtGetName = $pdo->prepare($sqlGetName)) {

    // Execute prepared statement
    if ($stmtGetName->execute()) {

        if ($stmtGetName->rowCount() == 1) {
            // Store the results into temp variables
            if ($row = $stmtGetName->fetch()) {
                $id = $row["id"];
               $firstName = $row['firstname'];
               $surName = $row['surname'];

                }
            }
        }
}

$name = $firstName . " " . $surName;

// Check If User has set there details
// Age
if (!isset ($_SESSION["ageSearch"])){
    $age = "-";
}
else{
    $age = $_SESSION["ageSearch"];
}

// Nationality
if (!isset ($_SESSION["nationalitySearch"])){
    $nationality = "-";
}
else{
    $nationality = $_SESSION["nationalitySearch"];
}

//Favourite place to visit
if (!isset ($_SESSION["favouriteSearch"])){
    $favourite = "-";
}
else{
    $favourite = $_SESSION["favouriteSearch"];
}

//About Me
if (!isset ($_SESSION["aboutSearch"])){
    $about = "-";
}
else{
    $about = $_SESSION["aboutSearch"];
}

//Image Path
if (!isset ($_SESSION["imgPathSearch"])){
   $imgPath = "Media/local/blank.jpg";
}
else{
    $imgPath = $_SESSION["imgPathSearch"];
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>

    <script>
        console.log(<?= json_encode($colour); ?>);
    </script>
    <script src="js/profileCustomization.js"></script>
</head>

<body>

<!-- Nav Bar -->
<div id="Search">
    <div id="Nav">
        <ul id="navList">
            <li class="navItem"><a href="#">Contact</a></li>
            <li class="navItem"><a href="#">Forum</a></li>
            <li class="navItem"><a href="profilePage.php">Profile </a></li>
            <li class="navItem"><a href="Index.php">Home</a></li>
        </ul>
    </div>
</div>

<!-- Profile Section -->
<div id="profileContainer">


    <!-- Left Side Profile, Personal Details -->
    <div id="profilePersonal" class="pinkBorder">
        <!-- Top Section Of Profile -->
        <div id="profileTopSectionLeft" class="profilePink">
            <!-- positioning for profile picture -->
            <div id="profilePictureContainer">
                <img id="profilePicture" src="<?php echo $imgPath ?>" alt="">
            </div>

            <!-- Name -->
            <h1 id = "profileName"> <?php echo $name ?></h1>
        </div>

        <!-- Main Section Of Profile Page -->
        <div id = "profilePersonalDetails">

            <div id="details" class="details">
                <ul>
                    <li><b>Age:</b> <?php echo $age ?></li>
                    <li><b>Nationality:</b> <?php echo $nationality ?></li>
                    <li><b>Favourite Place To Visit:</b> <?php echo $favourite ?> </li>

                </ul>

            </div>

            <div id="aboutMe" class="aboutMe">
                <h1> About me </h1>
                <p><?php echo $about ?></p>

            </div>

        </div>

    </div>

    <!-- Right Side Profile, Posts -->
    <div id="profilePosts" class="pinkBorder">
        <!-- Right Side Top -->
        <div id="profileTopSectionRight" class="profilePink">
            <!-- Title -->
            <div id="postsTitle">
                <h1>Posts From <?php echo $firstName ?></h1>
            </div>
        </div>

        <!-- Right Side Posts -->
        <div id="posts">
            <script>printPosts(5)</script>
        </div>

    </div>
    <?php
    if(isset ($colour)) {
        if ($colour == 1) {
            echo '<script type="text/javascript">';
            echo  'changeBannerColour(1);';
            echo '</script>';
        }
        else if ($colour == 2) {
            echo '<script type="text/javascript">';
            echo  'changeBannerColour(2);';
            echo '</script>';
        }
        else if ($colour == 3) {
            echo '<script type="text/javascript">';
            echo  'changeBannerColour(3);';
            echo '</script>';
        }
        else if ($colour == 4) {
            echo '<script type="text/javascript">';
            echo  'changeBannerColour(4);';
            echo '</script>';
        }
        else if ($colour == 5) {
            echo '<script type="text/javascript">';
            echo  'changeBannerColour(5);';
            echo '</script>';
        }
    }

    ?>
</div>