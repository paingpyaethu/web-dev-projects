<?php
function pr($arr){
   echo '<pre>';
   print_r($arr);
}

function prx($arr){
   echo '<pre>';
   print_r($arr);
   die();
}


// Email Verify
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/PHPMailer/src/SMTP.php';

function sendEmail($email, $html, $subject){

   $mail=new PHPMailer(true);

   try {
      $mail -> SMTPDebug = 0; //SMTP::DEBUG_SERVER

      $mail->isSMTP(); //Send using SMTP

      $mail->Host="smtp.gmail.com"; //Set the SMTP server to send through
      $mail->SMTPAuth=true;
      $mail->Username="winonaclark48185@gmail.com";
      $mail->Password="winonaclark12345";
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port=587;
      $mail->setFrom("winonaclark48185@gmail.com");
      $mail->addAddress($email);
      $mail->IsHTML(true);

      $mail-> Subject = $subject;
      $mail -> Body = $html;
      $mail -> send();
      return true;

   } catch (Exception $exception){
//      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      return false;
   }
}


// Common Start
function alert($data, $color = 'danger'){
   return "<p class='alert alert-$color'>$data</p>";
}

function alertDanger(){
   if (isset($_SESSION['danger-status']) && $_SESSION['danger-status'] != '') {
      echo '<p class="alert alert-danger">'.$_SESSION['danger-status'].'</p>';
      unset($_SESSION['danger-status']);
   }
}

function alertWarning(){
   if (isset($_SESSION['warning-status']) && $_SESSION['warning-status'] != '') {
      echo '<p class="alert alert-warning">'.$_SESSION['warning-status'].'</p>';
      unset($_SESSION['warning-status']);
   }
}

function alertSuccess(){
   if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
      echo '<p class="alert alert-success">'.$_SESSION['success'].'</p>';
      unset($_SESSION['success']);
   }
}

function runQuery($sql){
   if(mysqli_query(conn(),$sql)){
      return true;
   }else{
      die("Query Fail : ".mysqli_error(conn()));
   }
}

function fetch($sql){
   $query = mysqli_query(conn(), $sql);
   return mysqli_fetch_assoc($query);
}

function fetchAll($sql){
   $query = mysqli_query(conn(), $sql);
   $rows = [];

   while ($row = mysqli_fetch_assoc($query)){
      array_push($rows,$row);
   }
   return $rows;
}
function oldMessage($name){
   if (isset($_POST[$name])){
      return $_POST[$name];
   }else {
      return "";
   }
}

function redirect($l){
   echo "<script>window.location.href='$l'</script>";
}

function showTime($timestamp, $format = "d-m-Y"){
   return date($format,strtotime($timestamp));
}

   function showTime2($timestamp, $format = "d-m-Y h:i"){
      return date($format,strtotime($timestamp));
   }

function short($str, $length='10'){
   return substr($str,0,$length)."....";
}

//function get_safe_value($str){
//   $str = mysqli_real_escape_string(conn(), $str);
//   return $str;
//}

function textFilter($text){
   $text = trim($text);
   $text = htmlentities($text, ENT_QUOTES);
   $text = stripcslashes($text);
   return $text;
}

/*=========================================
                  Auth
==========================================*/

function signIn(){
   $username = textFilter($_POST['username']);
   $password = textFilter($_POST['password']);

   $sql = "SELECT * FROM admin WHERE username='$username' and password='$password'";
   $query = mysqli_query(conn(), $sql);
   $row = mysqli_fetch_assoc($query);

   if (!$row){
      return alert("Please Enter Valid Login Details.");
   }else {
      session_start();
      $_SESSION['user'] = $row;
      redirect("index.php");
   }
}

/*=========================================
                  Auth
==========================================*/

/*=========================================
                Category
==========================================*/

function categoryAdd(){
   $category = textFilter($_POST['category']);
   $orderNumber = textFilter($_POST['order_number']);

   $sql = "SELECT * FROM categories WHERE category='$category'";
   if (fetchAll($sql)){
      return alert("Category is already added.","warning");
   } else {
      if (empty($category) || empty($orderNumber)){
         return alert("Please fill input fields.");
      } else {
         $sql = "INSERT INTO categories (category, order_number, status) VALUES ('$category', '$orderNumber', 1)";
         if (runQuery($sql)){
            redirect("category_add.php");
         }
      }
   }
}

