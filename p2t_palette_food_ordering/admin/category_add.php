<?php include('../template/header.php'); ?>

<div class="card categories mb-3 border-0 shadow-sm">
   <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-3">
         <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="index.php">Home</a></li>
         <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="category_list.php">Category List</a></li>
         <li class="breadcrumb-item fs-7 fw-semi-bold active">Add Category</li>
      </ol>
   </nav>
</div>

<div class="card border-0 shadow-sm">
   <div class="card-body">
      <div class="d-flex align-items-center justify-content-between">
			<div class="d-flex align-items-center">
				<i class="fas fa-plus-circle fs-2 main-color"></i>
				<h3 class="mb-0 ms-2 fw-bold">Add Category</h3>
			</div>
			<a href="category_list.php" class="btn btn-outline-main">
				<i class="fas fa-list"></i>
			</a>
      </div>
      <hr>

		 	<?php
				if (isset($_POST['add_category_btn'])){
					echo categoryAdd();
				}
			?>

      <form method="post">
         <div class="mb-3">
            <label for="Category" class="form-label fs-7 fw-semi-bold">Category</label>
            <input type="text" class="form-control" id="Category" name="category" value="<?php echo oldMessage('category');?>">
         </div>

         <div class="mb-3">
            <label for="OrderNumber" class="form-label fs-7 fw-semi-bold">Order Number</label>
            <input type="number" class="form-control" id="OrderNumber" name="order_number" value="<?php echo oldMessage('order_number');?>">
         </div>
         <button type="submit" class="btn btn-main" name="add_category_btn">Submit</button>
      </form>
   </div>
</div>








<?php include('../template/footer.php'); ?>