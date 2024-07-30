<?php
session_start();

if (isset($_SESSION['authenticated'])) {
   $_SESSION['status'] = "You are already logged in!";
   header("Location: index.php");
   exit();
}
?>
<!DOCTYPE html>
<html lang="en">
   <?php include "includes/head.php";?>
   <body class="inner_page login">
      <div class="full_container">
         <div class="container">
            <div class="center verticle_center full_height">
               <div class="login_section">
                  <?php if(isset($_SESSION['status'])) {
                     ?>
                           <div class="alert alert-success " role="alert">
                              <?= $_SESSION['status'] ?>
                           </div>   
                           <?php
                           unset($_SESSION['status']);
                          }
                              ?>
                              
                  <div class="logo_login">
                     <div class="center">
                        <!-- <img width="210" src="images/logo/logo.png" alt="#" /> -->
                         <h3 class="text-white">Change Password</h3>
                     </div>
                  </div>
                  <div class="login_form">
                     <form action="password-reset-code.php" method="post">
                        <fieldset>
                            <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token']; } ?>" />
                           <div class="field">
                              <label class="label_field">Email Address</label>
                              <input type="email" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email']; } ?>" placeholder="Enter Email Address" />
                           </div>
                           <div class="field">
                              <label class="label_field">New Password</label>
                              <input type="text" name="new_password" placeholder="Enter New Password" />
                           </div>
                           <div class="field">
                              <label class="label_field">Confirm </label>
                              <input type="text" name="confirm_password" placeholder="Enter Confirm Password" />
                           </div>
                           <div class="field margin_0">
                              <button name="password_update" type="submit" class="btn_login">Update Password</button>
                           </div>
                        </fieldset>
                     </form>
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/animate.js"></script>
      <!-- select country -->
      <script src="js/bootstrap-select.js"></script>
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
   </body>
</html>