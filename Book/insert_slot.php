<?php
// Check if the POST data is set
if(isset($_POST['selectedDate']) && isset($_POST['selectedTime']) && isset($_POST['turf_id'])) {
    // Extract turf_id from the POST data
    $turf_id = $_POST['turf_id'];

    // Assuming you have a database connection established
    // Replace 'your_host', 'your_username', 'your_password', and 'your_database' with your actual database credentials
    $conn = new mysqli('localhost', 'Group5', 'Zephiroth123#', 'turf_registration');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape user inputs for security
    $selectedDate = $conn->real_escape_string($_POST['selectedDate']);
    $selectedTime = $conn->real_escape_string($_POST['selectedTime']);

    // Insert the selected date, time, and turf_id into the database
    $sql = "INSERT INTO booked_slots (turf_id, slot_date, slot_time) VALUES ('$turf_id', '$selectedDate', '$selectedTime')";

    if ($conn->query($sql) === TRUE) {
        echo "Slot booked successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Error: Invalid data.";
}
?>
