<?php
$servername = "localhost";
$username ="root";
$password ="";
$dbname = "city";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Get data from form
$city = $_POST['city'];
$name = $_POST['name'];
$address = $_POST['address'];

// Create table if it doesn't exist
$table_name = $city . "_table";
$sql = "CREATE TABLE IF NOT EXISTS $table_name (
id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
city VARCHAR(255) NOT NULL,
name VARCHAR(255) NOT NULL,
address VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === FALSE) {
  echo "Error creating table: " . $conn->error;
}

// Insert data into table
// Insert data into table
$stmt = $conn->prepare("INSERT INTO $table_name (city, name, address) VALUES (?, ?, ?)");
$stmt->bind_param( "sss", $city, $name, $address);

if ($stmt->execute()) {
    echo " created successfully";
} else {
    echo "Error: " . $stmt->error;
}
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital_Data</title>
    <link rel="stylesheet" href="login.css">
    <style>
        /* Style for the search container */
.search-container {
    position: relative;
    width: 300px;
}

/* Style for the search input */
#searchInput {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    background: #dde1e7;
    border-radius: 25px;
}

/* Style for the suggestion box */
.suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    width: fit-content;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
    display: none;
}

/* Style for individual suggestion items */
.suggestions-item {
    padding: 10px;
    cursor: pointer;
}

.suggestions-item:hover {
    background-color: #e0e0e0;
}
    </style>
</head>
<body>
    <h2>Select City</h2>
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Type to search...">
        <div class="suggestions" id="suggestions"></div>
        <button class="button" onclick="selectedcity()" >Select</button>
    </div>
<div class="center">
    <div class="content">
        <div class="text">
            Enter Hospital Data
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="field">
                <input required="" type="text" name="city" class="input" id="city" >
                <label class="label" id=""></label>
            </div>

            <div class="field">
                <input required="" type="text" name="name" class="input" id="name" >
                <label class="label">Hospital Name</label>
            </div>
            <br>
            <div class="field">
                <input required="" type="text" name="address" id="addresss" class="input">
                    <br>
                <label class="label">Address</label>
            </div><br>
          
            <button class="button" type="submit" >Insert</button>
        </form>
    </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
