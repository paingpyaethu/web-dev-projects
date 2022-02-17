<?php
require_once "../core/base.php";
require_once "../core/function.php";
require_once "../core/auth.php";

$id = $_GET['id'];
if (dishDelete($id)){
   $_SESSION['success'] = "Item deleted successfully.";
   redirect("dish.php");
}