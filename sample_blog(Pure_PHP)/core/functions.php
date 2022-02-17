<?php

// Common Start
function alert($data, $color = 'danger'){
   return "<p class='alert alert-$color'>$data</p>";
}


function runQuery($sql){
   global $conn;
//   $con = $conn;
   if (mysqli_query($conn, $sql)){
      return true;
   }else{
      die("Query Fail: ".mysqli_error($conn));
   }
}

function fetch($sql){
   global $conn;
   $query = mysqli_query($conn, $sql);
   $row = mysqli_fetch_assoc($query);
   return $row;
}

function fetchAll($sql){
   global $conn;
   $query = mysqli_query($conn, $sql);
   $rows = [];

   while ($row = mysqli_fetch_assoc($query)){
      array_push($rows,$row);
   }
   return $rows;
}

function redirect($l){
   header("location:$l");
}
function linkTo($l){
   echo "<script>location.href='$l'</script>";
}

function showTime($timestamp, $format = "d-m-y"){
   return date($format,strtotime($timestamp));
}

function countTotal($table, $condition = 1){
   if ($_SESSION['user']['role'] == 2){
      $currentUserId = $_SESSION['user']['id'];
      $sql = "SELECT COUNT(id) FROM $table WHERE user_id=$currentUserId";
      $total = fetch($sql);
      return $total['COUNT(id)'];
   } else {
      $sql = "SELECT COUNT(id) FROM $table WHERE $condition";
      $total = fetch($sql);
      return $total['COUNT(id)'];
   }
}

function short($str, $length='100'){
   return substr($str,0,$length)."....";
}

function short2($str1, $length='10'){
   return substr($str1, 0, $length)."..";
}

function textFilter($text){
   $text = trim($text);
   $text = htmlentities($text, ENT_QUOTES);
   $text = stripcslashes($text);
   return $text;
}
// Common End

