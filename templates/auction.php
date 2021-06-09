<form method="post">
  <select default="Category" name="cat">
     <option value="" selected data-default>Categories</option>
    <?php
    foreach (getCats() as $cat) {
      $catAmm = getCatAmm($cat['cat_id']);
      $i = 0;
        foreach ($catAmm as $num) {
          $i++;
        }
     ?><option name="cat" value="<?php echo $cat['cat_id']; ?>"><?php echo $cat['cat_title'];?> ( <?php echo $i;?> )</option>
    <?php } ?>
  </select>
  <button type="submit" name="catSubmit">Show products in category</button>
</form>
<br>


<form method="post">
<input type="search" name="searchbar" placeholder="Find an auction">
<button type="submit" name="search">Search</button>
</form>

<?php
if(isset($_POST['catSubmit'])){
  $cat = $_POST['cat'];
  $auctions = getAuctionsWithCat($cat);
  foreach ($auctions as $auction) {
    ?> <a href='?a=<?php echo $auction['prod_id'] . $auction['prod_title']; ?>'><?php
    echo $auction['prod_title'] . "<br>";
    ?> </a> <?php
    echo "Ends: " . $auction['end_time'] . "<br>";
  }
}elseif(isset($_POST['search'])){
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
     echo "Category: " . $auction['cat_title'] . "<br>";
     echo "Ends: " . $auction['end_time'] . "<br>";
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
      echo "Category: " . $auction['cat_title'] . "<br>";
      echo "Ends: " . $auction['end_time'] . "<br>";
    }
  }
}
