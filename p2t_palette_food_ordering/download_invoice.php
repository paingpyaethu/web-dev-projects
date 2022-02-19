<?php

session_start();
include('core/base.php');
include('core/function.php');
include('core/constant.php');
require "vendor/autoload.php";

if (isset($_SESSION['user'])){

}else {
   if(!isset($_SESSION['FOOD_USER_ID'])){
      redirect('shop');
   }
}


if(isset($_GET['id'])  && $_GET['id']>0) {

   $id = textFilter($_GET['id']);
   $orderEmail = orderEmail($id);

   $mpdf = new \Mpdf\Mpdf();
   $mpdf->WriteHTML($orderEmail);
   $file = uniqid().'order_history.pdf';
   $mpdf->Output($file,'D');

}



