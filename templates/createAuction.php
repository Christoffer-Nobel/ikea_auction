<p class='welcome'>Please enter your product information here to create your auction<p>
<form id="form" method="post" name="newAuction">
  <input class="create_auction" type="text" name="title" placeholder="Title" required>
  <select class="create_auction" name="cat" required>
    <?php
    foreach (getCats() as $cat) {
      ?><option name="cat" value="<?php echo $cat['cat_id']; ?>"><?php echo $cat['cat_title']; ?></option>
    <?php } ?>
  </select>
  <input class="create_auction" type="text" name="description" placeholder="Product description" required>
  <input class="create_auction" type="number" name="min_price" placeholder="Minimum price" required>
  <input class="create_auction" type="datetime-local" name="end_time" placeholder="Auction end time" required>
  <input class="create_auction" type="submit" name="submit">
</form>

<?php
if(isset($_SESSION['user_id']) && isset($_POST['submit'])){
  $title = $_POST['title'];
  $cat = $_POST['cat'];
  $description = $_POST['description'];
  $price = $_POST['min_price'];
  $end = $_POST['end_time'];
  $user = $_SESSION['user_id'];

  $sql = "INSERT INTO products (cat_id, prod_title, description, min_price, end_time, created_by) VALUES ('$cat', '$title', '$description', '$price', '$end', '$user');";

  $result = mysqli_query($conn, $sql);
  echo "Your auction has been published";
} elseif(isset($_SESSION['submit'])){
  echo "Something went wrong, please try again";
}
