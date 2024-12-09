<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles_footer.css">
    <link rel="stylesheet" href="dwopdown.css">
    
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4b6cb7, #182848);
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Distribute space between header, content, and footer */
            align-items: center; /* Center the content horizontally */
        }

        /* Header */
        header {
            width: 100%;
            background-color: #182848;
            color: white;
            padding: 5px;
            text-align: center;
            font-size: 12px;
        }

        /* About Us Section Title */
        .section-title {
            background-color: #182848;
            color: white;
            padding: 15px;
            text-align: center;
            width: 100%;
            font-size: 24px;
        }

        /* Footer */
        footer {
            flex-shrink: 0; /* Keep footer at the bottom */
            background: #182848;
            color: white;
            text-align: center;
            padding: 10px;
            width: 100%;
        }

        /* Contact Info section */
        .contact-info-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 20px 0;
            width: 100%;
            max-width: 800px;
            padding: 0 15px;
        }

        .contact-info {
            flex: 1;
            min-width: 250px;
            margin: 10px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .contact-info i {
            font-size: 24px;
            color: #4b6cb7;
            margin-bottom: 10px;
        }

        .contact-info h4 {
            margin: 10px 0;
            font-size: 18px;
            color: #333;
        }

        .contact-info p {
            margin: 0;
            font-size: 16px;
            color: #555;
        }

        /* Contact form container */
        .contact-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: 20px 0;
        }

        /* Contact form heading */
        .contact-container h2 {
            color: #4b6cb7;
            margin-bottom: 30px;
            font-size: 28px;
        }

        /* Form styling */
        .contact-container form {
            display: flex;
            flex-direction: column;
        }

        /* Input fields and textarea */
        .contact-container input[type="text"],
        .contact-container input[type="email"],
        .contact-container input[type="tel"],
        .contact-container input[type="text"],
        .contact-container textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }

        /* Textarea styling */
        .contact-container textarea {
            height: 150px;
            resize: none;
        }

        /* Submit button */
        .contact-container input[type="submit"] {
            background: #4b6cb7;
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        /* Submit button hover effect */
        .contact-container input[type="submit"]:hover {
            background: #182848;
        }

        /* Responsive layout */
        @media (max-width: 768px) {
            .contact-info-container {
                flex-direction: column;
                align-items: center;
            }

            .contact-info {
                min-width: 100%;
            }

            .contact-container {
                padding: 20px;
            }

            .contact-container h2 {
                font-size: 24px;
            }

            .contact-container input[type="text"],
            .contact-container input[type="email"],
            .contact-container input[type="tel"],
            .contact-container textarea {
                font-size: 14px;
            }

            .contact-container input[type="submit"] {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Include header -->
    <?php include("header.php"); ?>

    <!-- About Us Section -->
    <div class="section-title">Contact Us</div>

    <!-- Contact Info Section -->
    <div class="contact-info-container">
        <div class="contact-info">
            <i class="fas fa-phone"></i>
            <h4>Phone</h4>
            <p>+917348537852</p>
        </div>
        <div class="contact-info">
            <i class="fas fa-envelope"></i>
            <h4>Email</h4>
            <p>jobguru@gmail.com</p>
        </div>
        <div class="contact-info">
            <i class="fas fa-map-marker-alt"></i>
            <h4>Location</h4>
            <p>Rambhag, prayagraj,Utter pradesh</p>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="contact-container">
        <h2>Drop your message</h2>
        <form action="https://api.web3forms.com/submit" method="POST">
            <input type="hidden" name="access_key" value="b826efdc-b75a-40fc-b5b7-5e816ae1adee">

            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="tel" name="phone" placeholder="Your Mobile Number" required>
            <input type="text" name="role" placeholder="Your Role" required> <!-- Role input -->
            <textarea name="message" placeholder="Enter your message here..." required></textarea>
            <input type="submit" value="Send Message">
        </form>
    </div>

    <!-- Include footer -->
    <?php include("footer.php"); ?>

    <!-- FontAwesome for icons (if using the library, otherwise remove) -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
