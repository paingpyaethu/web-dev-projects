<?php require_once "core/auth.php"; ?>
<?php include "template/header.php"; ?>

<?php
if (isset($_POST['payNow'])){
   payNow();
}
?>

   <div class="row">
      <div class="col-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-4">
               <li class="breadcrumb-item"><a href="<?php echo $url; ?>/dashboard.php">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">My Wallet</li>
            </ol>
         </nav>
      </div>
   </div>
   <div class="row">
      <div class="col-12 col-xl-8">
         <div class="card mb-4">
            <div class="card-body">
               <div class="d-flex justify-content-between align-items-center">
                  <h4 class="mb-0">
                     <i class="feather-dollar-sign text-primary"></i> My Wallet
                  </h4>
                  <a href="#" class="btn btn-outline-primary full-screen-btn">
                     <i class="feather-gift"> Balance $</i><?php echo user($_SESSION['user']['id'])['money'];?>
                  </a>
               </div>
               <hr>


               <form method="post">
                  <div class="form-inline">
                     <select name="to_user" id="" class="custom-select mr-3 w-25">
                        <option value="0" selected disabled>Select User</option>
                        <?php foreach (users() as $user){ ?>
                           <?php if ($user['id'] != $_SESSION['user']['id']){ ?>
                           <option value="<?php echo $user['id'];?>"><?php echo $user['name'] ?></option>
			  									 <?php } ?>
                        <?php } ?>
                     </select>
                     <input type="number" class="form-control mr-3 w-25" name="amount" min="100" max="<?php echo user($_SESSION['user']['id'])['money'];?>" placeholder="Pay Amount">
                     <input type="text" class="form-control mr-3" name="description" placeholder="For What?">
                     <button class="btn btn-primary" name="payNow">Transfer</button>
                  </div>
               </form>
							<table class="table table-hover table-bordered mt-3 mb-0">
								<thead>
								<tr>
									<th>#</th>
									<th>From User</th>
									<th>To User</th>
									<th>Amount</th>
									<th>Description</th>
									<th>Date / Time</th>
								</tr>
								</thead>

								<tbody>
                <?php foreach (transitions() as $transition){ ?>
									 <tr>
										 <td><?php echo $transition['id'];?></td>
										 <td><?php echo user($transition['from_user'])['name'];?></td>
										 <td><?php echo user($transition['to_user'])['name'];?></td>
										 <td><?php echo $transition['amount'];?></td>
										 <td><?php echo $transition['description'];?></td>
										 <td><?php echo date("d-m-Y / h:i",strtotime($transition['created_at']));?></td>
									 </tr>
                <?php } ?>

								</tbody>
							</table>

            </div>
         </div>
      </div>
   </div>

<?php include "template/footer.php"; ?>
<script>
    $('.table').dataTable({
        "order": [[ 0, "desc" ]]
    });
</script>
