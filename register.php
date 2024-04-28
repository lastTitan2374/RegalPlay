<?php
// Database connection
$conn = new mysqli("localhost", "Group5", "Zephiroth123#", "user_info");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$full_name = $_POST["fullname"];
$username = $_POST["username"];
$email = $_POST["email"];
$phone_number = $_POST["phone"];
$password = $_POST["password"];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL query to insert user data into the database
$sql = "INSERT INTO users (full_name, username, email, phone_number, password) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $full_name, $username, $email, $phone_number, $hashed_password);

// Execute the query
if ($stmt->execute()) {
    // Registration successful, redirect to homepage
    header("Location: 1.html");
    exit; // Ensure no further output is sent
} else {
    echo "Error: " . $conn->error;
}

// Close the database connection
$stmt->close();
$conn->close();
?>
