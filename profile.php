<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["username"])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

// Connect to the database
$servername = "localhost";
$username = "Group5";
$password = "Zephiroth123#";
$database = "user_info";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute query to fetch user details
$username = $_SESSION["username"];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

// Check if user exists
if ($result->num_rows > 0) {
    // Fetch user data
    $userData = $result->fetch_assoc();
} else {
    // Handle case where user does not exist
    $errorMsg = "User not found.";
}

// Check if the logged-in user is 'admin'
$is_admin = ($_SESSION["username"] === 'admin');

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Turf Booking</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your custom CSS file -->
    <style>
        /* CSS for profile section */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .background-container {
            position: fixed;
            bottom:0;
            left: 0;
            width: 100%;
            height: 73%;
            background-image: url('loginbg.png');
            background-size: cover;
            filter: blur(2px); /* Apply blur effect */
            z-index: -1; /* Move behind content */
        }

        header {
            position: relative; /* Ensure header stays at the top */
            z-index: 1; /* Keep header above blurred background */
            background-color: #ffffff; /* Set background color */
            padding: 10px 0; /* Adjust padding as needed */
        }

        .logo {
            float: left;
            margin-left: 20px; /* Adjust margin as needed */
        }

        .logo img {
            height: 35px;
            width: auto;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin-right: 20px; /* Adjust margin as needed */
        }

        .profile-section {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent background */
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .profile-details {
            margin-bottom: 20px;
            background-color: #fff; /* White background */
            padding: 20px; /* Add padding */
            border-radius: 10px; /* Add border radius */
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); /* Add shadow */
        }

        .profile-details label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        .profile-details span {
            color: #333;
        }

        .logout-link {
            text-align: center;
            margin-top: 30px;
        }

        .logout-link a {
            text-decoration: none;
            color: #137e18;
            font-weight: bold;
            border: 2px solid #137e18;
            padding: 10px 20px;
            border-radius: 30px;
            transition: background-color 0.3s, color 0.3s;
        }

        .logout-link a:hover {
            background-color: #137e18;
            color: #fff;
        }

        .turf-section {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add box shadow */
            margin-bottom: 20px;
            padding: 20px;
        }

        .turf-details {
            margin-bottom: 10px;
        }

        .turf-details label {
            font-weight: bold;
        }

        .turf-details span {
            color: #333;
        }

        .approve-button {
            background-color: #137e18;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .approve-button:hover {
            background-color: #0e5f11;
        }
        .turf-section-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 100px;
    
}

.turf-section {
    flex: 0 0 calc(33.33% - 20px); /* Two turfs in a row with padding */
    margin-bottom: 20px;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    
}

    </style>
