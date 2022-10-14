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
$c_id = $_GET['c_id'];
$c_id = mysqli_real_escape_string($dbc, trim($c_id));
$v_money = $_POST['rub'];
$v_money = mysqli_real_escape_string($dbc, trim($v_money));
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$habar = $row_us['habar'];
$money = $row_us['money'];
$clan = $row_us['clan'];
$id_u = $row_us['id'];
$query_clan = "Select * from clans where  clan_id = '$c_id'  limit 1";
$result_clan = mysqli_query($dbc, $query_clan) or die ('Ошибка передачи запроса к БД');
$row_clan = mysqli_fetch_array($result_clan);
$clan_habar = $row_clan['clan_habar'];
$clan_money = $row_clan['clan_money'];
$on = '1';
?>
<?php
if ($clan != $c_id) {?>
<script type="text/javascript">
document.location.href = "csklad.php?c_id=<?php echo "$c_id";?>";
</script>
<?php
exit();
}
?>
<?php
$prover = ($money - $v_money);
if ($prover < '0') {
$on = '0';
}
?>
<?php
if ($v_money < '1') {
$on = '0';
}
?>
<?php
if ($money < $v_money) {
$on = '0';
}
?>
<?php if ($on == '1') {?>
<?php
$query = "update users set money=money-'$v_money', c_mon=c_mon+'$v_money' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "update clans set clan_money=clan_money+'$v_money' where clan_id = '$c_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
$query_add_log = "insert into clan_log (`time`, `clan_id`, `user_id`, `tip`, `why`, `num`) values ( NOW(), '$clan', '$id_u', '2', '2', '$v_money')";
$result_add_log = mysqli_query($dbc, $query_add_log) or die ('Ошибка передачи запроса к БД');
?>
<?php
}
?>
<script type="text/javascript">
  document.location.href = "csklad.php?c_id=<?php echo "$c_id";?>";
</script>
</body>
</html>