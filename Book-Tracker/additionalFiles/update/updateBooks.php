<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styleSheets/insertIntoBooks.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Montserrat:ital,wght@1,900&family=Racing+Sans+One&family=Raleway:wght@500&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="../icons/apple-touch-icon.png"> <!--Icon Courtesy of https://www.flaticon.com/free-icons/books" title="books icons">Books icons created by Freepik - Flaticon -->
    <link rel="icon" type="image/png" sizes="32x32" href="../icons/favicon-32x32.png"> <!--Icon Courtesy of https://www.flaticon.com/free-icons/books" title="books icons">Books icons created by Freepik - Flaticon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../icons/favicon-16x16.png"> <!--Icon Courtesy of https://www.flaticon.com/free-icons/books" title="books icons">Books icons created by Freepik - Flaticon -->
    <link rel="manifest" href="../icons/site.webmanifest"> <!--Icon Courtesy of https://www.flaticon.com/free-icons/books" title="books icons">Books icons created by Freepik - Flaticon -->
    <title>Update A Book</title>
    <script>
        var dataValidation = function() {
            var isbn = document.forms["insert_form"]["isbn"].value;
            var title = document.forms["insert_form"]["title"].value;
            var authorID = document.forms["insert_form"]["authorID"].value;

            if (isbn != NULL && isbn.toString().length != 13) {
                alert("ISBN must be 13 numbers long.");
                return false;
            }
            else if (isNaN(isbn)) {
                alert("ISBN must be numeric.");
                return false;
            }
            else if (title.length > 35) {
                alert("The title cannot exceed 35 charaters.");
                return false;
            }   
            else if (title.length < 3) {
                alert("The title must be at least 3 characters long.");
                return false;
            }
            else if (authorID > 199 || authorID < 100 || isNaN(authorID)) {
                alert("Please enter a valid 3 digit Author ID.\nRefer to the Authors table for a list of valid IDs.");
                return false;
            }
        };
    </script>
</head>
<body>
    <?php
        $sql = "SELECT ISBN FROM books;";
        $conn = new mysqli("localhost", "root", "", "BookInventory");

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $ISBN = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        $authorINFO = "SELECT Author_ID, Full_Name FROM authors;";
        $conn = new mysqli("localhost", "root", "", "BookInventory");

        $result2 = mysqli_query($conn, $authorINFO);

        if (mysqli_num_rows($result2) > 0) {
            $row = mysqli_fetch_all($result2, MYSQLI_ASSOC);
        }

        $currentISBN = $_GET['ISBN'];
    ?>

    <div class="main_container">
        <div id="welcome_banner">
            <h1>Update A Book<h1>
        </div>
        <div id="content">
            <form id="insert_form" name="insert_form" action="../update/updateProcess.php" method="POST" onsubmit="return dataValidation()">
                <label for="isbn">IBSN:</label>
                <select name="ISBN">
                    <option><?php echo $currentISBN;?></option>
                </select>
                <br><br>
                <label for="title">Title:</label>
                <input class="userInput" type="text" id="title" name="title" placeholder="Title here...">
                <br><br>
                <label for="authorID">Author ID:</label>
                <select name="authorID">
                    <?php
                        foreach($row as $row) {
                    ?>
                    <option><?php echo $row['Author_ID'];?></option>
                    <?php
                        }
                    ?>
                </select>
                <br><br>
                <button id="insert_submit" type="submit" name="submit">Submit</button>
            </form> <!-- end of insert_form -->
        </div>
        <div id="goBack">
            <button id="goBackButton" onclick="window.location.href='../view/viewBooks.php'">Go Back</button>
        </div>
    </div> <!-- end of main_container -->
</body>
</html>