<?php
session_start(); // Start the session to access session variables

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Database connection
include("config.php");

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Fetch user details from the database
$sql = "SELECT id, username, email, phone, password, created_at, image, dob, address FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id); // Bind user ID as an integer
$stmt->execute();
$stmt->bind_result($id, $username, $email, $phone, $password, $created_at, $image_path, $dob, $address);
$stmt->fetch();
$stmt->close();

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles_footer.css">
    <link rel="stylesheet" href="dwopdown.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .profile-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #4b6cb7;
        }
        .profile-info {
            margin: 15px 0;
        }
        .profile-info label {
            font-weight: bold;
        }
        .profile-info p {
            font-size: 16px;
        }
        .profile-image {
            text-align: center;
            margin: 15px 0;
        }
        .profile-image img {
            max-width: 150px;
            border-radius: 50%;
        }
        .back-button {
            display: block;
            background-color: #4b6cb7;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            margin: 20px auto;
            width: fit-content;
        }
        .back-button:hover {
            background-color: #182848;
        }
    </style>
</head>
<body>

<?php
    include("header.php");
    ?>
<div class="profile-container">
    <h2>User Profile</h2>

    <!-- Display User Profile Image -->
    <div class="profile-image">
        <?php if ($image_path): ?>
            <img src="<?php echo $image_path; ?>" alt="Profile Image">
        <?php else: ?>
            <img src="default-avatar.png" alt="Default Profile Image">
        <?php endif; ?>
    </div>

    <!-- Display User Information -->
    <div class="profile-info">
        <label for="username">Username:</label>
        <p><?php echo htmlspecialchars($username); ?></p>
    </div>

    <div class="profile-info">
        <label for="email">Email:</label>
        <p><?php echo htmlspecialchars($email); ?></p>
    </div>

    <div class="profile-info">
        <label for="phone">Phone Number:</label>
        <p><?php echo htmlspecialchars($phone); ?></p>
    </div>

    <div class="profile-info">
        <label for="dob">Date of Birth:</label>
        <p><?php echo htmlspecialchars($dob); ?></p>
    </div>

    <div class="profile-info">
        <label for="address">Address:</label>
        <p><?php echo nl2br(htmlspecialchars($address)); ?></p>
    </div>

    <div class="profile-info">
        <label for="created_at">Account Created On:</label>
        <p><?php echo htmlspecialchars($created_at); ?></p>
    </div>

    <!-- Back Button -->
    <a href="update_profile.php" class="back-button">Update Profile</a>
</div>

<?php
    include("footer.php");
    ?>
</body>
</html>
