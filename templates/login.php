<form method="post">
  <input type="email" name="email" required placeholder="Email">
  <input type="password" name="password" required placeholder="Adgangskode">
  <input type="submit" name="submit">
</form>

<?php
if(isset($_POST['submit'])){
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $hashedPass = hash('ripemd160', $pass);

  $users = getLogin();
  foreach ($users as $user) {
    if($email == $user['email'] && $hashedPass == $user['password']){
      echo $user['email'];
    break;
  }
}
}
