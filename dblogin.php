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
    // Now we also select the username in addition to password and id
    $stmt = $conn->prepare("SELECT username, password, id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($username, $hashed_password, $user_id); // Fetch username as well
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, set session variables and redirect
            $_SESSION['logged_in'] = true; 
            $_SESSION['username'] = $username; // Set the username fetched from the database
            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] = $email; // You can store other user info if needed
            header("Location: home.php"); // Redirect to home page
            exit();
        } else {
            // Password is incorrect
            echo"
                <script>
                    alert('INVALID USERNAME OR PASSWORD');
                    window.location.href='login.php';
                </script>
            ";
        }
    } else {
        // User does not exist
        echo"
        <script>
            alert('INVALID USERNAME OR PASSWORD');
            window.location.href='login.php';
        </script>
    ";
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>


