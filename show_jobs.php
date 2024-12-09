<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <style>

</head>
<body>

    <h1>Job Listings</h1>
    <div class="jobs-container">
        <div class="box-container">
            <?php
            // Database connection
            $conn = new mysqli("localhost", "root", "", "jobguru");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch data from the `company` table
            $sql = "SELECT id, company_name, job_post, job_type, schedule, address, pay, posted_days, image FROM company";
            $result = $conn->query($sql);

            // Check if there are results
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<div class='job-listing'>";
                    echo "<div class='company'><img src='" . $row["image"] . "' alt='Company Logo'></div>";
                    echo "<h2>" . $row["company_name"] . "</h2>";
                    echo "<div class='job-info'><span>Job Post:</span> " . $row["job_post"] . "</div>";
                    echo "<div class='job-info'><span>Job Type:</span> " . $row["job_type"] . "</div>";
                    echo "<div class='job-info'><span>Schedule:</span> " . $row["schedule"] . "</div>";
                    echo "<div class='job-info'><span>Address:</span> " . $row["address"] . "</div>";
                    echo "<div class='job-info'><span>Salary:</span> " . $row["pay"] . "</div>";
                    echo "<div class='job-info'><span>Posted:</span> " . $row["posted_days"] . " days ago</div>";
                    echo "<a href='view_job.php?id=" . $row["id"] . "' class='view-details-btn'>View Details</a>";
                    echo "</div>";
                }
            } else {
                echo "<div class='job-listing'>No job listings available.</div>";
            }

            // Close connection
            $conn->close();
            ?>
        </div>
    </div>

</body>
</html>
