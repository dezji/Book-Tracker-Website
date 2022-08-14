<?php

    $ISBN = $_POST["isbn"];
    $Cost = floatval($_POST["cost"]);
    $Date = $_POST["date"];
  
    $formatDate = date_create($Date);
    $Date = date_format(new DateTime($Date), 'Y-m-d');
    

    // connect to the database
    $conn = new mysqli("localhost", "root", "", "BookInventory");


    $sql = "INSERT INTO orders (ISBN, Cost, Order_Date)
            VALUES ($ISBN, $Cost, '$Date');";

    $OnOrder = "UPDATE books, orders
    SET books.On_Order = true 
    WHERE orders.ISBN = books.ISBN;";
    
    // checks to see if the isbn exists in the table, if not, an error message is shown
    $foreignKeyCheck = "SELECT * FROM books
    WHERE ISBN = $ISBN;";
    $foreignQuery = mysqli_query($conn, $foreignKeyCheck);

    // checks for duplicates in the table, if there is at least one, an error message is shown
    $checkForDupe = "SELECT * FROM orders
    WHERE ISBN = $ISBN;";
    $duplicate = mysqli_query($conn, $checkForDupe);

    // this statement is the duplicate error message
    if (mysqli_num_rows($duplicate) > 0) {
        echo '<script type="text/javascript">';
        echo ' alert("An order has already been placed for this book.")';
        echo '</script>';
    }
    // this is the foreign key error message
    else if (mysqli_num_rows($foreignQuery) <= 0) {
        echo '<script type="text/javascript">';
        echo ' alert("The ISBN is invalid, or the ISBN doesn\'t exist in the Books table.")';
        echo '</script>';
    }
    // if all is good, the statement will run just fine
    else {
        mysqli_query($conn, $sql);
        mysqli_query($conn, $OnOrder);
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
    <h1><a href="../../insert/insertIntoOrders.html">Click here to go back</a></h1>
</body>
</html>