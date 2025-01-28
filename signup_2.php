<?php
// Start the session to retrieve previous data
session_start();

// Check if session data exists, otherwise redirect to the first page
if (!isset($_SESSION['email'])) {
    header("Location: signup.php");
    exit();
}

// Retrieve session data
$fullname = $_SESSION['fullname'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];

// Create a database connection
$servername = "localhost";
$username = "root"; // default XAMPP username
$password_db = ""; // default XAMPP password is blank
$dbname = "ayurguru";

$conn = new mysqli($servername, $username, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve additional user inputs with real_escape_string
    $gender = $conn->real_escape_string($_POST['gender']);
    $skin_type = $conn->real_escape_string($_POST['skin-type']);
    $body_type = $conn->real_escape_string($_POST['body-type']);
    $skin_color = $conn->real_escape_string($_POST['skin-color']);
    $hair_type = $conn->real_escape_string($_POST['hair-type']);
    $eye_color = $conn->real_escape_string($_POST['eye-color']);

    // Insert the user data into the database
    $insert_sql = "INSERT INTO registration (fullname, email, password, gender, skin_type, body_type, skin_color, hair_type, eye_color) 
                   VALUES ('$fullname', '$email', '$password', '$gender', '$skin_type', '$body_type', '$skin_color', '$hair_type', '$eye_color')";

    if ($conn->query($insert_sql) === TRUE) {
        // Clear session data after successful registration
        session_unset();
        session_destroy();

        // Redirect to a success page or login page
        header("Location: profile.html");
        exit();
    } else {
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayurguru - Sign Up</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Flexbox Layout for Page */
        .signup-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Left Side - Image */
        .image-section {
            flex: 0.7;
            
        }
        .image-section img{
            margin-top:25%;
        }
        
        /* Right Side - Form */
        .form-section {
            flex: 1.5;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Form Container */
        .form-box {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        /* Form Group Styling */
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .form-group label {
            margin-bottom: 5px;
            color: #3b3a36;
            font-weight: bold;
        }

        .form-group input, .form-group select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Title */
        .form-box h1 {
            text-align: center;
            color: #3b603b;
            margin-bottom: 20px;
        }

        /* Button Styling */
        .form-box button {
            background-color: #4d774e;
            color: white;
            border: none;
            padding: 10px 20px; /* Adjust padding for a better appearance */
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .form-box button:hover {
            background-color: #3b603b;
        }
        a{
            color: #4d774e;
        }
    </style>
    </head>
<body>
    <header>
        <div class="logo">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbVYZ3E0LkkjISHT9A7HcFI43Aau8RAI13Gw&s" alt="Ayurguru Logo" />
            <h1>Ayurguru</h1>
        </div>
        <ul class="nav-links">
            <li><a href="home.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Sign Up</a></li>
        </ul>
    </header>
    <main class="main-content">
        <div class="signup-container">
            <div class="image-section">
                <img src="https://vedamayurveda.co.in/assets/images/resource/about-us.jpg" alt="signup">
            </div>
            <div class="form-section">
                <div class="form-box">
                    <h1 class="section-title">Sign Up</h1>
                    <form action="signup_2.php" action="/predict" method="post">
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="skin-type">Skin Type:</label>
                            <select id="skin-type" name="skin-type" required>
                                <option value="">Select Skin Type</option>
                                <option value="normal">Normal</option>
                                <option value="dry">Dry</option>
                                <option value="oily">Oily</option>
                                <option value="combination">Combination</option>
                                <option value="sensitive">Sensitive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="body-type">Body Type:</label>
                            <select id="body-type" name="body-type" required>
                                <option value="">Select Body Type</option>
                                <option value="ectomorph">Ectomorph</option>
                                <option value="mesomorph">Mesomorph</option>
                                <option value="endomorph">Endomorph</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="skin-color">Skin Color:</label>
                            <select id="skin-color" name="skin-color" required>
                                <option value="">Select Skin Color</option>
                                <option value="Dark">Dark</option>
                                <option value="FairPaleYellow">Fair Pale Yellow</option>
                                <option value="FairPink">Fair Pink</option>
                                <option value="FairReddish">Fair Reddish</option>
                                <option value="Whitish">Light</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="hair-type">Hair Type:</label>
                            <select id="hair-type" name="hair-type" required>
                                <option value="">Select Hair Type</option>
                                <option value="straight">Straight</option>
                                <option value="wavy">Wavy</option>
                                <option value="curly">Curly</option>
                                <option value="coily">Coily</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="eye-color">Eye Color:</label>
                            <select id="eye-color" name="eye-color" required>
                                <option value="">Select Eye Color</option>
                                <option value="Black">Black</option>
                                <option value="DarkBrown">Dark Brown</option>
                                <option value="LightBrown">Hazel</option>
                                <option value="Grayish">Gray</option>
                            </select>
                        </div>

                
                        <button type="submit" id="submitBtn">Sign Up</button>
                    </form>
                    <p style="text-align: center;">Already have an account? <a href="login.php">Login here</a>.</p>
                </div>
                

            </div>
        </div>
        
        <!-- Signup Form -->
        
            
    </main>
    <footer>
        <div class="footer-content">
            <div class="footer-section contact-info">
                <h2>Contact Us</h2>
                <p><i class="fas fa-envelope" style="margin-right: 3%;"></i>Email: info@ayurguru.com</p>
                <p><i class="fas fa-phone" style="margin-right: 3%;"></i>Phone: +91 12345 67890</p>
                <p><i class="fas fa-map-marker-alt" style="margin-right: 3%;"></i>Address: 123 Ayurvedic Street, Wellness City, India</p>
                <p><i class="fas fa-clock" style="margin-right: 3%;"></i>Business Hours: Mon - Fri, 9:00 AM - 6:00 PM</p>
            </div>

            <div class="footer-section quick-links">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="home.html">Home</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Sign Up</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                    <li><a href="faq.html">FAQ</a></li>
                    <li><a href="terms.html">Terms of Service</a></li>
                    <li><a href="privacy.html">Privacy Policy</a></li>
                </ul>
            </div>

            <div class="footer-section follow-us">
                <h2>Follow Us</h2>
                <p>Stay connected through our social media platforms:</p>
                <a href="https://www.facebook.com" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a> 
                <a href="https://www.instagram.com" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a> 
                <a href="https://www.twitter.com" target="_blank">
                    <i class="fab fa-twitter"></i>
                </a><br><br><br>
                <h2>Know more about Prakritis</h2>
                <ul style="list-style-type:disc;margin-left: 10%;">
                    <li><a href="vata.html">Vata</a></li>
                    <li><a href="pitta.html">Pitta</a></li>
                    <li><a href="kapha.html">Kapha</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2024 Ayurguru - All Rights Reserved</p>
        </div>
    </footer>

</body>
</html>
