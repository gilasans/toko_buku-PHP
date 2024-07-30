<?php

require_once "core/init.php";

if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $kode = htmlspecialchars($_POST['kode']);
    $kota = htmlspecialchars($_POST['kota']);
    $telpon = $_POST['telpon'];
    $alamat = htmlspecialchars($_POST['alamat']);

    // Proses upload gambar
    $gambar = $_FILES['gambar'];
    $gambarName = $gambar['name'];
    $gambarTmp = $gambar['tmp_name'];
    $gambarSize = $gambar['size'];
    $gambarError = $gambar['error'];

   // Cek apakah ada file yang diupload
   if ($gambarName) {
    $gambarExt = strtolower(pathinfo($gambarName, PATHINFO_EXTENSION));
    $allowedExtensions = array('jpg', 'jpeg', 'png');

    // Cek ekstensi file
    if (in_array($gambarExt, $allowedExtensions)) {
        // Generate nama unik untuk file
        $gambarNewName = uniqid('penerbit_', true) . '.' . $gambarExt;
        $gambarDestination = 'uploads/' . $gambarNewName;            

        // Pindahkan file ke direktori upload
        if (move_uploaded_file($gambarTmp, $gambarDestination)) {
            chmod($gambarDestination, 0644); // Ubah izin file setelah diunggah
            // Query untuk menyimpan data ke database
            $sql = "INSERT INTO penerbit (kode, nama, kota, alamat, telpon, gambar) 
                    VALUES ('$kode', '$nama', '$kota', '$alamat', '$telpon', '$gambarNewName')"; // Simpan nama file gambar

            $result = mysqli_query($connect, $sql);
            if ($result) {
                // Redirect ke halaman dt_penerbit.php setelah sukses menyimpan
                header("Location: dt_penerbit.php");
                exit(); // Pastikan untuk keluar dari skrip setelah redirect
            } else {
                echo "Terjadi kesalahan saat menyimpan data: " . mysqli_error($connect);
            }
        } else {
            echo "Gagal mengunggah file. Silakan coba lagi.";
        }
    } else {
        echo "Format file tidak didukung. Harap unggah file dalam format JPG, JPEG, atau PNG.";
    }
} else {
    echo "Silakan pilih file gambar.";
}
}


?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/head.php"; ?>

<body class="dashboard dashboard_1">
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            <?php include("includes/sidebar.php") ?>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                <?php include("includes/topbar.php") ?>
                <!-- end topbar -->
                <!-- dashboard inner -->
                <div class="midde_cont">
                    <div class="container-fluid">
                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="page_title">
                                    <h2>Input Data Penerbit Baru</h2>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid card px-4 py-4">
                        <form action="" class="row g-3" method="POST" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label"><b>Nama Penerbit</b></label>
                                    <input type="text" name="nama" class="form-control" id="nama">
                                </div>
                                <div class="col-md-6">
                                    <label for="kode" class="form-label"><b>Kode Penerbit</b></label>
                                    <input type="text" name="kode" class="form-control" id="kode">
                                </div>
                                <div class="col-md-6">
                                    <label for="kota" class="form-label"><b>Kota</b></label>
                                    <input type="text" name="kota" class="form-control" id="kota">
                                </div>
                                <div class="col-md-6">
                                    <label for="telpon" class="form-label"><b>Telpon</b></label>
                                    <input type="tel" name="telpon" class="form-control" id="telpon">
                                </div>
                                <div class="col-md-6">
                                    <label for="alamat" class="form-label"><b>Alamat</b></label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="gambar" class="form-label"><b>Gambar</b></label>
                                    <input type="file" class="form-control" id="gambar" name="gambar">
                                </div>
                                <div class="col-md-6">
                                    <button name="simpan" type="submit" class="btn btn-dark mt-4">Submit</button>
                                    <a href="dt_penerbit.php" class="btn btn-outline-dark mt-4">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php include("includes/copyright.php") ?>
            </div>
            <!-- end dashboard inner -->
        </div>
    </div>
  
    <!-- jQuery -->
    <?php include("includes/footer.php") ?>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>
