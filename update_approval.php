<?php
// Connect to the database
$servername = "localhost";
$username = "Group5";
$password = "Zephiroth123#";
$database = "turf_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if turfId is set in the POST request
if (isset($_POST["turfId"])) {
    // Sanitize input to prevent SQL injection
    $turfId = $conn->real_escape_string($_POST["turfId"]);

    // Update the 'approved' column in the turfs table
    $sql = "UPDATE turfs SET approved = 1 WHERE id = '$turfId'";
    if ($conn->query($sql) === TRUE) {
        echo "Turf approval status updated successfully";
    } else {
        echo "Error updating turf approval status: " . $conn->error;
    }
} else {
    echo "Turf ID not provided";
}

// Close the database connection
$conn->close();
?>