function categoryUpdate(){
   $id = $_POST['id'];
   $category = textFilter($_POST['category']);
   $orderNumber = textFilter($_POST['order_number']);

   $sql = "SELECT * FROM categories WHERE category='$category'";

   if (fetchAll($sql)){
      return alert("Category is already added.","warning");
   } else {
      $sql = "UPDATE categories SET category='$category', order_number='$orderNumber'  WHERE id='$id'";
      if (runQuery($sql)){
         redirect("category_list.php");
      }
   }
}

function category($id){
   $sql = "SELECT * FROM categories WHERE id = '$id'";
   return fetch($sql);
}

function categoryLists(){
   $sql = "SELECT * FROM categories ORDER BY order_number";
   return fetchAll($sql);
}

function categoryDelete($id){
   $sql = "DELETE FROM categories WHERE id='$id'";
   return runQuery($sql);
}

/*=========================================
               Category End
==========================================*/

/*=========================================
                User
==========================================*/
function userLists(){
   $sql = "SELECT * FROM users ORDER BY id DESC ";
   return fetchAll($sql);
}
/*=========================================
               User End
==========================================*/

/*=========================================
             Orders
==========================================*/
function orderLists(){
   $sql = "SELECT order_master.*,order_status.order_status AS order_status_str FROM order_master,order_status 
        WHERE order_master.order_status=order_status.id ORDER BY order_master.id DESC ";
   return fetchAll($sql);
}
/*=========================================
                Orders End
==========================================*/

/*=========================================
                Delivery
==========================================*/
function deliveryAdd(){
   $name = textFilter($_POST['name']);
   $mobile = textFilter($_POST['mobile']);
   $password = textFilter($_POST['password']);

   $sql = "SELECT * FROM delivery_boy WHERE mobile='$mobile'";
   if (fetchAll($sql)) {
      return alert("Delivery boy is already added.", "warning");
   }else {
      if (empty($name) || empty($mobile) || empty($password)){
         return alert("Please fill input fields.");
      }else{
         $sql = "INSERT INTO delivery_boy (name, mobile, password, status) VALUES ('$name', '$mobile', '$password', 1)";
         if (runQuery($sql)){
            redirect("delivery_add.php");
         }
      }
   }
}

function deliveryUpdate(){
   $id = textFilter($_POST['id']);
   $name = textFilter($_POST['name']);
   $mobile = textFilter($_POST['mobile']);
   $password = textFilter($_POST['password']);

   $sql = "SELECT * FROM delivery_boy WHERE mobile='$mobile' AND name='$name' AND password='$password'";
   if (fetchAll($sql)){
      return alert("Delivery boy is already added.","warning");
   } else {
      if (empty($name) || empty($mobile) || empty($password)){
         return alert("Please fill input fields.");
      }else {
         $sql = "UPDATE delivery_boy SET name='$name', mobile='$mobile', password='$password' WHERE id='$id'";
         if (runQuery($sql)){
            redirect("delivery.php");
         }
      }
   }
}

function deliveryBoyLists(){
   $sql = "SELECT * FROM delivery_boy ORDER BY id DESC";
   $query = mysqli_query(conn(),$sql);
   $rows = [];

   while ($row = mysqli_fetch_assoc($query)){
      array_push($rows,$row);
   }
   return $rows;
}

function deliveryBoy($id){
   $sql = "SELECT * FROM delivery_boy WHERE id = '$id'";
   return fetch($sql);
}

/*=========================================
               Delivery End
==========================================*/

/*=========================================
              Coupon Code
==========================================*/
function couponCodeAdd(){
   $couponCode = textFilter($_POST['coupon_code']);
   $couponType = textFilter($_POST['coupon_type']);
   $couponValue = textFilter($_POST['coupon_value']);
   $cartMinValue = textFilter($_POST['cart_min_value']);
   $expiredOn = textFilter($_POST['expired_on']);

   $sql = "SELECT * FROM coupon_codes WHERE coupon_code='$couponCode'";
   if (fetchAll($sql)) {
      return alert("Coupon Code is already added.", "warning");
   }else {
      if (empty($couponCode) || empty($couponType) || empty($couponValue) || empty($cartMinValue) || empty($expiredOn)){
         return alert("Please fill out input fields.");
      }else{
         $sql = "INSERT INTO coupon_codes (coupon_code,coupon_type,coupon_value,cart_min_value,expired_on,status)
        VALUES ('$couponCode','$couponType','$couponValue','$cartMinValue','$expiredOn',1)";
         if (runQuery($sql)){
            redirect("coupon_code_add.php");
         }
      }
   }
}

