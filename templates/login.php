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
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['first_name'] = $user['first_name'];
      $_SESSION['last_name'] = $user['last_name'];
      header('location: index.php');
    }
  }
}
