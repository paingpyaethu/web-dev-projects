<?php require_once "core/auth.php"; ?>
<?php include "core/isAdmin.php"; ?>
<?php include "template/header.php"; ?>
<?php
$id = $_GET['id'];
$current = user($id);
?>

<div class="row">
   <div class="col-12 col-md-8">
      <div class="card">
         <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
               <h4 class="mb-0">
                  <i class="feather-user text-primary"></i>
                  <?php echo $current['name']; ?>
                  <?php if ($current['id'] > 2){
                     echo '(User)';
                  } ?>
               </h4>
               <div class="">
                  <a href="<?php echo $url; ?>/user_list.php" class="btn btn-outline-primary">
                     <i class="feather-list"></i>
                  </a>
                  <a href="#" class="btn btn-outline-secondary full-screen-btn">
                     <i class="feather-maximize-2"></i>
                  </a>
               </div>
            </div>
            <hr>

            <table class="table table-bordered table-hover">
               <thead>
               <tr>
                  <th>Viewed Posts</th>
                  <th>Device</th>
                  <th>Time</th>
               </tr>
               </thead>
               <tbody>
                  <?php foreach (viewerCountByUsers($id) as $u){ ?>
                     <tr>
                        <td><?php echo post($u['post_id'])['title']; ?></td>
                        <td><?php echo $u['device']?></td>
                        <td class="text-nowrap"><?php echo showTime($u['created_at'])?></td>
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