function couponCodeUpdate(){
   $id = $_POST['id'];
   $couponCode = textFilter($_POST['coupon_code']);
   $couponType = textFilter($_POST['coupon_type']);
   $couponValue = textFilter($_POST['coupon_value']);
   $cartMinValue = textFilter($_POST['cart_min_value']);
   $expiredOn = textFilter($_POST['expired_on']);

   $sql = "SELECT * FROM coupon_codes WHERE coupon_code='$couponCode'";
   if (fetchAll($sql)){
      return alert("Coupon Code is already added.","warning");
   }else {
      if (empty($couponCode) || empty($couponType) || empty($couponValue) || empty($cartMinValue) || empty($expiredOn)){
         return alert("Please fill out input fields.");
      }else{
         $sql = "UPDATE coupon_codes SET coupon_code='$couponCode',coupon_type='$couponType',coupon_value='$couponValue',cart_min_value='$cartMinValue',expired_on='$expiredOn' WHERE id='$id'";
         if (runQuery($sql)){
            redirect("coupon_code.php");
         }
      }
   }
}

function couponCode($id){
   $sql = "SELECT * FROM coupon_codes WHERE id = '$id'";
   return fetch($sql);
}

function couponCodeLists(){
   $sql = "SELECT * FROM coupon_codes ORDER BY id DESC ";
   return fetchAll($sql);
}

function couponCodeDelete($id){
   $sql = "DELETE FROM coupon_codes WHERE id='$id'";
   return runQuery($sql);
}

/*=========================================
              Coupon Code End
==========================================*/

