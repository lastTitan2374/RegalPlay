<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Turf Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2; /* Light gray background */
            color: #333; /* Dark text color */
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff; /* White background */
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); /* Shadow effect */
        }
        
        h1 {
            color: #137e18; /* Mildly dark green */
            text-align: center;
            margin-bottom: 30px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #555; /* Gray color for labels */
        }
        
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc; /* Light gray border */
            border-radius: 5px;
            box-sizing: border-box; /* Include padding and border in width */
        }
        
        input[type="submit"] {
            background-color: #137e18; /* Mildly dark green */
            color: #fff; /* White text color */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        input[type="submit"]:hover {
            background-color: #0f5c10; /* Darker green on hover */
        }
        input[type="button"] {
            background-color: #137e18; /* Mildly dark green */
            color: #fff; /* White text color */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        input[type="button"]:hover {
            background-color: #0f5c10; /* Darker green on hover */
        }
        .error-msg {
            color: #ff0000; /* Red color for error messages */
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Turf Details</h1>
    <form id="editTurfForm" action="update_turf.php" method="post">
        <label for="turf_id">Enter Turf ID:</label><br>
        <input type="text" id="turf_id" name="turf_id"><br>
        <input type="button" id="fetchTurfDetails" value="Fetch Turf Details"><br><br>

        <!-- Input fields for turf details -->
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        
        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address"><br>
        
        <label for="amenities">Amenities:</label><br>
        <textarea id="amenities" name="amenities"></textarea><br>

        <label for="rate">Rate:</label><br>
        <input type="text" id="rate" name="rate"><br>
        
        <label for="additional_info">Additional Info:</label><br>
        <textarea id="additional_info" name="additional_info"></textarea><br>
        
        <label for="district">District:</label><br>
        <input type="text" id="district" name="district"><br>
        
        <label for="map_location">Map Location:</label><br>
        <input type="text" id="map_location" name="map_location"><br>
    
        <input type="submit" value="Save Changes">
    </form>
    </div>
    <script>
        document.getElementById("fetchTurfDetails").addEventListener("click", function() {
            // Get the turf ID entered by the user
            var turfId = document.getElementById("turf_id").value;

            // Fetch turf details using AJAX
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Parse JSON response
                        var turfDetails = JSON.parse(xhr.responseText);

                        // Fill input fields with turf details
                        document.getElementById("name").value = turfDetails.name;
                        document.getElementById("address").value = turfDetails.address;
                        document.getElementById("amenities").value = turfDetails.amenities;
                        document.getElementById("rate").value = turfDetails.rate;
                        document.getElementById("additional_info").value = turfDetails.additional_info;
                        document.getElementById("district").value = turfDetails.district;
                        document.getElementById("map_location").value = turfDetails.map_location;


                    } else {
                        // Handle error
                        console.error("Error fetching turf details: " + xhr.status);
                    }
                }
            };

            // Open and send AJAX request
            xhr.open("GET", "fetch_turf_details.php?turf_id=" + turfId, true);
            xhr.send();
        });
    </script>
</body>
</html>
