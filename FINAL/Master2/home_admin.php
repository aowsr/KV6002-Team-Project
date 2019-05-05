<?php
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

//check if the user is actually an admin
if (($_SESSION["userType"] !== 'Admin')) {
    header("location: Index.php");
    exit;
}

//condition if the user is suspended
if ($_SESSION["suspension"] == true) {
    header("location: suspensionPage.php");
    exit;
}

// require the class definition file
require_once('default/setPath.php');
require_once('default/errorFunctions.php');
require_once('default/connect.php');

//sql statment to load all users
$sql = 'SELECT * FROM users ORDER BY userType ASC, surname ASC;';
$statement = $pdo->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Admin Site</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<!-- Navabr -->
<header>
    <nav class="navbar navbar-expand-md bg-light navbar-light sticky-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav pull-right mr-auto">
                <a class="navbar-brand" href="Index.php">TravelSite - Admin</a>
            </ul>
            <ul class="navbar-nav ml-auto">

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="passwordReset.php">Reset Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="do_logout.php">Sign Out</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="#"><?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- table to display all users and their details -->
<body>
<div class="container">
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-center">
            <h2>All Users</h2>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>Username</th>
                    <th>Firstname</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Account Type</th>
                    <th>Suspended</th>
                    <th>Action</th>
                    <th>Suspend</th>
                </tr>
                <?php foreach ($people as $person): ?>
                    <tr>
                        <td><?= $person->username; ?></td>
                        <td><?= $person->firstname; ?></td>
                        <td><?= $person->surname; ?></td>
                        <td><?= $person->email; ?></td>
                        <td><?= $person->userType; ?></td>
                        <td><?= $person->suspension; ?></td>
                        <td>
                            <!-- two buttons, edit or delete user -->
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="editUsers.php?id=<?= $person->id ?>" class="btn btn-info">Edit</a>
                                <a onclick="return confirm('Are you sure you want to delete this user?')"
                                   href="deleteUsers.php?id=<?= $person->id ?>" class='btn btn-danger'>Delete</a>
                            </div>
                        </td>
                        <td>
                            <!-- suspend button for admin to apply on specifc users -->
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a onclick="return confirm('Are you sure you want to suspend this user?')"
                                   href="suspendUser.php?id=<?= $person->id ?>" class='btn btn-info'>Yes</a>
                                <a onclick="return confirm('Are you sure you want to unsuspend this user?')"
                                   href="unsuspendUser.php?id=<?= $person->id ?>" class='btn btn-secondary'>No</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
</body>
<!-- FOOTER -->
<footer class="container mt-8">
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>&copy; 2018-2019 Northumbria University &middot; Final Year Group Project</p>
</footer>
</html>