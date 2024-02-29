<?php
session_start();

// Establishing a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "patient appointment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Retrieve the phone number submitted via the form
$phone = $_SESSION['logged_phone'];

// Prepare a SQL statement to select the name associated with the provided phone number
$sql = "SELECT name FROM user_info WHERE phone = ?";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("s", $phone);

// Execute the statement
$stmt->execute();

// Store the result
$stmt->store_result();

// Check if there's any row returned
if ($stmt->num_rows > 0) {
    // Bind the result to a variable
    $stmt->bind_result($name);

    // Fetch the result
    $stmt->fetch();

    // Now $name contains the name associated with the provided phone number
    $_SESSION['name'] = $name;

    // Get the appointment details submitted via the form
    $hospital = $_POST['hos'];
    $address = $_POST['addr'];
    $city = $_POST['city'];

    // Prepare a SQL statement to insert the appointment details into the database
    $sql_insert = "INSERT INTO user_apointment (name, phone, hospital, address, city) VALUES (?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt_insert = $conn->prepare($sql_insert);

    // Bind parameters
    $stmt_insert->bind_param("sssss", $name, $phone, $hospital, $address, $city);

    // Execute the statement
    $stmt_insert->execute();

    // Check if the appointment details were inserted successfully
    if ($stmt_insert->affected_rows > 0) {
        echo "<script>alert('Appointment successfully!');</script>";
        echo "<script>window.location.href = 'home.php';</script>";
    } else {
        $ero = "Error: " . $sql_insert . "<br>" . $conn->error;
    }

    // Close the statement
    $stmt_insert->close();
} else {
    echo "No name found for the provided phone number.";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>