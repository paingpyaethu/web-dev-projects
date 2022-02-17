<?php include('template/front_panel/header.php'); ?>

<?php
if(!isset($_SESSION['FOOD_USER_ID'])){
   redirect('shop');
}

if (isset($_SESSION['FOOD_USER_ID'])){
   $is_show = '';
   $box_id = '';
   $final_show = 'show';
   $final_box_id = 'collapse-02';
   $checkOutCollapse = 'collapsed';
   $userDetails = getUserDetailById();
}else {
   $is_show = 'show';
   $box_id = 'collapse-01';
   $final_show = '';
   $final_box_id = '';
   $infoCollapse = 'collapsed';
}
?>

<div class="container-fluid bg-light shadow-sm">
   <div class="row">
      <div class="col-12">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <div class="card border-0 bg-light" style="padding: 1.3rem 0">
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 fw-semi-bold">
                           <li class="breadcrumb-item"><a href="<?php echo $front_url; ?>/index">Home</a></li>
                           <li class="breadcrumb-item active">Check out</li>
                        </ol>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="container-fluid">
   <div class="row">
      <div class="col-12">

         <div class="container">
            <div class="row min-vh-80 py-5">
               <div class="col-12 col-md-7 col-lg-8 col-xl-9">
                  <div id="queries" class="faq">
                     <div class="query-item">
                        <div class="query-header" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapseExample">
                           <h3 class="mb-0">Edit your account information</h3>
                        </div>

                        <div class="collapse show" id="collapse1">
                           <div class="query-body">
                              <p id="form_msg" class="success_field"></p>
                              <form class="row g-3" method="post" id="formProfile">
                                 <div class="col-md-6">
                                    <label for="userName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="userName" name="name" value="<?php echo $userDetails['name']?>" required>
                                 </div>
                                 <div class="col-md-6">
                                    <label for="inputMobile" class="form-label">Mobile</label>
                                    <input type="text" class="form-control" id="inputMobile" name="mobile" value="<?php echo $userDetails['mobile']?>" required>
                                 </div>
                                 <div class="col-12">
                                    <label for="Email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="Email" name="email" value="<?php echo $userDetails['email']?>" required>
                                 </div>

                                 <div class="col-12">
                                    <a href="#" class="btn btn-outline-danger text-uppercase">
                                       Back
                                    </a>
                                    <button type="submit" id="profile_submit" class="btn btn-success text-uppercase">Save</button>
                                 </div>
                                 <input type="hidden" name="type" value="profile">
                              </form>

                           </div>
                        </div>
                     </div>

                     <div class="query-item">
                        <div class="query-header collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false" aria-controls="collapseExample">
                           <h3 class="mb-0">Change Password</h3>
                        </div>

                        <div class="collapse" id="collapse-2">
                           <div class="query-body">
                              <p id="password_form_msg" class="alert_field mb-1"></p>
                              <form class="row g-3" method="post" id="formPassword">
                                 <div class="col-md-6">
                                    <label for="Password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="Password" name="old_password" required>
                                 </div>
                                 <div class="col-md-6">
                                    <label for="ConfirmPassword" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="ConfirmPassword" name="new_password" required>
                                 </div>

                                 <div class="col-12">
                                    <a href="#" class="btn btn-outline-danger text-uppercase">
                                       Back
                                    </a>
                                    <button type="submit" id="password_submit" class="btn btn-success text-uppercase">Confirm</button>
                                 </div>
                                 <input type="hidden" name="type" value="password">
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php include('template/front_panel/footer.php'); ?>
