<?php 
session_start();
include 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // PHPMailer autoload

$message = '';
$otpMessage = '';

// Clear OTP session data only on a fresh GET request
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    unset($_SESSION['otp']);
    unset($_SESSION['otp_generated']);
}

// Handle POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if email is already registered
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Handle OTP generation
    if (isset($_POST['generate_otp'])) {
        if ($result->num_rows > 0) {
            $message = "This email is already registered. Please log in instead.";
        } else {
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['email'] = $email;  // Store email in session
            $_SESSION['otp_generated'] = true;

            // Send OTP via email
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'adarshverma7376@gmail.com';  // Replace with your email
                $mail->Password = 'jmuecalvtlmwnkpb';  // Replace with your email app password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('adarshverma7376@gmail.com', 'OTP Service');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Your OTP Code';
                $mail->Body = "Your OTP code is: <b>$otp</b>";

                $mail->send();
                $otpMessage = "OTP sent! Please check your email.";
            } catch (Exception $e) {
                $otpMessage = "Error: Could not send OTP. Mailer Error: {$mail->ErrorInfo}.";
            }
        }
    }

    // Handle registration
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $otp = $_POST['otp'];

        if ($otp != $_SESSION['otp']) {
            $otpMessage = "Invalid OTP!";
        } else if ($password != $confirm_password) {
            $message = "Passwords do not match!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss", $name, $_SESSION['email'], $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['name'] = $name;
                unset($_SESSION['otp']);
                unset($_SESSION['email']);
                unset($_SESSION['otp_generated']);
                
                echo"
                <script>
                    alert('Registation Successfull!!!');
                    window.location.href='login.php';
                </script>
                ";
                
                exit();
            } else {
                $message = "Error: Could not register.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration with OTP</title>
    <link rel="stylesheet" href="registration.css">
</head>
<body>
    <div class="form-container">
        <h2> Registration</h2>
        <?php if ($message): ?>
            <div class="alert"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if ($otpMessage): ?>
            <div class="alert alert-info"><?php echo $otpMessage; ?></div>
        <?php endif; ?>

        <!-- Registration Form -->
        <form method="POST">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" required class="form-control" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" <?php echo isset($_SESSION['otp_generated']) ? 'readonly' : ''; ?>>

            <?php if (!isset($_SESSION['otp_generated'])): ?>
                <button type="submit" name="generate_otp" class="btn">Generate OTP</button>
            <?php else: ?>
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" required class="form-control">

                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" required class="form-control">

                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required class="form-control">

                <label for="otp" class="form-label">OTP</label>
                <input type="text" id="otp" name="otp" required class="form-control">

                <button type="submit" name="register" class="btn">Register</button>
                <a href="home.php" class="btn" style="background-color: #6c757d;">Back to Dashboard</a>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
