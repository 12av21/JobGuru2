
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles_footer.css">
    <link rel="stylesheet" href="dwopdown.css">
    <style>
        /* Additional CSS for the job search results */
        .job-results {
            margin-top: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .job-item {
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .job-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .job-item h4 {
            color: #4b6cb7; /* Change job title color */
            margin: 0;
        }

        .job-item p {
            margin: 5px 0;
            color: #555555; /* Subtle color for text */
        }

        .job-item .apply-button {
            display: inline-block;
            background-color: #4b6cb7;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .job-item .apply-button:hover {
            background-color: #182848;
        }

        /* Additional CSS for the no results message */
        .no-results {
            background-color: #f8d7da; /* Light red background */
            color: #721c24; /* Dark red text */
            padding: 15px; /* Padding for better spacing */
            border: 1px solid #f5c6cb; /* Border color */
            border-radius: 8px; /* Rounded corners */
            margin-top: 20px; /* Space above the message */
            position: relative; /* Position for absolute elements */
            text-align: center; /* Center the text */
        }

        .dismiss-button {
            background-color: #721c24; /* Dark red for the button */
            color: white; /* White text */
            border: none; /* No border */
            border-radius: 5px; /* Rounded corners */
            padding: 5px 10px; /* Padding */
            cursor: pointer; /* Pointer on hover */
            margin-top: 10px; /* Space above the button */
            transition: background-color 0.3s; /* Smooth transition */
        }

        .dismiss-button:hover {
            background-color: #a71d2a; /* Darker red on hover */
        }
    </style>
</head>

<body>

    <?php include("header.php");?>

    <div class="home-container">
        <section class="home">
            <form action="" method="post">
                <h3>Find Your Next Job</h3>
                <p>Job Title<span>*</span></p>
                <input type="text" name="title" placeholder="keyword, category or company" required maxlength="20" class="input">
                <p>Job Location</p>
                <input type="text" name="location" placeholder="city, state or country" required maxlength="50" class="input">
                <input type="submit" value="Search Job" name="search" class="btn">
            </form>

            <?php
            // Include database connection file
            include("config.php");

            if (isset($_POST['search'])) {
                $title = $_POST['title'];
                $location = $_POST['location'];

                // Prepare and execute the SQL statement
                $sql = "SELECT * FROM company WHERE job_title LIKE ? AND job_location LIKE ?";
                $stmt = $conn->prepare($sql);
                $title = "%" . $title . "%"; // Use wildcard for partial matches
                $location = "%" . $location . "%";
                $stmt->bind_param("ss", $title, $location);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if any jobs were found
                if ($result->num_rows > 0) {
                    echo "<h3>Search Results:</h3>";
                    echo "<div class='job-results'>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='job-item'>";
                        echo "<h4>" . $row['job_title'] . "</h4>";
                        echo "<p><strong>Location:</strong> " . $row['job_location'] . "</p>";
                        echo "<p><strong>Company:</strong> " . $row['company_name'] . "</p>";
                        echo "<p><strong>Salary:</strong> $" . $row['pay'] . "</p>";
                        echo "<p><strong>Posted on:</strong> " . $row['posted_days'] . "</p>";
                        echo "<a href='apply.php?id=" . $row['id'] . "' class='apply-button'>Apply Now</a>"; // Link to apply page
                        echo "</div>";
                    }
                    echo "</div>";
                } else {
                    // Display the no results message with dismiss option
                    echo "<div class='no-results'>";
                    echo "<p>No jobs found matching your criteria.</p>";
                    echo "<button class='dismiss-button' onclick='this.parentElement.style.display=\"none\";'>✖ Dismiss</button>";
                    echo "</div>";
                }

                // Close the statement
                $stmt->close();
            }

            // Close the database connection
            $conn->close();
            ?>
        </section>
    </div>

    <?php include("footer.php");?>

    <script src="script.js"></script>
</body>

</html>
