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
                         <h3 class="text-white">Login Form</h3>
                     </div>
                  </div>
                  <div class="login_form">
                     <form action="logincode.php" method="post">
                        <fieldset>
                           <div class="field">
                              <label class="label_field">Email Address</label>
                              <input type="email" name="email" placeholder="Enter email" />
                           </div>
                           <div class="field">
                              <label class="label_field">Password</label>
                              <input type="password" name="password" placeholder="*****" />
                           </div>
                           <div class="field">
                              <a href="password-reset.php" class="text-primary">Forgot Password?</a>
                           </div>
                           
                           <div class="field margin_0">
                              <button name="login_now_btn" type="submit" class="btn_login">Sign In</button>
                           </div>
                           <div class="field">
                              <p class="resen">
                                 Dont have an account ?
                                 <a href="register.php" class="text-primary">Sign Up</a>
                              </p>
                           </div>
                           <div class="field">
                              <p class="resen">
                                 Did not Recieve Your Verification Email?
                                 <a href="resend-email-verification.php" class="text-primary">Resend</a>
                              </p>
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