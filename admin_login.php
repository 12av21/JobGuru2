<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        /* General reset for margin, padding, and font */
        body, h2, form {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Full page background */
        body {
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container for the login form */
        .login-form {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        /* Heading styling */
        h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        /* Label styling */
        label {
            display: block;
            text-align: left;
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        /* Input fields styling */
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        /* Button styling */
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Hover effect for button */
        button:hover {
            background-color: #45a049;
        }

        /* Responsive styling */
        @media screen and (max-width: 400px) {
            .login-form {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <!-- Main content with login form -->
    <div class="login-form">
        <h2>Admin Login</h2>
        <form action="admin_db_login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
