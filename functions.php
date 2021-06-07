<?php

$conn = null;

function connect() {
  global $conn;

  $conn = mysqli_connect(DBHOST, DBUSER, DBPASS);

  if(!$conn) {
    die(mysqli_error($conn));
  }

  mysqli_select_db($conn, DBNAME);
}

function getNav() {
  global $conn;

  $sql = 'SELECT page_id, page_name FROM pages WHERE nav_display = 1';
  $result = mysqli_query($conn, $sql);
  $nav = [];

  if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
      $nav[] = $row;
    }
  }
  return $nav;
}
$i;
function getPage($i) {
  global $conn;

  $sql = 'SELECT page_id, page_name, template, frontpage FROM pages WHERE page_id = "'. $i . '"';
  $result = mysqli_query($conn, $sql);
  $pages = [];

  if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
      $pages[] = $row;
    }
  }
  return $pages;
}

function getLogin(){
  global $conn;
  $sql = 'SELECT user_id, first_name, last_name, email, password FROM users where user_id > 0';
  $result = mysqli_query($conn, $sql);
  $users =[];
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $users[] = $row;
    }
  }
return $users;
}

function getCats() {
  global $conn;

  $sql = 'SELECT * FROM product_categories WHERE cat_id > 0';
  $result = mysqli_query($conn, $sql);
  $cats = [];

  if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
      $cats[] = $row;
    }
  }
  return $cats;
}

function getAuctions(){
  global $conn;
  $sql = 'SELECT * FROM products where active = 1';
  $result = mysqli_query($conn, $sql);
  $auctions =[];
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $auctions[] = $row;
    }
  }
return $auctions;
}

function debug($data) {
  echo '<pre>';
  print_r($data);
  echo '</pre>';
}
