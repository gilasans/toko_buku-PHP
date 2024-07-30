<?php
session_start();
include "functions/db.php";

if(isset($_POST['login_now_btn'])){
    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $password = mysqli_real_escape_string($connect, $_POST['password']);

        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            if ($row['verify_status'] == "1") {
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['auth_user'] = [
                    'username' =>  $row['name'],
                    'email' =>  $row['email'],
                ];
                $_SESSION['status'] = 'You Are Logged In Successfully.';
                header('location: index.php');
                exit();
            }else{
                $_SESSION['status'] = 'Please Verify Your Email Address to login';
                header('location: login.php');
                exit();
            }
        } else {
            $_SESSION['status'] = 'Incorrect Email or Password';
            header('location: login.php');
            exit();
        }
    } else {
        $_SESSION['status'] = 'All Field are Mandetory';
        header('location: login.php');
    }
    
};