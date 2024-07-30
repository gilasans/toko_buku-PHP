<?php
include "core/init.php";
include "functions/db.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
// Load Composer's autoloader
require 'vendor/autoload.php';

function resend_email_verify($name, $email, $verify_token){
    $mail = new PHPMailer(true);

    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'msaeful858@gmail.com';                     // SMTP username
    $mail->Password   = 'jnknddloqctbkckh';                               // SMTP password
    $mail->SMTPSecure = "tls";         // Enable implicit TLS encryption
    $mail->Port       = 587;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Recipients
    $mail->setFrom('msaeful858@gmail.com', $name);
    $mail->addAddress($email);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Resend - Email verification from Toko buku ';
    $email_template = "
    <h2>You have registered with Toko Buku</h2>
    <h5>Verify your email address to login</h5>
    <br><br>
    <a href='http://localhost/praktikum/php/toko/verify-email.php?token=$verify_token'>Click me</a>";
    $mail->Body = $email_template;

    $mail->send();
}

if(isset($_POST['resend_email_verify_btn'])){
    if (!empty(trim($_POST['email']))) {
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            if ($row['verify_status'] == "0") {
                $name = $row['name'];
                $email = $row['email'];
                $verify_token = $row['verify_token'];
                resend_email_verify($name, $email, $verify_token);
                $_SESSION['status'] = 'Verification Email Link Has Been sent to your email address !';
                header('location: login.php');
                exit();
            } else {
                $_SESSION['status'] = 'Email already verified. Please login';
                header('location: resend-email-verification.php');
                exit();     
            }
           
        }else{
            $_SESSION['status'] = 'Email is not registered. Please registered now !!';
            header('location: register.php');
            exit();
        }
    }else{
        $_SESSION['status'] = 'Please Enter Your Email Address';
        header('location: resend-email-verification.php');
        exit();
    }
}