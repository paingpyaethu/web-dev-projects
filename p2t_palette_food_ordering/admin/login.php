<?php

require_once '../core/base.php';
require_once '../core/function.php';

?>

<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Admin Login</title>

	<link rel="icon" href="<?php echo $url; ?>/assets/images/favicon.png">
   <!-------------------- Bootstrap.CSS -------------------->
   <link rel="stylesheet" href="<?php echo $url; ?>/assets/vendor/bootstrap/dist/css/bootstrap.min.css">
   <!-------------------- FontAwesome.CSS -------------------->
   <link rel="stylesheet" href="<?php echo $url; ?>/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
   <!-------------------- Custom.CSS -------------------->
   <link rel="stylesheet" href="<?php echo $url; ?>/assets/css/style.css">
</head>
<body class="bg-light">

<section class="main container-fluid">
   <div class="row justify-content-center align-items-center min-vh-100">
      <div class="col-12 col-md-7 col-xl-4">
         <div class="card">
            <div class="card-body">
               <h3 class="text-center text-main mb-0 login-title">
                  <i class="fas fa-unlock-alt me-1"></i>
                  Admin Login
               </h3>
               <hr>

               <?php
               if (isset($_POST['signInBtn'])){
                  echo signIn();
               }
               ?>

               <form method="post">
                  <div class="mb-3">
                     <label for="UserName" class="form-label">
                        <i class="fas fa-user text-main me-1 fs-5"></i>
                        <span class="fw-bold fs-5">Username</span>
                     </label>
                     <input type="text" class="form-control" id="UserName" name="username" required>
                  </div>
                  <div class="mb-3">
                     <label for="Password" class="form-label">
                        <i class="fas fa-key text-main me-1 fs-5"></i>
                        <span class="fw-bold fs-5">Password</span>
                     </label>
                     <input type="password" class="form-control" id="Password" name="password" required>
                  </div>
						<button type="submit" class="btn btn-main" name="signInBtn">Sign In</button>
               </form>
            </div>
         </div>
      </div>
   </div>

</section>

<!-------------------- JQuery.js -------------------->
<script src="<?php echo $url; ?>/assets/vendor/jquery/dist/jquery.min.js"></script>
<!-------------------- Bootstrap.js -------------------->
<script src="<?php echo $url; ?>/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-------------------- main.js -------------------->
<script src="<?php echo $url; ?>/assets/js/main.js"></script>
</body>
</html>