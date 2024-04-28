<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the turf_id and other fields are set in the POST request
    if (isset($_POST["turf_id"]) && isset($_POST["name"]) && isset($_POST["address"]) && isset($_POST["amenities"]) && isset($_POST["rate"]) && isset($_POST["additional_info"]) && isset($_POST["district"]) && isset($_POST["map_location"])) {
        // Extract turf_id and other fields from the POST request
        $turf_id = $_POST["turf_id"];
        $name = $_POST["name"];
        $address = $_POST["address"];
        $amenities = $_POST["amenities"];
        $rate = $_POST["rate"];
        $additional_info = $_POST["additional_info"];
        $district = $_POST["district"];
        $map_location = $_POST["map_location"];

        // Perform database update
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

        // Prepare and execute SQL statement to update turf details
        $sql = "UPDATE turfs SET 
                name = '$name', 
                address = '$address', 
                amenities = '$amenities', 
                rate = '$rate', 
                additional_info = '$additional_info', 
                district = '$district', 
                map_location = '$map_location'  
                WHERE id = '$turf_id'";

        if ($conn->query($sql) === TRUE) {
            // Close database connection
            $conn->close();

            // Display alert and redirect to profile.php
            echo "<script>alert('Turf details updated successfully');</script>";
            echo "<script>window.location = 'profile.php';</script>";
            exit();
        } else {
            echo "Error updating turf details: " . $conn->error;
        }

        // Close database connection
        $conn->close();
    } else {
        echo "All fields are required";
    }
} else {
    // Redirect to the edit turf page if accessed directly without form submission
    header("Location: edit_turf.php");
    exit();
}
?>
