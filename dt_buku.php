<?php
// include "core/init.php";
include "authentication.php";
?>

<!DOCTYPE html>
<html lang="en">
<?php include("includes/head.php") ?>

<body class="inner_page tables_page">
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
                           <h2>Data</h2>
                        </div>
                     </div>
                  </div>
                  <!-- row -->
                  <div class="row">
                     <!-- table section -->
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2>Data Buku</h2>
                              </div>
                           </div>
                           <div class="table_section padding_infor_info">
                              <div class="table-responsive-sm">
                                 <?php
                                   $books = mysqli_query($connect ,"SELECT 
                                   kategori.kategori,
                                   penerbit.nama,
                                   buku.* FROM buku
                                   INNER JOIN kategori ON buku.kategori_id = kategori.id
                                   INNER JOIN penerbit ON buku.penerbit_id = penerbit.id
                                   ");
                                 ?>
                                 <table class="table">
                                    <thead>
                                       <tr>
                                          <th>#</th>
                                          <th>Kategori</th>
                                          <th>Nama Buku</th>
                                          <th>Harga</th>
                                          <th>Stok</th>
                                          <th>Penerbit</th>
                                          <th></th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       foreach ($books as $buku ) {
                                        ?>
                                        <tr>
                                            <td><?= $buku['kode']?></td>
                                            <td><?= $buku['kategori']?></td>
                                            <td><?= $buku['nama_buku']?></td>
                                            <td><?= $buku['harga']?></td>
                                            <td><?= $buku['stok']?></td>
                                            <td><?= $buku['nama']?></td>
                                            <td>
                                            <a class="btn btn-primary" href="edit_buku.php?id=<?= $buku["id"] ?>" data-toggle="tooltip" data-placement="right" title="Edit"><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-danger" href="hapus_buku.php?id=<?= $buku["id"] ?>" onclick="return confirm('Apakah anda yakin data ini akan dihapus ?')" data-toggle="tooltip" data-placement="right" title="Hapus">
                                                   <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <?php
                                       }
                                       ?>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php include("includes/copyright.php") ?>
            <!-- end dashboard inner -->
         </div>
      </div>
      <!-- model popup -->
      <!-- The Modal -->
      <?php include("includes/modal.php") ?>
      <!-- end model popup -->
   <?php include("includes/footer.php") ?>
   <script></script>
</body>

</html>