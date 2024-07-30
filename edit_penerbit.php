<?php 
require_once "core/init.php";
$id = $_GET["id"];

$query = "SELECT * FROM penerbit WHERE id=$id";
$edit = mysqli_query($connect, $query);
$pen = mysqli_fetch_assoc($edit);
if (isset($_POST['ubah'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $kode = htmlspecialchars($_POST['kode']);
    $kota = htmlspecialchars($_POST['kota']);
    $telpon = $_POST['telpon'];
    $alamat = htmlspecialchars($_POST['alamat']);

    // Handle file upload
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
         // Set permission to 644
        chmod($target_file, 0644);

        $gambar = basename($_FILES["gambar"]["name"]);
        
        // Update query to include gambar
        $query = "UPDATE penerbit SET nama='$nama', kode='$kode', kota='$kota', telpon='$telpon', alamat='$alamat', gambar='$gambar' WHERE id=$id";
    } else {
        // Update query without gambar
        $query = "UPDATE penerbit SET nama='$nama', kode='$kode', kota='$kota', telpon='$telpon', alamat='$alamat' WHERE id=$id";
    }

    if (mysqli_query($connect, $query)) {
        header("Location: dt_penerbit.php");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($connect);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include("includes/head.php") ?>

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
                                    <h2>Edit Data Penerbit</h2>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid card px-4 py-4">
                            <?php
                            foreach ($edit as $pen) {
                            ?>
                            <form action="" class="row g-3" method="POST" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label"><b>Nama Penerbit</b></label>
                                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($pen['nama']) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label"><b>Kode Penerbit</b></label>
                                    <input type="text" name="kode" class="form-control" value="<?= htmlspecialchars($pen['kode']) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label"><b>Kota</b></label>
                                    <input name="kota" type="text" class="form-control" id="inputPassword4" value="<?= htmlspecialchars($pen['kota']) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label"><b>Telpon</b></label>
                                    <input name="telpon" type="number" class="form-control" id="inputPassword4" value="<?= htmlspecialchars($pen['telpon']) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control"><?= htmlspecialchars($pen['alamat']) ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputFile" class="form-label"><b>Gambar</b></label>
                                    <input type="file" name="gambar" class="form-control" id="inputFile">
                                    <?php if ($pen['gambar']) { ?>
                                        <img src="uploads/<?= htmlspecialchars($pen['gambar']) ?>" alt="Gambar Penerbit" width="100">
                                    <?php } else { ?>
                                        <p>Gambar tidak ditemukan di direktori uploads.</p>
                                    <?php } ?>
                                    
                                </div>
                                <div class="col-md-6">
                                    <button name="ubah" type="submit" class="btn btn-dark mt-4">Update</button>
                                    <a href="dt_penerbit.php" class="btn btn-outline-dark mt-4">Batal</a>
                                </div>
                            </form>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php include("includes/copyright.php") ?>
            </div>
            <!-- end dashboard inner -->
        </div>
    </div>
    </div>
    <!-- jQuery -->
    <?php include("includes/footer.php") ?>
</body>

</html>
