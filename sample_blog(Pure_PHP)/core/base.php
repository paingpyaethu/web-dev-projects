<?php

//function con($dbName){
////   mysqli_connect("localhost", "root", "", "blog");
//   mysqli_connect("localhost", "root", "", "$dbName");
//}
//function con(){
//   return mysqli_connect("localhost","root","","blog");
//}

$conn = mysqli_connect("localhost","root","","blog");

$info = array(
  "name" => "Sample Blog",
  "short" => "SBlog",
  "description" => "Sample Project ( Pure PHP )",
);

$role = ['Admin', 'Editor', 'User'];

$url = "http://{$_SERVER['HTTP_HOST']}/web-dev(mmsit)/blog/sample_blog(Pure_PHP)";

date_default_timezone_set('Asia/Yangon');

