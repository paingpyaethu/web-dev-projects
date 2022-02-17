<?php require_once "../core/base.php"; ?>
<?php require_once "../core/function.php"; ?>
<?php require_once "../core/auth.php";?>
<?php
require_once "../core/constant.php";

//$curStr = $_SERVER['REQUEST_URI'];
//$curArr = explode('/',$curStr);
//$cur_path = $curArr[count($curArr)-1];
//
//$page_title='';
//if ($cur_path=='' || $cur_path=='index.php'){
//	$page_title = 'Dashboard';
//}elseif ($cur_path=='category_list.php' || $cur_path=='category_add.php'){
//   $page_title = 'Manage Category';
//}



?>



<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title><?php echo SITE_NAME ?></title>

	<link rel="icon" href="<?php echo $url; ?>/assets/images/favicon.png">
	<!-------------------- Bootstrap.CSS -------------------->
	<link rel="stylesheet" href="<?php echo $url; ?>/assets/vendor/bootstrap/dist/css/bootstrap.min.css">
	<!-------------------- FontAwesome.CSS -------------------->
	<link rel="stylesheet" href="<?php echo $url; ?>/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
	<!-------------------- DataTable.Bootstrap.CSS -------------------->
	<link rel="stylesheet" href="<?php echo $url; ?>/assets/vendor/datatable/css/dataTables.bootstrap5.min.css">
	<!-------------------- Custom.CSS -------------------->
	<link rel="stylesheet" href="<?php echo $url; ?>/assets/css/style.css">
</head>
<body>

<section class="main container-fluid">
   <div class="row">

      <!-------------------- Aside Section -------------------->
      <?php include 'aside.php';?>
      <!-------------------- Aside Section -------------------->


      <!-------------------- Content Section -------------------->
      <div class="col-12 col-lg-8 col-xl-9 bg-light" id="content">
         <div class="row content-header">
            <div class="col-12">
               <div class="d-flex justify-content-between align-items-center shadow-sm bg-main p-3 rounded">
						<button class="show-sidebar-btn btn btn-outline-main shadow-sm d-block d-lg-none">
							<i class="fas fa-bars text-white"></i>
						</button>

                  <div class="food-img d-flex">
                     <span><img src="<?php echo $url; ?>/assets/images/header/1.jpg" class="img-fluid" alt=""></span>
                     <span><img src="<?php echo $url; ?>/assets/images/header/2.jpg" class="img-fluid" alt=""></span>
                     <span><img src="<?php echo $url; ?>/assets/images/header/3.jpg" class="img-fluid" alt=""></span>
                     <span><img src="<?php echo $url; ?>/assets/images/header/4.jpg" class="img-fluid" alt=""></span>
                     <span><img src="<?php echo $url; ?>/assets/images/header/5.jpg" class="img-fluid" alt=""></span>
                  </div>

                  <div class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['user']['name']; ?>
                     </a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="logout.php">Log Out</a>
                     </div>
                  </div>
               </div>
            </div>
			</div>

			<div class="main-panel">
				<div class="content flex-grow-1">