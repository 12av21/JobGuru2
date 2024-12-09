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

// Handle form submission for updating the profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $password; // Only update if password is provided

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);

        // Check if the image is a valid type (e.g., jpg, jpeg, png)
        $allowed_exts = ['jpg', 'jpeg', 'png'];
        if (in_array(strtolower($image_ext), $allowed_exts) && $image_size <= 5000000) { // max size 5MB
            $image_path = 'uploads/' . uniqid() . '.' . $image_ext;
            move_uploaded_file($image_tmp, $image_path);
        }
    }

    // Update the database with the new details
    $update_sql = "UPDATE users SET username = ?, email = ?, phone = ?, password = ?, dob = ?, address = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssssssi", $username, $email, $phone, $password, $dob, $address, $image_path, $user_id);
    $stmt->execute();
    $stmt->close();

    // Redirect back to the profile page to see the changes
    header("Location: user_profile.php");
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
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
        .input-field {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .submit-button {
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
        .submit-button:hover {
            background-color: #182848;
        }
        .logout-button {
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
        .logout-button:hover {
            background-color: #182848;
        }
    </style>
</head>
<body>
    <?php
    include("header.php");
    ?>

<div class="profile-container">
    <h2>Update Your Profile</h2>
    <form action="update_profile.php" method="POST" enctype="multipart/form-data">
        

        <div class="profile-info">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" class="input-field" value="<?php echo htmlspecialchars($username); ?>" required>
        </div>

        <div class="profile-info">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="input-field" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>

        <div class="profile-info">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" class="input-field" value="<?php echo htmlspecialchars($phone); ?>" required>
        </div>

    

        <div class="profile-info">
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" class="input-field" value="<?php echo htmlspecialchars($dob); ?>" required>
        </div>

        <div class="profile-info">
            <label for="address">Address:</label>
            <textarea id="address" name="address" class="input-field" rows="4" required><?php echo htmlspecialchars($address); ?></textarea>
        </div>

        <div class="profile-info">
            <label for="image">Profile Image:</label>
            <input type="file" id="image" name="image" class="input-field">
            <?php if ($image_path): ?>
                <p><img src="<?php echo $image_path; ?>" alt="Profile Image" width="100"></p>
            <?php endif; ?>
        </div>

        <button type="submit" class="submit-button">Update Profile</button>
    </form>

    <button type="button" class="logout-button" onclick="window.history.back();">Go Back</button>
    <a href="logout.php" class="logout-button">Logout</a>
</div>

<?php
    include("footer.php");
    ?>
</body>
</html>
