<?php include('../template/header.php'); ?>
<?php

   if (isset($_GET['id']) && $_GET['id']>0) {
      $id = textFilter($_GET['id']);

      if (isset($_GET['order_status'])) {
         $order_status = textFilter($_GET['order_status']);
         mysqli_query(conn(),"UPDATE order_master SET order_status='$order_status' WHERE id='$id'");
         redirect('order_detail.php?id='.$id);
      }

      if(isset($_GET['deli_boy'])){
         $delivery_boy=textFilter($_GET['deli_boy']);
         mysqli_query(conn(),"UPDATE order_master SET delivery_boy_id='$delivery_boy' where id='$id'");
         redirect('order_detail.php?id='.$id);
      }
      $orderRow = adminOrderInvoices($id);
   } else {
      redirect('index.php');
   }

?>

   <div class="categories mb-3 p-4 border-0 shadow-sm">
      <h1 class="mb-0 text-uppercase text-main fw-bold text-center">Invoice</h1>
   </div>

   <div class="card border-0 shadow-sm">
      <div class="card-body">
         <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
               <i class="fas fa-shopping-cart fs-2 main-color"></i>
               <h3 class="mb-0 ms-2 fw-bold">Order ID <?php echo $id?></h3>
            </div>
            <div>
               <a href="#" class="btn btn-outline-secondary full-screen-btn">
                  <i class="fas fa-expand"></i>
               </a>
            </div>
         </div>
         <hr>

         <div class="row">
            <div class="col">
               <div class="">
                  <p class="mb-0 fw-bold">Shop Name</p>
                  <p class="">Shop Address</p>
               </div>
            </div>
            <div class="col">
               <div class="">
                  <p class="mb-0 fw-bold text-end">Invoice To</p>
                  <p class="text-end">
                     <?php echo $orderRow['name'] ?> <br>
                     <?php echo $orderRow['address'] ?> <br>
                     <?php echo $orderRow['zipcode'] ?> <br>
                  </p>
               </div>
            </div>

            <div class="row">
               <div class="col">
                  <div class="mt-3">
                     <p class="fw-bold">
                        Order Date: &nbsp;
                        <span class="fw-normal">
                           <?php echo showTime($orderRow['created_at']) ?>
                        </span>
                     </p>
                  </div>
               </div>
            </div>

            <div class="">
               <div class="table-content table-responsive">
                  <table class="table ">
                     <thead>
                     <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Attribute</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                     </tr>
                     </thead>
                     <tbody>
                     <?php
                     $getOrderDetails = getOrderDetails($id);
                     $total = 0;
                     $i = 1;
                        foreach ($getOrderDetails as $getOrderDetail) {
                           $total = $total + ($getOrderDetail['qty']*$getOrderDetail['price']);
                     ?>
                        <tr>
                           <td><?php echo $i ?></td>
                           <td><?php echo $getOrderDetail['dish']?></td>
                           <td><?php echo $getOrderDetail['attribute']?></td>
                           <td><?php echo $getOrderDetail['qty']?></td>
                           <td>$<?php echo $getOrderDetail['price']?></td>
                           <td>$<?php echo $getOrderDetail['qty']*$getOrderDetail['price']?></td>
                        </tr>
                     <?php
                        $i++;
                        }
                     ?>
                     </tbody>
                  </table>
               </div>
               <div class="">
                  <h4 class="text-end mb-0">Total: $<?php echo $total?></h4>
               </div>
               <hr>
               <div class="d-flex justify-content-between">
                  <?php
                     $orderStatusRes = mysqli_query(conn(),"SELECT * FROM order_status ORDER BY order_status");
                     $deliBoyRes = mysqli_query(conn(),"SELECT * FROM delivery_boy WHERE status=1 ORDER BY name");
                  ?>
                  <div class="d-inline-block">
                     <h4 class="">
                        Order Status:
                        <?php if ($orderRow['order_status_str'] == "Pending"){ ?>
                           <i class="text-warning fw-bold">
                              <?php echo $orderRow['order_status_str']?>
                           </i>
                        <?php } if ($orderRow['order_status_str'] == "On the Way"){ ?>
                           <i class="text-primary fw-bold">
                              <?php echo $orderRow['order_status_str']?>
                           </i>
                        <?php } if ($orderRow['order_status_str'] == "Cooking"){ ?>
                           <i class="text-secondary fw-bold">
                              <?php echo $orderRow['order_status_str']?>
                           </i>
                        <?php } if ($orderRow['order_status_str'] == "Delivered"){ ?>
                           <i class="text-success fw-bold">
                              <?php echo $orderRow['order_status_str']?>
                           </i>
                        <?php } if ($orderRow['order_status_str'] == "Cancel"){ ?>
                           <i class="text-danger fw-bold">
                              <?php echo $orderRow['order_status_str']?>
                           </i>
                        <?php } ?>
                     </h4>
                     <select class="form-select mb-3 w-50" aria-label="OrderStatus"
                             name="order_status" id="orderStatus" onchange="updateOrderStatus()" >
                        <option value="" selected>Update Order Status</option>
                        <?php
                           while ($orderStatusRow = mysqli_fetch_assoc($orderStatusRes)) {
                              echo "<option value='".$orderStatusRow['id']."'>".$orderStatusRow['order_status']."</option>";
                           }

                        ?>
                     </select>

                     <?php
                        echo "<h4 class='fw-semi-bold'>
                           Delivery Boy: 
                           <span class='text-main fw-bold'>
                           ".getDeliveryBoyNameById($orderRow['delivery_boy_id'])."
                           </span>
                           </h4>";
                     ?>
                     <select class="form-select w-50" aria-label="DeliBoy"
                             name="deli_boy" id="deliBoy" onchange="updateDeliBoy()">
                        <option value="" selected>Assign Delivery Boy</option>
                        <?php
                           while ($deliBoyRow = mysqli_fetch_assoc($deliBoyRes)) {
                              echo "<option value='".$deliBoyRow['id']."'>".$deliBoyRow['name']."</option>";
                           }

                        ?>
                     </select>
                  </div>
                  <div class="text-end d-inline-block">
                     <a href="../download_invoice.php?id=<?php echo $id; ?>" class="btn btn-outline-main">
                        <i class="fas fa-print"></i>
                        PDF
                     </a>
                  </div>
               </div>
            </div>



         </div>
         </div>
      </div>
   </div>

<?php include('../template/footer.php'); ?>
<script>
   function updateOrderStatus() {
      let orderStatus = jQuery('#orderStatus').val();
      if (orderStatus!='') {
         let orderId = "<?php echo $id?>";
         window.location.href='<?php echo $url?>/order_detail.php?id='+orderId+'&order_status='+orderStatus;
      }
   }

   function updateDeliBoy() {
      let deliBoy = jQuery('#deliBoy').val();
      if (deliBoy!='') {
         let orderId = "<?php echo $id?>";
         window.location.href='<?php echo $url?>/order_detail.php?id='+orderId+'&deli_boy='+deliBoy;
      }
   }
</script>
