<?php
// Include config file
require_once "connect.php";
session_start();

// Define variables and initialize with empty values
$content = $content_err  = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate firstname
    if(empty(trim($_POST["content"]))){
        $content_err = "Please enter some content.";
    } else{
        $content = trim($_POST["content"]);
    }

    // Check input errors before inserting in database
    if(empty($content_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO posts (post_content) VALUES (:content)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":content", $param_content, PDO::PARAM_STR);

            // Set parameters
            $param_content = $content;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                echo "wooooooooo.";
               // header("location: Index.php");
                }
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<div class="wrapper">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div class="form-group <?php echo (!empty($content_err)) ? 'has-error' : ''; ?>">
            <label>Please enter in your response</label>
            <input type="text" name="content" class="form-control" value="<?php echo $content; ?>">
            <span class="help-block"><?php echo $content_err; ?></span>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>

    </form>
</div>
</body>
</html>