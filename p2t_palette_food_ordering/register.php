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
                           <i class="fas fa-users"></i> User Register</h3>
                        <hr>
                        <p id="form_msg" class="success_field"></p>
                        <form action="" method="post" id="formRegister">
                           <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="name" name="name"  placeholder="Name" required>
                              <label for="name">
                                 <i class="fas fa-user text-main"></i> Your Name
                              </label>
                           </div>
                           <div class="form-floating mb-3">
                              <input type="email" class="form-control" id="email" name="email"  placeholder="name@example.com" required>
                              <label for="email">
                                 <i class="fas fa-at text-main"></i> Email address
                              </label>
                              <div id="email_error" class="error_field"></div>
                           </div>
                           <div class="form-floating mb-3">
                              <input type="password" class="form-control" id="password" name="password"  placeholder="Password" required>
                              <label for="password">
                                 <i class="fas fa-lock text-main"></i> Password
                              </label>
                           </div>
                           <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="Mobile" name="mobile"  placeholder="Mobile" required>
                              <label for="Mobile">
                                 <i class="fas fa-phone-alt text-main"></i> Mobile
                              </label>
                           </div>
                           <button type="submit" id="register_submit" class="btn btn-main me-1">Register</button>
                           <a href="<?php echo $front_url; ?>/login" class="btn btn-outline-main">Log In</a>

                           <input type="hidden" name="type" value="register">
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