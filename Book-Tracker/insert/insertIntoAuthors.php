<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styleSheets/insertIntoAuthors.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Montserrat:ital,wght@1,900&family=Racing+Sans+One&family=Raleway:wght@500&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="../icons/apple-touch-icon.png"> <!--Icon Courtesy of https://www.flaticon.com/free-icons/books" title="books icons">Books icons created by Freepik - Flaticon -->
    <link rel="icon" type="image/png" sizes="32x32" href="../icons/favicon-32x32.png"> <!--Icon Courtesy of https://www.flaticon.com/free-icons/books" title="books icons">Books icons created by Freepik - Flaticon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../icons/favicon-16x16.png"> <!--Icon Courtesy of https://www.flaticon.com/free-icons/books" title="books icons">Books icons created by Freepik - Flaticon -->
    <link rel="manifest" href="../icons/site.webmanifest"> <!--Icon Courtesy of https://www.flaticon.com/free-icons/books" title="books icons">Books icons created by Freepik - Flaticon -->
    <title>Insert An Author</title>

    <script>
        var dataValidation = function() {
            var firstName = document.forms["insert_form"]["firstName"].value;
            var lastName = document.forms["insert_form"]["lastName"].value;

            if (firstName.length > 25) {
                alert("The first name cannot exceed 25 charaters.");
                return false;
            }   
            else if (firstName.length < 3) {
                alert("The first name must be at least 3 characters long.");
                return false;
            }
            else if (lastName.length > 25) {
                alert("The last name cannot exceed 25 charaters.");
                return false;
            }   
            else if (lastName.length < 3) {
                alert("The last name must be at least 3 characters long.");
                return false;
            }
        };
    </script>
</head>
<body>
    <?php
        $sql = "SELECT Publisher_ID, Name FROM publishers;";
        $conn = new mysqli("localhost", "root", "", "BookInventory");

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    ?>
    <div class="main_container">
        <div id="welcome_banner">
            <h1>Insert An Author<h1>
        </div>
        <div id="content">
            <form id="insert_form" action="../additionalFiles/insert/insert_author.php" method="POST" onsubmit="return dataValidation()">
                <label for="firstName">First Name:</label>
                <input class="userInput" type="text" id="firstName" name="firstName" placeholder="First name...">
                <br><br>
                <label for="lastName">Last Name:</label>
                <input class="userInput" type="text" id="lastName" name="lastName" placeholder="Last name...">
                <br><br>
                <label for="publisherID">Publisher ID:</label>
                <select name="publisherID">
                    <option></option>
                    <?php
                        foreach($row as $row) {
                    ?>
                    <option><?php echo $row['Publisher_ID']?></option>
                    <?php
                        }
                    ?>
                </select>
                <br><br>
                <button id="insert_submit" type="submit" name="submit">Submit</button>
            </form> <!-- end of insert_form -->
        </div>
        <div id="goBack">
            <button id="goBackButton" onclick="window.location.href='insert.html'">Go Back</button>
        </div>
    </div> <!-- end of main_container -->
</body>
</html>