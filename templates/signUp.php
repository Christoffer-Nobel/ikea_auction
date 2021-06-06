<form method="post">
  <input type="text" name="firstName" required placeholder="Fornavn">
  <input type="text" name="lastName" required placeholder="Efternavn">
  <input type="email" name="email" required placeholder="Email">
  <input type="password" name="password" required placeholder="Adgangskode">
  <input type="password" name="repeatPassword" required placeholder="Gentag adgangskode">
  <input type="text" name="address" required placeholder="address">
  <input type="postal" name="postal" required placeholder="postal">
  <input type="submit" name="submit">
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
  global $conn;
  $result = mysqli_query($conn, $sql);
  echo "user has been created";
} elseif(isset($_POST['submit'])){
  echo "something went wrong";
}
