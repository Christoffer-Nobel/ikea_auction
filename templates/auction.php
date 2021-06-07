<?php
$auctions = getAuctions();
$time = date("20y-m-d H:m:s");
foreach ($auctions as $auction) {
  $id = $auction['prod_id'];
  if($time > $auction['end_time']){
    $sql = "UPDATE products SET  active = 0 WHERE prod_id = $id;";
    $result = mysqli_query($conn, $sql);
  }else {
    ?> <a href='?a=<?php echo $auction['prod_id'] . $auction['prod_title']; ?>'><?php
    echo $auction['prod_title'] . "<br>";
    ?> </a> <?php
    echo $auction['end_time'] . "<br>";
  }
}
