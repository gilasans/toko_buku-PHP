<?php 
    session_start();
    require "functions/functions.php";
    
    unset ($_SESSION['authenticated']);
    unset ($_SESSION['auth_user']);
    $_SESSION['status'] = ' You Logged out seuccessfully !';
    header("Location: login.php");