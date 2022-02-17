<?php include('../template/header.php'); ?>

   <div class="card categories mb-3 border-0 shadow-sm">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb mb-0 p-3">
            <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="banner.php">Banner List</a></li>
            <li class="breadcrumb-item fs-7 fw-semi-bold active">Add Banner</li>
         </ol>
      </nav>
   </div>

   <div class="card border-0 shadow-sm">
      <div class="card-body">
         <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
               <i class="fas fa-bold fs-2 main-color"></i>
               <h3 class="mb-0 ms-2 fw-bold">Add Banner</h3>
            </div>
            <a href="banner.php" class="btn btn-outline-main">
               <i class="fas fa-list"></i>
            </a>
         </div>
         <hr>

         <?php
         if (isset($_POST['add_banner_btn'])){
            bannerAdd();
            alertDanger();
         }
         ?>

         <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
               <label for="formFile" class="form-label fs-7 fw-semi-bold">Image</label>
               <input class="form-control" type="file" id="formFile" name="image">
            </div>
            <div class="mb-3">
               <label for="dish" class="form-label fs-7 fw-semi-bold">Heading</label>
               <input type="text" class="form-control" id="dish" name="heading" placeholder="Heading" value="<?php echo oldMessage('heading')?>">
            </div>
            <div class="mb-3">
               <label for="dish" class="form-label fs-7 fw-semi-bold">Sub Heading</label>
               <input type="text" class="form-control" id="dish" name="sub_heading" placeholder="Sub Heading" value="<?php echo oldMessage('sub_heading')?>">
            </div>
            <div class="mb-3">
               <label for="dish" class="form-label fs-7 fw-semi-bold">Link</label>
               <input type="text" class="form-control" id="dish" name="link" placeholder="Link" value="<?php echo oldMessage('link')?>">
            </div>
            <div class="mb-3">
               <label for="dish" class="form-label fs-7 fw-semi-bold">Link Text</label>
               <input type="text" class="form-control" id="dish" name="link_txt" placeholder="Link Text" value="<?php echo oldMessage('link_txt')?>">
            </div>
            <div class="mb-3">
               <label for="OrderNumber" class="form-label fs-7 fw-semi-bold">Order Number</label>
               <input type="number" class="form-control" id="OrderNumber" name="order_number" placeholder="Order Number" value="<?php echo oldMessage('order_number');?>">
            </div>
            <button type="submit" class="btn btn-main" name="add_banner_btn">Submit</button>
         </form>

      </div>
   </div>


<?php include('../template/footer.php'); ?>