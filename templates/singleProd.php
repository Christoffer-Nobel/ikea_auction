<?php
$prodId = $_GET['a'];
$product = getProd($prodId);

echo $product[0]['prod_title'] . "<br>";
echo "Description: " . $product[0]['description'] . "<br>";
echo "Highest bid: " . $product[0]['min_price'] . "<br>";
echo "Ends: " . $product[0]['end_time'] . "<br>";


?> <h2>Enter bid<h2>
<form method="post" name="newBid">
  <input type="number" name="bid">
  <button type="submit" name="submit">Place</button>
</form>

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
