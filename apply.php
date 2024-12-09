<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

// Get job id from the URL
if (isset($_GET['id'])) {
    $job_id = $_GET['id'];

    // Database connection
    include("config.php");

    // Fetch job details from the database
    $sql = "SELECT * FROM company WHERE id = " . (int)$job_id;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $job_details = $result->fetch_assoc();
    } else {
        echo "Job not found.";
        exit();
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles_footer.css">
    <link rel="stylesheet" href="dwopdown.css">
    <style>
        /* Basic reset */
        body, h2, form, div {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"], input[type="email"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="file"] {
            padding: 5px;
            border: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        @media (max-width: 768px) {
            form {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<?php include("header.php"); ?>

<h2>Apply for <?php echo $job_details['job_title']; ?> at <?php echo $job_details['company_name']; ?></h2>

<form action="submit_application.php" method="POST" enctype="multipart/form-data">
    <!-- Hidden field to store job ID -->
    <input type="hidden" name="job_id" value="<?php echo $job_details['id']; ?>">

    <div>
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" id="full_name" required>
    </div>
    <div>
        <label for="email">Email ID:</label>
        <input type="email" name="email" id="email" required>
    </div>
    <div>
        <label for="mobile_no">Mobile Number:</label>
        <input type="text" name="mobile_no" id="mobile_no" required>
    </div>
    <div>
        <label for="resume">Upload Resume (PDF only 5MB maximum):</label>
        <input type="file" name="resume" id="resume" accept="application/pdf" required>
    </div>

    <button type="submit">Apply Now</button>
</form>

<?php include("footer.php"); ?>
</body>
</html>
