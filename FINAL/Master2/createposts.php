<?php
// Include config file
require_once "connect.php";
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
//if the user is a admin account
if (($_SESSION["userType"] == 'Admin')) {
    header("location: home_admin.php");
    exit;
}

if ($_SESSION["suspension"] == true) {
    header("location: suspensionPage.php");
    exit;
}


//declaring content, user id
$content = $content_err = $user_id = "";
$catType_err = $catType = "";

// Processing form data when form is posted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // if the content is enter will make the user put some in
    if (empty(trim($_POST["content"]))) {
        $content_err = "Please enter some content.";
    } else {
        $content = trim($_POST["content"]);
    }

    // Validate cattype
    if (empty(trim($_POST["catType"]))) {
        $catType_err = "Please choose a option.";
    } else {
        $catType = trim($_POST["catType"]);
    }


    //error handling
    if (empty($content_err) && isset($_SESSION["id"])) {


        // inserting into posts
        $sql = "INSERT INTO posts (post_content, post_creator, category_id) VALUES (:content, :id, :catID)";

        if ($stmt = $pdo->prepare($sql)) {

            $user_id = $_SESSION["id"];

            // Bind variables
            $stmt->bindParam(":content", $param_content, PDO::PARAM_STR);
            $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);
            $stmt->bindParam(":catID", $param_catID, PDO::PARAM_STR);

            // Set parameters
            $param_content = $content;
            $param_id = $user_id;
            $param_catID = $catType;

            // executing the statement
            if ($stmt->execute()) {
                header("location: Index.php");
            }
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }
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

</head>

<header>
    <!--navbar code-->
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
                    <a class="nav-link" href="categories.php">Forum</a>
                </li>
                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Events
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="nav-link" href="createEvent.php">Create Event</a>
                        <div class="dropdown-divider"></div>
                        <a class="nav-link" href="chooseEvent.php">Edit Events</a>
                    </div>
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

<style type="text/css">
    body {
        font: 14px sans-serif;
    }

    .wrapper {
        width: 350px;
        padding: 20px;
    }
</style>

<body>
<div class="container mt-4 d-flex justify-content-center">
    <div class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <!--categories choices-->
            <div class="form-group <?php echo (!empty($catType_err)) ? 'has-error' : ''; ?>">
                <label for="catType">Categories</label>
                <select name="catType" id="catType" class="form-control">
                    <option value="">Choose...</option>
                    <option value="1">Best things to do in Amsterdam</option>
                    <option value="2">Best cities in the world</option>
                    <option value="3">Best cities in europe</option>
                    <option value="4">Best scenic view you have seen</option>
                    <option value="5">Best wonders of the world</option>
                </select>
                <span class="help-block"><?php echo $catType_err; ?></span>
            </div>
            <!--form for submitting the form-->
            <div class="form-group <?php echo (!empty($content_err)) ? 'has-error' : ''; ?>">
                <label>Please enter in your response</label>
                <input type="text" name="content" class="form-control" value="<?php echo $content; ?>">
                <span class="help-block"><?php echo $content_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-dark" href="Index.php">Cancel</a>
            </div>

        </form>
    </div>
</div>
</body>
<footer class="container mt-8">
    <br/>
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>&copy; 2018-2019 Northumbria University &middot; Final Year Group Project</p>
</footer>
</html>