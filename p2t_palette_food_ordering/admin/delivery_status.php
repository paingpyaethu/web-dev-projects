<?php
require_once "../core/base.php";
require_once "../core/function.php";
require_once "../core/auth.php";

if (isset($_GET['type']) && $_GET['type'] !== '' && isset($_GET['id']) && $_GET['id'] > 0){
   $id = textFilter($_GET['id']);
   $type = textFilter($_GET['type']);

   if ($type == 'active' || $type == 'deactive'){
      $status = 1;
      if ($type == 'deactive'){
         $status = 0;
      }
      $sql = "UPDATE delivery_boy SET status='$status' WHERE id='$id'";
      mysqli_query(conn(),$sql);
      redirect("delivery.php");
   }
}