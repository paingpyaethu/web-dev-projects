<?php
session_start();
require_once "core/base.php";
require_once "core/function.php";
require_once "core/constant.php";

$attr = textFilter($_POST['attr']);
$type = textFilter($_POST['type']);

if ($type == 'add'){
   $qty = textFilter($_POST['qty']);

   if (isset($_SESSION['FOOD_USER_ID'])){
      $user_id = $_SESSION['FOOD_USER_ID'];
      manageUserCart($user_id, $qty, $attr);
   }else {
      $_SESSION['cart'][$attr]['qty']=$qty;
   }
   $getUserFullCart = getUserFullCart();
   $totalPrice = 0;
   $dollarSign = '$';
   foreach ($getUserFullCart as $item){
      $totalPrice = $totalPrice + ($item['qty'] * $item['price']);
   }

   $getDishDetail = getDishDetailById($attr);
   $price = $getDishDetail['price'];
   $dishName = $getDishDetail['dish'];
   $image = $getDishDetail['image'];

   function toShort($str, $length='10'){
      return substr($str,0,$length)."....";
   }

   $totalDish = count(getUserFullCart());
   $arr = array('totalCartDish' => $totalDish, 'totalPrice' => $totalPrice, 'dollarSign' => $dollarSign,
                'price' => $price,'dish' => $dishName,'image' => $image,'toShort'=>toShort($dishName,10));
   echo json_encode($arr);
}

if ($type == 'delete') {
   removeDishFromCartByid($attr);

   $getUserFullCart=getUserFullCart();
   $totalDish=count($getUserFullCart);
   $dollarSign = '$';
   $totalPrice=0;
   foreach($getUserFullCart as $list){
      $totalPrice=$totalPrice + ($list['qty'] * $list['price']);
   }
   $arr=array('totalCartDish'=>$totalDish,'totalPrice'=>$totalPrice, 'dollarSign' => $dollarSign);
   echo json_encode($arr);
}












