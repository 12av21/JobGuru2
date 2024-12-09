<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Jobs</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="styles_footer.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .jobs-container {
            margin: 20px auto; /* Center the container */
            width: 80%;
            max-width: 1200px; /* Increase max width for better layout */
        }

        .box-container {
            display: grid; /* Use grid for layout */
            grid-template-columns: repeat(4, 1fr); /* 4 columns */
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

        .job-info {
            margin: 5px 0; /* Space around job info */
        }

        .btn {
            background-color: #4b6cb7;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s;
            display: inline-block; /* Ensures button spacing */
            margin-top: 10px; /* Space above the button */
        }

        .btn:hover {
            background-color: #182848;
        }

        @media (max-width: 768px) {
            .box-container {
                grid-template-columns: repeat(2, 1fr); /* 2 columns on smaller screens */
            }
        }

        @media (max-width: 480px) {
            .box-container {
                grid-template-columns: 1fr; /* 1 column on very small screens */
            }
        }
    </style>
</head>
<body>

    <?php
        include("header.php");
    ?>

    <h1 class="heading">All Job Listings</h1>
    <section class="jobs-container">
        <div class="box-container">
            <?php
            // Database connection
            include("config.php");

            // Fetch all jobs
            $sql = "SELECT id, company_name, job_title, job_type, schedule, job_location, pay, posted_days, image FROM company";
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
                    echo "<a href='apply.php?id=" . $row["id"] . "' class='btn'>Apply now</a>";
                    echo "</div>";
                }
            } else {
                echo "<div class='box'>No job listings available.</div>";
            }

            // Close connection
            $conn->close();
            ?>
        </div>
    </section>

    <?php
        include("footer.php");
    ?>

</body>
</html>
