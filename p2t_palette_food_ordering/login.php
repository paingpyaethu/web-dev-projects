<?php
include('template/front_panel/header.php');
?>


<div class="container-fluid">
   <div class="row">
      <div class="col-12">
         <div class="container">
            <div class="row justify-content-center align-items-center min-vh-80 py-5">
               <div class="col-lg-5 col-md-7 col-12">
                  <div class="card">
                     <div class="card-body">
                        <h3 class="text-center text-main">
                           <i class="fas fa-unlock-alt"></i> Login Form</h3>
                        <hr>

                        <p id="login_form_msg" class="alert_field mb-1"></p>
                        <form method="post" id="formLogin">
                           <div class="form-floating mb-3">
                              <input type="email" class="form-control" id="email" name="user_email"  placeholder="name@example.com" required>
                              <label for="email">
                                 <i class="fas fa-at text-main"></i> Email address
                              </label>
                           </div>
                           <div class="form-floating mb-3">
                              <input type="password" class="form-control" id="password" name="user_password"  placeholder="Password" required>
                              <label for="password">
                                 <i class="fas fa-lock text-main"></i> Password
                              </label>
                           </div>
                           <button type="submit" id="login_submit" name="login-btn" class="btn btn-main me-1">Login</button>
                           <a href="<?php echo $front_url; ?>/forgot_password" class="float-end mt-2 text-danger fw-semi-bold">Forgot Password?</a>

                           <input type="hidden" name="type" value="login">
                           <input type="hidden" id="is_checkout" name="is_checkout" value="">
                        </form>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php include('template/front_panel/footer.php'); ?>