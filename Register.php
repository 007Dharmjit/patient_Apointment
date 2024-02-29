
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "patient appointment";
    
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
    $sql_check = "SELECT * FROM user_info WHERE phone = '$phone'";
    $result = $conn->query($sql_check);
    
    if ($result->num_rows > 0) {
        // Phone number already exists, show error message
        $error ="Phone number already exist!";
    } else {
        // Phone number doesn't exist, proceed with registration
        $sql_insert = "INSERT INTO user_info (name, phone, password) VALUES ('$name', '$phone', '$password')";
        
        if ($conn->query($sql_insert) === TRUE) {
            echo "<script>alert('Registered successfully!');</script>";
            echo "<script>window.location.href = 'Login.php';</script>";
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
            Register
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
                    <input required="" type="password" name="password" id="password-input" class="input">
                    <span class="span" id="password-toggle">
                        <svg class="open" width="50" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 10C4 10 5.6 15 12 15M12 15C18.4 15 20 10 20 10M12 15V18M18 17L16 14.5M6 17L8 14.5" stroke="#464455" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <br>
                    <label class="label">Password</label>
                </div>
            <button class="button" type="submit">Register</button>
            <div class="sign-up">
                Alreasy have an account?
                <a href="signup.php">Login now</a>
            </div>
            <?php if (!empty($ero)): ?>
                <br>
        <p style="color: red;"><?php echo $ero; ?></p>
    <?php endif; ?>
        </form>
    </div>
</div>

<script>
        const passwordInput = document.getElementById("password-input");
        const passwordToggle = document.getElementById("password-toggle");

        passwordToggle.addEventListener("click", function(event) {
            event.stopPropagation();
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordToggle.innerHTML = `<span class="span" id="password-toggle"><svg width="50" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4 12C4 12 5.6 7 12 7M12 7C18.4 7 20 12 20 12M12 7V4M18 5L16 7.5M6 5L8 7.5M15 13C15 14.6569 13.6569 16 12 16C10.3431 16 9 14.6569 9 13C9 11.3431 10.3431 10 12 10C13.6569 10 15 11.3431 15 13Z" stroke="#464455" stroke-linecap="round" stroke-linejoin="round"/>
</svg> </span>`;
            } else {
                passwordInput.type = "password";
                passwordToggle.innerHTML = `<span class="span" id="password-toggle"><svg id="password-toggle" class="open" width="50" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4 10C4 10 5.6 15 12 15M12 15C18.4 15 20 10 20 10M12 15V18M18 17L16 14.5M6 17L8 14.5" stroke="#464455" stroke-linecap="round" stroke-linejoin="round"/>
</svg></span>`;
            }
        });
    </script>
</body>

</html>

