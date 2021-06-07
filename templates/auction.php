<form method="post">
<input type="search" name="searchbar" placeholder="Find an auction">
<button type="submit" name="search">Search</button>
</form>

<?php


if(isset($_POST['search'])){
 $search = "%" . $_POST['searchbar'] . "%";
 $auctions = searchAuction($search);
 if($auctions == NULL){
   echo "Sorry, we couldn't find any matching results";
 }else{
   echo "This is what we found for your search of '" . $_POST['searchbar'] . "'<br>";
 foreach ($auctions as $auction) {
   ?> <a href='?a=<?php echo $auction['prod_id'] . $auction['prod_title']; ?>'><?php
   echo $auction['prod_title'] . "<br>";
   ?> </a> <?php
   echo $auction['end_time'] . "<br>";
 }
 }
}else{
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
}
