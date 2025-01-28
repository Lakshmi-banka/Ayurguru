<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // default XAMPP username
$password = ""; // default XAMPP password is blank
$dbname = "ayurguru";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Check if the email exists
    $check_email_sql = "SELECT * FROM registration WHERE email='$email'";
    $result = $conn->query($check_email_sql);

    if ($result->num_rows == 0) {
        // Email does not exist
        $error_message = "Email does not exist. Please sign up.";
    } else {
        // Email exists, fetch user data
        $row = $result->fetch_assoc();
        // Check if password matches (no hashing in this case)
        if ($password !== $row['password']) {
            // Incorrect password
            $error_message = "Incorrect password. Please try again.";
        } else {
            // Password is correct, redirect to profile page
            $_SESSION['email'] = $email;
            header("Location: profile.html");
            exit();
        }
    }
}

$conn->close();
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
            min-height: 80vh;
        }
        
        /* Left Side - Image */
        .image-section {
            flex: 0.7;
            
        }
        .image-section img{
            margin-top:5%;
            height:90%;
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
            max-width: 400px;
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
        .login-content{
            margin-top:-10px;
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
                <img src="https://www.snehadipayurveda.com/wp-content/uploads/2020/04/Ayurveda.png" alt="signup">
            </div>
            <div class="form-section">
                <div class="form-box">
                    <h1 class="section-title">Login</h1>
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <button type="submit">Login</button><br>
                    </form>
                    <?php if (!empty($error_message)): ?>
                        <div style="color: red; margin-top: -25px;margin-bottom: 10px;text-align: center;"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    <div class="login-content">
                        <p>Don't have an account? <a href="signup.php">Sign Up here</a>.</p>
                    </div>
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
