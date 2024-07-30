<?php 
    $koneksi = mysqli_connect('localhost', 'phpmyadmin', 'bismillah', 'data');
    // if (mysqli_connect_errno()) {
    //     die('Gagal terhubung ke database: ' . mysqli_connect_error());
    // } else {
    //     echo 'Berhasil terhubung ke database';
    // }
    
    
    function query($query) {
        global $koneksi;
        $result = mysqli_query($koneksi, $query);
        $rows = [];
        while( $row = mysqli_fetch_assoc($result) ) {
            $rows[] = $row;
        }
        return $rows;
    }

    

    // tanggal indonesia
    function tgl_indo($tgl) {
        $tanggal = substr($tgl, 8, 2);
        $nama_bulan = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des");
        $bulan = $nama_bulan[substr($tgl, 5, 2) - 1];
        $tahun = substr($tgl, 0, 4);

        return $tanggal.'-'.$bulan.'-'.$tahun;
    }
    