<p> Are you sure you want to log out? <p>
<form method="post">
  <button type="submit" name="logOut">Log out</button>
</form>

<?
if(isset($_POST['logOut'])){
  session_destroy();
  header('location: index.php');
}
