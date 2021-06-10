<p class="welcome">Login<p>
<form id="form" method="post">
  <input class="create_auction" type="email" name="email" required placeholder="Email">
  <input class="create_auction" type="password" name="password" required placeholder="Adgangskode">
  <button class="create_auction" type="submit" name="submit">Login</button>
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
