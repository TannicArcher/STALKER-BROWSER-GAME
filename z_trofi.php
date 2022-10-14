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
$tip = $_GET['tip'];
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$loc = $row_us['loc'];//пистолет
$vid = $row_us['m_vid'];
$m_col = $row_us['m_col'];
?>

<?php if ($m_col < '1') {?>
  <script type="text/javascript">
  document.location.href = "zonas.php";
  </script>
  <?php
  exit();
}
?>
<?php
if ($loc == 'shevchenko' and $vid == '1') {?>
<?php
$query = "update users set t_1=t_1+'$m_col', m_col='0', m_need='0', m_vid='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'shevchenko' and $vid == '2') {?>
<?php
$query = "update users set t_1=t_1+'$m_col', m_col='0', m_need='0', m_vid='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'shevchenko' and $vid == '3') {?>
<?php
$query = "update users set t_2=t_2+'$m_col', m_col='0', m_need='0', m_vid='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'shevchenko' and $vid == '4') {?>
<?php
$query = "update users set t_2=t_2+'$m_col', m_col='0', m_need='0', m_vid='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'shevchenko' and $vid == '5') {?>
<?php
$query = "update users set t_3=t_3+'$m_col', m_col='0', m_need='0', m_vid='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'p_kran' and $vid == '1') {?>
<?php
$query = "update users set t_1=t_1+'$m_col', m_col='0', m_need='0', m_vid='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'p_kran' and $vid == '2') {?>
<?php
$query = "update users set t_1=t_1+'$m_col', m_col='0', m_need='0', m_vid='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'p_kran' and $vid == '3') {?>
<?php
$query = "update users set t_4=t_4+'$m_col', m_col='0', m_need='0', m_vid='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'p_kran' and $vid == '4') {?>
<?php
$query = "update users set t_4=t_4+'$m_col', m_col='0', m_need='0', m_vid='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'p_kran' and $vid == '5') {?>
<?php
$query = "update users set t_5=t_5+'$m_col', m_col='0', m_need='0', m_vid='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'izumrudnoe' and $vid == '1') {?>
<?php
$query = "update users set t_4=t_4+'$m_col', m_col='0', m_need='0', m_vid='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'izumrudnoe' and $vid == '2') {?>
<?php
$query = "update users set t_4=t_4+'$m_col', m_col='0', m_need='0', m_vid='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'izumrudnoe' and $vid == '3') {?>
<?php
$query = "update users set t_4=t_4+'$m_col', m_col='0', m_need='0', m_vid='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'izumrudnoe' and $vid == '4') {?>
<?php
$query = "update users set t_6=t_6+'$m_col', m_col='0', m_need='0', m_vid='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($loc == 'izumrudnoe' and $vid == '5') {?>
<?php
$query = "update users set t_6=t_6+'$m_col', m_col='0', m_need='0', m_vid='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
?>

<script type="text/javascript">
  document.location.href = "zonas.php?v=<?php echo "$vid";?>&c=<?php echo "$m_col";?>&trofi=true";
</script>
</body>
</html>