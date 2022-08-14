<?php

    $Name = $_POST["name"];
    $Phone = $_POST["phone"];
    $State = $_POST["state"];

    // connect to the database
    $conn = new mysqli("localhost", "root", "", "BookInventory");


    $sql = "INSERT INTO publishers (Name, Phone, State)
            VALUES ('$Name', $Phone, '$State');";

    mysqli_query($conn, $sql);

    header("Location: ../../success.html");

?>
