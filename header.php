<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ikea auctions</title>
  <link rel="stylesheet" href="CSS/style.css">
  </head>
  <body>
<div id="header_div">
  <img id="image" class="nav" src="./img/IKEAlogo.jpg" align="left">
  <a id="header_menu" class="nav" href='index.php'>Back to menu</a>
  <?php

  $nav = getNav();
    foreach($nav as $singleNav){
      if($singleNav['page_id'] == 7){
        if(isset($_SESSION['user_id'])){
          ?> <a id="header_mypage" class="nav" href='?p=<?php echo $singleNav['page_id'] . $singleNav['page_name']; ?>'>
          <?php echo $singleNav['page_name']; ?> </a>

        <?php }else{
        ?>  <div id="empty_div1"> </div> <?php
        }
      }else{
      ?>
      <a id="header_<?php echo $singleNav['page_name']?>" class="nav" href="?p=<?php echo $singleNav["page_id"] . $singleNav["page_name"]; ?>">
      <?php echo $singleNav["page_name"]; ?></a>
      <?php } ?>
    <?php } ?>
    <div id="empty_div2"> </div>
</div>
