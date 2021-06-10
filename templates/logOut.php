<p class="welcome"> Are you sure you want to log out? <p>
<form id="form" method="post">
  <button class="create_auction" type="submit" name="logOut">Yes, i'm sure</button>
  <button class="create_auction" type="submit" name="no">No, bring me back</button>
</form>

<?php
if(isset($_POST['logOut'])){
  session_destroy();
  header('location: index.php');
}elseif(isset($_POST['no'])){
  header('location: index.php');
}
