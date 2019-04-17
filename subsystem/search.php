<?php
session_start();
// Include config file
require_once "default/connect.php";
$output ='';
// Run if searchVal from InstantSearch is set
if(isset($_POST['searchVal'])) {

    $searchQ = $_POST['searchVal'];
    //Setting what symbols can be used for the search
    $searchQ = preg_replace("#[^0-9a-z]#i", "", $searchQ);

    // Prepare statement
    $qurey = "SELECT * FROM users WHERE firstname like '%$searchQ%' OR surname like '%$searchQ%' OR username like '%$searchQ%' ";

    if ($stmt = $pdo->prepare($qurey)) {

        // Execute prepared statement
        if ($stmt->execute()) {

            // If no results are found
            if ($stmt->rowCount() == 0) {
                $output = "No results Found!";
            }

            else{
                // Print out list
                $output = '<ul ="dropdown">';
                // Increment through rows and add all returned results to list
                while ($row = $stmt->fetch()){
                    $fname = $row['firstname'];
                    $lname = $row['surname'];
                    $_SESSION["firstnameSearch"] = $row['firstname'];
                    $_SESSION["surnameSearch"] = $row['surname'];
                    $username = $row['username'];

                    $_SESSION['searchID'] = $row['id'];

                    $searchID = $row['id'];

                    // Prepare the output, including setting the id to be sent to the profile page
                    $output .= '<a class="searchResult" href="otherUserViewProfile.php?id='.$searchID.'"><li> '.$username.' '.$fname.' '.$lname.'</li></a>';

                }
                $output .= '</ul>';
            }
        }
    }
}
echo($output);

?>