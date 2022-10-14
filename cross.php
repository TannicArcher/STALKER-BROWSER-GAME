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
$l = $_GET['l'];
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$loc = $row_us['loc'];
?>
<?php
if ($loc == 'skadovsk' and $l == '1') {?>
<?php
$query1 = "update users set loc='shevchenko' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'skadovsk' and $l == '2') {?>
<?php
$query1 = "update users set loc='hutor' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'skadovsk' and $l == '3') {?>
<?php
$query1 = "update users set loc='zemsnaryad' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'skadovsk' and $l == '4') {?>
<?php
$query1 = "update users set loc='p_kran' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'shevchenko' and $l == '1') {?>
<?php
$query1 = "update users set loc='skadovsk' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'shevchenko' and $l == '2') {?>
<?php
$query1 = "update users set loc='izumrudnoe' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'hutor' and $l == '1') {?>
<?php
$query1 = "update users set loc='skadovsk' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'zemsnaryad' and $l == '1') {?>
<?php
$query1 = "update users set loc='skadovsk' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'p_kran' and $l == '1') {?>
<?php
$query1 = "update users set loc='skadovsk' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'izumrudnoe' and $l == '1') {?>
<?php
$query1 = "update users set loc='shevchenko' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<?php }
?>
<script type="text/javascript">
  document.location.href = "zonas.php";
</script>
</body>
</html>