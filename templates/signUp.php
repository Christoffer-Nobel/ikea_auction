<p class="welcome">Enter your details to create an account<p>
<form method="post">
  <input class="create_auction" type="text" name="firstName" required placeholder="First name">
  <input class="create_auction" type="text" name="lastName" required placeholder="Last name">
  <input class="create_auction" type="email" name="email" required placeholder="Email">
  <input class="create_auction" type="password" name="password" required placeholder="Password">
  <input class="create_auction" type="password" name="repeatPassword" required placeholder="Repeat password">
  <input class="create_auction" type="text" name="address" required placeholder="Address">
  <input class="create_auction" type="postal" name="postal" required placeholder="Postal">
  <input class="create_auction" type="submit" name="submit">
</form>

<?php
if(isset($_POST['submit']) && $_POST['password'] == $_POST['repeatPassword']){
  $fName = $_POST['firstName'];
  $lName = $_POST['lastName'];
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $hashedPass = hash('ripemd160', $pass);
  $address = $_POST['address'];
  $postal = $_POST['postal'];

  $sql = "INSERT INTO users (first_name, last_name, email, password, address, postal) VALUES ('$fName', '$lName', '$email', '$hashedPass', '$address', '$postal');";
  $result = mysqli_query($conn, $sql);
  echo "User has been created";
} elseif(isset($_POST['submit']) && $_POST['password'] != $_POST['repeatPassword']){
  echo "Password and repeated password has to be the same, please try again";
} elseif(isset($_POST['submit'])){
  echo "Something went wrong, please try again";
}
