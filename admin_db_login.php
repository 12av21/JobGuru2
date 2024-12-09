<?php
session_start(); // Start a session to manage user login state

// Database connection
include("config.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to prevent SQL injection
    // Now we also select the username, password, and id
    $stmt = $conn->prepare("SELECT name, password, id FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if admin exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($username, $db_password, $user_id); // Fetch username and password
        $stmt->fetch();

        // Directly compare the password (NO hashing in this example)
        if ($password === $db_password) {
            // Password is correct, set session variables and redirect
            $_SESSION['logged_in'] = true;
            $_SESSION['name'] = $username; // Set the username fetched from the database
            $_SESSION['id'] = $user_id;
            $_SESSION['email'] = $email; // You can store other user info if needed
            header("Location: admin_index.php"); // Redirect to home page
            exit();
        } else {
            echo"
        <script>
            alert('INVALID USERNAME OR PASSWORD');
            window.location.href='admin_login.php';
        </script>
    ";
        }
    } else {
        echo"
        <script>
            alert('INVALID USERNAME OR PASSWORD');
            window.location.href='admin_login.php';
        </script>
    ";
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!-- Optional HTML for displaying error messages -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Error</title>
    <link rel="stylesheet" href="style.css"> <!-- Include your styles -->
</head>
<body>
    <div class="error-message">
        <?php if (isset($error_message)) echo $error_message; ?>
    </div>
    <p><a href="admin_login.php">Go back to login</a></p>
</body>
</html>
