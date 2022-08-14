<?php

    $FirstName = $_POST["firstName"];
    $LastName = $_POST["lastName"];
    $PublisherID = $_POST["publisherID"];
    $FullName = $FirstName . ' ' . $LastName;

    // connect to the database
    $conn = new mysqli("localhost", "root", "", "BookInventory");

    // checking for a publisher ID
    if ($PublisherID != NULL) {

        // checks to see if the publisher id exists in the table, if not, an error message is shown
        $foreignKeyCheck = "SELECT * FROM publishers
        WHERE Publisher_ID = $PublisherID;";
        $foreignQuery = mysqli_query($conn, $foreignKeyCheck);

        // this is the foreign key error message
        if (mysqli_num_rows($foreignQuery) <= 0) {
            echo '<script type="text/javascript">';
            echo ' alert("The Publisher ID is invalid, or the Publisher ID doesn\'t exist in the Publishers table.")';
            echo '</script>';
        }
        // if all is good, the statement will run just fine
        else {
            $sql = "INSERT INTO authors (First_Name, Last_Name, Full_Name, Publisher_ID)
                    VALUES ('$FirstName', '$LastName', '$FullName', $PublisherID);";
            mysqli_query($conn, $sql);
            header("Location: ../../success.html");
        }
    }
    // if there is not a publisher ID, the statement will run without any additional checks
    else {
        $sql = "INSERT INTO authors (First_Name, Last_Name, Full_Name)
                VALUES ('$FirstName', '$LastName', '$FullName');";
        mysqli_query($conn, $sql);
        header("Location: ../../success.html");
    }

?>

<!-- This is the error redirection page for the user -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Error</title>
</head>
<body>
    <h1><a href="../../insert/insertIntoAuthors.html">Click here to go back</a></h1>
</body>
</html>