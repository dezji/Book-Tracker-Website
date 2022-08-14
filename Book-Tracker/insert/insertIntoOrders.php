<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styleSheets/insertIntoOrders.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Montserrat:ital,wght@1,900&family=Racing+Sans+One&family=Raleway:wght@500&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="../icons/apple-touch-icon.png"> <!--Icon Courtesy of https://www.flaticon.com/free-icons/books" title="books icons">Books icons created by Freepik - Flaticon -->
    <link rel="icon" type="image/png" sizes="32x32" href="../icons/favicon-32x32.png"> <!--Icon Courtesy of https://www.flaticon.com/free-icons/books" title="books icons">Books icons created by Freepik - Flaticon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../icons/favicon-16x16.png"> <!--Icon Courtesy of https://www.flaticon.com/free-icons/books" title="books icons">Books icons created by Freepik - Flaticon -->
    <link rel="manifest" href="../icons/site.webmanifest"> <!--Icon Courtesy of https://www.flaticon.com/free-icons/books" title="books icons">Books icons created by Freepik - Flaticon -->
    <title>Insert An Order</title>
    <script>
        var dataValidation = function() {
            var isbn = document.forms["insert_form"]["isbn"].value;
            var cost = document.forms["insert_form"]["cost"].value;
            var date = document.forms["insert_form"]["date"].value;

            if (isbn.toString().length != 13) {
                alert("ISBN must be 13 numbers long.");
                return false;
            }
            else if (isNaN(isbn)) {
                alert("ISBN must be numeric.");
                return false;
            }
            else if (isNaN(cost)) {
                alert("Cost must be numeric.");
                return false;
            }
        };
    </script>
    <?php
        $sql = "SELECT ISBN FROM books;";
        $conn = new mysqli("localhost", "root", "", "BookInventory");

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    ?>
</head>
<body>
    
    <div class="main_container">
        <div id="welcome_banner">
            <h1>Insert An Order<h1>
        </div>
        <div id="content">
            <form id="insert_form" action="../additionalFiles/insert/insert_order.php" method="POST" onsubmit="return dataValidation()">
                <label for="isbn">ISBN:</label>
                <select name="isbn">
                    <?php
                        foreach($row as $row) {
                    ?>
                    <option><?php echo $row['ISBN'];?></option>
                    <?php
                        }
                    ?>
                </select>
                <br><br>
                <label for="cost">Cost:</label>
                <input class="userInput" type="text" id="cost" name="cost" placeholder="123.45" required>
                <br><br>
                <label for="date">Order Date:</label>
                <input class="userInput" type="date" id="date" name="date" required>
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