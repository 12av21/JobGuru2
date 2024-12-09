<?php


// Start session to access session variables (if necessary)
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['logged_in'])) {
    header("Location: admin_login.php"); // Redirect to login page if not logged in
    exit();
}

include("includes/header.php");
include("includes/topbar.php");
include("includes/siderbar.php");
include("config.php");
// Define variables
$old_password = $new_password = $confirm_password = "";
$old_password_err = $new_password_err = $confirm_password_err = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate old password
    if (empty(trim($_POST["old_password"]))) {
        $old_password_err = "Please enter your old password.";
    } else {
        $old_password = trim($_POST["old_password"]);
    }

    // Validate new password
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Please enter a new password.";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Password must have at least 6 characters.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm your new password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if ($new_password !== $confirm_password) {
            $confirm_password_err = "Passwords do not match.";
        }
    }

    // Check for errors before updating the password
    if (empty($old_password_err) && empty($new_password_err) && empty($confirm_password_err)) {

        // Fetch the current password from the database
        $sql = "SELECT password FROM admin WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $_SESSION['id']); // Assuming admin_id is stored in session
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($stored_password);
                    $stmt->fetch();

                    // Verify the old password (without hashing)
                    if ($old_password === $stored_password) {

                        // Update the password (without hashing)
                        $update_sql = "UPDATE admin SET password = ? WHERE id = ?";
                        if ($update_stmt = $conn->prepare($update_sql)) {
                            $update_stmt->bind_param("si", $new_password, $_SESSION['id']);
                            if ($update_stmt->execute()) {
                                echo "<div class='alert alert-success'>Password updated successfully.</div>";
                            } else {
                                echo "<div class='alert alert-danger'>Error updating password. Please try again later.</div>";
                            }
                        }
                    } else {
                        $old_password_err = "The old password is incorrect.";
                    }
                }
            }
        }
    }
}

?>
 

<div class="container mt-5">
    <h2>Update Password</h2>
    <p align="center">Please fill in your old password and the new password details to update your password.</p>

    <!-- Display any error messages -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($old_password_err)) ? 'has-error' : ''; ?>">
            <label for="old_password">Old Password</label>
            <input type="password" name="old_password" class="form-control" value="<?php echo $old_password; ?>">
            <span class="help-block text-danger"><?php echo $old_password_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
            <label for="new_password">New Password</label>
            <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
            <span class="help-block text-danger"><?php echo $new_password_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label for="confirm_password">Confirm New Password</label>
            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
            <span class="help-block text-danger"><?php echo $confirm_password_err; ?></span>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-info">Update Password</button>
        </div>
    </form>

</div>
<?php

include("includes/footer.php");

?>
