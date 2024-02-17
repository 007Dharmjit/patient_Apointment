<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "patient appointment";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Export the connection object for use in other files
$db = $conn;