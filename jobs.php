<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Filter</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="styles_footer.css">
    <link rel="stylesheet" href="dwopdown.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            
        }

        .filter-container {
            background-color: #fff;
            padding: 20px;
            margin: 20px auto; /* Center the container */
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
        }

        .filter-container h2 {
            margin-bottom: 20px;
        }

        .filter-container select,
        .filter-container input {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
        }

        .filter-container input[type="submit"] {
            background-color: #4b6cb7;
            color: white;
            border: none;
            cursor: pointer;
        }

        .filter-container input[type="submit"]:hover {
            background-color: #182848;
        }

        .jobs-container {
            margin: 20px auto; /* Center the container */
            width: 80%;
            max-width: 800px;
        }

        .box-container {
            display: grid; /* Use grid for layout */
            grid-template-columns: repeat(2, 1fr); /* 2 columns */
            gap: 20px; /* Space between items */
            margin-top: 20px; /* Space above the job listings */
        }

        .box {
            background-color: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            position: relative; /* For positioning inner elements */
        }

        .company {
            display: flex; /* Flexbox for company info */
            align-items: center; /* Center vertically */
        }

        .company img {
            width: 50px; /* Adjust company logo size */
            height: 50px; /* Adjust company logo size */
            margin-right: 10px; /* Space between logo and text */
            border-radius: 50%; /* Optional: make it circular */
        }

        .job-title {
            margin: 10px 0; /* Space around the job title */
        }

        .location {
            color: #777; /* Slightly lighter color for location */
        }

        .tags {
            display: flex; /* Flexbox for tags */
            justify-content: space-between; /* Space out tags */
            margin: 10px 0; /* Space above and below tags */
        }

        .flex-btn {
            display: flex; /* Flexbox for buttons */
            justify-content: space-between; /* Space between buttons */
            margin-top: 10px; /* Space above buttons */
        }

        .btn {
            background-color: #4b6cb7;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #182848;
        }

        @media (max-width: 768px) {
            .box-container {
                grid-template-columns: repeat(2, 1fr); /* Change to 2 columns on smaller screens */
            }
        }

        @media (max-width: 480px) {
            .box-container {
                grid-template-columns: 1fr; /* Change to 1 column on very small screens */
            }
        }

        .view-all {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body >

    <?php
        include("header.php");
    ?>

    <h1 class="heading">Job Filter</h1>
    <div class="filter-container">
        <form id="job-filter-form" method="GET">
            <label for="job-title">Job Title</label>
            <input type="text" id="job-title" name="job-title" placeholder="e.g., Software Engineer">

            <label for="location">Location</label>
            <input type="text" id="location" name="location" placeholder="e.g., New York">

            <label for="days">Days Posted</label>
            <select id="days" name="days">
                <option value="any">Any Time</option>
                <option value="1">Last 24 hours</option>
                <option value="7">Last 7 days</option>
                <option value="30">Last 30 days</option>
            </select>


            <label for="job-type">Job Type</label>
            <select id="job-type" name="job-type">
                <option value="any">Any Type</option>
                <option value="full-time">Full-Time</option>
                <option value="part-time">Part-Time</option>
                <option value="contract">Contract</option>
                <option value="internship">Internship</option>
            </select>

            <label for="work-shift">Work Shift</label>
            <select id="work-shift" name="work-shift">
                <option value="any">Any Shift</option>
                <option value="day">Day Shift</option>
                <option value="night">Night Shift</option>
            </select>

            <input type="submit" value="Filter Jobs">
        </form>
    </div>

    <section class="jobs-container">
        <h1 class="heading">Job Listings</h1>
        <div class="box-container">
            <?php
            // Database connection
            include("config.php");

            // Capture filter values
            $jobTitle = isset($_GET['job-title']) ? $_GET['job-title'] : '';
            $location = isset($_GET['location']) ? $_GET['location'] : '';
            $days = isset($_GET['days']) ? $_GET['days'] : 'any';
            $salaryMin = isset($_GET['salary-min']) ? $_GET['salary-min'] : '';
            $salaryMax = isset($_GET['salary-max']) ? $_GET['salary-max'] : '';
            $jobType = isset($_GET['job-type']) ? $_GET['job-type'] : 'any';
            $workShift = isset($_GET['work-shift']) ? $_GET['work-shift'] : 'any';

            // Base SQL query
            $sql = "SELECT id, company_name, job_title, job_type, schedule, job_location, pay, posted_days, image FROM company WHERE 1=1";

            // Apply filters to the SQL query
            if ($jobTitle) {
                $sql .= " AND job_title LIKE '%" . $conn->real_escape_string($jobTitle) . "%'";
            }

            if ($location) {
                $sql .= " AND job_location LIKE '%" . $conn->real_escape_string($location) . "%'";
            }

            if ($days !== 'any') {
                $sql .= " AND posted_days <= " . (int)$days;
            }

            if ($salaryMin) {
                $sql .= " AND pay >= " . (int)$salaryMin;
            }

            if ($salaryMax) {
                $sql .= " AND pay <= " . (int)$salaryMax;
            }

            if ($jobType !== 'any') {
                $sql .= " AND job_type = '" . $conn->real_escape_string($jobType) . "'";
            }

            if ($workShift !== 'any') {
                $sql .= " AND schedule = '" . $conn->real_escape_string($workShift) . "'";
            }

            // Limit results (optional)
            $sql .= " LIMIT 6"; // Fetch first 6 results

            // Execute query
            $result = $conn->query($sql);

            // Check if there are results
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<div class='box'>";
                    echo "<div class='company'><img src='" . $row["image"] . "' alt='Company Logo'></div>";
                    echo "<h2 class='job-title'>" . $row["company_name"] . "</h2>";
                    echo "<div class='job-info'><span>Job title:</span> " . $row["job_title"] . "</div>";
                    echo "<div class='job-info'><span>Job Type:</span> " . $row["job_type"] . "</div>";
                    echo "<div class='job-info'><span>Schedule:</span> " . $row["schedule"] . "</div>";
                    echo "<div class='job-info'><span>Location:</span> " . $row["job_location"] . "</div>";
                    echo "<div class='job-info'><span>Salary:</span> " . $row["pay"] . "</div>";
                    echo "<div class='job-info'><span>Posted:</span> " . $row["posted_days"] . " days ago</div>";
                    echo "<a href='apply.php?id=" . $row["id"] . "' class='btn'>Apply Now</a>";
                    echo "</div>";
                }
            } else {
                echo "<div class='box'>No job listings match your criteria.</div>";
            }

            // Close connection
            $conn->close();
            ?>
        </div>

        <!-- View All Button -->
        <div class="view-all">
            <a href="view_all_jobs.php" class="btn">View All Jobs</a>
        </div>
    </section>

    

    <?php
        include("footer.php");
    ?>

</body>
</html>
