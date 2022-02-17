<?php include('../template/header.php'); ?>

<div class="card categories mb-3 border-0 shadow-sm">
   <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-3">
         <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="dashboard.php">Home</a></li>
         <li class="breadcrumb-item fs-7 fw-semi-bold active">Coupon Code List</li>
      </ol>
   </nav>
</div>

<div class="card border-0 shadow-sm">
   <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
         <div class="d-flex align-items-center">
            <i class="fas fa-credit-card fs-2 main-color"></i>
            <h3 class="mb-0 ms-2 fw-bold">Coupon Code List</h3>
         </div>

         <div>
            <a href="coupon_code_add.php" class="btn btn-outline-main me-2">
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
                     <th>Code/Value</th>
                     <th>Type</th>
                     <th>Cart Min</th>
                     <th>Expired On</th>
                     <th>Actions</th>
                     <th>Created_At</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if (couponCodeLists()){
                     foreach (couponCodeLists() as $couponCodeList){
                  ?>
							<tr>
								<td><?php echo $couponCodeList['id']; ?></td>
								<td><?php echo $couponCodeList['coupon_code']; ?> / <?php echo $couponCodeList['coupon_value']; ?></td>
								<td><?php echo $couponCodeList['coupon_type']; ?></td>
								<td><?php echo $couponCodeList['cart_min_value']; ?></td>
								<td>
									<?php
									if ($couponCodeList['expired_on'] == '0000-00-00'){
										echo '...';
									}else {
										echo $couponCodeList['expired_on'];
									}
									 ?>
								</td>

								<td class="text-nowrap">
									<?php if ($couponCodeList['status'] == 1){ ?>
										<a href="coupon_code_status.php?id=<?php echo $couponCodeList['id']; ?>&type=deactive">
											<h5 class="mb-0 d-inline-block"><span class="badge bg-success">Active</span></h5>
										</a>
									<?php }else { ?>
										<a href="coupon_code_status.php?id=<?php echo $couponCodeList['id']; ?>&type=active">
											<h5 class="mb-0 d-inline-block"><span class="badge bg-warning">Deactive</span></h5>
										</a>
									<?php } ?>
									<a href="coupon_code_edit.php?id=<?php echo $couponCodeList['id'];?>">
										<h5 class="mb-0 d-inline-block"><span class="badge bg-secondary">Edit</span></h5>
									</a>
									<a href="coupon_code_delete.php?id=<?php echo $couponCodeList['id'];?>">
										<h5 class="mb-0 d-inline-block"><span class="badge bg-danger">Delete</span></h5>
									</a>
								</td>
								<td><?php echo showTime($couponCodeList['created_at']); ?></td>
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
