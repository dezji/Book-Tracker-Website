<?php

    $ISBN = $_POST["isbn"];
    $title = $_POST["title"];
    $authorID = $_POST["authorID"];

    // connect to the database
    $conn = new mysqli("localhost", "root", "", "BookInventory");

    $sql = "INSERT INTO books (ISBN, Title, Author_ID)
    VALUES ($ISBN, \"$title\", $authorID);";
    
    // checks to see if the author id exists in the table, if not, an error message is shown
    $foreignKeyCheck = "SELECT * FROM authors
    WHERE Author_ID = $authorID;";
    $foreignQuery = mysqli_query($conn, $foreignKeyCheck);

    // checks for duplicates in the table, if there is at least one, an error message is shown
    $checkForDupe = "SELECT * FROM books
    WHERE ISBN = $ISBN;";
    $duplicate = mysqli_query($conn, $checkForDupe);

    // this statement is the duplicate error message
    if (mysqli_num_rows($duplicate) > 0) {
        echo '<script type="text/javascript">';
        echo ' alert("This ISBN already exists in the table.")';
        echo '</script>';
    }
    // this is the foreign key error message
    else if (mysqli_num_rows($foreignQuery) <= 0) {
        echo '<script type="text/javascript">';
        echo ' alert("The Author ID is invalid, or the Author ID doesn\'t exist in the Authors table.")';
        echo '</script>';
    }
    // if all is good, the statement will run just fine
    else {
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
    <h1><a href="../../insert/insertIntoBooks.html">Click here to go back</a></h1>
</body>
</html>