<?php
include('template/front_panel/header.php');
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
                           <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                           <li class="breadcrumb-item active">Email Verification</li>
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
$successVerifyMsg = "";
$alreadyRegMsg = "";
if (isset($_GET['email']) && isset($_GET['v_code'])){
   $email = textFilter($_GET['email']);
   $verificationCode = textFilter($_GET['v_code']);

   $query = "SELECT * FROM users WHERE email='$email' AND verification_code='$verificationCode'";
   $result = mysqli_query(conn(),$query);
   if ($result){
      if (mysqli_num_rows($result) == 1){
         $result_fetch = mysqli_fetch_assoc($result);
         $v_email =$result_fetch['email'];

         if ($result_fetch['is_verified']==0){
            $update = "UPDATE users SET is_verified='1' WHERE email='$v_email'";
            if (mysqli_query(conn(),$update)){
               $successVerifyMsg = "Email verification successful. You can log in now.";
            }
         }else {
//            echo "<script>alert('Email already registered'); window.location.href='login.php';</script>";
            $alreadyRegMsg = "Your email already registered. You can log in now.";
         }
      }
   }
}
?>

<div class="container-fluid">
   <div class="row">
      <div class="col-12">
         <div class="container">
            <div class="row min-vh-80 pt-5">
               <div class="col-12">
                  <p class="fs-2 fw-bold text-success">
                     <?php echo $successVerifyMsg; ?>
                  </p>
                  <p class="fs-2 fw-bold text-black-50">
                     <?php echo $alreadyRegMsg; ?>
                  </p>
                  <?php if ($successVerifyMsg || $alreadyRegMsg){ ?>
                  <a href="<?php echo $front_url; ?>/login" class="btn btn-main">Log In</a>
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

















<?php include('template/front_panel/footer.php'); ?>