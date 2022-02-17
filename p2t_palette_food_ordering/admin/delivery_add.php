<?php include('../template/header.php'); ?>

   <div class="card categories mb-3 border-0 shadow-sm">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb mb-0 p-3">
            <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="delivery.php">Delivery Boy List</a></li>
            <li class="breadcrumb-item fs-7 fw-semi-bold active">Add Delivery Boy</li>
         </ol>
      </nav>
   </div>

   <div class="card border-0 shadow-sm">
      <div class="card-body">
         <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
               <i class="fas fa-plus-circle fs-2 main-color"></i>
               <h3 class="mb-0 ms-2 fw-bold">Add Delivery Boy</h3>
            </div>
            <a href="delivery.php" class="btn btn-outline-main">
               <i class="fas fa-list"></i>
            </a>
         </div>
         <hr>

         <?php

         if (isset($_POST['add_delivery_btn'])){
             echo deliveryAdd();
         }
         ?>

         <form method="post">
            <div class="mb-3">
               <label for="Name" class="form-label fs-7 fw-semi-bold">Name</label>
               <input type="text" class="form-control" id="Name" name="name" value="<?php echo oldMessage('name')?>">
            </div>
            <div class="mb-3">
               <label for="Mobile" class="form-label fs-7 fw-semi-bold">Mobile</label>
               <input type="text" class="form-control" id="Mobile" name="mobile" value="<?php echo oldMessage('mobile')?>">
            </div>
				<div class="mb-3">
					<label for="Password" class="form-label fs-7 fw-semi-bold">Password</label>
					<input type="password" class="form-control" id="Password" name="password" value="<?php echo oldMessage('password')?>">
				</div>
            <button type="submit" class="btn btn-main" name="add_delivery_btn">Submit</button>
         </form>
      </div>
   </div>








<?php include('../template/footer.php'); ?>