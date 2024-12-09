<?php
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Database connection
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    // Generate a random OTP
    $otp = rand(100000, 999999);
    
    // Save email and OTP to the database
    $stmt = $conn->prepare("INSERT INTO users_otp (email, otp) VALUES (?, ?)");
    $stmt->bind_param("si", $email, $otp);
    $stmt->execute();
    
    // Create a new PHPMailer instance
    $mail = new PHPMailer();
    
    // Configure PHPMailer
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'your_email@gmail.com'; // Your email address
    $mail->Password = 'your_password'; // Your email password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; // TCP port to connect to

    // Recipients
    $mail->setFrom('your_email@gmail.com', 'Your Name');
    $mail->addAddress($email); // Add a recipient

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Your OTP Code';
    $mail->Body    = "Your OTP code is: <strong>$otp</strong>";

    // Send email
    if ($mail->send()) {
        echo "OTP sent to your email. <a href='verify_otp.php?email=$email'>Click here to verify</a>";
    } else {
        echo "Failed to send OTP. Error: " . $mail->ErrorInfo;
    }

    $stmt->close();
}

$conn->close();
?>
