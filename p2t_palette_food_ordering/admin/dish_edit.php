<?php include('../template/header.php'); ?>

   <div class="card categories mb-3 border-0 shadow-sm">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb mb-0 p-3">
            <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="dish.php">Dish List</a></li>
            <li class="breadcrumb-item fs-7 fw-semi-bold active">Update Dish</li>
         </ol>
      </nav>
   </div>

   <div class="card border-0 shadow-sm">
      <div class="card-body">
         <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
               <i class="fas fa-edit fs-2 main-color"></i>
               <h3 class="mb-0 ms-2 fw-bold">Update Dish</h3>
            </div>
            <a href="dish.php" class="btn btn-outline-main">
               <i class="fas fa-list"></i>
            </a>
         </div>
         <hr>

         <?php
            $edit_id = $_GET['id'];
            $updateDish = dish($edit_id);

            if (isset($_GET['dish_details_id']) && $_GET['dish_details_id']>0){
               $dish_details_id = textFilter($_GET['dish_details_id']);
               mysqli_query(conn(),"DELETE FROM dish_details WHERE id='$dish_details_id'");
               redirect('dish_edit.php?id='.$edit_id);
            }

            if (isset($_POST['update_dish_btn'])){

               dishUpdate();
               alertWarning();
               alertDanger();
            }
         ?>

         <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
               <input type="hidden" value="<?php echo $edit_id ?>" name="id">
               <label for="Dish" class="form-label fs-7 fw-semi-bold">Category</label>
               <select class="form-select" aria-label="Dish" name="category_id">
                  <option selected>Select Category</option>
                  <?php
                     foreach (dishCategories() as $dishCategory){
                        if ($dishCategory['id'] == $updateDish['category_id']){
                           echo "<option value='".$dishCategory['id']."' selected>".$dishCategory['category']."</option>";
                        }else {
                           echo "<option value='".$dishCategory['id']."'>".$dishCategory['category']."</option>";
                        }
                     }
                  ?>
               </select>
            </div>
            <div class="mb-3">
               <label for="Dish" class="form-label fs-7 fw-semi-bold">Dish</label>
               <input type="text" class="form-control" id="Dish" name="dish" placeholder="Dish" value="<?php echo $updateDish['dish'];?>">
            </div>
            <?php
               $arrType = array("veg","non-veg");
            ?>
            <div class="mb-3">
               <input type="hidden" value="<?php echo $edit_id ?>" name="id">
               <label for="Dish" class="form-label fs-7 fw-semi-bold">Type</label>
               <select class="form-select" aria-label="Dish" name="types" required>
                  <option selected>Select Type</option>
                  <?php
                     foreach ($arrType as $list){
                        if ($list == $updateDish['type']){
                           echo "<option value='".strtoupper($list)."' selected>".strtoupper($list)."</option>";
                        }else {
                           echo "<option value='".strtoupper($list)."'>".strtoupper($list)."</option>";
                        }
                     }
                  ?>
               </select>
            </div>

            <div class="mb-3">
               <label for="Dish" class="form-label fs-7 fw-semi-bold">Dish Detail</label>
               <textarea type="text" rows="5" class="form-control" id="Dish" name="dish_detail"
                         placeholder="Dish Detail"><?php echo $updateDish['dish_detail'];?>
					</textarea>
            </div>
            <div class="mb-3">
               <label for="formFile" class="form-label fs-7 fw-semi-bold">Dish Image</label>
               <input class="form-control" type="file" id="image" name="image" value="<?php echo $updateDish['image'];?>">
            </div>

            <div class="row mb-3" id="dish_box_1">
               <label for="dish" class="form-label fs-7 fw-semi-bold">Dish Details</label>
               <?php
                  $id = $updateDish['id'];
                  $dish_details_res = mysqli_query(conn(),"select * from dish_details where dish_id='$id'");
                  $ii = 1;
                  while ($dish_details_row = mysqli_fetch_assoc($dish_details_res)){
                     ?>
                     <div class="col-4 mt-2">
                        <input type="hidden" name="dish_details_id[]" value="<?php echo $dish_details_row['id']?>">
                        <input type="text" class="form-control" placeholder="Attribute" aria-label="attribute" name="attribute[]"
                               value="<?php  echo $dish_details_row['attribute']; ?>" required>
                     </div>
                     <div class="col-3 mt-2">
                        <input type="text" class="form-control" placeholder="Price" aria-label="price" name="price[]"
                               value="<?php  echo $dish_details_row['price']; ?>" required>
                     </div>
                     <div class="col-3 mt-2">
                        <select class="form-select" name="status[]" required>
                           <option selected>Select Status</option>
                           <?php if ($dish_details_row['status'] == 1){ ?>
                           <option value="1" selected>Active</option>
                           <option value="0">Deactive</option>
                           <?php } ?>
                           <?php if ($dish_details_row['status'] == 0){ ?>
                              <option value="1">Active</option>
                              <option value="0" selected>Deactive</option>
                           <?php } ?>
                        </select>
                     </div>
                     <?php if ($ii!=1){ ?>
                        <div class="col-2">
                           <button type="button" class="btn btn-danger mt-2" onclick="removeOld('<?php echo $dish_details_row['id']?>')">
                              Remove
                           </button>
                        </div>
                     <?php } ?>
                     <?php $ii++; } ?>
            </div>

            <button type="submit" class="btn btn-main" name="update_dish_btn">Update</button>
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
         <div class="row mt-2" id="box${addMore}">
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

      function removeOld(id) {
         const result = confirm('Are you sure?');
         if (result === true){
            const cur_path = window.location.href;
            window.location.href = cur_path+"&dish_details_id="+id;
         }
      }
   </script>

<?php include('../template/footer.php'); ?>