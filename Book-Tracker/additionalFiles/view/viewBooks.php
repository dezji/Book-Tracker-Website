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
    <title>View Books</title>
    <script>
        var deleteConfirm = function() {
            return confirm('Are you sure you want to delete this record?');
        }
    </script>
    <?php
        if(isset($_GET['ISBN'])) {
            $ISBN = $_GET['ISBN'];

            $conn = new mysqli("localhost", "root", "", "BookInventory");
            $deleteSQL = "DELETE FROM books WHERE books.ISBN = $ISBN;";

            mysqli_query($conn, $deleteSQL);

        }
    ?>
</head>
<body>
    <div class="main_container">
        <div id="welcome_banner">
            <h1>View Books</h1>
        </div>
        <div id="content">
        <style>
            <?php include "../../styleSheets.viewRecords.css" ?>
        </style>
            <?php
                // connect to the database
                $conn = new mysqli("localhost", "root", "", "BookInventory");

                // get the query from the table
                $sql = "SELECT b.ISBN, b.Title, b.Author_ID, a.Publisher_ID, b.On_Order,
                                a.Full_Name
                        FROM books b, authors a
                        WHERE b.Author_ID = a.Author_ID
                        ORDER BY a.First_Name, a.Last_Name, b.Title, b.Author_ID;";
                $result = mysqli_query($conn, $sql);
                $OnOrder = "No";

                // iterates through the table and displays the results onto the webpage
                if (mysqli_num_rows($result) > 0) {
                    echo "<table id=\"table\"><tr>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Author Name</th>
                    <th>Author ID</th>
                    <th>Publisher ID</th>
                    <th>On Order</th>
                    </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        // does a check for the on order to equal yes or no
                        if ($row["On_Order"] == 0) {
                            $OnOrder = "No";
                        }
                        else {
                            $OnOrder = "Yes";
                        }
                        echo "<tr><td>" . $row["ISBN"] . "</td><td>" 
                        . $row["Title"] . "</td><td>" . $row["Full_Name"] . "</td><td>". $row["Author_ID"] . "</td><td>" 
                        . $row["Publisher_ID"] . "</td><td>" . $OnOrder .
                        "</td><td><a href='..\\update\\updateBooks.php?ISBN=".$row['ISBN']."' id='updateButton'>Update</a></td>
                        <td><a href='..\\view\\viewBooks.php?ISBN=".$row['ISBN']."' id='deleteButton' onclick='return deleteConfirm()'>Delete</a>"
                        . "</td></tr>";
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