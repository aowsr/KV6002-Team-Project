<?php
session_start();
// Include config file
require_once('default/connect.php');

// Set session search variables to be empty when returning to this page
$_SESSION["ageSearch"] = '';
$_SESSION["nationalitySearch"] = '';
$_SESSION["favouriteSearch"] = '';
$_SESSION["aboutSearch"] = '';
$_SESSION["imgPathSearch"] = '';

if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false) {
    header("location: welcome.php");
    exit;
}

if (($_SESSION["userType"] == 'Admin')) {
    header("location: home_admin.php");
    exit;
}

if ($_SESSION["suspension"] == true) {
    header("location: suspensionPage.php");
    exit;
}


// If Text has been entered into the search box and the search button is clicked
if (isset($_POST['submit']) && isset($_POST['search'])) {

    //Send search to next page
    $_SESSION['searchQurey'] = $_POST['search'];
    header("location:searchResults.php");
}


// If Text has been entered into the search box and the search button is clicked
if (isset($_POST['submit']) && isset($_POST['search'])) {

    //Send search to next page
    $_SESSION['searchQurey'] = $_POST['search'];
    header("location:searchResults.php");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src=js/instantSearch.js></script>
    <link rel="stylesheet" href="search.css">

</head>
<body>

<header>
    <nav class="navbar navbar-expand-md bg-light navbar-light sticky-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav pull-right mr-auto">
                <a class="navbar-brand" href="Index.php">TravelSite</a>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Forum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Create Event</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="emailAll.php">Message All</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="passwordReset.php">Reset Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="do_logout.php">Sign Out</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="profilePage.php"><?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main role="main">

        <br/>
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <form class="card card-sm" action="" method="POST">
                    <div class="card-body row no-gutters align-items-center">

                        <div class="col">
                            <input class="form-control form-control-lg form-control-borderless"
                                   name="search" type="search" placeholder="Search for next adventure"
                                   onkeyup="searchq();">
                        </div>
                        <!--end of col-->
                        <div class="col-auto">
                            <button class="btn btn-lg btn-light" type="submit"><i class="fa fa-search"></i>Search
                            </button>
                        </div>
                        <!--end of col-->
                    </div>
                    <div id="output"></div>
                </form>
            </div>
            <!--end of col-->
        </div>
        <br/>

<div class="container">

</div>

</main>
</body>
<footer class="container mt-8">
    <br/>
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>&copy; 2018-2019 Northumbria University. &middot; Final Year Group Project</p>
</footer>
</html>
