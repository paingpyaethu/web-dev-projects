<?php

require_once "../core/base.php";
require_once "../core/functions.php";

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

$sql = "SELECT * FROM categories WHERE 1";

if(isset($_GET['id'])){
   $id = textFilter($_GET['id']);
   $sql .= " AND id=$id";
}

if(isset($_GET['limit'])){
   $limit = textFilter($_GET['limit']);
   $sql .= " LIMIT $limit";
}

if(isset($_GET['offset'])){
   $offset = textFilter($_GET['offset']);
   $sql .= " OFFSET $offset";
}

$rows = fetchAll($sql);

echo apiOutput($rows);