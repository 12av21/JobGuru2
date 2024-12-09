<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

// Database connection
include("config.php");

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get job ID and applicant details from the form
    $job_id = $_POST['job_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $mobile_no = $_POST['mobile_no'];
    $resume = $_FILES['resume'];

    // Handle file upload
    $resume_name = $resume['name'];
    $resume_tmp_name = $resume['tmp_name'];
    $resume_error = $resume['error'];
    $resume_size = $resume['size']; // Size of the file in bytes

    // Check if there were any errors in the file upload
    if ($resume_error === 0) {
        // Check if the file is a PDF
        $resume_ext = pathinfo($resume_name, PATHINFO_EXTENSION);
        $allowed_extensions = ['pdf'];

        if (in_array(strtolower($resume_ext), $allowed_extensions)) {
            // Check the file size (5MB = 5 * 1024 * 1024 bytes)
            if ($resume_size <= 5 * 1024 * 1024) {
                // Generate a unique name for the uploaded resume
                $resume_new_name = uniqid('', true) . '.' . $resume_ext;
                $resume_upload_path = 'uploads/' . $resume_new_name;

                // Move the uploaded file to the specified directory
                if (move_uploaded_file($resume_tmp_name, $resume_upload_path)) {
                    // Insert application details into the database
                    $sql = "INSERT INTO applications (job_id, full_name, email, mobile_no, resume) 
                            VALUES (?, ?, ?, ?, ?)";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("issss", $job_id, $full_name, $email, $mobile_no, $resume_upload_path);
                    
                    if ($stmt->execute()) {
                        echo "
                        <script>
                            alert('Application submitted successfully!');
                            window.location.href = 'jobs.php';
                        </script>
                        ";
                    } else {
                        echo "Error: Could not submit application.";
                    }
                } else {
                    echo "Error: Could not upload resume.";
                }
            } else {
                echo "Error: Resume size exceeds the 5MB limit.";
            }
        } else {
            echo "Error: Only PDF files are allowed for resume.";
        }
    } else {
        echo "Error: There was an issue with the resume upload.";
    }

    // Close the connection
    $conn->close();
}
?>
