<?php

include("includes/header.php");
include("includes/topbar.php");
include("includes/siderbar.php");
include("config.php");

?>

   
    <h2>Upload Job Details</h2>
    <form action="admin_upload_job.php" method="POST" enctype="multipart/form-data">
        <label for="company_name">Company Name:</label>
        <input type="text" name="company_name" id="company_name" required>

        <label for="job_post">Job Post:</label>
        <input type="text" name="job_post" id="job_post" required>

        <label for="job_type">Job Type:</label>
        <select name="job_type" id="job_type" required>
            <option value="Full-Time">Full-Time</option>
            <option value="Part-Time">Part-Time</option>
            <option value="Contract">Contract</option>
            <option value="Internship">Internship</option>
            <option value="Temporary">Temporary</option>
            <option value="Fresher">Fresher</option>
        </select>

        <label for="schedule">Schedule:</label>
        <select name="schedule" id="schedule" required>
            <option value="Morning Shift">Morning Shift</option>
            <option value="Day Shift">Day Shift</option>
            <option value="Night Shift">Night Shift</option>
            <option value="Flexible Shift">Flexible Shift</option>
            <option value="Fixed Shift">Fixed Shift</option>
        </select>

        <label for="job_location">Location:</label>
        <input type="text" name="job_location" id="job_location" required>

        <label for="pay">Pay:</label>
        <input type="text" name="pay" id="pay" required>

        <label for="posted_days">Posted Days:</label>
        <input type="text" name="posted_days" id="posted_days" required>

        <label for="image">Upload Image:</label>
        <input type="file" name="image" id="image" accept="image/*">

        <button type="submit" name="submit">Submit</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        // Database connection
        $conn = new mysqli("localhost", "root", "", "jobguru");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve form data
        $company_name = $_POST['company_name'];
        $job_title = $_POST['job_post']; // Correct variable name
        $job_type = $_POST['job_type'];
        $schedule = $_POST['schedule'];
        $job_location = $_POST['job_location']; // Correct variable name
        $pay = $_POST['pay'];
        $posted_days = $_POST['posted_days'];
        $image = "";

        // Handle image upload
        if (!empty($_FILES['image']['name'])) {
            $image_name = basename($_FILES['image']['name']);
            $target_dir = "img/";
            $target_file = $target_dir . $image_name;

            // Ensure the target directory exists
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image = $target_file;
            } else {
                echo "<div class='error-message'>Error uploading image.</div>";
            }
        }

        // Insert data into database
        $sql = "INSERT INTO company (company_name, job_title, job_type, schedule, job_location, pay, posted_days, image)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Prepare and bind
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            echo "<div class='error-message'>Error preparing statement: " . htmlspecialchars($conn->error) . "</div>";
            exit();
        }
        $stmt->bind_param("ssssssss", $company_name, $job_title, $job_type, $schedule, $job_location, $pay, $posted_days, $image);

        if ($stmt->execute()) {
            echo "<div class='success-message'><h1>New job posted successfully!<h1></div>";
        } else {
            echo "<div class='error-message'>Error: " . htmlspecialchars($stmt->error) . "</div>";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>

<?php

include("includes/footer.php");

?>