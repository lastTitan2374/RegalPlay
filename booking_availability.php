<?php
// Include database connection
include 'db_connection.php';

// Check if turf ID and date are provided
if (isset($_GET['turf_id']) && isset($_GET['date'])) {
    $turf_id = $_GET['turf_id'];
    $date = $_GET['date'];

    $servername = "localhost";
    $username = "Group5";
    $password = "Zephiroth123#";
    $database = "turf_registration"; // Adjusted database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch booking availability for the selected turf and date
    $sql = "SELECT booking_availability FROM turfs WHERE id = $turf_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $booking_availability = json_decode($row['booking_availability'], true);
        // Send JSON response with booking availability data
        echo json_encode($booking_availability[$date]);
    } else {
        // Turf not found or no availability data
        echo json_encode([]);
    }

    // Close database connection
    $conn->close();
} else {
    // Invalid request
    echo json_encode([]);
}
?>