</head>
<body>
    <div class="background-container"></div> <!-- Background container -->
    <header style="background-color:green; color:white;">
        <div class="logo">
            <img src="L1.png" alt="Logo">
        </div>
        <nav>
            <ul style=" color:white;">
                <li><a href="1.html">Home</a></li>
                <li><a href="#">Facilities</a></li>
                <li><a href="abt.html">About Us</a></li>
                <li><a href="cus.html">Contact</a></li>
            </ul>
        </nav>
    </header> 
    <!-- Profile Section -->
    <div class="profile-section">
        <center><h1 style="color:green">User Profile</h1></center>
        <div class="profile-details">
            <label>Full Name:</label>
            <span><?php echo isset($userData['full_name']) ? $userData['full_name'] : ''; ?></span>
        </div>
        <div class="profile-details">
            <label>Username:</label>
            <span><?php echo isset($userData['username']) ? $userData['username'] : ''; ?></span>
        </div>
        <div class="profile-details">
            <label>Email:</label>
            <span><?php echo isset($userData['email']) ? $userData['email'] : ''; ?></span>
        </div>
        <div class="profile-details">
            <label>Phone Number:</label>
            <span><?php echo isset($userData['phone_number']) ? $userData['phone_number'] : ''; ?></span>
        </div>
        <!-- Logout option -->
        <div class="logout-link">
            <a href="edit_profile.php">Edit Profile</a>
        </div> <br>
        <div class="logout-link">
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <!-- Admin-specific sections -->
    <?php if($is_admin): ?>
        <script>
        // Reload the page every 5 seconds
        setInterval(function(){
            location.reload();
        }, 10000);
    </script>
        <!-- Display turfs waiting for approval -->
        
            <center><h2 style="position: relative; top: 50px;">Turfs Waiting for Approval</h2></center>
            <!-- Add code to display turfs waiting for approval -->
            <div class="turf-section-container">
            <?php
            $servername = "localhost";
            $username = "Group5";
            $password = "Zephiroth123#";
            $database = "turf_registration";
            // Create connection
            $conn = new mysqli($servername, $username, $password, $database);
            // Prepare and execute query to fetch turfs waiting for approval
            $sql_turfs_waiting = "SELECT * FROM turfs WHERE approved = 0"; // Assuming there's a column named 'approved' indicating approval status
            $result_turfs = $conn->query($sql_turfs_waiting);
            // Check if the query executed successfully
            if ($result_turfs === false) {
                echo "Error executing query: " . $conn->error;
                // Handle the error as needed
            } else {
                // Check if turfs are waiting for approval
                if ($result_turfs->num_rows > 0) {
                    // Display turfs waiting for approval
                    while ($row = $result_turfs->fetch_assoc()) {
                        // Display each turf waiting for approval
                        $id = $row["id"];
                        $name = $row["name"];
                        $address = $row["address"];
                        $rate = $row["rate"];
            ?>
                        
                        <div class="turf-section">
                            <h2>Turf Details</h2>
                            <div class="turf-details">
                                <label>Turf ID:</label>
                                <span><?php echo $id; ?></span>
                            </div>
                            <div class="turf-details">
                                <label>Name:</label>
                                <span><?php echo $name; ?></span>
                            </div>
                            <div class="turf-details">
                                <label>Address:</label>
                                <span><?php echo $address; ?></span>
                            </div>
                            <div class="turf-details">
                                <label>Rate:</label>
                                <span><?php echo $rate; ?></span>
                            </div>
                            <button class="approve-button" onclick="approveTurf(<?php echo $id; ?>, this)">Approve</button>
                        </div>
                    
            <?php
                    }
                } else {
                    echo "No turfs waiting for approval.";
                }
            }
            // Close the database connection
            $conn->close();
            ?>
        </div>
     <!-- Display approved turfs -->
     <center><h2 style="position: relative; top: 50px;">Approved Turfs</h2>
     <div class="turf-section-container">
            <?php
            $servername = "localhost";
            $username = "Group5";
            $password = "Zephiroth123#";
            $database = "turf_registration";
            // Create connection
            $conn = new mysqli($servername, $username, $password, $database);
            // Prepare and execute query to fetch turfs waiting for approval
            $sql_turfs_waiting = "SELECT * FROM turfs WHERE approved = 1"; // Assuming there's a column named 'approved' indicating approval status
            $result_turfs = $conn->query($sql_turfs_waiting);
            // Check if the query executed successfully
            if ($result_turfs === false) {
                echo "Error executing query: " . $conn->error;
                // Handle the error as needed
            } else {
                // Check if turfs are waiting for approval
                if ($result_turfs->num_rows > 0) {
                    // Display turfs waiting for approval
                    while ($row = $result_turfs->fetch_assoc()) {
                        // Display each turf waiting for approval
                        $id = $row["id"];
                        $name = $row["name"];
                        $address = $row["address"];
                        $rate = $row["rate"];
            ?>
                        
                        <div class="turf-section">
                            <h2>Turf Details</h2>
                            <div class="turf-details">
                                <label>Turf ID:</label>
                                <span><?php echo $id; ?></span>
                            </div>
                            <div class="turf-details">
                                <label>Name:</label>
                                <span><?php echo $name; ?></span>
                            </div>
                            <div class="turf-details">
                                <label>Address:</label>
                                <span><?php echo $address; ?></span>
                            </div>
                            <div class="turf-details">
                                <label>Rate:</label>
                                <span><?php echo $rate; ?></span>
                            </div>
                            <button class="approve-button" onclick="disapproveTurf(<?php echo $id; ?>, this)">Disapprove</button>
                        </div>
                    
            <?php
                    }
                } else {
                    echo "No turfs waiting for approval.";
                }
            }
            // Close the database connection
            $conn->close();
            ?>
        </div>
    <!-- Turf Search Section -->
    <div>
        <h2 style="position: relative; bottom: 20px;">Search for Turfs</h2>
        <div class="search-bar" style="position: relative; left:450px;">               
                <form action="search.php" method="POST" >
                    
                    <input type="text" id="search_term" name="search_term" placeholder="Search by Turf Name or District" style="width: 500px;">
                    <button type="submit">Search</button>
                </form>
            
            </div>
    </div><br><br><br>
    <!-- Edit Turf Section -->
    <div>
        <h2>Edit Turf Details</h2><br><br>
        <form id="editTurfForm" action="edit_turf.php" method="post">
    
    <!-- Other input fields for turf details -->
    <button type="submit" style=" padding: 18px 36px; /* Increased padding */
    border: none;
    background-color: #388E3C;
    color: #fff;
    border-radius: 50px;
    cursor: pointer;
    font-size: 18px; /* Increased font size */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">Edit Turf</button>
</form>

    <?php endif; ?>
    <br><br><br><br><br>
</body>
<script>
       

        // Call the function to load approved turfs when the page loads
        

        // Function to approve a turf dynamically
        function approveTurf(turfId, button) {
        // Send an AJAX request to update the 'approved' column in the turfs table
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Handle the response
                console.log(this.responseText);
                // Remove the turf section from the DOM
                var turfSection = button.closest(".turf-section");
                turfSection.parentNode.removeChild(turfSection);
            }loadApprovedTurfs();
        };
        xhttp.open("POST", "update_approval.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("turfId=" + turfId);
        
    }
    function disapproveTurf(turfId, button) {
        // Send an AJAX request to update the 'approved' column in the turfs table
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Handle the response
                console.log(this.responseText);
                // Remove the turf section from the DOM
                var turfSection = button.closest(".turf-section");
                turfSection.parentNode.removeChild(turfSection);
            }loadApprovedTurfs();
        };
        xhttp.open("POST", "update_disapproval.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("turfId=" + turfId);
        
    }

    </script>


</html>
