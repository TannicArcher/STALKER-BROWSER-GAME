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
$query_us = "Select clan, clan_rang, money, loto_time, user from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$admin = $row_us['admin'];
$user = $row_us['user'];
$clan1 = $row_us['clan'];
$clan_rang = $row_us['clan_rang'];
$clan2 = $c_id;
$query_usg = "Select id from users where clan='$clan2' and clan_rang='9'  limit 1";
$result_usg = mysqli_query($dbc, $query_usg) or die ('Ошибка передачи запроса к БД');
$row_usg = mysqli_fetch_array($result_usg);
$id_2 = $row_usg['id'];
$query_cl = "Select war, clan_habar, clan_money, name, time_war from clans where clan_id = '$clan1'  limit 1";
$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
$row_cl = mysqli_fetch_array($result_cl);
$clan1_w = $row_cl['war'];
$name1 = $row_cl['name'];
$h_clan1 = $row_cl['clan_habar'];
$hab_clan1 = ($h_clan1 / '2');
$m_clan1 = $row_cl['clan_money'];
$mon_clan1 = ($m_clan1 / '3');
$time_war1 = $row_cl['time_war'];
$time_war1 = strtotime("$time_war1");
$query_num2 = "Select id from users where clan='$clan1' " ;
$result_num2 = mysqli_query($dbc, $query_num2) or die ('Ошибка передачи запроса к БД');
$sostav1 = mysqli_num_rows($result_num2); 
$query_cl1 = "Select war, clan_habar, clan_money, time_war, name from clans where clan_id = '$clan2'  limit 1";
$result_cl1 = mysqli_query($dbc, $query_cl1) or die ('Ошибка передачи запроса к БД');
$row_cl1 = mysqli_fetch_array($result_cl1);
$clan2_w = $row_cl1['war'];
$name2 = $row_cl1['name'];
$h_clan2 = $row_cl1['clan_habar'];
$hab_clan2 = ($h_clan2 / '2');
$m_clan2 = $row_cl1['clan_money'];
$mon_clan2 = ($m_clan2 / '3');
$query_num3 = "Select id from users where clan='$clan2' " ;
$result_num3 = mysqli_query($dbc, $query_num3) or die ('Ошибка передачи запроса к БД');
$sostav2 = mysqli_num_rows($result_num3); 
$time_war2 = $row_cl1['time_war'];
$time_war2 = strtotime("$time_war2");
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$time_war1q = ($time_war1 + '600');
$time_war2q = ($time_war2 + '600');
$time_q1 = ($time_war1q - $now);
$time_q2 = ($time_war2q - $now);
$query_num = "Select id from users where hp>'0' and clan='$clan2' and last_active > NOW()-(1000) " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
$sost1 = mysqli_num_rows($result_num); 
?>
<?php if ($clan1_w == '1' or $clan2_w == '1') {?>
  <script type="text/javascript">
  document.location.href = "help.php?help=bitva";
  </script>
<?php
exit();
}
?>
<?php
$query_add_ch = "insert into bitva_o (`time`, `clan1`, `clan2`, `clan1_y`, `clan2_y`, `hab_clan1`, `hab_clan2`, `mon_clan1`, `mon_clan2`) values (NOW(), '$clan1', '$clan2', '0', '0', '$hab_clan1', '$hab_clan2', '$mon_clan1', '$mon_clan2')";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "update clans set war='1', war_id='$clan2', time_war=NOW() where clan_id = '$clan1' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query1 = "update clans set war='1', war_id='$clan1', time_war=NOW() where clan_id = '$clan2' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '$clan2', 'На ваш отряд напал отряд $name1 ', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '$clan1', 'Ваш отряд напал на отряд $name2 ', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "update users set clan_mes=clan_mes+'1' where clan = '$clan1' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "update users set clan_mes=clan_mes+'1' where clan = '$clan2' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<script type="text/javascript">
  document.location.href = "bitva.php";
</script>
</body>
</html>