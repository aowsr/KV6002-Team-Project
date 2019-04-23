<!<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
        .cat_links{
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
<a href="createcat.php">Create a new category</a>
</div>
<?php

session_start();

//require_once("connect.php");
/*$con = mysqli_connect('localhost','unn_w16028251','Montybriah3');
$sql = "SELECT * FROM categories ORDER BY category_title ASC";
$res = mysqli_query($con, $sql) or die (mysqli_error($con));
$categories = "";
if (mysqli_num_rows($res) > 0){
    while ($row = mysqli_fetch_assoc($res)){
        $id = $row['id'];
        $title = $row['category_title'];
        $description = $row['category_description'];
        $categories = "<a href '#' class='cat_links'>".$title." ".$description."</a>";
    }
    echo $categories;
}
else {
    echo "<p>There are no categories available yet</p>";
}

*/

$categories = $id = $title = "";

require_once "connect.php";

$sql = "SELECT * FROM categories ORDER BY category_title ASC";
$statement = $pdo->prepare($sql);
// Attempt to execute the prepared statement
if($statement->execute()) {
// Check if username exists, if yes then verify password
    if ($statement->rowCount() > 0) {
        if ($row = $statement->fetch()) {
            $id = $row['id'];
            $title = $row['category_title'];

            if (isset ($id)){
                $categories .= '<a href="posts.php?id='.$id.'" class="cat_links">'. $id .'  |     ' . $title . '<br>' . '</a>';
            }
            else{
                $categories = "No ID Found";
            }

        }
        echo $categories;
    } else {
        echo "<p>There are no categories available yet</p>";
    }
}
?>



<?php echo $categories ?>
</body>
</html>