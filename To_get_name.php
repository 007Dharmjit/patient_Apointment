<?php 
 session_start();
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "patient appointment";

 // Establishing a database connection
 $conn = new mysqli($servername, $username, $password, $dbname);
 if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
    // / Retrieve the phone number submitted via the form
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


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_hospital = $_POST['hos'];
    $_address= $_POST['addr'];
    $_city =$_POST['city'];
        // $hos = $_hospital[0];
        // $add = $_address[0];
       echo"<h2>Hello $name </h2> <br>";
       echo" Your City:$_city <br>";
       echo"Your Selected Hospital:$_hospital<br>";
       echo"Hospital Address:$_address";
   } else {
       echo "Error: The 'name' session variable is not set.";
   
}
} else {
    echo "No name found for the provided phone number.";
}
// Close the statement and connection
$stmt->close();
$conn->close();

?>
