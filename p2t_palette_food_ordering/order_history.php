<?php include('template/front_panel/header.php'); ?>

<?php
   if(!isset($_SESSION['FOOD_USER_ID'])){
      redirect('shop');
   }


?>

<div class="container-fluid">
   <div class="row">
      <div class="col-12">

         <div class="container">
            <div class="row min-vh-80 py-5">
               <div class="col-12">
                  <h4 class="fw-bold mb-3">Order History</h4>

                  <form method="post">
                     <?php if (count(orderLists()) > 0) { ?>
                        <div class="table-content table-responsive">
                           <table class="table table-bordered">
                              <thead>
                              <tr>
                                 <th class="text-uppercase">Order No</th>
                                 <th class="text-uppercase">Price</th>
                                 <th class="text-uppercase">Address</th>
                                 <th class="text-uppercase">Dish</th>
                                 <th class="text-uppercase">Order Status</th>
                                 <th class="text-uppercase">Payment Status</th>
                              </tr>
                              </thead>

                              <tbody>
                              <?php
                                 foreach (orderLists() as $orderList){
                                    $i=1;
                              ?>
                                 <tr>
                                    <td>
                                       <?php echo $i; ?>
                                       <br>
                                       <a href="<?php echo FRONT_SITE_PATH?>download_invoice?id=<?php echo $orderList['id'];?>">
                                          <img src='<?php echo FRONT_SITE_PATH?>assets/images/icon-img/pdf.png' width="30px" title="Download Invoice">
                                       </a>
                                    </td>
                                    <td>
                                       <span class="fw-semi-bold">
                                       <span class="text-black-50">Total:</span> $<?php echo $orderList['total_price']; ?> <br>

                                       <?php if ($orderList['coupon_code'] != ''){ ?>
                                          <span class="text-black-50">Coupon Code:</span> <?php echo $orderList['coupon_code']; ?> <br>
                                          <span class="text-black-50">Final Price:</span> $<?php echo $orderList['final_price']; ?>
                                       <?php } ?>
                                       </span>
                                    </td>
                                    <td>
                                       <p class="mb-0"><?php echo $orderList['address']; ?></p>
                                       <p class="mb-0"><?php echo $orderList['zipcode']; ?></p>
                                    </td>
                                    <td class="text-center">
                                       <table class="table-bordered dish-col-header" style="border:1px solid #e9e8ef; width: 100%">
                                          <tr>
                                             <th class="p-1">Dish</th>
                                             <th class="p-1">Attribute</th>
                                             <th class="p-1">Price</th>
                                             <th class="p-1">Qty</th>
                                          </tr>
                                          <?php
                                          $getOrderDetails = getOrderDetails($orderList['id']);
                                          foreach ($getOrderDetails as $list){
                                             ?>
                                             <tr>
                                                <td class="p-1"><?php echo $list['dish']?></td>
                                                <td class="p-1"><?php echo $list['attribute']?></td>
                                                <td class="p-1"><?php echo $list['price']?></td>
                                                <td class="p-1"><?php echo $list['qty']?></td>
                                             </tr>
                                          <?php } ?>
                                       </table>
                                    </td>
                                    <td>
                                       <?php if ($orderList['order_status_str'] == "Pending"){ ?>
                                          <span class="badge bg-warning">
                                       <?php echo $orderList['order_status_str']; ?>
                                          </span>
                                       <?php } if($orderList['order_status_str'] == "On the Way"){?>
                                          <span class="badge bg-primary">
                                       <?php echo $orderList['order_status_str']; ?>
                                          </span>
                                       <?php } if ($orderList['order_status_str'] == "Cooking"){ ?>
                                          <span class="badge bg-secondary">
                                       <?php echo $orderList['order_status_str']; ?>
                                          </span>
                                       <?php } if ($orderList['order_status_str'] == "Delivered"){ ?>
                                          <span class="badge bg-success">
                                       <?php echo $orderList['order_status_str']; ?>
                                          </span>
                                       <?php } if ($orderList['order_status_str'] == "Cancel"){ ?>
                                          <span class="badge bg-danger">
                                       <?php echo $orderList['order_status_str']; ?>
                                          </span>
                                       <?php } ?>
                                    </td>
                                    <td>
                                       <?php if ($orderList['payment_status'] == "pending"){ ?>
                                          <span class="badge bg-warning">
                                       <?php echo ucfirst($orderList['payment_status']); ?>
                                          </span>
                                       <?php } if($orderList['payment_status'] == "success"){?>
                                          <span class="badge bg-success">
                                       <?php echo ucfirst($orderList['payment_status']); ?>
                                          </span>
                                       <?php } ?>
                                    </td>
                                 </tr>
                              <?php } ?>
                              </tbody>
                           </table>
                        </div>
                     <?php $i++; } else {
                        echo "<p class='alert alert-danger fw-bold fs-5'>Empty Order</p>";
                     } ?>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php include('template/front_panel/footer.php'); ?>
