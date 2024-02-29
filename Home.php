<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home_Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caudex:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="h2">
            <p>Hospital Managment</p>
    </div>
    <div class="menu">
        <a href="Home.php">Home</a>
        <a href="">Contact</a>
        <a href="appointment.php">Apointment</a>
        <a href="">About</a>
        <a href="admin.php">Admin</a>
       <button id="BTN" class="BTN" >Logout</button>
    </div>
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
        echo "<h2 class='user'>Welcome back, ".$name."!</h2>";
    } 
        else {
            echo "No name found for the provided phone number.";
        }
        
        // Close the statement and connection
        $stmt->close();
        $conn->close();
    ?>
    <div class="ap">
        <a href="card.php"><h2>Check your appointment</h2></a>
    </div>
</body>
</html>