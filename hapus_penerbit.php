<?php
require_once "core/init.php";

$id = $_GET["id"];

// Hapus buku terlebih dahulu yang terkait dengan penerbit
$deleteBooksQuery = "DELETE FROM buku WHERE penerbit_id = $id";
$deleteBooksResult = mysqli_query($connect, $deleteBooksQuery);

// Setelah itu baru hapus penerbit
if ($deleteBooksResult) {
    $deletePenerbitQuery = "DELETE FROM penerbit WHERE id = $id";
    $deletePenerbitResult = mysqli_query($connect, $deletePenerbitQuery);

    if ($deletePenerbitResult) {
        header("location: dt_penerbit.php");
    } else {
        echo "Gagal menghapus penerbit: " . mysqli_error($connect);
    }
} else {
    echo "Gagal menghapus buku: " . mysqli_error($connect);
}
