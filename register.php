<?php

require_once('connection.php');
if(isset($_POST['regs']))
{
    $fname=mysqli_real_escape_string($con,$_POST['fname']);
    $lname=mysqli_real_escape_string($con,$_POST['lname']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $lic=mysqli_real_escape_string($con,$_POST['lic']);
    $ph=mysqli_real_escape_string($con,$_POST['ph']);
   
    $pass=mysqli_real_escape_string($con,$_POST['pass']);
    $cpass=mysqli_real_escape_string($con,$_POST['cpass']);
    $gender=mysqli_real_escape_string($con,$_POST['gender']);
    $Pass=($pass);
    if(empty($fname)|| empty($lname)|| empty($email)|| empty($lic)|| empty($ph)|| empty($pass) || empty($gender))
    {
        echo '<script>alert("please fill the place")</script>';
    }
    else{
        if($pass==$cpass){
        $sql2="SELECT *from users where EMAIL='$email'";
        $res=mysqli_query($con,$sql2);
        if(mysqli_num_rows($res)>0){
            echo '<script>alert("EMAIL ALREADY EXISTS PRESS OK FOR LOGIN!!")</script>';
            echo '<script> window.location.href = "index.php";</script>';

        }
        else{
        $sql="insert into users (FNAME,LNAME,EMAIL,LIC_NUM,PHONE_NUMBER,PASSWORD,GENDER) values('$fname','$lname','$email','$lic',$ph,'$Pass','$gender')";
        $result = mysqli_query($con,$sql);
          

          // $to_email = $email;
          // $subject = "NO-REPLY";
          // $body = "THIS MAIL CONTAINS YOUR AUTHENTICATION DETAILS....\nYour Password is $pass and Your Registered email is $to_email"
          //          ;
          // $headers = "From: sender email";
          
          // if (mail($to_email, $subject, $body, $headers))
          
          // {
          //     echo "Email successfully sent to $to_email...";
          // }
          
          // else
 
          // {
          // echo "Email sending failed!";
          // }
        if($result){
            echo '<script>alert("Registration Successful Press ok to login")</script>';
            echo '<script> window.location.href = "index.php";</script>';       
           }
        else{
            echo '<script>alert("please check the connection")</script>';
        }
    
        }

        }
        else{
            echo '<script>alert("PASSWORD DID NOT MATCH")</script>';
            echo '<script> window.location.href = "register.php";</script>';
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Rental Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 30px;
        }
        form {
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 400px;
            margin: auto;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        small {
            color: red;
            display: block;
            margin-top: -8px;
            margin-bottom: 10px;
        }
        .btnn {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #ff7200;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        .btnn:hover {
            background-color: #e06100;
        }
        .btn-home {
            margin-top: 15px;
            background-color: #007bff;
        }
        .btn-home:hover {
            background-color: #0056b3;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        #message {
            display: none;
            background: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            margin-top: -5px;
            margin-bottom: 10px;
            color: #000;
        }
        #message p {
            margin: 5px 0;
            font-size: 14px;
        }
        .valid {
            color: green;
        }
        .valid:before {
            content: "✔ ";
        }
        .invalid {
            color: red;
        }
        .invalid:before {
            content: "✖ ";
        }
    </style>
</head>
<body>

<form id="register" method="POST">
    <h2>Car Rental Registration</h2>

    <label>First Name:</label>
    <input type="text" name="fname" id="fname" placeholder="Enter Your First Name" required>
    <small id="fnameError"></small>

    <label>Last Name:</label>
    <input type="text" name="lname" id="lname" placeholder="Enter Your Last Name" required>
    <small id="lnameError"></small>

    <label>Email:</label>
    <input type="email" name="email" id="email"
           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
           title="ex: example@ex.com"
           placeholder="Enter Valid Email" required>

    <label>Your License Number:</label>
    <input type="text" name="lic" id="lic" maxlength="16" placeholder="Enter Your License Number" required>
    <small id="licError"></small>

    <label>Phone Number:</label>
    <input type="tel" name="ph" maxlength="10" id="ph"
           onkeypress="return onlyNumberKey(event)"
           placeholder="Enter Your Phone Number" required>

    <label>Password:</label>
    <input type="password" name="pass" maxlength="12" id="psw"
           placeholder="Enter Password" required>

    <div id="message">
        <p id="letter" class="invalid">A lowercase letter</p>
        <p id="capital" class="invalid">A capital (uppercase) letter</p>
        <p id="number" class="invalid">A number</p>
        <p id="length" class="invalid">Minimum 8 characters</p>
    </div>

    <label>Confirm Password:</label>
    <input type="password" name="cpass" id="cpsw" placeholder="Re-enter the password" required>

    <label>Gender:</label><br>
    <input type="radio" name="gender" value="male" required> Male
    &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" name="gender" value="female" required> Female

    <br><br>
    <input type="submit" class="btnn" value="REGISTER" name="regs">
    <button type="button" class="btnn btn-home" onclick="window.location.href='index.php'">HOME</button>
</form>

<script>
    function onlyNumberKey(evt) {
        let ASCIICode = (evt.which) ? evt.which : evt.keyCode;
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }

    document.getElementById("fname").addEventListener("input", function () {
        let fname = this.value;
        let error = document.getElementById("fnameError");
        if (!/^[A-Za-z]+$/.test(fname)) {
            error.textContent = "First name must contain only letters.";
        } else {
            error.textContent = "";
        }
    });

    document.getElementById("lname").addEventListener("input", function () {
        let lname = this.value;
        let error = document.getElementById("lnameError");
        if (!/^[A-Za-z]+$/.test(lname)) {
            error.textContent = "Last name must contain only letters.";
        } else {
            error.textContent = "";
        }
    });

    document.getElementById("lic").addEventListener("input", function () {
        let lic = this.value;
        let error = document.getElementById("licError");
        if (!/^\d{16}$/.test(lic)) {
            error.textContent = "License number must be 16 digits.";
        } else {
            error.textContent = "";
        }
    });

    let password = document.getElementById("psw");
    let message = document.getElementById("message");
    let letter = document.getElementById("letter");
    let capital = document.getElementById("capital");
    let number = document.getElementById("number");
    let length = document.getElementById("length");

    password.onfocus = function () {
        message.style.display = "block";
    };

    password.onblur = function () {
        message.style.display = "none";
    };

    password.onkeyup = function () {
        let lowerCaseLetters = /[a-z]/g;
        if (password.value.match(lowerCaseLetters)) {
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }

        let upperCaseLetters = /[A-Z]/g;
        if (password.value.match(upperCaseLetters)) {
            capital.classList.remove("invalid");
            capital.classList.add("valid");
        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
        }

        let numbers = /[0-9]/g;
        if (password.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }

        if (password.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
    };
</script>

</body>
</html>

    

