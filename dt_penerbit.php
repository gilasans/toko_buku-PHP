<?php
require_once "core/init.php";
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
                                 <h2>Data Penerbit</h2>
                              </div>
                           </div>
                           <div class="table_section padding_infor_info">
                              <div class="table-responsive-sm">
                                 <?php
                                   $penerbit = mysqli_query($connect ,"SELECT * FROM penerbit");
                                 ?>
                                 <table class="table">
                                    <thead>
                                       <tr>
                                          <th>#</th>
                                          <th>Nama Penerbit</th>
                                          <th>Alamat</th>
                                          <th>Kota</th>
                                          <th>No Telpon</th>
                                          <th>Fhoto penerbit</th>
                                          <th></th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       foreach ($penerbit as $pen ) {
                                        ?>
                                        <tr>
                                            <td><?= $pen['kode']?></td>
                                            <td><?= $pen['nama']?></td>
                                            <td><?= $pen['alamat']?></td>
                                            <td><?= $pen['kota']?></td>
                                            <td><?= $pen['telpon']?></td>
                                            <td>
                                             <?php if ($pen['gambar'] && file_exists('uploads/' . $pen['gambar'])) { ?>
                                                   <img src="uploads/<?= htmlspecialchars($pen['gambar']) ?>" alt="Gambar Penerbit" style="max-width: 100px;">
                                             <?php } else { ?>
                                                   <p>Gambar tidak ditemukan di direktori uploads.</p>
                                             <?php } ?>
                                          </td>
                                            <td>
                                            <a class="btn btn-primary" href="edit_penerbit.php?id=<?= $pen["id"] ?>" data-toggle="tooltip" data-placement="right" title="Edit"><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-danger" href="hapus_penerbit.php?id=<?= $pen["id"] ?>" onclick="return confirm('Apakah anda yakin data ini akan dihapus ?')" data-toggle="tooltip" data-placement="right" title="Hapus">
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
   </div>
   <!-- jQuery -->
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <!-- wow animation -->
   <script src="js/animate.js"></script>
   <!-- select country -->
   <script src="js/bootstrap-select.js"></script>
   <!-- owl carousel -->
   <script src="js/owl.carousel.js"></script>
   <!-- chart js -->
   <script src="js/Chart.min.js"></script>
   <script src="js/Chart.bundle.min.js"></script>
   <script src="js/utils.js"></script>
   <script src="js/analyser.js"></script>
   <!-- nice scrollbar -->
   <script src="js/perfect-scrollbar.min.js"></script>
   <script>
      var ps = new PerfectScrollbar('#sidebar');
   </script>
   <!-- custom js -->
   <script src="js/custom.js"></script>
   <!-- calendar file css -->
   <script src="js/semantic.min.js"></script>
   <script></script>
</body>

</html>