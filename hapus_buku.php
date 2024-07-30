<?php

require_once "core/init.php";
// susunan mysqli_query = variabel koneksi, query
// $kategori = mysqli_query($connect,"SELECT * FROM kategori")
$id = $_GET["id"];

$query = "DELETE FROM buku WHERE id=$id";
$delete = mysqli_query($connect, $query);

header("location:dt_buku.php");
