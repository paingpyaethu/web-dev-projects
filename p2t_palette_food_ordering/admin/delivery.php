<?php include('../template/header.php'); ?>

<div class="card categories mb-3 border-0 shadow-sm">
   <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-3">
         <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="index.php">Home</a></li>
         <li class="breadcrumb-item fs-7 fw-semi-bold active">Delivery Boy List</li>
      </ol>
   </nav>
</div>

<div class="card border-0 shadow-sm">
   <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
         <div class="d-flex align-items-center">
            <i class="fas fa-motorcycle fs-2 main-color"></i>
            <h3 class="mb-0 ms-2 fw-bold">Delivery Boy List</h3>
         </div>

         <div>
            <a href="delivery_add.php" class="btn btn-outline-main me-2">
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
                     <th>Mobile</th>
                     <th>Actions</th>
                     <th>Created_At</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if (deliveryBoyLists()){
                     foreach (deliveryBoyLists() as $deli){
                  ?>
							<tr>
								<td><?php echo $deli['id']; ?></td>
								<td><?php echo $deli['name']; ?></td>
								<td><?php echo $deli['mobile']; ?></td>
								<td class="text-nowrap">
									<?php if ($deli['status'] == 1){ ?>
										<a href="delivery_status.php?id=<?php echo $deli['id']; ?>&type=deactive">
											<h5 class="mb-0 d-inline-block"><span class="badge bg-success">Active</span></h5>
										</a>
									<?php }else { ?>
										<a href="delivery_status.php?id=<?php echo $deli['id']; ?>&type=active">
											<h5 class="mb-0 d-inline-block"><span class="badge bg-warning">Deactive</span></h5>
										</a>
									<?php } ?>
									<a href="delivery_edit.php?id=<?php echo $deli['id'];?>">
										<h5 class="mb-0 d-inline-block"><span class="badge bg-secondary">Edit</span></h5>
									</a>
								</td>
								<td><?php echo showTime($deli['created_at']); ?></td>
							</tr>
                     <?php } } else {  ?>
                     <tr>
                        <td colspan="5" class="text-center fw-bold text-danger">No Data Found!</td>
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
