<?php

function conn(){
   return mysqli_connect("localhost","root","","p2t_food_palette");
}

$url = "http://{$_SERVER['HTTP_HOST']}/projects/p2t_palette_food_ordering/admin";
$front_url = "http://{$_SERVER['HTTP_HOST']}/projects/p2t_palette_food_ordering";


date_default_timezone_set('Asia/Yangon');



