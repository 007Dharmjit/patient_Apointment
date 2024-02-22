


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <link rel="stylesheet" href="Appointment.css">
    <style>
        .hospital {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="h2">
            <p>Appointment</p>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="search-container">
                <label for="city">Select City</label><br>
                <input type="text" id="searchInput" name="city" placeholder="Type to search...">
                <div class="suggestions" id="suggestions"></div>
                <button class="button" type="submit">Select</button>
            </div>
        </form>
    </div>
    <?php
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
        // Output the address and hospital name for each result
        foreach ($results as $result) {
            $address = $result['address'];
            $hospitalName = $result['name'];
            echo "<div class='hospital'>";
            echo "<p>Hospital Name: $hospitalName</p>";
            echo "<p>Address: $address</p>";
            echo "</div>";
        }
    } else {
        // Handle case where no results are found
        echo "No data found for the selected city.";
    }
}
?>

</body>
</html>