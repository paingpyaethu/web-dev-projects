<?php include('../template/header.php'); ?>

   <div class="card categories mb-3 border-0 shadow-sm">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb mb-0 p-3">
            <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="coupon_code.php">Coupon Code List</a></li>
            <li class="breadcrumb-item fs-7 fw-semi-bold active">Update Coupon Code</li>
         </ol>
      </nav>
   </div>

   <div class="card border-0 shadow-sm">
      <div class="card-body">
         <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
               <i class="fas fa-edit fs-2 main-color"></i>
               <h3 class="mb-0 ms-2 fw-bold">Update Coupon Code</h3>
            </div>
            <a href="coupon_code.php" class="btn btn-outline-main">
               <i class="fas fa-list"></i>
            </a>
         </div>
         <hr>

         <?php
         $id = $_GET['id'];
         $updateCouponCode = couponCode($id);

         if (isset($_POST['add_couponCode_btn'])){
            echo couponCodeUpdate();
         }
         ?>

			<form method="post">
				<div class="mb-3">
					<input type="hidden" value="<?php echo $id ?>" name="id">
					<label for="CouponCode" class="form-label fs-7 fw-semi-bold">Coupon Code</label>
					<input type="text" class="form-control" id="CouponCode" name="coupon_code" value="<?php echo $updateCouponCode['coupon_code']?>">
				</div>
				<div class="mb-3">
					<label for="CouponType" class="form-label fs-7 fw-semi-bold">Coupon Type</label>
					<select class="form-select" aria-label="CouponType" name="coupon_type">
						<option selected>Select Type</option>
                  <?php
                  $arr = array('P'=>'Percentage','F'=>'Fixed');
                  foreach ($arr as $key=>$val){
                  	if ($key==$updateCouponCode['coupon_type']){
                        echo "<option value='".$key."' selected>".$val."</option>";
							}else  {
                        echo "<option value='".$key."'>".$val."</option>";
                     }
                  }
                  ?>
					</select>
				</div>
				<div class="mb-3">
					<label for="CouponValue" class="form-label fs-7 fw-semi-bold">Coupon Value</label>
					<input type="text" class="form-control" id="CouponValue" name="coupon_value" value="<?php echo $updateCouponCode['coupon_value']?>">
				</div>
				<div class="mb-3">
					<label for="CartMinValue" class="form-label fs-7 fw-semi-bold">Cart Min Value</label>
					<input type="text" class="form-control" id="CartMinValue" name="cart_min_value" value="<?php echo $updateCouponCode['cart_min_value']?>">
				</div>
				<div class="mb-3">
					<label for="Date" class="form-label fs-7 fw-semi-bold">Expired On</label>
					<input type="date" class="form-control" id="Date" name="expired_on" value="<?php echo $updateCouponCode['expired_on']?>">
				</div>
				<button type="submit" class="btn btn-main" name="add_couponCode_btn">Submit</button>
			</form>


		</div>
   </div>

<?php include('../template/footer.php'); ?>