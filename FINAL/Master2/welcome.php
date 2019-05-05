<?php
session_start();
// Include config file

require_once('default/connect.php');
// Set session search variables to be empty when returning to this page

//if the user is logged in to be redirected to home page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: Index.php");
    exit;
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Travel Site</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <!--     <link href="travel.css" rel="stylesheet"> -->
</head>
<!-- Navabr -->
<header>
    <nav class="navbar navbar-expand-md bg-light navbar-light fixed-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav pull-right mr-auto">
                <a class="navbar-brand" href="#">TravelSite</a>
            </ul>
            <ul class="navbar-nav pull-right ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<body>

<main role="main">

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="first-slide" src="Media/beach-benches-bridge-2091018.jpg"
                     style='max-width: 100%; max-height: 100%;' alt="First slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h2>Not a member?</h2>
                        <p><a class="btn btn-secondary" href="signup.php" role="button">Register Now &raquo;</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container marketing">

        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">Our Goal. <span class="text-muted">It'll Blow Your Mind.</span></h2>
                <p class="lead">Some moments are better shared, TravelSite connects like-minded travellers so that you can
                    share those moments with new friends. Post your travel adventure stories on the feed or ask other
                    travellers for tips and advice.</p>
            </div>
            <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto img-thumbnail"
                     src="Media/adventure-backpacker-blue-sky-1271619.jpg " alt="Generic placeholder image">
            </div>
        </div>


        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading">Travel. <span class="text-muted">Like Never Before.</span></h2>
                <p class="lead">Maybe you’re a backpacker, a solo traveller, a digital nomad or maybe you’re not even
                    travelling right now but would love to meet travellers nearby? It doesn’t matter what type of
                    traveller you are, on TravelSite you can create the community you want.</p>
            </div>
            <div class="col-md-5 order-md-1">
                <img class="featurette-image img-fluid mx-auto img-thumbnail"
                     src="Media/adventure-casual-cheerful-541518.jpg" alt="Generic placeholder image">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">Now. <span class="text-muted">It's Your Turn.</span></h2>
                <p class="lead">Sign-up today and discover for yourself
                what the craze is all about.</p>
            </div>
            <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto img-thumbnail"
                     src="Media/activity-adventure-blur-297642.jpg " alt="Generic placeholder image">
            </div>
        </div>

        <hr class="featurette-divider">

    </div><!-- /.container -->
</main>

<!-- FOOTER -->
<footer class="container mt-8">
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>&copy; 2018-2019 Northumbria University &middot; Final Year Group Project</p>
</footer>

</body>
</html>