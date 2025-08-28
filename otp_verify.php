<?php
session_start();
require "connection.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_otp = $_POST["otp"];

    if (isset($_SESSION["otp"]) && isset($_SESSION["email"])) {
        if ($entered_otp == $_SESSION["otp"]) {
            unset($_SESSION["otp"]);  // Remove OTP after successful verification
            $_SESSION["loggedin"] = true;

            header("Location: cardetails.php");
            exit();
        } else {
            $error = "Invalid OTP! Try again.";
        }
    } else {
        $error = "OTP expired. Please log in again.";
    }
}
?>
