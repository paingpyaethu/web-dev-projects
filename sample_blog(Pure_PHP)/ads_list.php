<?php require_once "core/auth.php"; ?>
<?php include "core/isEditor&Admin.php"; ?>
<?php include "template/header.php"; ?>


<div class="row">
   <div class="col-12">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb bg-white mb-4">
            <li class="breadcrumb-item"><a href="<?php echo $url; ?>/dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ads</li>
         </ol>
      </nav>
   </div>
</div>

<div class="row">
   <div class="col-12">
      <div class="card mb-4">
         <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
               <h4 class="mb-0">
                  <i class="feather-list text-primary"></i> Ads List
               </h4>
               <div class="">
                  <a href="<?php echo $url; ?>/ads_add.php" class="btn btn-outline-primary">
                     <i class="feather-plus-circle"></i>
                  </a>
                  <a href="#" class="btn btn-outline-secondary full-screen-btn">
                     <i class="feather-maximize-2"></i>
                  </a>
               </div>
            </div>

            <hr>
            <table class="table table-hover table-striped table-bordered mt-3 mb-0">
               <thead>
               <tr class="text-nowrap">
                  <th>#</th>
                  <th>Owner Name</th>
                  <th>Photo</th>
                  <th>Link</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Control</th>
                  <th>Created_At</th>
               </tr>
               </thead>

               <tbody>
               <?php
               foreach (ads() as $ad){
                  ?>
                  <tr>
                     <td><?php echo $ad['id'];?></td>
                     <td><?php echo $ad['owner_name'];?></td>
                     <td><?php echo short2($ad['photo']);?></td>
                     <td><?php echo short2($ad['link']); ?></td>
                     <td><?php echo $ad['start_date'];?></td>
                     <td><?php echo $ad['end_date'];?></td>
                     <td class="text-nowrap">
                        <a href="post_detail.php?id=<?php echo $ad['id'];?>" class="btn btn-outline-info btn-sm">
                           <i class="feather-info"></i>
                        </a>
                        <a href="post_delete.php?id=<?php echo $ad['id'];?>" onclick="return confirm('Are you sure?')"
                           class="btn btn-outline-danger btn-sm">
                           <i class="feather-trash-2"></i>
                        </a>
                        <a href="post_edit.php?id=<?php echo $ad['id'];?>" class="btn btn-outline-warning btn-sm">
                           <i class="feather-edit-3"></i>
                        </a>
                     </td>
                     <td><?php echo showTime($ad['created_at']);?></td>
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
