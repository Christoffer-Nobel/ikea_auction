<?php
  echo "Welcome to your page " . $_SESSION['first_name'] . " " . $_SESSION['last_name'] . ". Here you can view your open auctions, and bids you have recently placed or won";

echo "<h2>Your active bids:</h2>";

$uid = $_SESSION['user_id'];
$bids = getMaxBid($uid);

foreach ($bids as $bid) {
  $bidAmm = $bid['bid_ammount'];
  $sql = "SELECT * FROM user_bids WHERE bid_ammount = '$bidAmm' AND user_id = '$uid'";
  $result = mysqli_query($conn, $sql);
  $prod =[];
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $prod[] = $row;
      }
    }
    foreach ($prod as $prod) {

      $time = date("20y-m-d H:m:s");
      $id = $prod['prod_id'];
      if($time > $prod['end_time']){
        $sql = "UPDATE products SET  active = 0 WHERE prod_id = $id;";
        $result = mysqli_query($conn, $sql);
      }else {
        ?> <a href='?a=<?php echo $prod['prod_id'] . $prod['prod_title']; ?>'><?php
        echo $prod['prod_title'] . "<br>";
        ?> </a> <?php
        echo "Auction ends: " . $prod['end_time'] . "<br>";
        if($bidAmm == $prod['min_price']){
          echo "Your bid is currently the highest at kr. " . $bidAmm . "<br><br>";
        }elseif($bidAmm < $prod['min_price']){
          echo "You have been out-bid. The current price is kr. " . $prod['min_price'] . "<br><br>";
        }
      }
    }
}
