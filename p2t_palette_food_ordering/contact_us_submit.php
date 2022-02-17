<?php

require_once "core/base.php";
require_once "core/function.php";
require_once "core/constant.php";

$name = textFilter($_POST['name']);
$email = textFilter($_POST['email']);
$mobile = textFilter($_POST['mobile']);
$subject = textFilter($_POST['subject']);
$message = textFilter($_POST['message']);

$query = "INSERT INTO contact_us (name, email, mobile, subject, message) VALUES ('$name', '$email', '$mobile','$subject', '$message')";
$query_run = mysqli_query(conn(), $query);

if ($query_run){
   echo "Thank you for connecting with us, will get back to you shortly";
}










