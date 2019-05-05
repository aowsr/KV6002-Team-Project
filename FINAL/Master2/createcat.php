<?php
session_start();
// Include config file
require_once "connect.php";

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

// Define variables
$categories = $categories_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // if for posting of categories
    if (empty(trim($_POST["categories"]))) {
        $categories_err = "Please enter a category title";
    } else {
        $categories = trim($_POST["categories"]);
    }

    // Check categories errors before inserting in database
    if (empty($categories_err)) {
        // Prepare an insert statement for inserting into category on the database
        $sql = "INSERT INTO categories (category_title) VALUES (:categories)";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables
            $stmt->bindParam(":categories", $param_categories, PDO::PARAM_STR);

            //parameters
            $param_categories = $categories;

            // executing all of the code
            if ($stmt->execute()) {
                header("location: Index.php");
            }
        } else {
            //if something has went wrong
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
    <!--nav bar-->
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
                    <a class="nav-link active" href="categories.php">Forum</a>
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
<?php
//if the user type is comitee will allow to create a cat
if (($_SESSION["userType"] !== 'Committee Member')) {
    ?>

    <div class="jumbotron jumbotron-fluid">
        <h1 class="display-4 text-center">Upgrade Today!</h1>
        <hr class="my-4">
        <p class="lead text-center">This feature is only for our Committee Members.</p>
    </div>
    <?php
} else {
    ?>

    <div class="container mt-4 d-flex justify-content-center">
        <div class="wrapper">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <div class="form-group <?php echo (!empty($categories_err)) ? 'has-error' : ''; ?>">
                    <label>Create a new category:</label>
                    <input type="text" name="categories" class="form-control" value="<?php echo $categories; ?>">
                    <span class="help-block"><?php echo $categories_err; ?></span>
                </div>
                <!--code for buttons when posting -->
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a class="btn btn-dark" href="Index.php">Cancel</a>
                </div>

            </form>
        </div>
    </div>
    <?php
}
?>
</body>
<footer class="container mt-8">
    <br/>
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>&copy; 2018-2019 Northumbria University &middot; Final Year Group Project</p>
</footer>
</html>