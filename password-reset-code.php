<?php
session_start();
include "functions/db.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
// Load Composer's autoloader
require 'vendor/autoload.php';

function send_password_reset($get_name, $get_email, $verify_token) {
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
    $mail->setFrom('msaeful858@gmail.com', $get_name);
    $mail->addAddress($get_email);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Reset Password Notification';
    $email_template = "
    <h2>Hello</h2>
    <h3>You are receiving this email because wereceived a password reset request for your account.</h3>
    <br><br>
    <a href='http://localhost/praktikum/php/toko/password-change.php?token=$verify_token&email=$get_email'>Click me</a>";
    $mail->Body = $email_template;

    $mail->send();
}

if (isset($_POST['password_reset_link'])) {
    $email = mysqli_real_escape_string($connect,$_POST['email']);
    $verify_token = md5(rand());
    $sql = "SELECT email from users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $get_name = isset($row['name']) ? $row['name'] : ''; // Perbaikan undefined array key
        $get_email = $row['email'];
        $update_token = "UPDATE users SET verify_token = '$verify_token' WHERE email = '$get_email' LIMIT 1";
        $update = mysqli_query($connect, $update_token);
        if ($update) {
            send_password_reset($get_name, $get_email, $verify_token);
            $_SESSION['status'] = "Please check your email to reset your password";
            header("Location: password-reset.php");
            exit();
        } else {
            $_SESSION['status'] = "Something went wrong, please try again";
            header("Location: password-reset.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "Email not found";
        header("Location: password-reset.php");
        exit();
    }
}

if(isset($_POST['password_update'])){
    $email = mysqli_real_escape_string($connect,$_POST['email']);
    $new_password = mysqli_real_escape_string($connect,$_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($connect,$_POST['confirm_password']);
    $token = mysqli_real_escape_string($connect,$_POST['password_token']);
    // $sql = "SELECT * from users WHERE email = '$email' AND verify_token = '$verify_token' LIMIT 1";
    // $result = mysqli_query($connect, $sql);
    if (!empty($token)) {
        if (!empty($email) && !empty($new_password) && !empty($confirm_password)) {
            $check_token = "SELECT verify_token FROM users WHERE verify_token='$token' LIMIT 1";
            $result_token = mysqli_query($connect, $check_token);
            if (mysqli_num_rows($result_token) > 0) {
                if ($new_password == $confirm_password) {
                    $sql = "UPDATE users SET password = '$new_password' WHERE email = '$email' AND verify_token = '$token' LIMIT 1";
                    $result = mysqli_query($connect, $sql);
                    if ($result) {
                        $new_token = md5(rand()).'saeful';
                        $update_to_new_token = "UPDATE users SET verify_token = '$new_token' WHERE email = '$email' AND verify_token = '$token' LIMIT 1";
                        $update_to_new_token_run = mysqli_query($connect, $update_to_new_token);

                        $_SESSION['status'] = "Password changed successfully";
                        header("Location: login.php");
                        exit();
                    } else {
                        $_SESSION['status'] = "Something went wrong, please try again";
                        header("Location: password-change.php?token=$token&email=$email");
                        exit();
                    }
                } else {
                    $_SESSION['status'] = "Password and Confirm Password does not match";
                    header("Location: password-change.php?token=$token&email=$email");
                    exit();
                }
        }else{
            $_SESSION['status'] = "Invalid Token";
            header("Location: password-change.php?token=$token&email=$email");
            exit();    
        }
    }else{
        $_SESSION['status'] = "All field are mandetory";
        header("Location: password-change.php?token=$token&email=$email");
        exit();    
    }
    
} else {
    $_SESSION['status'] = "No Token Available";
    header("Location: password-change.php");
    exit();
}

}