<!<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
        .table{
            display: block;
            padding: 5px;
            padding-top:10px;
            padding-bottom:10px;
            border: 1px solid white;
            margin-bottom: 5px;
            background-color: royalblue;
            color: #000000;
        }

        .cat_links:hover{
            background-color: #dddddd;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <a href="createposts.php">Create a new posts</a>
</div>
<?php

session_start();

$posts = $id = $content = "";

require_once "connect.php";

$sql = "SELECT * FROM posts ORDER BY post_content ASC";
$statement = $pdo->prepare($sql);
// Attempt to execute the prepared statement
if($statement->execute()) {
// Check if username exists, if yes then verify password
    if ($statement->rowCount() > 0) {
        if ($row = $statement->fetch()) {
            $id = $row['id'];
            $content = $row['post_content'];

            if (isset ($id, $content)){
                $posts .= $id . $content .'<"class=table">'. '<br>' . '</a>';
            }
            else{
                $posts = "No ID Found";
            }

        }
        echo $posts;
    } else {
        echo "<p>There are no posts available yet</p>";
    }
}
?>



<?php echo $posts ?>
</body>
</html>