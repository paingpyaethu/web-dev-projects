<?php include('../template/header.php'); ?>

<?php

if (isset($_POST['submit']))
{
   $cart_min_price = textFilter($_POST['cart_min_price']);
   $cart_min_price_msg = textFilter($_POST['cart_min_price_msg']);
   $website_close = textFilter($_POST['website_close']);
   $website_close_msg = textFilter($_POST['website_close_msg']);

   mysqli_query(conn(), "UPDATE settings SET cart_min_price='$cart_min_price', cart_min_price_msg='$cart_min_price_msg',
                              website_close='$website_close',website_close_msg='$website_close_msg' WHERE 1");
}

$row = mysqli_fetch_assoc(mysqli_query(conn(), "SELECT * FROM settings WHERE 1"));
$cart_min_price = $row['cart_min_price'];
$cart_min_price_msg = $row['cart_min_price_msg'];
$website_close = $row['website_close'];
$website_close_msg = $row['website_close_msg'];

$websiteCloseArr = array('No','Yes');
?>

   <div class="card categories mb-3 border-0 shadow-sm">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb mb-0 p-3">
            <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item fs-7 fw-semi-bold active">Setting</li>
         </ol>
      </nav>
   </div>

   <div class="card border-0 shadow-sm">
      <div class="card-body">
         <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
               <i class="fas fa-tools fs-2 main-color"></i>
               <h3 class="mb-0 ms-2 fw-bold">Setting</h3>
            </div>
         </div>
         <hr>

         <form method="post">
            <div class="mb-3">
               <label for="Setting" class="form-label fs-7 fw-semi-bold">Cart Min Price</label>
               <input type="text" class="form-control" id="Setting" name="cart_min_price" value="<?php echo $cart_min_price;?>">
            </div>

            <div class="mb-3">
               <label for="Setting" class="form-label fs-7 fw-semi-bold">Cart Min Price Msg</label>
               <input type="text" class="form-control" id="Setting" name="cart_min_price_msg" value="<?php echo $cart_min_price_msg;?>">
            </div>

            <div class="mb-3">
               <label for="Setting" class="form-label fs-7 fw-semi-bold">Website Close</label>
               <select class="form-select" aria-label="Setting" name="website_close">
                  <option value="">Select Category</option>
                  <?php
                  foreach ($websiteCloseArr as $key=>$val){
                     if ($website_close==$key){
                        echo "<option value='$key' selected='selected'>$val</option>";
                     }else{
                        echo "<option value='$key'>$val</option>";
                     }
                  }
                  ?>
               </select>
            </div>

            <div class="mb-3">
               <label for="Setting" class="form-label fs-7 fw-semi-bold">Website Close Msg</label>
               <input type="text" class="form-control" id="Setting" name="website_close_msg" value="<?php echo $website_close_msg;?>">
            </div>
            <button type="submit" class="btn btn-main" name="submit">Submit</button>
         </form>
      </div>
   </div>

<?php include('../template/footer.php'); ?>