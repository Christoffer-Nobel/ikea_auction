<?php
  ?> <p class="welcome"> <?php echo "Welcome to your page " . $_SESSION['first_name'] . " " . $_SESSION['last_name'] . ". Here you can view your open auctions, and bids you have recently placed or won <p>";

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
        ?> <a class="auction_a" href='?a=<?php echo $prod['prod_id'] . $prod['prod_title']; ?>'><div class="auction"><?php
        echo $prod['prod_title'] . "<br>";
        echo "Auction ends: " . $prod['end_time'] . "<br><br>";
        if($bidAmm == $prod['min_price']){
          echo "Your bid is currently the highest at kr. " . $bidAmm . "<br>";
        }elseif($bidAmm < $prod['min_price']){
          echo "You have been out-bid. The current price is kr. " . $prod['min_price'] . "<br>";
        }
        ?> </div></a> <?php
      }
    }
}
echo "<h2>Your active auctions:</h2>";

$sql = "SELECT * FROM products WHERE created_by = '$uid' AND active = 1;";
$result = mysqli_query($conn, $sql);
$prods =[];
if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    $prods[] = $row;
    }
  }
foreach ($prods as $prod){
  $time = date("20y-m-d H:m:s");
  $id = $prod['prod_id'];
  if($time > $prod['end_time']){
    $sql = "UPDATE products SET  active = 0 WHERE prod_id = $id;";
    $result = mysqli_query($conn, $sql);
  }else {
    ?> <a class="auction_a" href='?a=<?php echo $prod['prod_id'] . $prod['prod_title']; ?>'><div class="auction"><?php
    echo $prod['prod_title'] . "<br>";
    echo "Auction ends: " . $prod['end_time'] . "<br>";
    echo "Highest bid is currently at: " . $prod['min_price'] . "<br>";
    ?> </div></a> <?php
  }
}
echo "<h2>Your auction wins: </h2>";

$sql = "SELECT * FROM creator_ended_bids WHERE user_id = '$uid';";
$result = mysqli_query($conn, $sql);
$prods =[];
if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    $prods[] = $row;
  }
}
foreach ($prods as $prod){
  ?> <div class="ended_auction"> <?php
  echo $prod['prod_title'] . "<br>";
  echo "Final price: " . $prod['bid_ammount'] . "<br>";
  echo "Seller contact info: " . $prod['email'] . "<br><br>";
  ?> </div> <?php
}

echo "<h2>Your ended auctions: </h2>";

$sql = "SELECT * FROM users_ended_bids WHERE created_by = '$uid';";
$result = mysqli_query($conn, $sql);
$prods =[];
if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    $prods[] = $row;
  }
}
foreach ($prods as $prod){
  ?> <div class="ended_auction"> <?php
  echo $prod['prod_title'] . "<br>";
  echo "Final price: " . $prod['bid_ammount'] . "<br>";
  echo "Buyer contact info: " . $prod['email'] . "<br><br>";
  ?> </div> <?php
}
