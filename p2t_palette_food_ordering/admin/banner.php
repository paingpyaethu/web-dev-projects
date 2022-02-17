<?php include('../template/header.php'); ?>

<div class="card categories mb-3 border-0 shadow-sm">
   <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-3">
         <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="<?php echo $url;?>/index.php">Home</a></li>
         <li class="breadcrumb-item fs-7 fw-semi-bold active">Banner List</li>
      </ol>
   </nav>
</div>

<?php alertSuccess(); ?>

<div class="card border-0 shadow-sm">
   <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
         <div class="d-flex align-items-center">
            <i class="fas fa-bold fs-2 main-color"></i>
            <h3 class="mb-0 ms-2 fw-bold">Banner List</h3>
         </div>

         <div>
            <a href="banner_add.php" class="btn btn-outline-main me-2">
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
                     <th class="text-nowrap">Heading</th>
                     <th>Sub Heading</th>
                     <th>Image</th>
                     <th>Actions</th>
                     <th>Created_At</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if (bannerLists()){
                     foreach (bannerLists() as $bannerList){
                        ?>
                        <tr>
                           <td><?php echo $bannerList['id']; ?></td>
                           <td><?php echo $bannerList['heading']; ?></td>
                           <td><?php echo $bannerList['sub_heading']?></td>
                           <td>
                              <div class="show-photo">
                                 <img src="<?php echo SITE_BANNER_IMAGE.$bannerList['image']; ?>">
                              </div>
                           </td>
                           <td class="text-nowrap">

                              <?php if ($bannerList['status'] == 1){ ?>
                                 <a href="banner_status.php?id=<?php echo $bannerList['id']; ?>&type=deactive">
                                    <h5 class="mb-0 d-inline-block"><span class="badge bg-success">Active</span></h5>
                                 </a>
                              <?php }else { ?>
                                 <a href="banner_status.php?id=<?php echo $bannerList['id']; ?>&type=active">
                                    <h5 class="mb-0 d-inline-block"><span class="badge bg-warning">Deactive</span></h5>
                                 </a>
                              <?php } ?>

                              <a href="banner_edit.php?id=<?php echo $bannerList['id'];?>">
                                 <h5 class="mb-0 d-inline-block"><span class="badge bg-secondary">Edit</span></h5>
                              </a>
                              <a href="banner_delete.php?id=<?php echo $bannerList['id'];?>">
                                 <h5 class="mb-0 d-inline-block"><span class="badge bg-danger">Delete</span></h5>
                              </a>
                           </td>
                           <td><?php echo showTime($bannerList['created_at']); ?></td>
                        </tr>
                     <?php } } else {  ?>
                     <tr>
                        <td colspan="6" class="text-center fw-bold text-danger">No Data Found!</td>
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
