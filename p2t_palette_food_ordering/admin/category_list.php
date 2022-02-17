<?php include('../template/header.php'); ?>

   <div class="card categories mb-3 border-0 shadow-sm">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb mb-0 p-3">
            <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="<?php echo $url;?>/index.php">Home</a></li>
            <li class="breadcrumb-item fs-7 fw-semi-bold active">Category List</li>
         </ol>
      </nav>
   </div>

   <div class="card border-0 shadow-sm">
      <div class="card-body">
         <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
               <i class="fas fa-layer-group fs-2 main-color"></i>
               <h3 class="mb-0 ms-2 fw-bold">Category List</h3>
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
								<th>Category</th>
								<th class="text-nowrap">Order Number</th>
								<th>Actions</th>
								<th>Created_At</th>
							</tr>
							</thead>
							<tbody>
                     <?php
                     if (categoryLists()){
                        foreach (categoryLists() as $categoryList){
                     ?>
								<tr>
									<td><?php echo $categoryList['id']; ?></td>
									<td><?php echo $categoryList['category']; ?></td>
									<td><?php echo $categoryList['order_number']; ?></td>
									<td class="text-nowrap">

										<?php if ($categoryList['status'] == 1){ ?>
											<a href="category_status.php?id=<?php echo $categoryList['id']; ?>&type=deactive">
												<h5 class="mb-0 d-inline-block"><span class="badge bg-success">Active</span></h5>
											</a>
										<?php }else { ?>
											<a href="category_status.php?id=<?php echo $categoryList['id']; ?>&type=active">
												<h5 class="mb-0 d-inline-block"><span class="badge bg-warning">Deactive</span></h5>
											</a>
										<?php } ?>

										<a href="category_edit.php?id=<?php echo $categoryList['id'];?>">
											<h5 class="mb-0 d-inline-block"><span class="badge bg-secondary">Edit</span></h5>
										</a>
										<a href="category_delete.php?id=<?php echo $categoryList['id'];?>">
											<h5 class="mb-0 d-inline-block"><span class="badge bg-danger">Delete</span></h5>
										</a>
									</td>
									<td><?php echo showTime($categoryList['created_at']); ?></td>
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
