<?php
// Check if "selectedDate" and "turf_id" are set in the $_POST array
if(isset($_POST['selectedDate']) && isset($_POST['turf_id'])) {
    // Retrieve the selected date and turf_id from the POST request
    $selectedDate = $_POST['selectedDate'];
    $turf_id = $_POST['turf_id'];

    // Your database connection details
    $servername = "localhost";
    $username = "Group5";
    $password = "Zephiroth123#";
    $dbname = "turf_registration";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve booked slots from the database
    $sql = "SELECT slot_time FROM booked_slots WHERE slot_date = '$selectedDate' AND turf_id = '$turf_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output each booked slot as plain text
        while($row = $result->fetch_assoc()) {
            echo $row["slot_time"] . "\n";
        }
    } else {
        echo "No booked slots for the selected date and turf.";
    }
    $conn->close();
} else {
    // Return an empty response or provide a default behavior
    echo "No 'selectedDate' or 'turf_id' parameter provided.";
}
?>
