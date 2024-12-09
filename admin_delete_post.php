<?php
include("config.php");

// Check if the user_id is provided in the URL
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Prepare the SQL query to delete the user
    $sql = "DELETE FROM company WHERE id = ?";

    // Using prepared statement to avoid SQL injection
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id); // "i" means the parameter is an integer

        if ($stmt->execute()) {
            // If the deletion is successful, redirect back to the users list page
            header("Location: admin_job_post_view.php"); // Change this to your actual page
            exit;
        } else {
            echo "Error deleting user: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "No user ID provided.";
}

$conn->close();
?>