//Auth Start
function register(){
   $name = $_POST['name'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $c_password = $_POST['c_password'];

   if ($password == $c_password){
      $passwordSecurity = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO users (name, email, password) VALUES ('$name','$email','$passwordSecurity')";

      if (runQuery($sql)){
         redirect('login.php');
      }

   }else{
      return alert('Passwords do not match.');
   }
}

function login(){
   $email = $_POST['email'];
   $password = $_POST['password'];

   $sql = "SELECT * FROM users WHERE email = '$email'";
   global $conn;
   $query = mysqli_query($conn, $sql);
   $row = mysqli_fetch_assoc($query);

   if (!$row){
      return alert("Email or Password do not match!");
   }else{

      if (!password_verify($password, $row['password'])){
         return alert("Email or Password do not match!");
      }else{
         session_start();
         $_SESSION['user'] = $row;
         redirect("dashboard.php");
      }
   }
}
//Auth End

// User Start
function user($id){
   $sql = "SELECT * FROM users WHERE id = $id";
   return fetch($sql);
}

function users(){
   $sql = "SELECT * FROM users";
   return fetchAll($sql);
}
// User End

//Category Start
function categoryAdd(){
   $title = textFilter(strip_tags($_POST['title'])); // XSS Attack အား ကာကွယ်ခြင်း။
   $user_id = $_SESSION['user']['id'];

   if ($title == ""){
      return alert("Fill Data");
   }else {
      $sql = "INSERT INTO categories (title, user_id) VALUES ('$title','$user_id')";
      if (runQuery($sql)){
         linkTo("category_add.php");
      }
   }

}

function category($id){
   $sql = "SELECT * FROM categories WHERE id = $id";
   return fetch($sql);
}

function categories(){
   $sql = "SELECT * FROM categories ORDER BY ordering DESC";
   return fetchAll($sql);

}

function categoryDelete($id){
   $sql = "DELETE FROM categories WHERE id = $id";
   return runQuery($sql);
}

function categoryUpdate(){
   $title = $_POST['title'];
   $id = $_POST['id'];
   $sql = "UPDATE categories SET title='$title' WHERE id=$id";
   return runQuery($sql);
}

function categoryPinToTop($id){
   global $conn;
   $sql = "UPDATE categories SET ordering = '0'";
   mysqli_query($conn, $sql);

   $sql = "UPDATE categories SET ordering = '1' WHERE id=$id";
   return runQuery($sql);
}
function categoryRemovePin(){
   $sql = "UPDATE categories SET ordering = '0'";
   return runQuery($sql);
}

function isCategory($id){ // ကိုယ် သတ်မှတ်ထားတဲ့ Category ဖြစ်မှ ပို့စ်တင်လို့ရအောင် ပြုလုပ်။
   if (category($id)){
      return $id;
   } else {
      die("Category is invalid.");
   }
}
//Category End

// Post Start
function postAdd(){
   $title = textFilter($_POST['title']);
   $description = textFilter($_POST['description']);
   $category_id = isCategory($_POST['category_id']);
   $user_id = $_SESSION['user']['id'];

   $sql = "INSERT INTO posts (title,description,user_id,category_id) VALUES ('$title','$description','$user_id','$category_id')";
   if (runQuery($sql)){
      linkTo('post_add.php');
   }
}

function post($id){
   $sql = "SELECT * FROM posts WHERE id = $id";
   return fetch($sql);
}

function posts(){
   if ($_SESSION['user']['role'] == 2){
      $current_userID = $_SESSION['user']['id'];
      $sql = "SELECT * FROM posts WHERE user_id=$current_userID"; // For User
   }else{
      $sql = "SELECT * FROM posts";
   }
   return fetchAll($sql);
}

function postDelete($id){
   $sql = "DELETE FROM posts WHERE id = $id";
   return runQuery($sql);
}

function postUpdate(){
   $title = $_POST['title'];
   $description = $_POST['description'];
   $category_id = $_POST['category_id'];
   $id = $_POST['id'];

   $sql = "UPDATE posts SET title='$title', description='$description', category_id='$category_id' WHERE id=$id";
   return runQuery($sql);
}
// Post End

// Front Panel Start
function fPosts($orderCol = "id", $orderType = "DESC"){
   $sql = "SELECT * FROM posts ORDER BY $orderCol $orderType";
   return fetchAll($sql);
}
function fCategories(){
   $sql = "SELECT * FROM categories ORDER BY ordering DESC";
   return fetchAll($sql);
}
function fPostByCategory($category_id, $limit = "999999", $post_id = 0){
   $sql = "SELECT * FROM posts WHERE category_id = $category_id AND id != $post_id ORDER BY id DESC LIMIT $limit";
   return fetchAll($sql);
}
function fSearch($searchKey){
   $sql = "SELECT * FROM posts WHERE title LIKE '%$searchKey%' OR description LIKE '%$searchKey%' ORDER BY id DESC";
   return fetchAll($sql);
}
function fSearchByDate($start, $end){
   $sql = "SELECT * FROM posts WHERE created_at BETWEEN '$start' AND '$end' ORDER BY id DESC";
   return fetchAll($sql);
}

// Front Panel End

// Viewers Count Start

function viewerRecords($userId, $postId, $device){
   $sql = "INSERT INTO viewers(user_id, post_id, device) VALUES ('$userId', '$postId', '$device')";
   runQuery($sql);
}

function viewerCountByPosts($postId){
   $sql = "SELECT * FROM viewers WHERE post_id = $postId";
   return fetchAll($sql);
}
function viewerCountByUsers($userId){
   $sql = "SELECT * FROM viewers WHERE user_id = $userId";
   return fetchAll($sql);
}

// Viewers Count End

// Ads Start
function adsAdd(){
   $ownerName = $_POST['owner_name'];
   $file = $_FILES['photo'];
   $tempFile = $file['tmp_name'];
   $fileName = $file['name'];
   $saveFolder = "Db_AdsPhoto/";
   $photo = $saveFolder.uniqid()."_".$fileName;
   move_uploaded_file($tempFile,$photo); // Enable to see front panel....

   $adsLink = $_POST['link'];
   $startDate = $_POST['start_date'];
   $endDate = $_POST['end_date'];

   $sql = "INSERT INTO ads (owner_name,photo,link,start_date,end_date) VALUES ('$ownerName','$photo','$adsLink','$startDate','$endDate')";
   if (runQuery($sql)){
      linkTo('ads_add.php');
   }
}

function ads(){
   $today = date("Y-m-d");
   $sql = "SELECT * FROM ads WHERE start_date <= '$today' && end_date > '$today'";
   return fetchAll($sql);
}

// Ads End

// Payment Start
function payNow(){
   global $conn;
   $fromUser = $_SESSION['user']['id'];
   $toUser = $_POST['to_user'];
   $amount = $_POST['amount'];
   $description = $_POST['description'];

   //From_user Money Update (-)
   $remainMoney = user($fromUser)['money'] - $amount;

   if (user($fromUser)['money'] >= $amount){
      $sql = "UPDATE users SET money = $remainMoney WHERE id = $fromUser";
      mysqli_query($conn, $sql);

      //To_user Money Update (+)
      $newMoney = user($toUser)['money'] + $amount;
      $sql = "UPDATE users SET money = $newMoney WHERE id = $toUser";
      mysqli_query($conn, $sql);

      //Add to Transition Table
      $sql = "INSERT INTO transition (from_user,to_user,amount,description) VALUES ('$fromUser','$toUser','$amount','$description')";
      if (runQuery($sql)){
         linkTo('wallet.php');
      }
   }

}

function transition($id){
   $sql = "SELECT * FROM transition WHERE id = $id";
   return fetch($sql);
}

function transitions(){
   $userId = $_SESSION['user']['id'];
   if ($_SESSION['user']['role'] == 0){
      $sql = "SELECT * FROM transition";
   }else {
      $sql = "SELECT * FROM transition WHERE from_user = $userId OR to_user = $userId";
   }
   return fetchAll($sql);

}
// Payment End

// Dashboard Start
function dashboardPosts($limit = 9999999){
   if ($_SESSION['user']['role'] == 2){
      $current_userID = $_SESSION['user']['id'];
      $sql = "SELECT * FROM posts WHERE user_id=$current_userID ORDER BY id DESC LIMIT $limit"; // For User
   }else{
      $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT $limit";
   }
   return fetchAll($sql);
}

// Dashboard End


// Api Start
function apiOutput($arr){

   return json_encode($arr);
}


// Api End