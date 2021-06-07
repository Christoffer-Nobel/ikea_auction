<?php

define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "root");
define("DBNAME", "ikea_auction");

session_start();

include('functions.php');
connect();
include('header.php');

if(isset($_GET['a'])){
  include('templates/singleProd.php');
}elseif(isset($_GET['p'])){
  $pid = $_GET['p'];
  $page = getPage($pid);
  include('templates/' . $page[0]['template']);
}
