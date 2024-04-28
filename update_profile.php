<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["username"])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $new_full_name = $_POST["full_name"];
    $new_email = $_POST["email"];
    $new_phone_number = $_POST["phone_number"];
    $username = $_SESSION["username"];

    // Connect to the database
    $servername = "localhost";
    $db_username = "Group5"; // Changed variable name to avoid conflict
    $password = "Zephiroth123#";
    $database = "user_info";

    // Create connection
    $conn = new mysqli($servername, $db_username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute query to update user data
    $sql = "UPDATE users SET full_name='$new_full_name', email='$new_email', phone_number='$new_phone_number' WHERE username='$username'";
    
    // Debugging: echo SQL query for verification
    echo "SQL Query: $sql<br>";

    if ($conn->query($sql) === TRUE) {
        // Update successful
        echo "Update successful";
        header("Location: profile.php");
        exit();
    } else {
        // Handle error
        $errorMsg = "Error updating record: " . $conn->error;
        echo $errorMsg;
    }

    // Close database connection
    $conn->close();
} else {
    // Redirect to edit profile page if form data is not submitted
    header("Location: edit_profile.php");
    exit();
}
?>
