<?php
require_once "core/init.php";

$penerbit = mysqli_query($connect, "SELECT * FROM penerbit");
$kategori = mysqli_query($connect, "SELECT * FROM kategori");

if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $kode = htmlspecialchars($_POST['kode']);
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori = $_POST['kategori'];
    $penerbit = $_POST['penerbit'];

    $sql = "INSERT INTO buku (kode,nama_buku,harga,stok,penerbit_id,kategori_id) VALUES ('$kode','$nama','$harga','$stok','$penerbit',$kategori)";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        header("location:dt_buku.php");
    } else {
        die(mysqli_error($connect));
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
                                    <h2>Input Data Buku Baru</h2>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid card px-4 py-4">
                            <form action="" class="row g-3" method="POST" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label"><b>Nama Buku</b></label>
                                    <input type="text" name="nama" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label"><b>Kode Buku</b></label>
                                    <input type="text" name="kode" class="form-control">
                                </div>
                                <!-- <script>
                                    $(document).ready(function() {
                                        $("#nama").change(function() {
                                            var nama = $(this).val();
                                            $("#kode option[data-nama='" + nama + "']").prop('selected', true);
                                        });
                                        $("#kode").change(function() {
                                            var kode = $(this).val();
                                            $("#nama option[value='" + kode + "']").prop('selected', true);
                                        });
                                    });
                                </script> -->
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label"><b>Harga</b></label>
                                    <input name="harga" type="number" class="form-control" id="inputPassword4">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label"><b>Stok</b></label>
                                    <input name="stok" type="number" class="form-control" id="inputPassword4">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputState" class="form-label"><b>Kategori</b></label>
                                    <select name="kategori" id="inputState" class="form-control">
                                        <option hidden>Pilih Kategori</option>
                                        <?php
                                        foreach ($kategori as $ktg) {
                                        ?>
                                            <option value="<?= $ktg['id'] ?>"><?= $ktg['kategori'] ?></option>
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
                                            <option value="<?= $pen['id'] ?>"><?= $pen['nama'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                               
                                <div class="col-md-6">
                                    <button name="simpan" type="submit" class="btn btn-dark mt-4">Submit</button>
                                    <a href="dt_buku.php" class="btn btn-outline-dark mt-4">Batal</a>
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
    </div>
    <!-- jQuery -->
    <?php include("includes/footer.php") ?>
</body>

</html>