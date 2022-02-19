<?php include('template/front_panel/header.php'); ?>
<?php
   if (!isset($_SESSION['ORDER_ID']))
   {
      redirect('shop');
   }
   if (isset($_SESSION['COUPON_CODE']))
   {
      unset($_SESSION['COUPON_CODE']);
      unset($_SESSION['FINAL_PRICE']);
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
                              <li class="breadcrumb-item active">Order Placed</li>
                           </ol>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="about-us-area py-5">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="container">
                  <div class="row">
                     <div class="col-12 d-flex align-items-center">
                        <div class="about-us-content">
                           <h2 class="">Order has been placed<span class="text-success"> successfully.</span></h2>
                           <br>
                           <h3>Order Id <?php echo $_SESSION['ORDER_ID'];?></h3>
                        </div>
                     </div>

                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>




<?php
unset($_SESSION['ORDER_ID']);
include('template/front_panel/footer.php');

?>