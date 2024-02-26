<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>


<?php
session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "patient appointment";

    // Establishing a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Checking connection
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Checking if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieving phone and password from the form
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        // Sanitizing input to prevent SQL injection
        $phone = $conn->real_escape_string($phone);
        $password = $conn->real_escape_string($password);

        // Querying the database to fetch user_info based on phone
        $query = "SELECT * FROM user_info WHERE phone = '$phone';";
        $result = $conn->query($query);

        if ($result) {
            // Checking if user with given phone exists
            if ($result->num_rows > 0) {
                // User found, check password
                $row = $result->fetch_assoc();
                if ($password == $row['password']) {

                    // Passwords match, authentication successful
                    $_SESSION['logged_phone'] = $phone;
                    echo "<script>alert('Login successfully!');</script>";
                    echo "<script>window.location.href = 'Home.php';</script>";
                    exit;
                } else {
                    // Passwords don't match
                    $error = "Password was incorrect!";
                }
            } else {
                // User with given phone not found
                $error = "Phone number not found!";
            }
        } else {
            // Error in SQL query
            echo "<p>Error: " . $conn->error . "</p>";
        }

        // Freeing result set
        $result->free();
    }

    // Closing connection
    $conn->close();
    ?>

<div class="center">
    <div class="content">
        <div class="text">
            Login
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="field">
                <input required="" type="text" name="phone" class="input">
                <span class="span"><svg class="" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 512 512" y="0" x="0" height="20" width="50" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path class="" data-original="#000000" fill="#595959" d="M256 0c-74.439 0-135 60.561-135 135s60.561 135 135 135 135-60.561 135-135S330.439 0 256 0zM423.966 358.195C387.006 320.667 338.009 300 286 300h-60c-52.008 0-101.006 20.667-137.966 58.195C51.255 395.539 31 444.833 31 497c0 8.284 6.716 15 15 15h420c8.284 0 15-6.716 15-15 0-52.167-20.255-101.461-57.034-138.805z"></path>
                        </g>
                    </svg></span>
                <label class="label">Enter Phone.No</label>
            </div>
            <div class="field">
                <input required="" type="password" name="password" class="input">
                <span class="span"><svg class="" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 512 512" y="0" x="0" height="20" width="50" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path class="" data-original="#000000" fill="#595959" d="M336 192h-16v-64C320 57.406 262.594 0 192 0S64 57.406 64 128v64H48c-26.453 0-48 21.523-48 48v224c0 26.477 21.547 48 48 48h288c26.453 0 48-21.523 48-48V240c0-26.477-21.547-48-48-48zm-229.332-64c0-47.063 38.27-85.332 85.332-85.332s85.332 38.27 85.332 85.332v64H106.668zm0 0"></path>
                        </g>
                    </svg></span>
                    <br>
                <label class="label">Password</label>
            </div><br>
            <div class="forgot-pass">
                <a href="#">Forgot Password?</a>
            </div>
            <button class="button" type="submit" >Login</button>
            <div class="sign-up">
                Don't have an account?
                <a href="Register.php">Register now</a>
            </div>
        </form>
        <?php if (!empty($error)): ?>
                <br>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if (!empty($err)): ?>
                <br>
        <p style="color: red;"><?php echo $err; ?></p>
    <?php endif; ?>
    </div>
</div>
</body>

</html>
<script>
   
</script>