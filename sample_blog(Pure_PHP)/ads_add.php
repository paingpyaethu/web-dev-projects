<?php require_once "core/auth.php"; ?>
<?php include "core/isEditor&Admin.php"; ?>
<?php include "template/header.php"; ?>

<div class="row">
   <div class="col-12">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb bg-white mb-4">
            <li class="breadcrumb-item"><a href="<?php echo $url; ?>/dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo $url; ?>/ads_list.php">Ads</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Ads</li>
         </ol>
      </nav>
   </div>
</div>


<form class="row" method="post" enctype="multipart/form-data" >
   <div class="col-12 col-xl-8">
      <div class="card">
         <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
               <h4 class="mb-0">
                  <i class="feather-plus-circle text-primary"></i> Add New Advertisement
               </h4>
               <a href="<?php echo $url; ?>/ads_list.php" class="btn btn-outline-primary">
                  <i class="feather-list"></i>
               </a>
            </div>
            <hr>
            <?php
            if (isset($_POST['addAds-btn'])){
               adsAdd();
            }
            ?>

					  <div class="form-group">
							<label for="">Owner Name</label>
							<input type="text" name="owner_name" class="form-control" required>
						</div>
					  <div class="form-group">
							<label for="">Photo Upload</label>
							<i class="feather-info" data-container="body" data-toggle="popover" data-placement="top" data-content="" ></i>
							<input type="file" name="photo" id="photo" class="form-control p-1" required>
						</div>
					  <div class="form-group">
							<label for="">Ads Link</label>
							<input type="text" name="link" class="form-control" required>
						</div>
					  <div class="form-group">
						  <label for="">Start Date</label>
						  <input type="date" name="start_date" class="form-control" required>
					  </div>
					  <div class="form-group">
						  <label for="">End Date</label>
						  <input type="date" name="end_date" class="form-control" required>
					  </div>
					  <hr>
					  <button class="btn btn-primary" name="addAds-btn">Create New Ads</button>
         </div>
      </div>
   </div>

</form>












<?php include "template/footer.php"; ?>
