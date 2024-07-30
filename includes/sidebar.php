<nav id="sidebar">
   <div class="sidebar_blog_1">
      <div class="sidebar-header">
         <div class="logo_section">
            <a href="#"><img class="logo_icon img-responsive" src="images/logo/logo_icon.png" alt="#" /></a>
         </div>
      </div>
      <div class="sidebar_user_info">
         <div class="icon_setting"></div>
         <div class="user_profle_side">
            <div class="user_img"><img class="img-responsive" src="images/layout_img/user_img.jpg" alt="#" /></div>
            <div class="user_info">
               <h6> <?=$_SESSION['auth_user']['username'];?></h6>
               <p><span class="online_animation"></span> Online</p>
            </div>
         </div>
      </div>
   </div>
   <div class="sidebar_blog_2">
      
      <ul class="list-unstyled components">
         <li class="active"><a href="index.php"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a></li>
         <li>
            <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-database orange_color"></i> <span>Buku</span></a>
            <ul class="collapse list-unstyled" id="element">
               <li><a href="dt_buku.php"> <span>Data Buku</span></a></li>
               <li><a href="form_buku.php"> <span>Tambah Buku</span></a></li>
            </ul>
         </li>
         <li>
            <a href="#el" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-database orange_color"></i> <span>Penerbit</span></a>
            <ul class="collapse list-unstyled" id="el">
               <li><a href="dt_penerbit.php"> <span>Data Penerbit</span></a></li>
               <li><a href="form_penerbit.php"> <span>Tambah Penerbit</span></a></li>
            </ul>
         </li>
         <li><a href="pengadaan.php"><i class="fa fa-archive green_color"></i> <span>pengadaan</span></a></li>
      </ul>
   </div>
</nav>