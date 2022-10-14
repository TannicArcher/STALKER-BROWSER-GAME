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
  $sht = $_GET['sht'];
  $sht = mysqli_real_escape_string($dbc, trim($sht));
$user_id = $_SESSION['id'];
$query_us = "Select habar from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$habar = $row_us['habar'];
?>
<?php if ($habar < ($sht * '200')  or $sht < '1' or $sht > '100') {?>
  <script type="text/javascript">
  document.location.href = "tremor.php?sl=3";
  </script>
<?php 
  exit();
}
?>
<?php
$query = "update users set habar=habar - ($sht * '200'), aptechki=aptechki + $sht where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>

  <script type="text/javascript">
  document.location.href = "tremor.php?sl=1";
  </script>

</body>
</html>