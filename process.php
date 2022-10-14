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
$page_title = 'Лотерея';
require_once('conf/head.php');
?>
<?php
$user_id = $_SESSION['id'];
$tip = $_GET['tip'];
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$money = $row_us['money'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$loto_time = $row_us['loto_time'];
$loto_time = strtotime("$loto_time");
$time = ($loto_time - $now);
$poisk_tip = $row_us['poisk_tip'];
$poisk_time = $row_us['poisk_time'];
$poisk = $row_us['poisk'];
?>
<?php if ($poisk_tip != 0) {?>
  <script type="text/javascript">
  document.location.href = "vzlom.php";
  </script>
<?php
exit();
}?>
<?php 
if ($tip == '1') {?>
<?php
$query = "update users set poisk_tip='1', poisk='1', poisk_time=NOW() where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($tip == '2') {?>
<?php
$query = "update users set poisk_tip='1', poisk='2', poisk_time=NOW() where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($tip == '3') {?>
<?php
$query = "update users set poisk_tip='1', poisk='3', poisk_time=NOW() where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($tip == '4') {?>
<?php
$query = "update users set poisk_tip='1', poisk='4', poisk_time=NOW() where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>

  <script type="text/javascript">
  document.location.href = "vzlom.php";
  </script>

</body>
</html>