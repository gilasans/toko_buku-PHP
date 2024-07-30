<?php
// include "core/init.php";
include "authentication.php";

// Pagination variables
$per_page = 5; // Number of items per page
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number

// Pencarian (search)
if (isset($_GET['searc'])) {
    $search = $_GET['searc'];
    $count_query = "SELECT COUNT(*) AS total FROM buku WHERE nama_buku LIKE '%$search%'";
    $query = "SELECT 
        kategori.kategori,
        penerbit.nama,
        buku.* 
        FROM buku
        INNER JOIN kategori ON buku.kategori_id = kategori.id
        INNER JOIN penerbit ON buku.penerbit_id = penerbit.id 
        WHERE nama_buku LIKE '%$search%'
        LIMIT " . ($current_page - 1) * $per_page . ", $per_page";
} else {
    $count_query = "SELECT COUNT(*) AS total FROM buku";
    $query = "SELECT 
        kategori.kategori,
        penerbit.nama,
        buku.* 
        FROM buku
        INNER JOIN kategori ON buku.kategori_id = kategori.id
        INNER JOIN penerbit ON buku.penerbit_id = penerbit.id
        LIMIT " . ($current_page - 1) * $per_page . ", $per_page";
}

// Execute count query
$count_result = mysqli_query($connect, $count_query);
$total_rows = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_rows / $per_page);

// Execute data query
$buku = mysqli_query($connect, $query);

// Check for database errors
if (mysqli_error($connect)) {
    echo "Error: " . mysqli_error($connect);
}
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
                        <?php if(isset($_SESSION['status'])) {
                     ?>
                           <div class="alert alert-success " role="alert">
                              <?= $_SESSION['status'] ?>
                           </div>   
                           <?php
                           unset($_SESSION['status']);
                          }
                              ?>
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
                              <form class="row float-end row-cols-lg-auto g-2 align-items-center" method="GET">
                                  <div class="col-6">
                                      <div class="form-check">
                                          <input type="text" class="form-control" placeholder="Mau cari apa?" name="searc">
                                      </div>
                                  </div>
                                  <div class="col-6">
                                      <button type="submit" class="btn btn-success" name="cari">
                                          <i class="fa fa-search"></i> Cari</button>
                                  </div>
                              </form>
                           </div>
                          
                           <div class="table_section padding_infor_info">
                              <div class="table-responsive-sm">
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
                                       if (mysqli_num_rows($buku) > 0) {
                                           while ($buk = mysqli_fetch_assoc($buku)) {
                                               ?>
                                               <tr>
                                                   <td><?= htmlspecialchars($buk['kode']) ?></td>
                                                   <td><?= htmlspecialchars($buk['kategori']) ?></td>
                                                   <td><?= htmlspecialchars($buk['nama_buku']) ?></td>
                                                   <td><?= htmlspecialchars($buk['harga']) ?></td>
                                                   <td><?= htmlspecialchars($buk['stok']) ?></td>
                                                   <td><?= htmlspecialchars($buk['nama']) ?></td>
                                               </tr>
                                               <?php
                                           }
                                       } else {
                                           echo "<tr><td colspan='7' class='text-center'>Data buku tidak tersedia.</td></tr>";
                                       }
                                       ?>
                                    </tbody>
                                 </table>
                              </div>
                              <?php
                              if (isset($error)) {
                                  echo "<div class='text-center text-muted'>Pencarian tidak ditemukan.</div>";
                              }
                              ?>
                               <!-- Pagination -->
                           <nav aria-label="Page navigation example">
                               <ul class="pagination justify-content-end">
                                   <?php if ($current_page > 1) : ?>
                                       <li class="page-item">
                                           <a class="page-link" href="?page=<?= $current_page - 1 ?>" aria-label="Previous">
                                               <span aria-hidden="true">&laquo;</span>
                                           </a>
                                       </li>
                                   <?php endif; ?>

                                   <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                       <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                           <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                       </li>
                                   <?php endfor; ?>

                                   <?php if ($current_page < $total_pages) : ?>
                                       <li class="page-item">
                                           <a class="page-link" href="?page=<?= $current_page + 1 ?>" aria-label="Next">
                                               <span aria-hidden="true">&raquo;</span>
                                           </a>
                                       </li>
                                   <?php endif; ?>
                               </ul>
                           </nav>
                           <!-- End Pagination -->
                        </div>
                           </div>

                          
                     </div>
                  </div>
               </div>
               <?php include("includes/copyright.php") ?>
            </div>
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
