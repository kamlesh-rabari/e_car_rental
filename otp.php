<?php
session_start();
require "connection.php";
require "sendmail.php"; // Required to send OTP

$error = "";
$success = "";

// Handle OTP verification
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["verify_otp"])) {
    $entered_otp = trim($_POST["otp"]);

    if (isset($_SESSION["otp"]) && isset($_SESSION["email"])) {
        if ($entered_otp == $_SESSION["otp"]) {
            unset($_SESSION["otp"]);
            $_SESSION["loggedin"] = true;

            header("Location: cardetails.php");
            exit();
        } else {
            $error = "Invalid OTP! Please try again.";
        }
    } else {
        $error = "OTP expired. Please login again.";
    }
}

// Handle Resend OTP
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["resend_otp"])) {
    if (isset($_SESSION["email"])) {
        $email = $_SESSION["email"];
        $new_otp = rand(100000, 999999);
        $_SESSION["otp"] = $new_otp;

        if (sendOTP($email, $new_otp)) {
            $success = "A new OTP has been sent to your email.";
        } else {
            $error = "Failed to resend OTP. Please try again.";
        }
    } else {
        $error = "Session expired. Please login again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('3.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 15px;
            width: 480px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .form-control {
            background: rgba(255, 255, 255, 0.3);
            color: black;
        }
        .login-btn, .resend-btn {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            font-size: 18px;
            border: none;
        }
        .login-btn {
            background: #003cff;
            color: white;
        }
        .login-btn:hover {
            background: #002bbf;
        }
        .resend-btn {
            background: #28a745;
            color: white;
            margin-top: 10px;
        }
        .resend-btn:hover {
            background: #1e7e34;
        }
        .error { color: red; font-size: 14px; }
        .success { color: green; font-size: 14px; }
    </style>
</head>
<body>
    <div class="login-container">
        <form method="POST">
            <h3>Verify OTP</h3>
            <hr>
            <div class="mb-3">
                <label>Enter OTP</label>
                <input type="text" name="otp" class="form-control" placeholder="Enter OTP">
                <?php if ($error): ?><div class="error mt-2"><?= $error ?></div><?php endif; ?>
                <?php if ($success): ?><div class="success mt-2"><?= $success ?></div><?php endif; ?>
            </div>
            <button type="submit" name="verify_otp" class="login-btn">Verify</button>
        </form>

        <form method="POST">
            <button type="submit" name="resend_otp" class="resend-btn">Resend OTP</button>
        </form>
    </div>
</body>
</html>
