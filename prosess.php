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

function sendemail_verify($name, $email, $verify_token){
    $mail = new PHPMailer(true);

    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'msaeful858@gmail.com';                     // SMTP username
    $mail->Password   = 'jnknddloqctbkckh';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable implicit TLS encryption
    $mail->Port       = 587;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Recipients
    $mail->setFrom('msaeful858@gmail.com', $name);
    $mail->addAddress($email);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Email verification from Toko Buku';
    $email_template = "
    <h2>You have registered with Toko Buku</h2>
    <h5>Verify your email address to login</h5>
    <br><br>
    <a href='http://localhost/praktikum/php/toko/verify-email.php?token=$verify_token'>Click me</a>";
    $mail->Body = $email_template;

    $mail->send();
    // echo 'Message has been sent';
}


if (isset($_POST['register_btn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $verify_token = md5(rand());

    // Uncomment the following code to insert the data into the database
    $check_email_query = "SELECT email from users where email = '$email' LIMIT 1";
    $check_email = mysqli_query($connect, $check_email_query);

    if (mysqli_num_rows($check_email) > 0) {
        $_SESSION['status'] = 'Email id already exists';
        header("Location: register.php");
        exit();
    } else {
        $query = "INSERT INTO users (name, email, password, verify_token) VALUES ('$name', '$email', '$password', '$verify_token')";
        $result = mysqli_query($connect, $query);

        if ($result) {
            sendemail_verify($name, $email, $verify_token);

            $_SESSION['status'] = 'Registration Successfullly, Please verify your email address';
            header("Location: register.php");
            exit();
        } else {
            $_SESSION['status'] = 'Account creation failed';
            header("Location: register.php");
            exit();
        }
    }
}
