<?php include('../template/header.php'); ?>

<div class="card categories mb-3 border-0 shadow-sm">
   <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-3">
         <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="<?php echo $url;?>/index.php">Home</a></li>
         <li class="breadcrumb-item fs-7 fw-semi-bold active">Contact Us</li>
      </ol>
   </nav>
</div>

<div class="card border-0 shadow-sm">
   <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
         <div class="d-flex align-items-center">
            <i class="fas fa-address-book fs-2 main-color"></i>
            <h3 class="mb-0 ms-2 fw-bold">Contact Us</h3>
         </div>

         <div>
            <a href="category_add.php" class="btn btn-outline-main me-2">
               <i class="fas fa-plus-circle"></i>
            </a>
            <a href="#" class="btn btn-outline-secondary full-screen-btn">
               <i class="fas fa-expand"></i>
            </a>
         </div>
      </div>
      <hr>
      <div class="row">
         <div class="col-12">
            <div class="table-responsive">
               <table class="table ">
                  <thead>
                  <tr>
                     <th>#</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Mobile</th>
                     <th class="text-nowrap">Subject</th>
                     <th class="text-nowrap">Message</th>
                     <th>Actions</th>
                     <th>Created_At</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if (contactUs()){
                     foreach (contactUs() as $contactUs){
                        ?>
                        <tr>
                           <td class="text-nowrap"><?php echo $contactUs['id']; ?></td>
                           <td class="text-nowrap"><?php echo $contactUs['name']; ?></td>
                           <td class="text-nowrap"><?php echo $contactUs['email']; ?></td>
                           <td class="text-nowrap"><?php echo $contactUs['mobile']; ?></td>
                           <td class="text-nowrap"><?php echo $contactUs['subject']; ?></td>
                           <td class="text-nowrap"><?php echo $contactUs['message']; ?></td>
                           <td class="text-nowrap">
                              <a href="admin_contact_delete.php?id=<?php echo $contactUs['id'];?>">
                                 <h5 class="mb-0 d-inline-block"><span class="badge bg-danger">Delete</span></h5>
                              </a>
                           </td>
                           <td class="text-nowrap"><?php echo showTime($contactUs['created_at']); ?></td>
                        </tr>
                     <?php } } else {  ?>
                     <tr>
                        <td colspan="8" class="text-center fw-bold text-danger">No Data Found!</td>
                     </tr>
                  <?php }  ?>

                  </tbody>
               </table>
            </div>
         </div>
      </div>



   </div>
</div>





<?php include('../template/footer.php'); ?>
<script>
   $('.table').dataTable({
      // "order": [[ 0, "desc" ]]
   });
</script>
