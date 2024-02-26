<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <link rel="stylesheet" href="Appointment.css">
</head>

<body>
    <div class="container">
        <div class="h2">
            <p>Appointment</p>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="search-container">
                <input type="text" id="searchInput" name="city" placeholder="Search City name...">
                <div class="suggestions" id="suggestions"></div>
                <button class="button" type="submit">Select</button>
            </div>
        </form>
    </div>
    <?php

    session_start();
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "city";

    // Create connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the selected city from the form
        $selectedCity = $_POST['city'];
        $table_name = $selectedCity . "_table";
        // Prepare and execute a query to fetch data from your database based on the selected city
        $query = "SELECT address,name FROM $table_name WHERE city = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$selectedCity]);

        // Fetch all the results
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);


        // Check if results are found
        if ($results) {
            echo"<h2>Hospilat in $selectedCity:</h2>";
            echo "<div class='card'>";
            // Output the address and hospital name for each result
            foreach ($results as $result) {
                $address = $result['address'];
                $hospitalName = $result['name'];
                echo"<form action='action.php' method='post'>";
                echo "<input type='hidden' name='city' value='$selectedCity' />";
                echo "<div class='hospital'>";
                echo "<input type='hidden' name='hos' value='$hospitalName' />";
                echo "<input type='hidden' name='addr' value='$address' />";
                echo "<p name='hos'>$hospitalName</p>";
                echo "<p name='addr'>$address</p>";
                echo "<input type='submit' value='Appoint' />";
                echo "</div>";
                echo "</form>";
            }
            echo "</div>";
          
        } else {
            // Handle case where no results are found
            echo "No data found for the selected city.";
        }
    }
    ?>
<script src="script.js"></script>
</body>

</html>