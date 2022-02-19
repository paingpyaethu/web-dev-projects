<?php

   session_start();
   require_once "core/base.php";
   require_once "core/function.php";
   require_once "core/constant.php";

// Load Composer's autoloader
   require "vendor/autoload.php";

   $coupon_code = textFilter($_POST['coupon_code']);

   $res = mysqli_query(conn(), "SELECT * FROM coupon_codes WHERE coupon_code='$coupon_code'");
   $check = mysqli_num_rows($res);
   if ($check > 0) {
      $row = mysqli_fetch_assoc($res);

      $cart_min_value = $row['cart_min_value'];
      $coupon_type = $row['coupon_type'];
      $coupon_value = $row['coupon_value'];
      $expired_on = strtotime($row['expired_on']);
      $today = strtotime(date('Y-m-d'));

      $getCartTotalPrice = getCartTotalPrice();

      if ($getCartTotalPrice > $cart_min_value) {
         if ($today > $expired_on) {
            $arr = array('status'=>'error', 'msg'=>'Coupon Code Expired.');
         }else {
            $coupon_code_apply = 0;
            if ($coupon_type == 'F') {
               $coupon_code_apply = $getCartTotalPrice - $coupon_value;
            }
            if ($coupon_type == 'P') {
               $coupon_code_apply = $getCartTotalPrice - ($coupon_value / 100) * $getCartTotalPrice;
            }
            $_SESSION['COUPON_CODE'] = $coupon_code;
            $_SESSION['FINAL_PRICE'] = $coupon_code_apply;

            $arr = array('status' => 'success', 'msg' => 'Coupon code applied!', 'coupon_code_apply' => $coupon_code_apply);
         }
      }else {
         $arr = array('status'=>'error', 'msg'=>'Order Price should be greater than Coupon code min value $'.$cart_min_value.'.');
      }
   }else {
      $arr = array('status'=>'error', 'msg'=>'Coupon code not found!');
   }
   echo json_encode($arr);