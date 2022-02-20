<?php include('template/front_panel/header.php'); ?>

<?php

if (!count(getUserFullCart()) > 0) {
   redirect('shop');
}

if ($website_close == 1)
{
   redirect('shop');
}

if (isset($_SESSION['FOOD_USER_ID'])){
   $is_show = '';
   $box_id = '';
   $final_show = 'show';
   $final_box_id = 'collapse-02';
   $checkOutCollapse = 'collapsed';
   $userDetails = getUserDetailById();
}else {
   $is_show = 'show';
   $box_id = 'collapse-01';
   $final_show = '';
   $final_box_id = '';
   $infoCollapse = 'collapsed';
}



if (isset($_POST['place_order'])){

   if ($cart_min_price != ''){
      if ($totalPrice >= $cart_min_price){

         $userId = $_SESSION['FOOD_USER_ID'];
         $checkout_name = textFilter($_POST['checkout_name']);
         $checkout_email = textFilter($_POST['checkout_email']);
         $checkout_mobile = textFilter($_POST['checkout_mobile']);
         $checkout_zip = textFilter($_POST['checkout_zip']);
         $checkout_address = textFilter($_POST['checkout_address']);
         $payment_type = textFilter($_POST['payment_type']);

         if (isset($_SESSION['COUPON_CODE']) && isset($_SESSION['FINAL_PRICE']))
         {
            $coupon_code = textFilter($_SESSION['COUPON_CODE']);
            $final_price = textFilter($_SESSION['FINAL_PRICE']);
         } else {
            $coupon_code = '';
            $final_price = $totalPrice;
         }


         $sql = "INSERT INTO order_master (user_id, name, email, mobile, address, total_price, coupon_code, final_price, zipcode, payment_status, order_status)
           VALUES ('$userId','$checkout_name','$checkout_email','$checkout_mobile','$checkout_address','$totalPrice',
           '$coupon_code','$final_price','$checkout_zip','pending','1')";
         mysqli_query(conn(),$sql);

         getOrderMasterId();
         emptyCart();
         redirect('order_success');
      }
   }
}

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
                           <li class="breadcrumb-item active">Check out</li>
                        </ol>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="container-fluid">
   <div class="row">
      <div class="col-12">

         <div class="container">
            <div class="row min-vh-80 py-5">
               <div class="col-12 col-md-7 col-lg-8 col-xl-9">
                  <div id="queries" class="faq">
                     <div class="query-item">
                        <div class="query-header <?php echo $checkOutCollapse;?>" data-bs-toggle="collapse" data-bs-target="#<?php echo $box_id;?>" aria-expanded="false" aria-controls="collapseExample">
                           <h3 class="mb-0">Checkout Method</h3>
                        </div>

                        <div class="collapse <?php echo $is_show;?>" id="<?php echo $box_id;?>">
                           <div class="query-body">
                              <h5 class="mb-2">
                                 <i class="fas fa-unlock-alt"></i> Log In
                              </h5>

                              <form method="post" id="formLogin">
                                 <p id="login_form_msg" class="alert_field mb-1"></p>
                                 <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="user_email"  placeholder="name@example.com" required>
                                    <label for="email">
                                       <i class="fas fa-at text-main"></i> Email address
                                    </label>
                                 </div>
                                 <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password" name="user_password"  placeholder="Password" required>
                                    <label for="password">
                                       <i class="fas fa-lock text-main"></i> Password
                                    </label>
                                 </div>
                                 <button type="submit" id="login_submit" name="login-btn" class="btn btn-main me-1">Login</button>
                                 <a href="<?php echo $front_url; ?>/register" class="btn btn-outline-main">Register Now</a>

                                 <input type="hidden" name="type" value="login">
                                 <input type="hidden" id="is_checkout" name="is_checkout" value="yes">
                              </form>

                           </div>
                        </div>
                     </div>

                     <div class="query-item">
                        <div class="query-header <?php echo $infoCollapse;?>" data-bs-toggle="collapse" data-bs-target="#<?php echo $final_box_id;?>" aria-expanded="false" aria-controls="collapseExample">
                           <h3 class="mb-0">Other Information</h3>
                        </div>

                        <div class="collapse <?php echo $final_show;?>" id="<?php echo $final_box_id;?>">
                           <div class="query-body">
                              <form class="row g-3" method="post">
                                 <div class="col-md-6 col-lg-3">
                                    <label for="inputText" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="inputText" name="checkout_name" value="<?php echo $userDetails['name']?>" required>
                                 </div>
                                 <div class="col-md-6 col-lg-3">
                                    <label for="inputEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="inputEmail" name="checkout_email" value="<?php echo $userDetails['email']?>" required>
                                 </div>
                                 <div class="col-md-6 col-lg-3">
                                    <label for="inputMobile" class="form-label">Mobile</label>
                                    <input type="text" class="form-control" id="inputMobile" name="checkout_mobile" value="<?php echo $userDetails['mobile']?>" required>
                                 </div>
                                 <div class="col-md-6 col-lg-3">
                                    <label for="inputZip" class="form-label">Zip/Postal Code</label>
                                    <input type="text" class="form-control" id="inputZip" name="checkout_zip" required>
                                 </div>
                                 <div class="col-12">
                                    <label for="inputAddress" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="checkout_address" required>
                                 </div>
                                 <div class="col-md-6 col-lg-3">
                                    <label for="coupon_code" class="form-label">Coupon Code</label>
                                    <input type="text" class="form-control" id="coupon_code" name="coupon_code">
                                 </div>
                                 <div class="col-md-6 col-lg-3">
                                    <button type="button" name="coupon_code" class="btn btn-outline-success text-uppercase"
                                            style="margin-top: 27px" onclick="applyCoupon()">
                                       Apply Coupon
                                    </button>
                                 </div>
                                 <p class="my-0 text-danger fw-bold" id="couponCodeMsg"></p>

                                 <div class="col-12">
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" id="gridCheck" name="payment_type" value="cod" checked="checked">
                                       <label class="form-check-label" for="gridCheck">
                                          Cash on Delivery (COD)
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-12">
                                    <button type="submit" name="place_order" class="btn btn-primary text-uppercase">Place Your Order</button>
                                 </div>
                                 <div class="col-12">
                                    <?php
                                    if ($cart_min_price != ''){
                                       if ($totalPrice < $cart_min_price) {
                                          echo "<p class='fw-bold text-danger'> $cart_min_price_msg </p>";
                                       }
                                    }
                                    ?>
                                 </div>
                              </form>

                           </div>
                        </div>
                     </div>

                  </div>
               </div>

               <div class="col-12 col-md-5 mt-3 mt-md-0 col-lg-4 col-xl-3">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="mb-0">Cart Details</h4>
                     </div>
                     <div class="card-body">
                        <div class="check-out-content">
                           <ul>
                              <?php foreach (getUserFullCart() as $key => $list){ ?>
                                 <li class="single-shopping-cart">
                                    <div class="shopping-cart-img">
                                       <a href="javascript:void(0)"><img alt="" src="<?php echo SITE_DISH_IMAGE.$list['image']?>" class="img-fluid"></a>
                                    </div>
                                    <div class="shopping-cart-title">
                                       <h4 class="fw-bold fs-5"><a href="javascript:void(0)"><?php echo short($list['dish_name']);?></a></h4>
                                       <h6 class="fs-6 fw-semi-bold">Qty: <?php echo $list['qty'];?></h6>
                                       <span><?php echo '$'.$list['price'] * $list['qty'];?></span>
                                    </div>
                                 </li>
                              <?php } ?>
                           </ul>
                           <div class="shopping-cart-total">
                              <h4>Total : <span class="shop-total"><?php echo $dollarSign.$totalPrice;?></span></h4>
                              <div class="coupon_code_box">
                                 <h4 class="fs-6 fw-bold">Coupon Code: <span class="float-end text-danger coupon_code_str"></span></h4>
                                 <h4 class="fs-6 fw-bold">Final Price: <span class="float-end text-danger final_price"></span></h4>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php

   if (isset($_SESSION['COUPON_CODE']))
   {
      unset($_SESSION['COUPON_CODE']);
      unset($_SESSION['FINAL_PRICE']);
   }

?>
<?php include('template/front_panel/footer.php'); ?>
