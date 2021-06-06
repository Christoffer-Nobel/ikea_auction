<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ikea auctions</title>
  </head>
  <body>
<a href='index.php'>Back to menu</a> <br>
  <?php
$nav = getNav();
    foreach ($nav as $singleNav) {
    ?> <a href='?p=<?php echo $singleNav['page_id'] . $singleNav['page_name']; ?>'>
    <?php echo $singleNav['page_name']; ?> </a>
    <br>
    <?
    }

?>
<br><br><br>
