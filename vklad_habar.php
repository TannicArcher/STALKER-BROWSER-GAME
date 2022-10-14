<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick']))) {
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
$c_id = htmlspecialchars($_GET['c_id']);
$c_id = mysqli_real_escape_string($dbc, trim($c_id));
$v_habar = mysqli_real_escape_string($dbc, trim($_POST['habar']));
$v_habar = round("$v_habar");
$query_us = "Select * from users where id = '$user_id' limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$nick = $row_us['nick'];
$lvl = $row_us['lvl'];
if ($lvl < '10') {
$lvl_u = ($lvl * '10000');
}
if ($lvl < '20' and $lvl > '9') {
$lvl_u = ($lvl * '300000');
}
if ($lvl < '30' and $lvl > '19') {
$lvl_u = ($lvl * '600000');
}
if ($lvl < '40' and $lvl > '29') {
$lvl_u = ($lvl * '1500000');
}
if ($lvl < '45' and $lvl > '39') {
$lvl_u = ($lvl * '3000000');
}
if ($lvl < '50' and $lvl > '44') {
$lvl_u = ($lvl * '5000000');
}
if ($lvl > '49') {
$lvl_u = ($lvl * '10000000');
}
$vkl = '0';
	  $query_us00 = "Select * from clan_log where user_id = '$user_id' and time > NOW() - ('240000') and tip = '2' and why = '1' order by time desc";
      $result_us00 = mysqli_query($dbc, $query_us00) or die ('Ошибка передачи запроса к БД');
	  while ($row_us00 = mysqli_fetch_array($result_us00)) {
$num_db = $row_us00['num'];
?>
<?php
$vkl = ($vkl + $num_db);
?>
<?php 
}
$vkl = ($vkl + $v_habar);
?>
<?php
$habar = $row_us['habar'];
$money = $row_us['money'];
$clan = $row_us['clan'];
$id_u = $row_us['id'];
$query_clan = "Select * from clans where clan_id = '$c_id' limit 1";
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
if ($vkl > $lvl_u) {?>
<script type="text/javascript">
document.location.href = "csklad.php?err=5";
</script>
<?php
exit();
}
?>
<?php
if ($habar < $v_habar) {?>
<script type="text/javascript">
document.location.href = "csklad.php?err=6";
</script>
<?php
exit();
}
?>
<?php
$prover = ($habar - $v_habar);
if ($prover < '0') {
$on = '0';
}
?>
<?php
if ($v_habar < '1') {
$on = '0';
}
?>
<?php
if ($habar < $v_habar) {
$on = '0';
}
?>
<?php if ($on == '1') {?>
<?php
$query = "update users set habar=habar-'$v_habar', c_hab=c_hab+'$v_habar' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "update clans set clan_habar=clan_habar+'$v_habar' where clan_id = '$c_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
$query_add_log = "insert into clan_log (`time`, `clan_id`, `user_id`, `tip`, `why`, `num`) values ( NOW(), '$clan', '$id_u', '2', '1', '$v_habar')";
$result_add_log = mysqli_query($dbc, $query_add_log) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<script type="text/javascript">
document.location.href = "csklad.php?c_id=<?php echo "$c_id";?>";
</script>
</body>
</html>