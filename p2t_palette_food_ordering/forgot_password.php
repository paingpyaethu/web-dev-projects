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
                        <h3 class="text-center text-danger">
                           <i class="fas fa-key"></i> Forgot Password</h3>
                        <hr>

                        <p id="forgot_form_msg" class=""></p>
                        <form method="post" id="formForgot">
                           <div class="form-floating mb-3">
                              <input type="email" class="form-control" id="email" name="email"  placeholder="name@example.com" required>
                              <label for="email">
                                 <i class="fas fa-at text-main"></i> Email address
                              </label>
                           </div>
                           <button type="submit" id="forgot_submit" class="btn btn-main me-1">Submit</button>
                           <input type="hidden" name="type" value="forgot">
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