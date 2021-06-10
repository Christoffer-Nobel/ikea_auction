<?php

session_start();
include('conn.php');
include('functions.php');
connect();
include('header.php');

if(isset($_GET['a'])){
  include('templates/singleProd.php');
}elseif(isset($_GET['p'])){
  $pid = $_GET['p'];
  $page = getPage($pid);
  include('templates/' . $page[0]['template']);
}elseif(isset($_SESSION['user_id'])){
  $page = getPage(3);
  ?><p class='welcome'><?php echo "Hi there " . $_SESSION['first_name'] . ", Thank you for helping us in the quest to limit waste! Here are all the active auctions:"; ?> </p> <?php
  include('templates/' . $page[0]['template']);
}else{
  $page = getPage(3);
  ?><p class='welcome'><?php echo "Welcome to IKEA actions. With your help, we are able to give new life to used, but perfectly usable products. Please log in, or sign up to create your own auctions or place bids"; ?> </p> <?php
  include('templates/' . $page[0]['template']);
}
