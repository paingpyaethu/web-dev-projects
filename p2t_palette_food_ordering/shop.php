<?php include('template/front_panel/header.php'); ?>
<?php
$cat_dish='';
$type = '';
$cat_dish_arr=array();

if(isset($_GET['cat_dish'])){
   $cat_dish=textFilter($_GET['cat_dish']);
   $cat_dish_arr=array_filter(explode(':',$cat_dish));
   $cat_dish_str=implode(",",$cat_dish_arr);
}


if(isset($_GET['type'])){
   $type = $_GET['type'];
}

$arrType = array("veg","non-veg","both");
?>
<div class="container-fluid bg-light shadow-sm">
   <div class="row">
      <div class="col-12">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <div class="card border-0 bg-light" style="padding: 1.3rem 0">
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 fw-semi-bold">
                           <li class="breadcrumb-item"><a href="<?php echo $front_url; ?>/index">Home</a></li>
                           <li class="breadcrumb-item active">Shop</li>
                        </ol>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

   <?php
   if ($website_close == 1)
   {
      echo "<div class='text-center mt-5 text-danger'>
               <h2 class='mb-0 fw-bold'> $website_close_msg </h2>
            </div>";
   }
   ?>

<div class="container-fluid">
   <div class="row">
      <div class="col-12">
         <div class="container">
            <div class="row my-5 py-lg-3 flex-row-reverse min-vh-80">
               <div class="col-12 col-lg-9 ">

                  <div class="text-center text-md-end">
                     <?php
                     foreach ($arrType as $item) {
                        $typeRadioSelected = '';
                        if ($item == $type){
                           $typeRadioSelected = "checked='checked'";
                        }
                     ?>
                        <div class="form-check-inline">
                           <input class="form-check-input" type="checkbox" name="type" value="<?php echo $item;?>"
                                  id="flexCheckDefault_<?php echo $item;?>" onclick="setFoodType('<?php echo $item;?>')"
                              <?php echo $typeRadioSelected;?> >
                           <label class="form-check-label fw-bold" for="flexCheckDefault_<?php echo $item;?>">
                              <?php echo strtoupper($item);?>
                           </label>
                        </div>

                     <?php } ?>
                  </div>

                  <?php
                  $cat_id=0;
                  $product_sql="SELECT * FROM dishes WHERE status=1";
                  if($cat_dish!=''){
                     $product_sql.=" AND category_id IN ($cat_dish_str) ";
                  }
                  if($type!='' && $type!='both'){
                     $product_sql.=" and type ='$type' ";
                  }
                  $product_sql.=" ORDER BY id DESC";
                  $product_res=mysqli_query(conn(),$product_sql);
                  $product_count=mysqli_num_rows($product_res);
                  ?>
                  <?php if (!empty($product_count)){ ?>
                  <div class="row">
                     <?php while ($product_row = mysqli_fetch_assoc($product_res)){  ?>
                     <div class="col-12 col-md-6 col-xl-4">
                        <div class="card products ps-2 shadow bg-light border-0 mt-4">
                           <div class="product-img">
                              <a href="javascript::void(0)">
                                 <img src="<?php echo SITE_DISH_IMAGE.$product_row['image']?>" alt="" class="img-fluid">
                              </a>
                           </div>
                           <div class="product-content ms-3">
                              <h5 class="text-main fw-bold">
                                 <?php
                                 if ($product_row['type'] == 'veg'){
                                    echo "<img src='assets/images/icon-img/veg.png'>";
                                 }else {
                                    echo "<img src='assets/images/icon-img/non-veg.png'>";
                                 }

                                 ?>
                                 <a href="javascript::void(0)">
                                    <?php echo $product_row['dish']?>
                                 </a>
                              </h5>
                              <?php
                              $dish_attr_res = mysqli_query(conn(),"SELECT * FROM dish_details WHERE dish_id = '".$product_row['id']."' ORDER BY price ASC");
                              ?>
                              <div class="form-check products-cart">
                                 <?php while ($dish_attr_row = mysqli_fetch_assoc($dish_attr_res)) { ?>

                                 <?php if ($website_close == 0) { ?>
                                 <input class="form-check-input" <?php echo $dish_attr_row['status'] == 0 ? 'disabled' : '' ;?>
                                        type="radio" name="Radio_<?php echo $product_row['id']; ?>" id="RadioBtn_<?php echo $dish_attr_row['id']; ?>"
                                        value="<?php echo $dish_attr_row['id']; ?>">
                                 <?php } ?>

                                 <label class="form-check-label" for="RadioBtn_<?php echo $dish_attr_row['id']; ?>">
                                    <?php echo $dish_attr_row['attribute'];?>
                                    <span class="fw-bold text-danger"> $<?php echo $dish_attr_row['price'];?></span>
                                    <?php
                                    $addedMsg = "";
                                    if (array_key_exists($dish_attr_row['id'], $cartArr)){
                                       $addedQty = getUserFullCart($dish_attr_row['id']);
                                       $addedMsg = "( Added - $addedQty )";
                                    }
                                    echo "<span id='shop_added_msg_".$dish_attr_row['id']."' class='text-success fw-bold fs-12'>
                                          ".$addedMsg."
                                          </span>";
                                    ?>
                                 </label>

                                 <?php } ?>
                              </div>
                              <div class="d-flex align-items-center">
                                 <?php if ($website_close == 0){ ?>
                                 <select id="qty<?php echo $product_row['id']?>" class="form-select form-select-sm mt-3" aria-label=".form-select-sm example">
                                    <option value="0">Qty</option>
                                    <?php for ($i=1; $i<=20; $i++){
                                       echo "<option>$i</option>";
                                    } ?>
                                 </select>
                                 <i class="fas fa-cart-plus fs-7 mt-3 ms-1 btn btn-sm btn-outline-primary" style="cursor: pointer;"
                                    onclick="addToCart('<?php echo $product_row['id']?>','add')">
                                    <span class="mt-3 ms-1 fs-6">Add to cart</span>
                                 </i>
                                 <?php }?>
                              </div>
                              <?php if ($website_close == 1){ ?>
                                 <p class="mb-0 mt-2 fw-bold text-danger"><?php echo $website_close_msg; ?></p>
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                     <?php } ?>
                  </div>
                  <?php }else {
                     echo '<p class="alert alert-danger mt-5">No Dish Found!</p>';
                  } ?>
               </div>

               <?php
               $cat_res = mysqli_query(conn(), "SELECT * FROM categories WHERE status=1 ORDER BY order_number DESC");
               ?>

               <div class="col-12 col-lg-3 mt-5 mt-lg-0">
                  <div class="card shadow-sm">
                     <div class="card-body">
                        <div class="shop-category">
                           <h5 class="mb-4 fw-bold">Shop By Categories</h5>
                           <div class="category_list">
                              <div class="form-check">
                                 <a href="<?php echo $front_url;?>/shop">
                                    <h6><span class="badge bg-danger fs-6">Clear</span></h6>
                                 </a>
                              </div>

                              <?php
                              while($cat_row=mysqli_fetch_assoc($cat_res)){
                                 $is_checked='';
                                 if(in_array($cat_row['id'],$cat_dish_arr)){
                                    $is_checked="checked='checked'";
                                 }
                                 echo "
                              <div class='form-check'>
                                 <input class='form-check-input' $is_checked type='checkbox' value='".$cat_row['id']."'
                                       name='cat_arr[]' id='dishCate_".$cat_row['id']."' onclick=set_checkbox('".$cat_row['id']."')>
                                 <label class='form-check-label fw-bold' for='dishCate_".$cat_row['id']."'>".$cat_row['category']."</label>
                              </div>
                              ";
                              }
                              ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <form method="get" id="formCate">
                  <input type="hidden" name="cat_dish" id="cat_dish" value='<?php echo $cat_dish;?>'/>
                  <input type="hidden" name="type" id="type" value="<?php echo $type;?>">
               </form>
            </div>
         </div>
      </div>
   </div>
</div>


<?php include('template/front_panel/footer.php'); ?>

