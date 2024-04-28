<?php
// Perform database connection
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

// Check if turf_id is provided in the URL parameter
if (isset($_GET['turf_id'])) {
    // Get the turf_id from the URL parameter
    $turf_id = $_GET['turf_id'];

    // Prepare and execute SQL query to fetch turf details
    $sql = "SELECT * FROM turfs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $turf_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        // Fetch turf details as an associative array
        $turfDetails = $result->fetch_assoc();

        // Convert the array to JSON format and echo it
        echo json_encode($turfDetails);
    } else {
        // If no rows are returned, echo an error message
        echo json_encode(array("error" => "Turf not found"));
    }
} else {
    // If turf_id is not provided in the URL parameter, echo an error message
    echo json_encode(array("error" => "Turf ID not provided"));
}

// Close the database connection
$stmt->close();
$conn->close();
?>
