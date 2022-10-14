<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$h=getenv("HTTP_REFERER");
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "reg.php?err_login=1";
  </script>
  <?php
  exit();
}
if (empty($h)) {
  ?>
  <script type="text/javascript">
  document.location.href = "mail2.php";
  </script>
  <?php
  exit();
}
?>

<?php
$id1 = $_SESSION['id'];
$id2 = $_GET['id'];
?>

<?php
$query = "delete from kontakts where user_id='$id1' and drug_id='$id2' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>

<script type="text/javascript">
  document.location.href = "mail2.php";
</script>
</body>
</html>