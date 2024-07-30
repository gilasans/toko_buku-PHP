<?php
include "core/init.php";

if (!isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "Please Login to access dashboard !";
    header("Location: login.php");
    exit();
}