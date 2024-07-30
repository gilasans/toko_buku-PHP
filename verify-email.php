<?php
include 'core/init.php';
include 'functions/db.php';

if (isset($_GET['token'])) {
    $token =  $_GET['token'];
    $query = "SELECT verify_token, verify_status FROM users WHERE verify_token = '$token' LIMIT 1";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        
        if ( $row['verify_status'] == "0") { 
            $clicked_token = $row['verify_token']; 
            $update_query = "UPDATE users SET verify_status = '1' WHERE verify_token = '$clicked_token' LIMIT 1";
            $update_result = mysqli_query($connect, $update_query);
            if ($update_result) {
                    $_SESSION['status'] = 'Your Account has been verified Successfully!';
                    header('location: login.php');
                    exit();    
            }else {
                $_SESSION['status'] = 'Verification Failed.!';
                header('location: login.php');
                exit();    
            }
        } else {
            $_SESSION['status'] = 'Email already verified .please login';
            header('location: login.php');
            exit();    
        }
        
    } else {
        $_SESSION['status'] = 'This Token does ot exists';
        header('location: login.php');
    }
} else {
    $_SESSION['status'] = 'not allowed';
    header('location: login.php');
}
