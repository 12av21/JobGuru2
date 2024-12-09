<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles_footer.css">
    <link rel="stylesheet" href="dwopdown.css"> <!-- Link to your CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            
        }

        .job-container {
            width: 80%;
            max-width: 800px;
            background-color: #fff;
            border-radius: 10px;
            margin: 20px 0;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .job-title {
            font-size: 20px;
            font-weight: bold;
        }

        .job-details {
            margin: 10px 0;
            color: #555;
        }

        .apply-btn {
            background-color: #4b6cb7;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            text-align: center;
        }

        .apply-btn:hover {
            background-color: #182848;
        }
    </style>
</head>
<body>
<?php include("header.php");?>

    <h1>Available Job Listings</h1>

    <?php
   include("config.php");

    // Fetch job details from the database
    $sql = "SELECT * FROM job_details LIMIT 1 ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display each job listing
        while($row = $result->fetch_assoc()) {
            echo "<div class='job-container'>";
            echo "<div class='job-title'>" . $row["company_name"] . " - " . $row["employment_type"] . "</div>";
            echo "<div class='job-details'><strong>Location:</strong> " . $row["location"] . "</div>";
            echo "<div class='job-details'><strong>Salary:</strong> " . $row["salary_range"] . "</div>";
            echo "<div class='job-details'><strong>Shift:</strong> " . $row["shift"] . "</div>";
            echo "<div class='job-details'><strong>Description:</strong> " . $row["job_description"] . "</div>";
            echo "<div class='job-details'><strong>Requirements:</strong> " . $row["requirements"] . "</div>";
            echo "<div class='job-details'><strong>Benefits:</strong> " . $row["benefits"] . "</div>";
            echo "<a href='apply.php?job_id=" . $row["id"] . "' class='apply-btn'>Apply Now</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No job listings available.</p>";
    }

    $conn->close();
    ?>
<?php include("footer.php");?>
</body>
</html>
