
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "admin";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Escape user inputs for security
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $password = $conn->real_escape_string($_POST['password']);
    
    // Check if phone number already exists in database
    $sql_check = "SELECT * FROM admin_info WHERE phone = '$phone'";
    $result = $conn->query($sql_check);
    
    if ($result->num_rows > 0) {
        // Phone number already exists, show error message
        $error ="Phone number already exist!";
    } else {
        // Phone number doesn't exist, proceed with registration
        $sql_insert = "INSERT INTO admin_info (name, phone, password) VALUES ('$name', '$phone', '$password')";
        
        if ($conn->query($sql_insert) === TRUE) {
            echo "<script>alert('Registered successfully!');</script>";
            echo "<script>window.location.href = 'Home.php';</script>";
        } else {
           $ero ="Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }
    // Close connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
<div class="center">
    <div class="content">
        <div class="text">
           Admin Register
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="field">
                <input required="" type="text" name="name" class="input">
                <span class="span"><svg class="" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 512 512" y="0" x="0" height="20" width="50" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path class="" data-original="#000000" fill="#595959" d="M256 0c-74.439 0-135 60.561-135 135s60.561 135 135 135 135-60.561 135-135S330.439 0 256 0zM423.966 358.195C387.006 320.667 338.009 300 286 300h-60c-52.008 0-101.006 20.667-137.966 58.195C51.255 395.539 31 444.833 31 497c0 8.284 6.716 15 15 15h420c8.284 0 15-6.716 15-15 0-52.167-20.255-101.461-57.034-138.805z"></path>
                        </g>
                    </svg></span>
                <label class="label">Enter Your Name</label>
            </div>

            <div class="field">
                <input required="" type="text" name="phone" class="input">
                <span class="span"><svg class="" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 512 512" y="0" x="0" height="20" width="50" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path class="" data-original="#000000" fill="#595959" d="M256 0c-74.439 0-135 60.561-135 135s60.561 135 135 135 135-60.561 135-135S330.439 0 256 0zM423.966 358.195C387.006 320.667 338.009 300 286 300h-60c-52.008 0-101.006 20.667-137.966 58.195C51.255 395.539 31 444.833 31 497c0 8.284 6.716 15 15 15h420c8.284 0 15-6.716 15-15 0-52.167-20.255-101.461-57.034-138.805z"></path>
                        </g>
                    </svg></span>
                <label class="label">Enter Phone.No</label>
            </div>
            <?php if (!empty($error)): ?>
                <br>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
            <br>
            <div class="field">
                <input required="" type="password" name="password" class="input">
                <span class="span"><svg class="" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 512 512" y="0" x="0" height="20" width="50" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path class="" data-original="#000000" fill="#595959" d="M336 192h-16v-64C320 57.406 262.594 0 192 0S64 57.406 64 128v64H48c-26.453 0-48 21.523-48 48v224c0 26.477 21.547 48 48 48h288c26.453 0 48-21.523 48-48V240c0-26.477-21.547-48-48-48zm-229.332-64c0-47.063 38.27-85.332 85.332-85.332s85.332 38.27 85.332 85.332v64H106.668zm0 0"></path>
                        </g>
                    </svg></span>
                <label class="label">Password</label>
            </div>
            <button class="button" type="submit">Register</button>
            <?php if (!empty($ero)): ?>
                <br>
        <p style="color: red;"><?php echo $ero; ?></p>
    <?php endif; ?>
        </form>
    </div>
</div>
</body>

</html>

