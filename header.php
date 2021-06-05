<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

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
