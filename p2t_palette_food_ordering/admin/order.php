<?php include('../template/header.php'); ?>

<div class="card categories mb-3 border-0 shadow-sm">
   <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-3">
         <li class="breadcrumb-item fs-7 fw-semi-bold"><a href="index.php">Home</a></li>
         <li class="breadcrumb-item fs-7 fw-semi-bold active">Order Master</li>
      </ol>
   </nav>
</div>

<div class="card border-0 shadow-sm">
   <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
         <div class="d-flex align-items-center">
            <i class="fas fa-shopping-bag fs-2 main-color"></i>
            <h3 class="mb-0 ms-2 fw-bold">Order Master</h3>
         </div>

         <div>
            <a href="#" class="btn btn-outline-secondary full-screen-btn">
               <i class="fas fa-expand"></i>
            </a>
         </div>
      </div>
      <hr>
      <div class="row">
         <div class="col-12">
            <div class="table-responsive">
               <table class="table ">
                  <thead>
                  <tr>
                     <th>Order Id</th>
                     <th>Name/Email/Mobile</th>
                     <th>Address/Zipcode</th>
                     <th>Price</th>
                     <th>Payment Status</th>
                     <th>Order Status</th>
                     <th>Created At</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if (adminOrderLists()){
                     foreach (adminOrderLists() as $orderList){
                        ?>
                        <tr>
                           <td>
                              <a href="order_detail.php?id=<?php echo $orderList['id']; ?>" class="order_detail">
                                 <?php echo $orderList['id']; ?>
                              </a>
                           </td>
                           <td>
                              <p class="mb-1"><?php echo $orderList['name']; ?></p>
                              <p class="mb-1"><?php echo $orderList['email']; ?></p>
                              <p class="mb-1"><?php echo $orderList['mobile']; ?></p>
                           </td>
                           <td>
                              <p><?php echo $orderList['address']; ?></p>
                              <p><?php echo $orderList['zipcode']; ?></p>
                           </td>
                           <td>
                              <span class="fw-semi-bold">
                                 $<?php echo $orderList['total_price']; ?>
                              </span>
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
                           <td><?php echo $orderList['order_status_str']; ?></td>

                           <td><?php echo showTime2($orderList['created_at']); ?></td>
                        </tr>
                     <?php } } else {  ?>
                     <tr>
                        <td colspan="8" class="text-center fw-bold text-danger">No Data Found!</td>
                     </tr>
                  <?php }  ?>

                  </tbody>
               </table>
            </div>
         </div>
      </div>



   </div>
</div>





<?php include('../template/footer.php'); ?>
<script>
   $('.table').dataTable({
      // "order": [[ 0, "desc" ]]
   });
</script>
