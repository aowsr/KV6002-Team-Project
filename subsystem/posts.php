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
        #content {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #content td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #content tr:nth-child(even){background-color: #f2f2f2;}

        #content tr:hover {background-color: #ddd;}

        #content th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
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
            //$creator = $row['post_creator'];
            //$time = $row['post_date'];
            $content = $row['post_content'];

            if (isset ($id, $content)){
                $posts .= $id . $content . '<br>' . '</a>';
            }
            else{
                $posts = "No ID Found";
            }

        }
        //echo $posts;
        echo "<table id='content'>
              <tr>
              <th>ID:</th>
              <th>Creator:</th>
              <th>content:</th>
              </tr>
              <tr>
              <td>$id</td>
              <td>CREATOR</td>
              <td>$content</td>
              </tr>
              </table> ";
    } else {
        echo "<p>There are no posts available yet</p>";
    }
}
?>

</body>
</html>