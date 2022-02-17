<?php
require_once "../core/base.php";
require_once "../core/function.php";
require_once "../core/auth.php";

$id = $_GET['id'];
if (categoryDelete($id)){
   redirect("category_list.php");
}


