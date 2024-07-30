<?php
require_once "core/init.php";
$id = $_GET["id"];

$penerbit = mysqli_query($connect, "SELECT * FROM penerbit");
$kategori = mysqli_query($connect, "SELECT * FROM kategori");

$query = "SELECT * FROM buku WHERE id=$id ";
$edit = mysqli_query($connect, $query);


if (isset($_POST["ubah"])) {
    // $id = $_POST["id"];
    $nama = htmlspecialchars($_POST['nama']);
    $kode = htmlspecialchars($_POST['kode']);
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori = $_POST['kategori'];
    $penerbit = $_POST['penerbit'];
    // id nya bisa pakai yang get diatas atau bisa pakai id inputnya nya dihidden
    $query = "UPDATE buku set nama_buku='$nama', kode='$kode', harga='$harga', stok='$stok', kategori_id='$kategori', penerbit_id ='$penerbit'    WHERE id=$id";
    mysqli_query($connect, $query);
    header("location:dt_buku.php");
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
                                    <h2>Input Data Buku Baru</h2>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid card px-4 py-4">
                            <?php
                            foreach ($edit as $ed) {
                            ?>
                            <form action="" class="row g-3" method="POST" >
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label"><b>Nama Buku</b></label>
                                    <input type="text" name="nama" class="form-control" value="<?= $ed['nama_buku']?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label"><b>Kode Buku</b></label>
                                    <input type="text" name="kode" class="form-control" value="<?= $ed['kode']?>">
                                </div>
                               
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label"><b>Harga</b></label>
                                    <input name="harga" type="number" class="form-control" id="inputPassword4"  value="<?= $ed['harga']?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label"><b>Stok</b></label>
                                    <input name="stok" type="number" class="form-control" id="inputPassword4"  value="<?= $ed['stok']?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputState" class="form-label"><b>Kategori</b></label>
                                    <select name="kategori" id="inputState" class="form-control">
                                        <option hidden>Pilih Kategori</option>
                                        <?php
                                        foreach ($kategori as $ktg) {
                                        ?>
                                            <option value="<?= $ktg['id'] ?>"<?= $ed["kategori_id"] == $ktg["id"] ? "selected" : "" ;?>><?= $ktg['kategori'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputState" class="form-label"><b>Penerbit</b></label>
                                    <select name="penerbit" id="inputState" class="form-control">
                                        <option hidden>Pilih Penerbit</option>
                                        <?php
                                        foreach ($penerbit as $pen) {
                                        ?>
                                            <option value="<?= $pen['id'] ?>" <?= $ed["penerbit_id"] == $pen["id"] ? "selected" : "" ;?>><?= $pen['nama'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                               
                                <div class="col-md-6">
                                    <button name="ubah" type="submit" class="btn btn-dark mt-4">Submit</button>
                                    <a href="dt_buku.php" class="btn btn-outline-dark mt-4">Batal</a>
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