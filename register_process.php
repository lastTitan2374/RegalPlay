<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Check if user is logged in
if (!isset($_SESSION["username"])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Prepare and execute query to insert turf details into the database
    $name = $_POST['name'];
    $address = $_POST['address'];
    $amenities = $_POST['amenities'];
    $rate = $_POST['rate'];
    $additional_info = $_POST['additional_info'];
    $district = $_POST['district'];
    $map_location = $_POST['map_location'];

    // Image file handling
    $image1 = $_FILES['image1']['name'];
    $image2 = $_FILES['image2']['name'];
    $image3 = $_FILES['image3']['name'];
    $image4 = $_FILES['image4']['name'];

    $target_dir = "uploads/"; // Specify the directory where images will be stored
    move_uploaded_file($_FILES['image1']['tmp_name'], $target_dir . $image1);
    move_uploaded_file($_FILES['image2']['tmp_name'], $target_dir . $image2);
    move_uploaded_file($_FILES['image3']['tmp_name'], $target_dir . $image3);
    move_uploaded_file($_FILES['image4']['tmp_name'], $target_dir . $image4);

    $sql = "INSERT INTO turfs (name, address, amenities, rate, additional_info, district, map_location, image1, image2, image3, image4) 
            VALUES ('$name', '$address', '$amenities', '$rate', '$additional_info', '$district', '$map_location', '$image1', '$image2', '$image3', '$image4')";

    if ($conn->query($sql) === TRUE) {
        // Show success message
        echo "<script>alert('Turf registered');</script>";
        // Redirect to 1.html after 1 second
        echo "<script>setTimeout(function() { window.location.href = '1.html'; }, 1000);</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turf Owner Registration</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your custom CSS file -->
    <style>
        /* CSS for registration form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .registration-form {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .registration-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="password"],
        .form-group input[type="email"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group textarea {
            resize: none; /* Prevent resizing of textarea */
        }

        .form-group input[type="file"] {
            margin-top: 5px; /* Adjust margin as needed */
        }

        .form-group input[type="submit"] {
            background-color: #137e18;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-group input[type="submit"]:hover {
            background-color: #0e5a11;
        }
        nav a {
    text-decoration: none;
    color: #333;
    padding: 5px 20px;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

nav a:hover {
    box-shadow: 0 8px 10px rgba(0, 0, 0, 0.3);
}
.socials-container {
  width: fit-content;
  height: fit-content;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 25px;
  padding: 20px 40px;
  background-color: #137e18;
}
.social {
  width: 50px;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  border: 1px solid rgb(194, 194, 194);
}
.twitter:hover {
  background: linear-gradient(45deg, #66757f, #00acee, #36daff, #dbedff);
}
.facebook:hover {
  background: linear-gradient(45deg, #134ac0, #316ff6, #78a3ff);
}
.google-plus:hover {
  background: linear-gradient(45deg, #872419, #db4a39, #ff7061);
}
.instagram:hover {
  background: #f09433;
  background: -moz-linear-gradient(
    45deg,
    #f09433 0%,
    #e6683c 25%,
    #dc2743 50%,
    #cc2366 75%,
    #bc1888 100%
  );
  background: -webkit-linear-gradient(
    45deg,
    #f09433 0%,
    #e6683c 25%,
    #dc2743 50%,
    #cc2366 75%,
    #bc1888 100%
  );
  background: linear-gradient(
    45deg,
    #f09433 0%,
    #e6683c 25%,
    #dc2743 50%,
    #cc2366 75%,
    #bc1888 100%
  );
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f09433', endColorstr='#bc1888',GradientType=1 );
}
.social svg {
  fill: white;
  height: 20px;
}

    </style>
</head>
<body>
<header>
        <div class="logo">
            <img  src="L1.png" style="height: 35px; width: auto;" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="1.html">Home</a></li>            
                <li><a href="abt.html">About Us</a></li>
                <li><a href="cus.html">Contact</a></li>
                
            </ul>
        </nav>
        <!-- User Account Section -->
        <div class="user-account">
            <div class="avatar-wrapper">
                <img src="u1.png" alt="User Avatar" class="avatar"> <!-- Avatar icon URL -->
                <div class="dropdown-menu"> <!-- Dropdown menu for user options -->
                    <a href="profile.php">Profile</a>
                    <a href="#">Settings</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </header><br><br>
    <div class="registration-form">
        <h2>Turf Owner Registration</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Turf Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="amenities">Amenities:</label>
                <textarea id="amenities" name="amenities" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="rate">Rate for 1/2 hour:</label>
                <input type="text" id="rate" name="rate" required>
            </div>
            <div class="form-group">
                <label for="additional_info">Additional Information:</label>
                <textarea id="additional_info" name="additional_info" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="district">District:</label>
                <input type="text" id="district" name="district" required>
            </div>
            <div class="form-group">
                <label for="map_location">Map Location:</label>
                <input type="text" id="map_location" name="map_location" required>
            </div>
            <div class="form-group">
                <label for="image1">Image 1:</label>
                <input type="file" id="image1" name="image1" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="image2">Image 2:</label>
                <input type="file" id="image2" name="image2" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="image3">Image 3:</label>
                <input type="file" id="image3" name="image3" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="image4">Image 4:</label>
                <input type="file" id="image4" name="image4" accept="image/*" required>
            </div>
            <div class="form-group">
                <a href="1.html"><input type="submit" value="Register"></a>
            </div>
        </form>
    </div>
    <footer style="background-color:#137e18;">
        <div class="footer-content">
            <div class="footer-logo">
                <img src="L1.png" style="height: 40px; width: auto;" alt="Footer Logo">
            </div>
            <div class="footer-links">
                <ul>
                    <li><a href="1.html">Home</a></li>
                    
                    <li><a href="abt.html">About Us</a></li>
                    <li><a href="cus.html">Contact</a></li>
                </ul>
            </div>
            <div class="footer-social" style="width: 60px; height: 70px; position: relative; right: 150px;">
                <div class="socials-container">
                    <a href="https://twitter.com/" target="_blank" class="social twitter">
                      <svg height="1em" viewBox="0 0 512 512">
                        <path
                          d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"
                        ></path>
                      </svg>
                    </a>
                  
                    <a href="https://www.facebook.com/" target="_blank" class="social facebook"
                      ><svg height="1em" viewBox="0 0 320 512">
                        <path
                          d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"
                        ></path></svg
                    ></a>
                  
                    
                  
                    <a href="https://www.instagram.com/" target="_blank" class="social instagram"
                      ><svg height="1em" viewBox="0 0 448 512">
                        <path
                          d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"
                        ></path></svg
                    ></a>
                  </div>
                  
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 RegalPlay. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
