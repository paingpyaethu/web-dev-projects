<table class="table table-hover mt-3 mb-0">
   <thead>
   <tr>
      <th>#</th>
      <th>Title</th>
      <th>User</th>
      <th>Control</th>
      <th>Created_At</th>
   </tr>
   </thead>

   <tbody>
   <?php
   foreach (categories() as $c){
      ?>
      <tr class="<?php echo $c['ordering']==1 ?'table-info' :''; ?>">
         <td><?php echo $c['id'];?></td>
         <td><?php echo $c['title'];?></td>
         <td><?php echo user($c['user_id'])['name'];?></td>
         <td>
            <a href="category_delete.php?id=<?php echo $c['id'];?>" onclick="return confirm('Are you sure?')"
							 class="btn btn-outline-danger btn-sm">
               <i class="feather-trash-2"></i>
            </a>
            <a href="category_edit.php?id=<?php echo $c['id'];?>" class="btn btn-outline-success btn-sm">
               <i class="feather-edit-3"></i>
            </a>
					 <?php if ($c['ordering'] != 1 ){?>
					  <a href="category_pin_to_top.php?id=<?php echo $c['id'];?>" class="btn btn-outline-info btn-sm">
						  <i class="feather-corner-left-up"></i>
					  </a>
					 <?php }else{ ?>
					 <a href="category_pin_to_remove.php?id=<?php echo $c['id'];?>" class="btn btn-outline-info btn-sm">
						 <i class="feather-corner-right-down"></i>
					 </a>
					 <?php } ?>
				 </td>
         </td>
         <td><?php echo showTime($c['created_at']);?></td>
      </tr>

   <?php } ?>
   </tbody>
</table>