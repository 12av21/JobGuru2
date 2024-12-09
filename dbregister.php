<?php
// Include the database configuration file
include("config.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and handle SQL injection
    $username = $conn->real_escape_string($_POST['username']);
    $phoneno = $conn->real_escape_string($_POST['phoneno']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['conformpassword']);

    // Check if the passwords match
    if ($password != $confirm_password) {
        echo "Passwords do not match!";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL query to insert data
        $sql = "INSERT INTO users (username, phoneno, email, password) VALUES (?, ?, ?, ?)";

        // Prepare the SQL statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("ssss", $username, $phoneno, $email, $hashed_password);

            // Execute the statement
            if ($stmt->execute()) {
                header("Location: login.php");
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            // If prepare() fails, output the error
            echo "Error in SQL statement preparation: " . $conn->error;
        }
    }
}

// Close the database connection at the end of the script
$conn->close();
?>
