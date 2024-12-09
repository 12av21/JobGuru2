<?php
session_start();
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = $_POST['otp'];

    // Validate OTP
    if ($otp == $_SESSION['otp']) {
        header("Location: complete_registration.php");
        exit();
    } else {
        $message = "Invalid OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
</head>
<body>
    <h2>Verify OTP</h2>
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" required>
        <button type="submit">Verify OTP</button>
    </form>
</body>
</html>
