<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to login page if not logged in
    header("Location: admin_login.php");
    exit();
}

// Connect to the database
$servername = "localhost";
$username = "Group5";
$password = "Zephiroth123#";
$database = "turf_registration";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Logic for approving turfs
if (isset($_POST['approve_turf'])) {
    $turf_id = $_POST['turf_id'];

    // Retrieve turf details from the turfs table
    $sql_select = "SELECT * FROM turfs WHERE id = $turf_id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        // Insert turf details into the approved_turfs table
        $row = $result->fetch_assoc();
        $sql_insert = "INSERT INTO approved_turfs (name, address, amenities, rate, additional_info, district, map_location, image1, image2, image3, image4)
                       VALUES ('" . $row['name'] . "', '" . $row['address'] . "', '" . $row['amenities'] . "', " . $row['rate'] . ", '" . $row['additional_info'] . "', '" . $row['district'] . "', '" . $row['map_location'] . "', '" . $row['image1'] . "', '" . $row['image2'] . "', '" . $row['image3'] . "', '" . $row['image4'] . "')";
        $conn->query($sql_insert);

        // Delete turf from the turfs table
        $sql_delete = "DELETE FROM turfs WHERE id = $turf_id";
        $conn->query($sql_delete);
    }
}

// Logic for searching turfs
// Implement search functionality here

// Logic for editing turf details
// Implement editing functionality here

// Close the database connection
$conn->close();
?>

<!-- HTML for admin dashboard -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome, Admin</h1>
    <h2>Approve Turfs</h2>
    <!-- Display list of turfs waiting for approval -->
    <form action="" method="POST">
        <!-- Loop through turfs waiting for approval -->
        <?php
        // Fetch turfs waiting for approval from the turfs table
        $sql_select_waiting = "SELECT * FROM turfs";
        $result_waiting = $conn->query($sql_select_waiting);

        if ($result_waiting->num_rows > 0) {
            while ($row_waiting = $result_waiting->fetch_assoc()) {
                echo "<div>";
                echo "<p>Name: " . $row_waiting['name'] . "</p>";
                echo "<p>Address: " . $row_waiting['address'] . "</p>";
                // Add more details as needed
                echo "<input type='hidden' name='turf_id' value='" . $row_waiting['id'] . "'>";
                echo "<button type='submit' name='approve_turf'>Approve</button>";
                echo "</div>";
            }
        } else {
            echo "<p>No turfs waiting for approval</p>";
        }
        ?>
    </form>

    <!-- Other sections for searching turfs and editing turf details -->
</body>
</html>
