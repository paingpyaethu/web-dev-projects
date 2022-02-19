<?php
session_start();
require_once "core/base.php";
require_once "core/function.php";
require_once "core/constant.php";

$dollarSign = '$';

getDishCartStatus();

if (isset($_POST['update_cart'])) {
   foreach ($_POST['qty'] as $key => $value) {
      if (isset($_SESSION['FOOD_USER_ID'])) {
          if ($value[0] == 0) {
             $userId = $_SESSION['FOOD_USER_ID'];
             mysqli_query(conn(),"DELETE FROM dish_carts WHERE dish_detail_id='$key' AND user_id='$userId'");
          }else {
             $userId = $_SESSION['FOOD_USER_ID'];
             mysqli_query(conn(), "UPDATE dish_carts SET qty='".$value[0]."' WHERE dish_detail_id='$key' AND
             user_id='$userId'");
          }
      } else {
          if ($value[0] === 0) {
              unset($_SESSION['cart'][$key]['qty']);
          }else {
             $_SESSION['cart'][$key]['qty'] = $value[0];
          }
      }
   }


}

$cartArr = getUserFullCart();

$totalPrice = getCartTotalPrice();
$totalCartDish = count($cartArr);
?>


<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title><?php echo SITE_NAME ?></title>

   <link rel="icon" href="<?php echo $front_url; ?>/assets/images/favicon.png">
   <!-------------------- Bootstrap.CSS -------------------->
   <link rel="stylesheet" href="<?php echo $front_url; ?>/assets/vendor/bootstrap/dist/css/bootstrap.min.css">
   <!-------------------- FontAwesome.CSS -------------------->
   <link rel="stylesheet" href="<?php echo $front_url; ?>/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
   <!-------------------- Animate.CSS -------------------->
   <link rel="stylesheet" href="<?php echo $front_url; ?>/assets/vendor/animate.css/animate.min.css">
   <!-------------------- Owl-Carousel.CSS -------------------->
   <link rel="stylesheet" href="<?php echo $front_url; ?>/assets/vendor/owl-carousel/css/owl.carousel.min.css">
   <!-------------------- DataTable.Bootstrap.CSS -------------------->
   <link rel="stylesheet" href="<?php echo $front_url; ?>/assets/vendor/datatable/css/dataTables.bootstrap5.min.css">
   <!-------------------- Custom.CSS -------------------->
   <link rel="stylesheet" href="<?php echo $front_url; ?>/assets/css/styles.css">
</head>
<body>


<header class="header-area">
   <div class="header-top black-bg">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="container">
                  <div class="row align-items-center py-2">
                     <div class="col-6">
                        <div class="welcome-area text-white">
                           2441 Counts Lane Hartford, CT 06103
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="settings float-end">
                           <?php if (isset($_SESSION['FOOD_USER_NAME'])){ ?>
                           <ul>
                              <li class="top-hover">
                                 <a href="#">
                                    <span id="user_top_name"><?php echo $_SESSION['FOOD_USER_NAME']?></span>
                                    <i class="fas fa-sort-down"></i>
                                 </a>
                                 <ul>
                                    <li><a href="<?php echo $front_url; ?>/profile">Profile</a></li>
                                    <li><a href="<?php echo $front_url; ?>/order_history">Order History</a></li>
                                    <li><a href="<?php echo $front_url; ?>/logout">Logout</a></li>
                                 </ul>
                              </li>
                           </ul>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="header-middle py-4">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="container">
                  <div class="row align-items-center">
                     <div class="col-md-4 col-12">
                        <div class="logo">
                           <a href="<?php echo $front_url;?>/index" class="d-flex align-items-center">
                              <img alt="" src="<?php echo $front_url;?>/assets/images/favicon.png" class="img-fluid" style="width: 50px">
                              <h3 class="text-main ms-3 mb-0">
                                 P2T <span class="text-warning">Food</span> Pa<span class="text-danger">le</span>tte
                              </h3>
                           </a>
                        </div>
                     </div>
                     <div class="col-md-8 col-12">
                        <div class="header-middle-right mt-4 mt-md-0 float-md-end d-flex justify-content-md-end justify-content-between">
                           <div class="header-login me-md-5 d-flex align-items-center">
                              <a href="#" class="d-flex align-items-center">
                                 <div class="header-icon-style">
                                    <i class="fas fa-user-alt"></i>
                                 </div>
                                 <div class="login-text-content">
                                    <?php
                                       if (isset($_SESSION['FOOD_USER_NAME'])){
                                          echo "<span class='fw-bold fs-7 text-black'>Welcome <span class='fs-4 text-main'>".$_SESSION['FOOD_USER_NAME']."</span></span>";
                                       }else{
                                    ?>
                                    <a href="<?php echo $front_url; ?>/register" class="btn btn-main">Register</a>
                                    <a href="<?php echo $front_url; ?>/login" class="btn btn-outline-danger">Sign in</a>
                                    <?php } ?>
                                 </div>
                              </a>
                           </div>

                           <div class="header-cart">
                              <a href="#" class="d-flex align-items-center">
                                 <div class="header-icon-style">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span class="count-style" id="totalCartDish">
                                       <?php
                                       echo $totalCartDish;
                                       ?>
                                    </span>
                                 </div>
                                 <div class="ms-3">
                                    <p class="mb-0 fw-bold fs-5 text-black">My Cart</p>
                                    <span class="fw-bold fs-7 text-danger" id="dollarSign">
                                       <?php
                                       if ($totalPrice != 0){
                                          echo $dollarSign;
                                       }
                                       ?>
                                    </span>
                                    <span class="fw-bold fs-7 text-danger" id="totalPrice">
                                       <?php
                                       if ($totalPrice != 0){
                                          echo $totalPrice;
                                       }
                                       ?>
                                    </span>
                                 </div>
                              </a>

                              <?php if ($totalPrice != 0){ ?>
                              <div class="shopping-cart-content">
                                 <ul id="cart_ul">
                                    <?php foreach (getUserFullCart() as $key => $list){ ?>
                                    <li class="single-shopping-cart" id="attr_<?php echo $key;?>">
                                       <div class="shopping-cart-img">
                                          <a href="javascript:void(0)"><img alt="" src="<?php echo SITE_DISH_IMAGE.$list['image']?>" class="img-fluid"></a>
                                       </div>
                                       <div class="shopping-cart-title">
                                          <h4 class="fw-bold fs-6"><a href="javascript:void(0)"><?php echo short($list['dish_name']);?></a></h4>
                                          <h6>Qty: <?php echo $list['qty'];?></h6>
                                          <span><?php echo '$'.$list['price'] * $list['qty'];?></span>
                                       </div>
                                       <div class="shopping-cart-delete">
                                          <a href="javascript:void(0)" onclick="delete_cart('<?php echo $key ?>')"><i class="fas fa-times-circle text-danger fs-5"></i></a>
                                       </div>
                                    </li>
                                    <?php } ?>
                                 </ul>
                                 <div class="shopping-cart-total">
                                    <h4>Total : <span class="shop-total" id="shop-total"><?php echo $dollarSign.$totalPrice;?></span></h4>
                                 </div>
                                 <div class="shopping-cart-btn">
                                    <a href="<?php echo $front_url; ?>/cart">view cart</a>
                                    <a href="<?php echo $front_url; ?>/checkout">checkout</a>
                                 </div>
                              </div>
                              <?php } ?>

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="header-bottom transparent-bar black-bg">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="container">
                  <div class="row">
                     <div class="col-12">
                        <div class="main-menu">
                           <nav class="navbar navbar-expand-lg">
                              <div class="container p-0">
                                 <a class="navbar-brand text-white d-lg-none fw-bold" href="#">Menu</a>

                                 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="menu-icon fas fa-bars"></i>
                                 </button>

                                 <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class="navbar-nav">
                                       <li class="nav-item">
                                          <a class="nav-link active" href="<?php echo $front_url; ?>/index">Home</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link" href="<?php echo $front_url; ?>/shop">Shop</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link" href="<?php echo $front_url; ?>/about_us">About</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link" href="<?php echo $front_url; ?>/contact_us">Contact Us</a>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </nav>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>


</header>


