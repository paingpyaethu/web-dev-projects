<?php

session_start();
require_once "core/base.php";
require_once "core/function.php";
require_once "core/constant.php";

// Load Composer's autoloader
require "vendor/autoload.php";

$type = textFilter($_POST['type']);

//$verification_code = substr(number_format(time() * rand(),0,'',''),0,6);
$verification_code = bin2hex(random_bytes(16));
if ($type == 'register'){
   $name = textFilter($_POST['name']);
   $email = textFilter($_POST['email']);
   $mobile = textFilter($_POST['mobile']);
   $password = textFilter($_POST['password']);
   $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

   $check = mysqli_num_rows(mysqli_query(conn(), "SELECT * FROM users WHERE email='$email'"));
   if ($check > 0){
      $arr = array('status'=>'error', 'msg'=>'Email is already registered.', 'field'=>'email_error');
   }else {
      mysqli_query(conn(), "INSERT INTO users (name, email, mobile, password, status, verification_code,is_verified) VALUES ('$name', '$email', '$mobile','$encrypted_password','1',
                                 '$verification_code','0')");

      $html = "Thanks for registration! Click the link below to verify the email address
              <a href='http://localhost/projects/p2t_palette_food_ordering/email_verification?email=$email&v_code=$verification_code'>
              Verify
              </a>";
      sendEmail($email, $html,'Email Verification.....');

      $arr = array('status'=>'success', 'msg'=>'Thank you for register. Please check your email, to verify your account.',
         'field'=>'form_msg');
   }
   echo json_encode($arr);
}


if ($type == 'login'){
   $email = textFilter($_POST['user_email']);
   $password = textFilter($_POST['user_password']);

   $query = mysqli_query(conn(), "SELECT * FROM users WHERE email='$email'");
   $result = mysqli_num_rows($query);
   if ($result > 0){
      $row = mysqli_fetch_assoc($query);
      $status = $row['status'];
      $is_verified = $row['is_verified'];

      if ($is_verified == 1){
         if ($status == 1){
            if (password_verify($password, $row['password'])){
               $_SESSION['FOOD_USER_ID'] = $row['id'];
               $_SESSION['FOOD_USER_NAME'] = $row['name'];
               $arr = array('status'=>'success', 'msg'=>'');

               if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
                  foreach ($_SESSION['cart'] as $key=>$value){
                     manageUserCart($_SESSION['FOOD_USER_ID'], $value['qty'], $key);
                  }
               }

            }else{
               $arr = array('status'=>'error', 'msg'=>'Please enter correct password!');
            }
         }else {
            $arr = array('status'=>'error', 'msg'=>'Your account has been deactivated!');
         }
      }else {
         $arr = array('status'=>'error', 'msg'=>'Please verify your email!');
      }
   }else {
      $arr = array('status'=>'error', 'msg'=>'Please enter correct email!');
   }
   echo json_encode($arr);
}


if ($type == 'forgot'){
   $email = textFilter($_POST['email']);

   $query = mysqli_query(conn(), "SELECT * FROM users WHERE email='$email'");
   $result = mysqli_num_rows($query);

   if ($result > 0){
      $row = mysqli_fetch_assoc($query);
      $status = $row['status'];
      $is_verified = $row['is_verified'];
      $id = $row['id'];

      if ($is_verified == 1){
         if ($status == 1){
            $rand_password =  bin2hex(random_bytes(16));
            $generate_password = substr(str_shuffle($rand_password),0,10);

            $newPassword = password_hash($generate_password, PASSWORD_DEFAULT);
            mysqli_query(conn(),"UPDATE users SET password='$newPassword' WHERE id='$id'");

            $html = "Your New Password is $generate_password -> You can login now. 
            <a href='http://localhost/projects/p2t_palette_food_ordering/login.php' class='btn btn-main'>
            Login in here
            </a>";
            sendEmail($email, $html,'New Password');
            $arr = array('status'=>'success', 'msg'=>'Password has been reset. Please check your email');

         }else {
            $arr = array('status'=>'error', 'msg'=>'Your account has been deactivated!');
         }
      }else {
         $arr = array('status'=>'error', 'msg'=>'Please verify your email!');
      }
   }
   echo json_encode($arr);
}








