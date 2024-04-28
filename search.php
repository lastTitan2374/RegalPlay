<?php
// Connect to the database
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and execute query to fetch turfs based on search criteria
    $search_term = $_POST['search_term']; // Assuming this is the name or district entered in the search form
    $sql = "SELECT * FROM turfs WHERE name LIKE '%$search_term%' OR district LIKE '%$search_term%'";
    $result = $conn->query($sql);

    // Redirect to search results page with query string parameter
    header("Location: search_results.php?search_term=" . urlencode($search_term));
    exit();
}

$conn->close();
?>
