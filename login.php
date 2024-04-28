<?php
session_start();

// Initialize $errorMsg variable
$errorMsg = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are provided
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        // Connect to your database
        $servername = "localhost"; // Change this to your database server name
        $username = "Group5"; // Change this to your database username
        $password = "Zephiroth123#"; // Change this to your database password
        $dbname = "user_info"; // Change this to your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to retrieve hashed password for the provided username
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $_POST["username"]);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a row is returned
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            // Verify the provided password with the hashed password from the database
            if (password_verify($_POST['password'], $hashed_password)) {
                // Set session variable to indicate user is logged in
                $_SESSION["username"] = $_POST["username"];
                // Redirect to home page or perform any other actions for successful login
                header("Location: 1.html");
                exit();
            } else {
                // Set error message for invalid password
                $errorMsg = "Invalid password. Please try again.";
            }
        } else {
            // Set error message for invalid username
            $errorMsg = "Username not found. Please try again.";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Set error message if username or password is not provided
        $errorMsg = "Please provide both username and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Turf Booking</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* CSS for login section */
        .login-section {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            z-index: 1001; /* Ensure login section is above mask */
            display: block; /* Initially display login section */
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.4); /* Add shadow effect */
        }
        
        .login-section h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-section input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .login-section button {
            width: 100%;
            padding: 10px;
            background-color: #0ea540;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-section button:hover {
            background-color:#0ea540;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<header>
        <div class="logo">
            <img  src="L1.png" style="height: 35px; width: auto;" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="1.html">Home</a></li>
                <li><a href="#">Facilities</a></li>
                <li><a href="abt.html">About Us</a></li>
                <li><a href="cus.html">Contact</a></li>

            </ul>
        </nav>
    </header> 
    <!-- Login Section -->
    <div class="login-section">
        <h2>Login</h2>
        <!-- Display error message here -->
        <?php if (!empty($errorMsg)) : ?>
            <div class="error-message"><?php echo $errorMsg; ?></div>
        <?php endif; ?>
        <!-- Login form -->
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <!-- Register option -->
            <br><br>
            <center><p>Don't have an account? <a href="reg.html" style="text-decoration: none; color: #137e18;">Register here</a></p></center>
        </form>
    </div>
</body>
</html>