/*=========================================
               Banner Start
==========================================*/
function bannerAdd(){
   $heading = textFilter($_POST['heading']);
   $subHeading = textFilter($_POST['sub_heading']);
   $link = textFilter($_POST['link']);
   $linkTxt = textFilter($_POST['link_txt']);
   $orderNumber = textFilter($_POST['order_number']);
   $image = $_FILES['image']['name'];

   if (empty($image) || empty($heading) || empty($subHeading) || empty($link) || empty($linkTxt) || empty($orderNumber)){
      $_SESSION['danger-status']="Please fill out input fields.";
   }else{
      if (file_exists("upload/banner/" . $_FILES['image']['name'])){
         $store = $_FILES['image']['name'];
         $_SESSION['danger-status'] = "Image already exists! ' $store.'";
      }else {
         move_uploaded_file($_FILES['image']['tmp_name'],"upload/banner/".$image);
         mysqli_query(conn(),"INSERT INTO banner (heading,sub_heading,link,link_txt,order_number,image,status) 
        VALUES ('$heading','$subHeading','$link','$linkTxt','$orderNumber','$image',1)");
         $_SESSION['success'] = "Item added to list successfully.";
         redirect('banner.php');
      }
   }
}

function bannerUpdate(){
   $id = $_POST['id'];
   $heading = textFilter($_POST['heading']);
   $subHeading = textFilter($_POST['sub_heading']);
   $link = textFilter($_POST['link']);
   $linkTxt = textFilter($_POST['link_txt']);
   $orderNumber = textFilter($_POST['order_number']);
   $image = $_FILES['image']['name'];

   if (empty($heading) || empty($subHeading) || empty($link) || empty($linkTxt) || empty($orderNumber)){
      $_SESSION['danger-status']="Please fill out input fields.";
   } else {
      $sql = "select * from banner where id='$id'";
      $query = mysqli_query(conn(),$sql);
      foreach ($query as $item){
         if ($image == NULL){
            // Update with existing image
            $image_data = $item['image'];
         }else {
            // Update with new image and delete old image
            if ($img_path = "upload/banner/".$item['image']){
               unlink($img_path);
               $image_data = $image;
            }
         }
      }
      mysqli_query(conn(),"update banner set heading='$heading', sub_heading='$subHeading', link='$link', 
      link_txt='$linkTxt',order_number='$orderNumber',image='$image_data' where id='$id'");

      if ($image == NULL){
         // Update with existing image

         $_SESSION['success'] = "Item updated to list successfully with an existing image.";
         redirect("banner.php");
      }else {
         // Update with new image and delete old image
         move_uploaded_file($_FILES['image']['tmp_name'],SERVER_BANNER_IMAGE.$_FILES['image']['name']);

         $_SESSION['success'] = "Item updated to list successfully.";
         redirect("banner.php");
      }
   }
}

function bannerLists(){
   $sql = "SELECT * FROM banner ORDER BY order_number";
   return fetchAll($sql);
}

function frontBannerLists(){
   $sql = "SELECT * FROM banner WHERE status='1' ORDER BY order_number";
   return fetchAll($sql);
}

function bannerList($id){
   $sql = "SELECT * FROM banner where id='$id'";
   return fetch($sql);
}

function bannerDelete($id){
   $sql = "DELETE FROM banner WHERE id='$id'";
   return runQuery($sql);
}

/*=========================================
               Banner End
==========================================*/

/*=========================================
                 Dishes
==========================================*/

/*=========================================
                 Dish Details
==========================================*/

function getDishId(){
   foreach (dishLists() as $dishList){
      $dishId = $dishList['id'];
   }

   $attributeArr = $_POST['attribute'];
   $priceArr = $_POST['price'];
   $statusArr = $_POST['status'];

   foreach ($attributeArr as $key=>$val){
      $attribute = $val;
      $price = $priceArr[$key];
      $status = $statusArr[$key];

      mysqli_query(conn(),"insert into dish_details (dish_id, attribute, price, status) values ('$dishId','$attribute','$price','$status')");
   }
}


function dishAdd(){
   $categoryId = textFilter($_POST['category_id']);
   $dish = textFilter($_POST['dish']);
   $dishDetail = textFilter($_POST['dish_detail']);
   $image = $_FILES['image']['name'];
   $types = textFilter($_POST['types']);

   $query = "select * from dishes where dish='$dish'";
   if (fetchAll($query)){
      $_SESSION['warning-status']="Dish is already added.";
   } else {
      $attributeArr = $_POST['attribute'];
      $priceArr = $_POST['price'];

      foreach ($attributeArr as $key=>$val) {
         $attribute = $val;
         $price = $priceArr[$key];

      }if ($categoryId == 0 || empty($dish) || empty($dishDetail) || empty($attribute) || empty($price) || empty($types) || empty($image)){
         $_SESSION['danger-status']="Please fill out input fields.";
      }else {
         $img_type = $_FILES['image']['type'];
         if ($img_type != 'image/jpeg' && $img_type != 'image/png') {
            $_SESSION['danger-status'] = "Invalid image format";
         } else {
            if (file_exists("upload/dishes/" . $_FILES['image']['name'])) {
               $store = $_FILES['image']['name'];
               $_SESSION['danger-status'] = "Image already exists! ' $store.'";
            } else {
               move_uploaded_file($_FILES['image']['tmp_name'], "upload/dishes/" . $image);
               mysqli_query(conn(), "insert into dishes (category_id,dish,dish_detail,image,type,status) values 
               ('$categoryId','$dish','$dishDetail','$image','$types',1)");

               getDishId();

               $_SESSION['success'] = "Item added to list successfully.";
               redirect("dish.php");
            }
         }
      }
   }
}

function dishUpdate(){

   $id = $_POST['id'];
   $categoryId = textFilter($_POST['category_id']);
   $dish = textFilter($_POST['dish']);
   $dishDetail = textFilter($_POST['dish_detail']);
   $types = textFilter($_POST['types']);
   $image = $_FILES['image']['name'];

//   $sql = "select * from dishes WHERE dish_detail = '$dishDetail'";
//   if (fetchAll($sql)){
//      $_SESSION['warning-status'] = "Dish Detail is already added.";
//   }else {
      if ($categoryId == 0 || empty($dish) || empty($dishDetail)){
         $_SESSION['danger-status'] = "Please fill out input fields.";
      }else {
         $sql = "select * from dishes where id='$id'";
         $query = mysqli_query(conn(),$sql);

         foreach ($query as $item) {

            $img_type = $_FILES['image']['type'];
            if ($img_type != 'image/jpeg' && $img_type != 'image/png' && $image != NULL) {
               $_SESSION['danger-status'] = "Invalid image format";
            } else {
               if ($image == NULL) {
                  // Update with existing image
                  $image_data = $item['image'];
               }
               else {
                  // Update with new image and delete old image
                  if ($img_path = "upload/dishes/" . $item['image']) {
                     unlink($img_path);
                     $image_data = $image;
                  }
               }
               $sql = "update dishes set category_id='$categoryId', dish='$dish', dish_detail='$dishDetail', type='$types',
               image='$image_data' where id='$id'";
               mysqli_query(conn(),$sql);


               $attributeArr = $_POST['attribute'];
               $priceArr = $_POST['price'];
               $statusArr = $_POST['status'];
               $dishDetailsIdArr = $_POST['dish_details_id'];

               foreach ($attributeArr as $key => $val) {
                  $attribute = $val;
                  $price = $priceArr[$key];
                  $status = $statusArr[$key];

                  if (isset($dishDetailsIdArr[$key])) {
                     $dishId = $dishDetailsIdArr[$key];
                     mysqli_query(conn(), "UPDATE dish_details SET attribute='$attribute',price='$price',status='$status' WHERE id='$dishId'");
                  } else {
                     mysqli_query(conn(), "insert into dish_details (dish_id, attribute, price, status) values ('$id','$attribute','$price','$status')");
                  }
               }
               if ($image == NULL) {
                  // Update with existing image
                  $_SESSION['success'] = "Item updated to list successfully with an existing image.";
                  redirect("dish.php");
               } else {
                  // Update with new image and delete old image
                  move_uploaded_file($_FILES['image']['tmp_name'], SERVER_DISH_IMAGE . $_FILES['image']['name']);
                  $_SESSION['success'] = "Item updated to list successfully.";
                  redirect("dish.php");
               }
            }
         }
      }
}


function dishDelete($id){
   $query = "delete from dishes where id='$id'";
   return runQuery($query);
}

function dish($id){
   $query = "SELECT * FROM dishes where id='$id'";
   return fetch($query);
}

function dishLists(){
   $query = "SELECT * FROM dishes";
   return fetchAll($query);
}

function dishCategories(){
   $query = "SELECT * FROM categories WHERE status='1' ORDER BY category ASC ";
   return fetchAll($query);
}

/*=========================================
               Contact Us
==========================================*/
function contactUs(){
   $query = "SELECT * FROM contact_us ORDER BY id ";
   return fetchAll($query);
}

function contactUsDelete($id){
   $query = "DELETE FROM contact_us WHERE id = '$id'";
   return runQuery($query);
}

/*=========================================
              Admin Panel End
==========================================*/
/*=========================================
              Front Panel Start
==========================================*/
//function login(){
//   $email = $_POST['user_email'];
//   $password = $_POST['user_password'];
//
//   $sql = "SELECT * FROM users WHERE email = '$email'";
//   $query = mysqli_query(conn(), $sql);
//   $row = mysqli_num_rows($query);
//
//   if ($row == 0){
//      die("Email not found!");
//   }
//
//   $user = mysqli_fetch_object($query);
//   if (!password_verify($password, $row['user_password'])){
//      die("Password is not correct.");
//   }
//   if ($user->email_verified_at == null){
//      die("Please verify your email <a href='email_verification.php?email=".$email."'></a>");
//   }
//   echo "<p>Your Login Logic here..</p>";
//   exit();
//}

function getUserCart(){
   $arr = array();
   $id = $_SESSION['FOOD_USER_ID'];

   $query = mysqli_query(conn(), "SELECT * FROM dish_carts WHERE user_id='$id'");
   while ($row=mysqli_fetch_assoc($query)){
      $arr[] = $row;
   }
   return $arr;
}

function manageUserCart($user_id, $qty, $attr){
   $query = mysqli_query(conn(), "SELECT * FROM dish_carts WHERE user_id='$user_id' AND dish_detail_id='$attr'");
   if (mysqli_num_rows($query) > 0){
      $row = mysqli_fetch_assoc($query);
      $cartId = $row['id'];
      mysqli_query(conn(),"UPDATE dish_carts SET qty='$qty' WHERE id='$cartId'");
   }else {
      mysqli_query(conn(),"INSERT INTO dish_carts (user_id,dish_detail_id,qty) VALUES ('$user_id','$attr','$qty')");
   }
}

function getDishCartStatus(){

   $dishDetailsId = array();

   if (isset($_SESSION['FOOD_USER_ID'])){
      $getUserCart = getUserCart();
      foreach ($getUserCart as $list){
         $dishDetailsId[]=$list['dish_detail_id'];
      }
   }else {
      if (isset($_SESSION['cart']) && count($_SESSION['cart'])>0) {
         foreach ($_SESSION['cart'] as $key => $val){
            $dishDetailsId[]=$key;
         }
      }
   }
   foreach ($dishDetailsId as $id) {
      $sql = mysqli_query(conn(), "SELECT dish_details.status, dishes.status AS dish_status, dishes.id
          FROM dish_details, dishes WHERE dish_details.id='$id' AND dish_details.dish_id=dishes.id");
      $row = mysqli_fetch_assoc($sql);
      if ($row['dish_status'] == 0) {
         $id = $row['id']; // id of dishes table.
         $res = mysqli_query(conn(),"SELECT id FROM dish_details WHERE dish_id = '$id'");
         while ($row_1 = mysqli_fetch_assoc($res)){
            removeDishFromCartById($row_1['id']); // id of dish_details table.
         }
      }
      if ($row['status'] == 0){
         removeDishFromCartById($id);
      }
   }
}

function getUserFullCart($attr_id = ''){
   $cartArr = array();
   if (isset($_SESSION['FOOD_USER_ID'])){
      $getUserCart = getUserCart();
      $cartArr = array();
      foreach ($getUserCart as $list){
         $cartArr[$list['dish_detail_id']]['qty']=$list['qty'];
         $getDishDetail = getDishDetailById($list['dish_detail_id']);

         $cartArr[$list['dish_detail_id']]['price']=$getDishDetail['price'];
         $cartArr[$list['dish_detail_id']]['dish_name']=$getDishDetail['dish'];
         $cartArr[$list['dish_detail_id']]['image']=$getDishDetail['image'];
      }
   }else {
      if (isset($_SESSION['cart']) && count($_SESSION['cart'])>0) {
         foreach ($_SESSION['cart'] as $key => $val){
            $cartArr[$key]['qty']=$val['qty'];
            $getDishDetail = getDishDetailById($key);

            $cartArr[$key]['price']=$getDishDetail['price'];
            $cartArr[$key]['dish_name']=$getDishDetail['dish'];
            $cartArr[$key]['image']=$getDishDetail['image'];
         }
      }
   }
   if ($attr_id != ''){
      return $cartArr[$attr_id]['qty'];
   }else {
      return $cartArr;
   }
}

function getDishDetailById($id){
   $query = mysqli_query(conn(),"SELECT dishes.dish, dishes.image, dish_details.price FROM dish_details, dishes 
         WHERE dish_details.id='$id' AND dishes.id=dish_details.dish_id");
   $row = mysqli_fetch_assoc($query);
   return $row;
}

function getUserDetailById() {
   $data['name'] = '';
   $data['email'] = '';
   $data['mobile'] = '';

   $userId = $_SESSION['FOOD_USER_ID'];

   if ($userId){
      $row = mysqli_fetch_assoc(mysqli_query(conn(), "SELECT * FROM users WHERE id='$userId'"));
      $data['name'] = $row['name'];
      $data['email'] = $row['email'];
      $data['mobile'] = $row['mobile'];
   }
   return $data;
}

function removeDishFromCartById($id){
   if (isset($_SESSION['FOOD_USER_ID'])){
      $userId = $_SESSION['FOOD_USER_ID'];
      $query = "DELETE FROM dish_carts WHERE dish_detail_id='$id' AND user_id='$userId'";
      return runQuery($query);
   }else {
      unset($_SESSION['cart'][$id]);
   }
}

/*=========================================
             Order Master
==========================================*/

function orderMasterLists(){
   $sql = "SELECT * FROM order_master";
   return fetchAll($sql);
}

function getOrderMasterId() {
   foreach (orderMasterLists() as $orderMasterList) {
      $orderMasterId = $orderMasterList['id'];
      $_SESSION['ORDER_ID'] = $orderMasterId;
   }

   foreach (getUserFullCart() as $key=>$value) {
      $price = $value['price'];
      $qty = $value['qty'];
      mysqli_query(conn(), "INSERT INTO order_details (order_master_id, dish_detail_id, price, qty)
      VALUES ('$orderMasterId','$key','$price','$qty')");
   }
   $emailHTML = orderEmail($orderMasterId);
   // Load Composer's autoloader
   require "vendor/autoload.php";
   $getUserDetailById = getUserDetailById();
   $email = $getUserDetailById['email'];

   sendEmail($email, $emailHTML,'Order Placed.');
}

function emptyCart() {
   if (isset($_SESSION['FOOD_USER_ID'])) {
      $userId = $_SESSION['FOOD_USER_ID'];
      $res = mysqli_query(conn(), "DELETE FROM dish_carts WHERE user_id='$userId'");
   }else {
      unset($_SESSION['cart']);
   }
}

function getOrderDetails($oid){
   $sql="SELECT order_details.price,order_details.qty,dish_details.attribute,dishes.dish
   FROM order_details,dish_details,dishes WHERE order_details.order_master_id='$oid' AND order_details.dish_detail_id=dish_details.id AND
   dish_details.dish_id=dishes.id";

   $data=array();
   $res=mysqli_query(conn(),$sql);
   while($row=mysqli_fetch_assoc($res)){
      $data[]=$row;
   }
   return $data;
}

function getOrderById($orderId) {
   $sql = "SELECT * FROM order_master WHERE id='$orderId'";
   return fetchAll($sql);
}

function orderEmail($orderId)
{
   $getUserDetailById = getUserDetailById();
   $name = $getUserDetailById['name'];

   $getOrderById = getOrderById($orderId);
//   prx($getOrderById);

   $order_id = $getOrderById[0]['id'];
   $total_amount = $getOrderById[0]['total_price'];

   $getOrderDetails = getOrderDetails($orderId);
//   prx($getOrderDetails);



   $html='<!doctype html>
         <html lang="en">
         <head>
           <meta charset="UTF-8">
           <meta name="viewport"
                 content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
           <meta http-equiv="X-UA-Compatible" content="ie=edge">
           <title></title>
           <style type="text/css" rel="stylesheet" media="all">
         
             body {
               width: 100% !important;
               height: 100%;
               margin: 0;
             }
         
             h1 {
               margin-top: 0;
               color: #333333;
               font-size: 22px;
               font-weight: bold;
             }
             
             h3 {
               font-size: 20px;
               font-weight: bold;
               color: #6c5fa7;
               margin: 10px 0 0 0;
             }
         
             p {
               margin: .4em 0 1.1875em;
               font-size: 16px;
               line-height: 1.625;
               color: #51545E;
             }
         
             .pre-header {
               display: none !important;
               visibility: hidden;
               mso-hide: all;
               font-size: 1px;
               line-height: 1px;
               max-height: 0;
               max-width: 0;
               opacity: 0;
               overflow: hidden;
             }
         
             .email-wrapper {
               width: 100%;
               margin: 0;
               padding: 0;
               -premailer-width: 100%;
               -premailer-cellpadding: 0;
               -premailer-cellspacing: 0;
               background-color: #F4F4F7;
             }
         
             .email-content {
               width: 100%;
               margin: 0;
               padding: 0;
               -premailer-width: 100%;
               -premailer-cellpadding: 0;
               -premailer-cellspacing: 0;
             }
         
             /* Masthead ----------------------- */
             .email-masthead {
               padding: 25px 0;
               text-align: center;
             }
         
             .email-masthead_name {
               text-decoration: none;
               text-shadow: 0 1px 0 white;
             }
         
             /* -------------------------- Body ------------------------------ */
         
             .email-body {
               width: 100%;
               margin: 0;
               padding: 0;
               -premailer-width: 100%;
               -premailer-cellpadding: 0;
               -premailer-cellspacing: 0;
               background-color: #FFFFFF;
             }
         
             .email-body_inner {
               width: 570px;
               margin: 0 auto;
               padding: 0;
               -premailer-width: 570px;
               -premailer-cellpadding: 0;
               -premailer-cellspacing: 0;
               background-color: #FFFFFF;
             }
         
             .content-cell {
               padding: 35px;
             }
         
             /* ---------- Attribute list ---------- */
         
             .attributes {
               margin: 0 0 21px;
             }
         
             .attributes_content {
               background-color: #F4F4F7;
               padding: 16px;
             }
         
             .attributes_item {
               padding: 0;
             }
         
             /* ---------- Data table ---------- */
         
             .purchase {
               width: 100%;
               margin: 0;
               padding: 20px 0;
               -premailer-width: 100%;
               -premailer-cellpadding: 0;
               -premailer-cellspacing: 0;
             }
         
             .purchase_content {
               width: 100%;
               margin: 0;
               padding: 25px 0 0 0;
               -premailer-width: 100%;
               -premailer-cellpadding: 0;
               -premailer-cellspacing: 0;
             }
         
             .purchase_item {
               padding: 10px 0;
               color: #51545E;
               font-size: 15px;
               line-height: 18px;
             }
         
             .purchase_heading {
               padding-bottom: 8px;
               border-bottom: 1px solid #EAEAEC;
             }
         
             .purchase_heading p {
               margin: 0;
               color: #85878E;
               font-size: 12px;
             }
         
             .purchase_footer {
               padding-top: 15px;
               border-top: 1px solid #EAEAEC;
             }
         
             .purchase_total {
               margin: 0;
               text-align: right;
               font-weight: bold;
               color: #333333;
             }
         
             .purchase_total--label {
               padding: 0 15px 0 0;
             }
         
             /* ---------- Media Queries ---------- */
         
             @media only screen and (max-width: 600px) {
               .email-body_inner {
                 width: 100% !important;
               }
             }
         
           </style>
         </head>
         <body>
         <span class="pre-header">This is an invoice for your purchase on '.SITE_NAME.'</span>
         <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
           <tr>
             <td align="center">
               <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                 <tr>
                   <td class="email-masthead">
                     <a href="" class="f-fallback email-masthead_name">
                       <img src="https://i.ibb.co/2NgCN7t/Favicon.png">
                       <h3>
                         P2T <span style="color: #ffc107">Food</span> Pa<span style="color: #dc3545">le</span>tte
                       </h3>
                     </a>
                   </td>
                 </tr>
         
                 <!---------- Email Body ---------->
                 <tr>
                   <td class="email-body" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                     <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                       <!----- Body content ----->
                       <tr>
                         <td class="content-cell">
                           <div class="f-fallback">
                             <h1>Hi '.$name.',</h1>
                             <p>This is an invoice for your recent purchase.</p>
                             <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                               <tr>
                                 <td class="attributes_content">
                                   <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                     <tr>
                                       <td class="attributes_item">
                                         <span class="f-fallback">
                                          <strong>Amount Due:</strong> $'.$total_amount.'
                                         </span>
                                       </td>
                                     </tr>
                                     <tr>
                                       <td class="attributes_item">
                                         <span class="f-fallback">
                                           <strong>Order ID:</strong> '.$order_id.'
                                         </span>
                                       </td>
                                     </tr>
                                   </table>
                                 </td>
                               </tr>
                             </table>
         
                             <!---------- Action ---------->
                             <table class="purchase" width="100%" cellpadding="0" cellspacing="0" role="presentation">
         
                               <tr>
                                 <td colspan="3">
                                   <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                     <tr>
                                       <th class="purchase_heading" align="left">
                                         <p class="f-fallback">Description</p>
                                       </th>
                                       <th class="purchase_heading" align="center">
                                         <p class="f-fallback">Qty</p>
                                       </th>
                                       <th class="purchase_heading" align="right">
                                         <p class="f-fallback">Amount</p>
                                       </th>
                                     </tr>';
                                    $total = 0;
                                    foreach ($getOrderDetails as $detail) {
                                       $amount = $detail['qty'] * $detail['price'];
                                       $total = $total + $amount;
                                 $html .= '<tr>
                                             <td width="40%" class="purchase_item"><span class="f-fallback">' . $detail['dish'] . ' (' . $detail['attribute'] . ')</span></td>
                                             <td width="40%" class="purchase_item" align="center"><span class="f-fallback">' . $detail['qty'] . ' </span></td>
                                             <td class="purchase_item" width="20%" align="right"><span class="f-fallback">$' . $amount . '</span></td>
                                          </tr>';
   }
                                 $html.='<tr>
                                             <td width="80%" class="purchase_footer" valign="middle" colspan="2">
                                               <p class="f-fallback purchase_total purchase_total--label">Total</p>
                                             </td>
                                             <td width="20%" class="purchase_footer" valign="middle">
                                               <p class="f-fallback purchase_total">$'.$total.'</p>
                                             </td>
                                           </tr>
                                   </table>
                                 </td>
                               </tr>
                             </table>
                             <p>If you have any questions about this invoice, simply reply to this email or reach out to our 
                             <a href="'.FRONT_SITE_PATH.'">support team</a> for help.</p>
                             <p>Cheers,<br>'.SITE_NAME.'.</p>
                             <!-- Sub copy -->
                           </div>
                         </td>
                       </tr>
         
                     </table>
                   </td>
                 </tr>
               </table>
             </td>
           </tr>
         </table>
         </body>
         </html>';
   return $html;
}






