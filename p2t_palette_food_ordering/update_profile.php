<?php

session_start();
require_once "core/base.php";
require_once "core/function.php";
require_once "core/constant.php";


$type = textFilter($_POST['type']);
$userId = $_SESSION['FOOD_USER_ID'];

if ($type == 'profile'){
   $name = textFilter($_POST['name']);
   $mobile = textFilter($_POST['mobile']);
   $email = textFilter($_POST['email']);
   $_SESSION['FOOD_USER_NAME'] = $name;

   mysqli_query(conn(),"UPDATE users SET name='$name', mobile='$mobile', email='$email' WHERE id='$userId'");
   $arr = array('status'=>'success', 'msg'=>'Profile has benn updated.');

   echo json_encode($arr);
}

if ($type == 'password') {
   $oldPassword = textFilter($_POST['old_password']);
   $newPassword = textFilter($_POST['new_password']);

   $check = mysqli_num_rows(mysqli_query(conn(), "SELECT * FROM users WHERE password='$oldPassword'"));

   $query = mysqli_query(conn(), "SELECT password FROM users WHERE id='$userId'");
   $row = mysqli_fetch_assoc($query);

   if (password_verify($oldPassword, $row['password'])) {

      $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
      mysqli_query(conn(),"UPDATE users SET password='$newPassword' WHERE id='$userId'");

      $arr = array('status'=>'success', 'msg'=>'Password has benn updated.');
   } else {
      $arr = array('status'=>'error', 'msg'=>'Please enter correct password.');
   }
   echo json_encode($arr);
}


//if ($type == 'login'){
//   $email = textFilter($_POST['user_email']);
//   $password = textFilter($_POST['user_password']);
//
//   $query = mysqli_query(conn(), "SELECT * FROM users WHERE email='$email'");
//   $result = mysqli_num_rows($query);
//   if ($result > 0){
//      $row = mysqli_fetch_assoc($query);
//      $status = $row['status'];
//      $is_verified = $row['is_verified'];
//
//      if ($is_verified == 1){
//         if ($status == 1){
//            if (password_verify($password, $row['password'])){
//               $_SESSION['FOOD_USER_ID'] = $row['id'];
//               $_SESSION['FOOD_USER_NAME'] = $row['name'];
//               $arr = array('status'=>'success', 'msg'=>'');
//
//               if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
//                  foreach ($_SESSION['cart'] as $key=>$value){
//                     manageUserCart($_SESSION['FOOD_USER_ID'], $value['qty'], $key);
//                  }
//               }
//
//            }else{
//               $arr = array('status'=>'error', 'msg'=>'Please enter correct password!');
//            }
//         }else {
//            $arr = array('status'=>'error', 'msg'=>'Your account has been deactivated!');
//         }
//      }else {
//         $arr = array('status'=>'error', 'msg'=>'Please verify your email!');
//      }
//   }else {
//      $arr = array('status'=>'error', 'msg'=>'Please enter correct email!');
//   }
//   echo json_encode($arr);
//}
//
//
//if ($type == 'forgot'){
//   $email = textFilter($_POST['email']);
//
//   $query = mysqli_query(conn(), "SELECT * FROM users WHERE email='$email'");
//   $result = mysqli_num_rows($query);
//
//   if ($result > 0){
//      $row = mysqli_fetch_assoc($query);
//      $status = $row['status'];
//      $is_verified = $row['is_verified'];
//      $id = $row['id'];
//
//      if ($is_verified == 1){
//         if ($status == 1){
//            $rand_password =  bin2hex(random_bytes(16));
//            $generate_password = substr(str_shuffle($rand_password),0,10);
//
//            $newPassword = password_hash($generate_password, PASSWORD_DEFAULT);
//            mysqli_query(conn(),"UPDATE users SET password='$newPassword' WHERE id='$id'");
//
//            $html = "Your New Password is $generate_password -> You can login now.
//            <a href='http://localhost/My_Projects/Food_Ordering_System/p2t_palette_food_ordering/login.php' class='btn btn-main'>
//            Login in here
//            </a>";
//            sendEmail($email, $html,'New Password');
//            $arr = array('status'=>'success', 'msg'=>'Password has been reset. Please check your email');
//
//         }else {
//            $arr = array('status'=>'error', 'msg'=>'Your account has been deactivated!');
//         }
//      }else {
//         $arr = array('status'=>'error', 'msg'=>'Please verify your email!');
//      }
//   }
//   echo json_encode($arr);
//}








