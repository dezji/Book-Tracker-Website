<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styleSheets/viewRecords.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Montserrat:ital,wght@1,900&family=Racing+Sans+One&family=Raleway:wght@500&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="../../icons/apple-touch-icon.png"> <!--Icon Courtesy of https://www.flaticon.com/free-icons/books" title="books icons">Books icons created by Freepik - Flaticon -->
    <link rel="icon" type="image/png" sizes="32x32" href="../../icons/favicon-32x32.png"> <!--Icon Courtesy of https://www.flaticon.com/free-icons/books" title="books icons">Books icons created by Freepik - Flaticon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../icons/favicon-16x16.png"> <!--Icon Courtesy of https://www.flaticon.com/free-icons/books" title="books icons">Books icons created by Freepik - Flaticon -->
    <link rel="manifest" href="../../icons/site.webmanifest"> <!--Icon Courtesy of https://www.flaticon.com/free-icons/books" title="books icons">Books icons created by Freepik - Flaticon -->
    <title>View Authors</title>
</head>
<body>
    <div class="main_container">
        <div id="welcome_banner">
            <h1>View Authors</h1>
        </div>
        <div id="content">
            <style>
                <?php include "../../styleSheets.viewRecords.css" ?>
            </style>
            <?php
                // connect to the database
                $conn = new mysqli("localhost", "root", "", "BookInventory");

                // get the query from the table
                $sql = "SELECT * FROM authors
                        ORDER BY Author_ID;";
                $result = mysqli_query($conn, $sql);

                // iterates through the table and displays the results onto the webpage
                if (mysqli_num_rows($result) > 0) {
                    echo "<table><tr>
                    <th>Author ID</th>
                    <th>First Name</th> 
                    <th>Last Name</th>
                    <th>Full Name</th>
                    <th>Publisher ID</th>
                    </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>" . $row["Author_ID"] .  "</td><td>" . $row["First_Name"] . 
                        "</td><td>" . $row["Last_Name"] . "</td><td>" . $row["Full_Name"] . "</td><td>" 
                        .  $row["Publisher_ID"] . "</td></tr>";
                    }
                    echo "</table>";
                }
                // if no data exists, this message is displayed
                else {
                    echo "<h3 id=\"emptyTable\">There is currenly no data in the table</h3>";
                }
            ?>
        </div> <!-- end of content -->
        <div id="goBack">
            <button id="goBackButton" onclick="window.location.href='../../view/view.html'">Go Back</button>
        </div>
    </div> <!-- end of main_container -->
</body>
</html>