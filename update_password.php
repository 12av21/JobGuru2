<?php
session_start(); // Start the session to access session variables

// Database connection
$conn = new mysqli("localhost", "root", "", "jobguru"); // Update with your DB credentials

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if (isset($_POST['submit'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate password match
    if ($new_password !== $confirm_password) {
        $message = "Passwords do not match.";
    } else {
        // Check if the email and phone match a user in the database
        $sql = "SELECT id FROM users WHERE email = ? AND phone = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $phone);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Email and phone match, update the password
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT); // Hash the new password
            $sql_update = "UPDATE users SET password = ? WHERE email = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("ss", $hashed_password, $email);
            if ($stmt_update->execute()) {
                $message = "Password updated successfully!";
            } else {
                $message = "Error updating password. Please try again.";
            }
            $stmt_update->close();
        } else {
            $message = "Email or phone number does not match.";
        }

        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .update-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #4b6cb7;
        }
        .form-group {
            margin: 10px 0;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="email"],
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4b6cb7;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #182848;
        }
        .message {
            text-align: center;
            margin-top: 20px;
            color: red;
        }

        .logout-button{
            top: 10px;
            background-color: #4b6cb7;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        .logout-button:hover{
            background-color: #182848;
        }
    </style>
</head>
<body>

<div class="update-container">
    <h2>Update Password</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <input type="submit" name="submit" value="Update Password">
        <button type="button" class="logout-button" onclick="window.history.back();"> Go Back </button>
    
    </form>


    <?php if ($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
</div>

</body>
</html>
