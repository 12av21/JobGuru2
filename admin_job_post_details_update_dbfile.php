<?php
include("config.php");

// Check if the form is submitted
if (isset($_POST['update_job'])) {

    // Capture form data
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
    $job_title = mysqli_real_escape_string($conn, $_POST['job_title']);
    $job_type = mysqli_real_escape_string($conn, $_POST['job_type']);
    $schedule = mysqli_real_escape_string($conn, $_POST['schedule']);
    $job_location = mysqli_real_escape_string($conn, $_POST['job_location']);
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);
    $posted_days = mysqli_real_escape_string($conn, $_POST['posted_days']);
    
    // Initialize image variable
    $image_path = '';
    
    // Handle image upload if an image is selected
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);

        // Generate a unique name for the image to avoid conflicts
        $new_image_name = 'job_image_' . time() . '.' . $image_ext;
        $upload_dir = 'uploads/';  // Specify the directory for image uploads

        // Check if the image is valid (size and type validation can be added)
        if ($image_size < 5000000 && in_array($image_ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            // Move the uploaded file to the upload directory
            $image_path = $upload_dir . $new_image_name;
            if (move_uploaded_file($image_tmp_name, $image_path)) {
                // Image uploaded successfully
            } else {
                echo "Error uploading image!";
            }
        } else {
            echo "Invalid image file. Ensure the file is under 5MB and of a valid type (jpg, jpeg, png, gif).";
            exit;
        }
    } else {
        // If no new image is uploaded, keep the existing image path (optional)
        $image_path = $_POST['existing_image']; // This field should hold the previous image path
    }

    // SQL query to update the job details in the database
    $update_query = "
        UPDATE company 
        SET 
            company_name = '$company_name',
            job_title = '$job_title',
            job_type = '$job_type',
            schedule = '$schedule',
            job_location = '$job_location',
            pay = '$salary',
            posted_days = '$posted_days',
            image = '$image_path'
        WHERE id = '$user_id'
    ";

    // Execute the query
    if (mysqli_query($conn, $update_query)) {
        // If the update was successful, redirect to the dashboard or success page
        header("Location: admin_job_post_view.php?message=Job updated successfully");
        exit;
    } else {
        // If the update failed, display an error message
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
