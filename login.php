<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles_footer.css">
    <style>
        /* General styling for body and page layout */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4b6cb7, #182848);
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        header {
            flex-shrink: 0; /* Keep header at the top */
        }

        /* Footer */
        footer {
            flex-shrink: 0; /* Keep footer at the bottom */
            background: #182848;
            color: white;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        /* Main container for login form */
        .main-content {
            margin: 50px;
             flex-grow: 1; /* Grow the middle section */
            display: flex;
            justify-content: center; /* Align the form to the center */
            align-items: center;
            padding-bottom: 80px; /* Adjust this to move form further up/down */
        }

        /* Login container styling */
        .login-container {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 15px;
            width: 400px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            animation: slide-in 1s ease-out;

        }
        .login-container p{
            font-size: 16px;
            padding: 10px 20px;
        }

        /* Form input fields styling */
        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 15px;
            margin: 10px 0 20px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        /* Change background and border color when focusing on input fields */
        .login-container input[type="email"]:focus,
        .login-container input[type="password"]:focus {
            border-color: #4b6cb7;
            background: #f0f0f0;
            outline: none;
        }

        /* Submit button styling */
        .login-container input[type="submit"] {
            width: 100%;
            padding: 15px;
            background: #4b6cb7;
            border: none;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        /* Change background and scale effect on hover */
        .login-container input[type="submit"]:hover {
            background: #182848;
            transform: scale(1.05);
        }

        /* Error message styling */
        .error-message {
            color: red;
            margin-top: 20px;
        }

        /* Heading styling */
        .login-container h2 {
            color: #4b6cb7;
            margin-bottom: 30px;
            font-size: 24px;
        }

        /* Animation for sliding in the container */
        @keyframes slide-in {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <?php include("header.php");?>

    <!-- Main content with login form -->
    <div class="main-content">
        <div class="login-container">
            <h2>Login</h2>
            <form action="dblogin.php" method="POST">
                <input type="email" id="email" name="email" placeholder="Email" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
                <p>Does not have an account?
                <a href="register.php">Register</a></p>
            </form>
            
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include("footer.php");?>

</body>
</html>
