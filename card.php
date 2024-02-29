<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card</title>
    <style>
        /* .card {
            display: flex;
            justify-content: center;
            align-items: center;
        } */

        .box {
            border-radius: 10px;
             background: #dad8d8;
             box-shadow:  35px 35px 70px #b9b8b8,
             -35px -35px 70px #fbf8f8;
               height: fit-content;
               width: fit-content;
               padding: 20px;
        }
    </style>
</head>

<body>
    <div class="card">
<h2>appointment</h2>
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

            // Prepare a SQL statement to select the name, hospital, address, and city associated with the provided phone number
            $sql = "SELECT name, hospital, address, city FROM user_apointment WHERE phone = ?";

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
                // Bind the result to variables
                $stmt->bind_result($name, $hospital, $address, $city);

                // Fetch the result
              while($stmt->fetch())
              {

                // Now $name, $hospital, $address, and $city contain the required details associated with the provided phone number
                // $_SESSION['name'] = $name;
                // $_SESSION['hospital'] = $hospital;
                // $_SESSION['address'] = $address;
                // $_SESSION['city'] = $city;
                echo"<div class='box'>";
                echo "<p>Hello $name</p>";
                echo "<p>Selected City:$city</p>";
                echo "<p>hospital:$hospital</p>";
                echo "<p>address:$address</p>";
                echo"</div>";
              }
            } else {
                echo "<script>alert('No Data Found!');</script>";
            }
            // Close the statement and connection
            $stmt->close();
            $conn->close();
            ?>
    </div>
</body>

</html>