<?php
$prodId = $_GET['a'];
$product = getProd($prodId);
?><div id="single_prod_div"> <?php
  echo "<h3>" . $product[0]['prod_title'] . "</h3>";
  echo "<b>Description:</b> " . $product[0]['description'] . "<br><br>";
  echo "<b>Highest bid:</b> " . $product[0]['min_price'] . "<br><br>";
  echo "<b>Ends:</b> " . $product[0]['end_time'] . "<br><br>";

  ?>
<h2>Enter bid<h2>
<form method="post" name="newBid">
  <input class="create_auction" type="number" name="bid">
  <button class="create_auction" type="submit" name="submit">Place bid</button>
</form>
</div>
<?php
$time = date("20y-m-d H:m:s");
if(isset($_SESSION['user_id'])){
  $uid = $_SESSION['user_id'];
  if(isset($_POST['submit'])){
    $bid = $_POST['bid'];
    if($uid != $product[0]['created_by']){
      if($bid > $product[0]['min_price']){
        if($time < $product[0]['end_time']){
          $prodBidId = $product[0]['prod_id'];

          $sql = "INSERT INTO bids (prod_id, bidder_id, bid_ammount) VALUES ('$prodBidId', '$uid', '$bid');";
          $result = mysqli_query($conn, $sql);

          $sql = "UPDATE products SET min_price = $bid WHERE prod_id = $prodBidId;";
          $result = mysqli_query($conn, $sql);

          header("Refresh:2");
          echo "Your bid has been place";

        }elseif(isset($_POST['submit'])){
            echo "Something went wrong. Auction may not be active";
        }
      }elseif($bid <= $product[0]['min_price']){
          echo "Your bid has to be larger than the current highest bid";
      }
    }else{
      echo "You can't bid on your own auctions";
    }
  }
}else{
    echo "Please log in to place bid";
}
?>
