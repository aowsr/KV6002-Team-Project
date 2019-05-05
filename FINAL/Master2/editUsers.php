<?php
session_start();

// require the class definition file
require_once('default/setPath.php');
require_once('default/errorFunctions.php');
require_once('default/connect.php');

//get specific user id
$id = $_GET['id'];
$sql = 'SELECT * FROM users WHERE id=:id';
$statement = $pdo->prepare($sql);
$statement->execute([':id' => $id]);
//fetch all data of that specific user
$person = $statement->fetch(PDO::FETCH_OBJ);
//if statment to make sure every is set, validation
if (isset ($_POST['username']) && isset($_POST['firstname']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['userType'])) {
    //if anything is edited it is stored
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $userType = $_POST['userType'];
    //sql statment to update users details then redirect back to admin page
    $sql = 'UPDATE users SET username=:username, firstname=:firstname, surname=:surname ,email=:email, userType=:userType WHERE id=:id';
    $statement = $pdo->prepare($sql);
    if ($statement->execute([':username' => $username, ':firstname' => $firstname, ':surname' => $surname, ':email' => $email, ':userType' => $userType, ':id' => $id])) {
        header("Location: home_admin.php");
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

</head>
<!-- form to edit users details -->
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Update person</h2>
        </div>
        <div class="card-body">
            <?php if (!empty($message)): ?>
                <div class="alert alert-success">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
            <form method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input value="<?= $person->username; ?>" type="text" name="username" id="username"
                           class="form-control">
                </div>
                <div class="form-group">
                    <label for="firstname">Firstname</label>
                    <input value="<?= $person->firstname; ?>" type="text" name="firstname" id="firstname"
                           class="form-control">
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input value="<?= $person->surname; ?>" type="text" name="surname" id="surname"
                           class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" value="<?= $person->email; ?>" name="email" id="email" class="form-control">
                </div>
                <!-- Allows users to become admin or committee memeber -->
                <div class="form-group">
                    <label for="userType">User Type</label>
                    <select value="<?= $person->userType; ?>" name="userType" id="userType" class="form-control">
                        <option value="Member">Member</option>
                        <option value="Committee Member">Committee Member</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary">Update</button>
                    <a class="btn btn-dark" href="welcome.php">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
</html>