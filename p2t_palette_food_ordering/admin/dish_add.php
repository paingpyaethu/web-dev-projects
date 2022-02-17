<?php include('../template/header.php'); ?>



   <div class="card categories mb-3 border-0 shadow-sm">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb mb-0 p-3">
            <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="dish.php">Dish List</a></li>
            <li class="breadcrumb-item fs-7 fw-semi-bold active">Add Dish</li>
         </ol>
      </nav>
   </div>

   <div class="card border-0 shadow-sm">
      <div class="card-body">
         <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
               <i class="fas fa-plus-circle fs-2 main-color"></i>
               <h3 class="mb-0 ms-2 fw-bold">Add Dish</h3>
            </div>
            <a href="dish.php" class="btn btn-outline-main">
               <i class="fas fa-list"></i>
            </a>
         </div>
         <hr>

         <?php

            if (isset($_POST['add_dish_btn'])){
               dishAdd();
               alertDanger();
               alertWarning();
            }
         ?>

         <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
               <label for="dish" class="form-label fs-7 fw-semi-bold">Category</label>
               <select class="form-select" aria-label="dish" name="category_id">
                  <option selected>Select Category</option>
                  <?php
                     foreach (dishCategories() as $dishCategory){
                        if ($dishCategory['id']==oldMessage('category_id')){
                           echo "<option value='".$dishCategory['id']."' selected>".$dishCategory['category']."</option>";
                        }else{
                           echo "<option value='".$dishCategory['id']."'>".$dishCategory['category']."</option>";
                        }
                     }
                  ?>
               </select>
            </div>
            <div class="mb-3">
               <label for="dish" class="form-label fs-7 fw-semi-bold">Dish</label>
               <input type="text" class="form-control" id="dish" name="dish" placeholder="Dish" value="<?php echo oldMessage('dish')?>">
            </div>
            <?php $arrType = array("VEG","NON-VEG"); ?>
            <div class="mb-3">
               <label for="dish" class="form-label fs-7 fw-semi-bold">Type</label>
               <select class="form-select" aria-label="dish" name="types" required>
                  <option selected>Select Type</option>
                  <?php
                     foreach ($arrType as $list){
                        if ($list == oldMessage('types')){
                           echo "<option value='$list' selected>$list</option>";
                        }else {
                           echo "<option value='".$list."'>$list</option>";
                        }
                     }
                  ?>
               </select>
            </div>

            <div class="mb-3">
               <label for="dish" class="form-label fs-7 fw-semi-bold">Dish Detail</label>
               <textarea type="text" class="form-control" id="dish" name="dish_detail" placeholder="Dish Detail"><?php echo oldMessage('dish_detail')?></textarea>
            </div>
            <div class="mb-3">
               <label for="formFile" class="form-label fs-7 fw-semi-bold">Dish Image</label>
               <input class="form-control" type="file" id="formFile" name="image">
            </div>

            <div class="row mb-3" id="dish_box_1">
               <label for="dish" class="form-label fs-7 fw-semi-bold">Dish Details</label>
               <div class="col-4">
                  <input type="text" class="form-control" placeholder="Attribute" aria-label="attribute" name="attribute[]">
               </div>
               <div class="col-3">
                  <input type="text" class="form-control" placeholder="Price" aria-label="price" name="price[]">
               </div>
               <div class="col-3">
                  <select class="form-select" name="status[]" required>
                     <option selected>Select Status</option>
                     <option value="1">Active</option>
                     <option value="0">Deactive</option>
                  </select>
               </div>
            </div>
            <button type="submit" class="btn btn-main" name="add_dish_btn">Submit</button>
            <button type="button" class="btn btn-outline-success ms-3" onclick="add_more()">Add More</button>
         </form>
      </div>
   </div>

   <input type="hidden" id="add_more" value="1">
   <script>
      function add_more() {
         let addMore = jQuery('#add_more').val();
         addMore++;
         jQuery('#add_more').val(addMore);
         let html = `
         <div class="row mt-3" id="box${addMore}">
            <div class="col-4">
               <input type="text" class="form-control" placeholder="Attribute" aria-label="attribute" name="attribute[]" required>
            </div>
            <div class="col-3">
               <input type="text" class="form-control" placeholder="Price" aria-label="price" name="price[]" required>
            </div>
            <div class="col-3">
               <select class="form-select" name="status[]" required>
                  <option selected>Select Status</option>
                  <option value="1">Active</option>
                  <option value="0">Deactive</option>
               </select>
            </div>
            <div class="col-2">
               <button type="button" class="btn btn-danger" onclick=remove("${addMore}")>Remove</button>
            </div>
         </div>
         `;
         jQuery('#dish_box_1').append(html);
      }

      function remove(id) {
         jQuery('#box'+id).remove();
      }
   </script>

<?php include('../template/footer.php'); ?>