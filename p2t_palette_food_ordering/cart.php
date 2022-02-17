<?php include('template/front_panel/header.php'); ?>

<div class="container-fluid">
   <div class="row">
      <div class="col-12">

         <div class="container">
            <div class="row min-vh-80 py-5">
               <div class="col-12">
                  <h4 class="fw-bold mb-3">Your Orders</h4>

                  <form method="post">
                     <?php if (count(getUserFullCart()) > 0) { ?>
                     <div class="table-content table-responsive">
                        <table class="table table-bordered table-hover">
                           <thead>
                           <tr>
                              <th class="text-uppercase">Image</th>
                              <th class="text-uppercase">Product Name</th>
                              <th class="text-uppercase">Until Price</th>
                              <th class="text-uppercase">Qty</th>
                              <th class="text-uppercase">Subtotal</th>
                              <th class="text-uppercase">Action</th>
                           </tr>
                           </thead>

                           <tbody>
                           <?php foreach (getUserFullCart() as $key=>$list){ ?>
                           <tr>
                              <td class="product-thumbnail">
                                 <a href="#"><img src="<?php echo SITE_DISH_IMAGE.$list['image']?>" alt="" style="width: 70px" </a>
                              </td>
                              <td class="product-name fw-bold"><a href="#"><?php echo $list['dish_name'];?></a></td>
                              <td class="product-price-cart fw-semi-bold"><span class="amount"><?php echo '$'.$list['price'];?></span></td>
                              <td class="product-quantity">
                                 <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" type="text" name="qty[<?php echo $key ?>][]" value="<?php echo $list['qty'];?>">
                                 </div>
                              </td>
                              <td class="product-subtotal fw-semi-bold">
                                 <?php echo '$'.$list['price'] * $list['qty'];?>
                              </td>
                              <td class="product-remove">
                                 <button class="btn btn-outline-danger" onclick="delete_cart('<?php echo $key ?>','load')"><i class="fas fa-trash-alt"></i></button>
                              </td>
                           </tr>
                           <?php } ?>
                           </tbody>
                        </table>
                     </div>
                     <?php } else {
                         echo "<p class='alert alert-danger fw-bold fs-5'>Empty Cart</p>";
                     } ?>

                      <div class="row mt-3">
                          <div class="col-12">
                              <div class="d-md-flex justify-content-between">
                                  <div class="">
                                      <a href="<?php echo $front_url; ?>/shop" class="btn btn-main px-lg-5 py-lg-2 text-uppercase fw-semi-bold">
                                          Continue Shopping
                                      </a>
                                  </div>
                                  <div class="">
                                      <button name="update_cart" class="btn btn-warning mt-3 mt-md-0 me-3 px-lg-5 py-lg-2 text-uppercase fw-semi-bold">
                                          Update Shopping Cart
                                      </button>
                                      <a href="<?php echo $front_url; ?>/checkout" class="btn btn-outline-danger mt-3 mt-md-0 px-lg-5 py-lg-2 text-uppercase fw-semi-bold">
                                          Check out
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>















<?php include('template/front_panel/footer.php'); ?>
