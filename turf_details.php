<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turf Details</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        /* Add CSS for Turf Details */
        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; /* Changed font to Helvetica Neue */
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Background container with blur effect */
        .background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-image: url('bg2.jpg');
            background-size: cover;
            background-position: center;
            filter: blur(3px);
            -webkit-filter: blur(3px);
        }
        
        .container {
            max-width: 1400px; /* Increased container width */
            margin: 20px auto;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            border-radius: 15px; /* Increased border radius */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); /* Added box shadow */
        }
        
        h1 {
            font-size: 40px; /* Increased font size */
            margin-bottom: 20px;
            color: #4caf50; /* Green color */
            grid-column: 1 / -1;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .gallery-container {
            overflow-x: auto;
            white-space: nowrap;
            margin-bottom: 20px;
            background-color: #fff;
            padding: 20px; /* Increased padding */
            border-radius: 15px; /* Increased border radius */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); /* Added box shadow */
            grid-column: 1 / -1;
        }

        .turf-image {
            display: inline-block;
            width: 100%; /* Made image containers wider */
            max-width: 400px; /* Maximum width for image containers */
            margin-right: 20px;
            border-radius: 15px; /* Increased border radius */
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .turf-image img {
            width: 100%;
            height: auto;
            border-radius: 15px; /* Increased border radius */
        }
        
        .turf-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 15px; /* Increased border radius */
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); /* Added box shadow */
            grid-column: 1 / span 1;
        }
        
        .address, .amenities, .rate, .rating, .additional-info, .customer-review {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 15px; /* Increased border radius */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .rating {
            display: flex;
            align-items: center;
        }
        
        .stars {
            color: #fdd835;
            margin-right: 5px;
        }
        
        .reviews {
            margin-left: 5px;
            color: #888;
        }

        .customer-review {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .customer-review .user {
            background-color: #fff;
            padding: 20px; /* Increased padding */
            border-radius: 15px; /* Increased border radius */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .customer-review .user h4 {
            margin-bottom: 10px;
            color: #2a892d;
        }
        
        .book-now {
            background-color: #2d8530;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%; /* Make the button full width */
        }
        
        .book-now:hover {
            background-color: #267c2b;
        }

        .map-container {
            background-color: #fff;
            border-radius: 15px; /* Increased border radius */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); /* Added box shadow */
            grid-column: 2 / span 1;
            overflow: hidden;
        }

        .map {
            width: 100%;
            height: 300px;
        }

        .offers {
            background-color: #2d8b30;
            padding: 20px;
            border-radius: 15px; /* Increased border radius */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); /* Added box shadow */
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
            font-family: 'Roboto', sans-serif; /* Changed font to Roboto */
            background: linear-gradient(to bottom, #1c7612, #7fdc6d); /* Gradient background */
        }

        .offer {
            background-color: white; /* Semi-transparent white background */
            padding: 20px; /* Increased padding */
            border-radius: 15px; /* Increased border radius */
            margin-bottom: 20px; /* Increased margin */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease; /* Added transition */
        }

        .offer:hover {
            transform: translateY(-5px); /* Add hover effect */
        }

        .offer-title {
            font-weight: bold;
            font-size: 24px; /* Increased font size */
            color: #45a049; /* Changed offer title color */
            font-family: 'Pacifico', cursive; /* Changed font to Pacifico */
            margin: 0; /* Removed margin */
            padding-bottom: 10px; /* Added padding */
            border-bottom: 2px solid #fff; /* Added border bottom */
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
<body style="padding-top: 60px;">
    <header>
        <div class="logo">
            <img  src="L1.png" style="height: 35px; width: auto;" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="/RP/1.html">Home</a></li>
                <li><a href="#">Facilities</a></li>
                <li><a href="/RP/abt.html">About Us</a></li>
                <li><a href="/RP/cus.html">Contact</a></li>
            </ul>
        </nav>
        <!-- User Account Section -->
        <div class="user-account">
            <div class="avatar-wrapper">
                <img src="u1.png" alt="User Avatar" class="avatar"> <!-- Avatar icon URL -->
                <div class="dropdown-menu"> <!-- Dropdown menu for user options -->
                <a href="/RP\profile.php">Profile</a>
                    <a href="#">Settings</a>
                    <a href="/RP\logout.php">Logout</a>
                </div>
            </div>
        </div>
    </header>
    <div class="background-container"></div> <!-- Background container -->
    <div class="container">
        <?php
        // Check if turf ID is provided in the URL
        if (isset($_GET['id'])) {
            $turf_id = $_GET['id'];

            // Connect to the database
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

            // Prepare and execute query to fetch turf details based on turf ID
            $sql = "SELECT * FROM turfs WHERE id = $turf_id";
            $result = $conn->query($sql);

            // Display turf details
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Store each turf detail in its own variable
                    $turf_name = $row["name"];
                    $address = $row["address"];
                    $amenities = $row["amenities"];
                    $rate = $row["rate"];
                    $additional_info = $row["additional_info"];
                    $district = $row["district"];
                    $map_location = $row["map_location"];
                    $image1 = "uploads/" . $row["image1"];
                    $image2 = "uploads/" . $row["image2"];
                    $image3 = "uploads/" . $row["image3"];
                    $image4 = "uploads/" . $row["image4"];
                }

                // Output the turf details using the variables
                
            } else {
                echo "No turf details found.";
            }

            $conn->close();
        } else {
            // Redirect back to search page if turf ID is not provided
            header("Location: search_results.php");
            exit();
        }
        ?>
        <h2 style="position:relative; left: 20px;"><?php echo $turf_name; ?></h2>
        <div class="gallery-container">
    <div class="turf-image">
        <img src="<?php echo $image1; ?>" alt="Turf Image 1">
    </div>
    <div class="turf-image">
        <img src="<?php echo $image2; ?>" alt="Turf Image 2">
    </div>
    <div class="turf-image">
        <img src="<?php echo $image3; ?>" alt="Turf Image 3">
    </div>
    <div class="turf-image">
        <img src="<?php echo $image4; ?>" alt="Turf Image 4">
    </div>
    <!-- Add more images as needed -->
</div>

<div class="turf-details">
    <h3>Address</h3>
    <p class="address"><?php echo $address; ?></p>
    
    <div class="amenities">
        <h3>Amenities</h3>
        <p><?php echo $amenities; ?></p>
    </div>
    
    <div class="rate">
        <h3>Rate (for 1/2 hour)</h3>
        <p><?php echo $rate; ?></p> <!-- Adjust rate as needed -->
    </div>
    
    <div class="rating">
        <h3>Rating:   </h3>
        <span class="stars">★★★★★</span> <!-- Adjust star rating as needed -->
        <span class="reviews">(5 reviews)</span> <!-- Adjust number of reviews as needed -->
    </div>

    <h3>Additional Information</h3>
    <p><?php echo $additional_info; ?></p>
    <p>Opening Hours: Mon-Sat 8:00 AM - 10:00 PM</p>
    <!-- Add more information as needed -->
</div>

<div class="map-container">
    <br> <h3>  Map</h3>
    <div class="map">
        <!-- Corrected map embed code with the new coordinates -->
        <iframe src="<?php echo $map_location; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>


        <div class="additional-info">
            <h3>Customer Reviews</h3>
            <div class="customer-review">
                <div class="user">
                    <h4>John Smith</h4>
                    <div class="rating">
                        <span class="stars">★★★★★</span>
                    </div>
                    <p>Great turf with excellent facilities!</p>
                </div>
                <div class="user">
                    <h4>Rachael Thomas</h4>
                    <div class="rating">
                        <span class="stars">★★★☆☆</span>
                    </div>
                    <p>Nice place, but could improve cleanliness.</p>
                </div>
                <!-- Add more reviews as needed -->
            </div>
            <br><br><br><br>
            <center><a href="/RP\Book\c.html?id=<?php echo $turf_id; ?>"><button style="height: 50px; width: 500px;" class="book-now">Book Now</button></center></a>
        </div>

        <div class="offers">
            <h2 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">Offers Available</h2><br>
            <div class="offer">
                <p class="offer-title">Offer 1: Get Rs.100 off on your first booking!</p>
            </div><br><br>
            <div class="offer">
                <p class="offer-title">Offer 2: Avail 20% discount on group bookings (4 or more people)!</p>
            </div><br><br>
            <div class="offer">
                <p class="offer-title">Offer 3: Special discount for students on weekdays!</p>
            </div>
        </div>
    </div>
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
