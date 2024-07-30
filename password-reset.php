<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
   <?php include "includes/head.php";?>
   <body class="inner_page resend">
      <div class="full_container">
         <div class="container">
            <div class="center verticle_center full">
               <div class="resend_section">
                  <?php if(isset($_SESSION['status'])) {
                     ?>
                           <div class="alert alert-success " role="alert">
                              <?= $_SESSION['status'] ?>
                           </div>   
                           <?php
                           unset($_SESSION['status']);
                          }
                              ?>
                              
                  <div class="logo_resend">
                     <div class="center">
                        <!-- <img width="210" src="images/logo/logo.png" alt="#" /> -->
                         <h3 class="text-white">Reset Password</h3>
                     </div>
                  </div>
                  <div class="resend_form">
                     <form action="password-reset-code.php" method="post">
                        <fieldset>
                           <div class="field">
                              <label class="label_field">Email Address</label>
                              <input type="email" name="email" placeholder="Enter email address" />
                           </div>
                           <div class="field margin_0">
                              <button name="password_reset_link" type="submit" class="btn_login">Send Password Reset Link</button>
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