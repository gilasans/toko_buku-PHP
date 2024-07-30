<?php
session_start();
// Pastikan tidak ada output sebelum ini
require_once "functions/db.php";

// // Contoh penggunaan header setelah session_start()
// if (isset($_SESSION['user_id'])) {
//     header("Location: index.php");
//     exit();
// }