<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "reg.php?err_login=1";
  </script>
  <?php
  exit();
}
?>
<?php
$user_id = $_SESSION['id'];
?>
<?php
$query1 = "update users set message='0' where id = '$user_id'";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД1');
$query2 = "update message set reading='1' where dlya='$user_id' and reading='0' ";
$result2 = mysqli_query($dbc, $query2) or die ('Ошибка передачи запроса к БД2');
?>
<script type="text/javascript">
  document.location.href = "mail2.php";
</script>
</body>
</html>