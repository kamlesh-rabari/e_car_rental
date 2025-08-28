<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendOTP($email, $otp) {
    $mail = new PHPMailer(true);
    
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'prkhmanav@gmail.com'; // Your Gmail
        $mail->Password = 'ujrcppbvpznnaysi'; // ✅ Use App Password (no spaces)
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom('prkhmanav@gmail.com', 'e-Rental Car'); // MUST match your Gmail
        $mail->addAddress($email);

        // Email content
        $mail->Subject = "Your OTP Code";
        $mail->isHTML(true);
        $mail->Body = "
            <div style='max-width: 500px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; font-family: Arial, sans-serif; background: #f9f9f9;'>
                <h2 style='text-align: center; color: #003cff;'>Your OTP Verification Code</h2>
                <p style='font-size: 16px; color: #333;'>Hello,</p>
                <p style='font-size: 16px; color: #333;'>Use the following One-Time Password (OTP) to verify your login:</p>
                <div style='text-align: center; font-size: 24px; font-weight: bold; background: #003cff; color: white; padding: 10px; border-radius: 5px;'>
                    $otp
                </div>
                <p style='font-size: 14px; color: #555;'>This OTP is valid for <strong>5 minutes</strong>. Please do not share it with anyone.</p>
                <hr>
                <p style='font-size: 12px; text-align: center; color: #888;'>If you did not request this, please ignore this email.</p>
            </div>
        ";

        return $mail->send(); // ✅ True if sent successfully

    } catch (Exception $e) {
        // Log error or print it
        error_log('Mailer Error: ' . $mail->ErrorInfo);
        return false;
    }
}
?>
