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
$user_id122 = $_SESSION['id'];
$query123 = "Select opit, lvl, clan from users where id = '$user_id122' limit 1";
$result123 = mysqli_query($dbc, $query123) or die ('Ошибка передачи запроса к БД');
$row123 = mysqli_fetch_array($result123);
$clan = $row123['clan'];
$opit123 = $row123['opit'];
$opit123 = ( $opit123 / '100');
$lvl123 = $row123['lvl'];
$query_lvl1 = "Select opit from opit where opit_id='$lvl123' limit 1";
$result_lvl1 = mysqli_query($dbc, $query_lvl1) or die ('Ошибка передачи запроса к БД');
$row_lvl1 = mysqli_fetch_array($result_lvl1);
$lvl1_opit = $row_lvl1['opit'];
$lvl3_opit = $row_lvl1['opit'];
$query_lvl2 = "Select opit from opit where lvl='$lvl123' limit 1";
$result_lvl2 = mysqli_query($dbc, $query_lvl2) or die ('Ошибка передачи запроса к БД');
$row_lvl2 = mysqli_fetch_array($result_lvl2);
$lvl2_opit = $row_lvl2['opit'];
$opit123 = ( $opit123 - $lvl2_opit );
$lvl1_opit = ( $lvl1_opit - $lvl2_opit );
$proc = (( '100' / $lvl1_opit ) * $opit123 );
$polos = (( '400' / '100') * $proc );
?>
<?php
$user_id = $_SESSION['id'];
$vrag_id = $_GET['id'];
$tip = $_GET['tip'];
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$lvl = $row_us['lvl'];
$opit = $row_us['opit'];
$arena1 = $row_us['arena'];//пистолет
$yron_pp = $row_us['yron_p'];
$yron_pp1 = ($yron_pp * '0.75');
$yron_pp2 = ($yron_pp * '1.25');
$yron_p1 = rand($yron_pp1,$yron_pp2);
$pistol1 = $yron_p1;
$bronya_1 = $row_us['bronya'];
$bronya1 = ($bronya_1 / '2');//автомат
$yron_ww = $row_us['yron_w'];
$yron_ww1 = ($yron_ww * '0.75');
$yron_ww2 = ($yron_ww * '1.25');
$yron_w1 = rand($yron_ww1,$yron_ww2);
$avtomat1 = $yron_w1;
$hp_us = $row_us['hp'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$speed_p = $row_us['speed_p'];
$time_p = $row_us['time_p'];
$time_p = strtotime("$time_p");
$time_pr = ($time_p + $speed_p);
$speed_w = $row_us['speed_w'];
$time_w = $row_us['time_w'];
$time_w = strtotime("$time_w");
$time_wr = ($time_w + $speed_w);
$query_us1 = "Select * from users where  id = '$vrag_id'  limit 1";
$result_us1 = mysqli_query($dbc, $query_us1) or die ('Ошибка передачи запроса к БД');
$row_us1 = mysqli_fetch_array($result_us1);
$arena2 = $row_us1['arena1'];//пистолет
$yron_p2 = $row_us1['yron_p'];
$pistol2 = $yron_p2;
$bronya_2 = $row_us1['bronya'];
$bronya2 = ($bronya_2 / '2');//автомат
$yron_w2 = $row_us1['yron_w'];
$avtomat2 = $yron_w2;
$hp_v = $row_us1['hp'];
$yr_pist1 = ($pistol1 - $bronya2);
$yr_pist2 = ($pistol2 - $bronya1);
if ($yr_pist1 < 1) {
$yr_pist1 = '0';
}
if ($yr_pist1 > $hp_v) {
$yr_pist1 = $hp_v;
}
if ($hp_v == '0') {
$yr_pist1 = '0';
}
if ($yr_pist2 < 1) {
$yr_pist2 = '0';
}
if ($yr_pist2 > $hp_us) {
$yr_pist2 = $hp_us;
}
if ($hp_us == '0') {
$yr_pist2 = '0';
}
$yr_avt1 = ($avtomat1 - $bronya2);
$yr_avt2 = ($avtomat2 - $bronya1);
if ($yr_avt1 < 1) {
$yr_avt1 = '0';
}
if ($yr_avt1 > $hp_v) {
$yr_avt1 = $hp_v;
}
if ($hp_v == '0') {
$yr_avt1 = '0';
}
if ($yr_avt2 < 1) {
$yr_avt2 = '0';
}
if ($yr_avt2 > $hp_us) {
$yr_avt2 = $hp_us;
}
if ($hp_us == '0') {
$yr_avt2 = '0';
}
$query_log = "Select * from arena_log where  user_id = '$user_id' order by time desc limit 1";
$result_log = mysqli_query($dbc, $query_us1) or die ('Ошибка передачи запроса к БД');
$row_log = mysqli_fetch_array($result_us1);
$vrag_id1 = $row_log['vrag_id'];
if($vrag_id == '10706') {
if ($yr_avt2 < '1') {
$yr_avt2 = '100';
}
if ($yr_pist2 < '1') {
$yr_pist2 = '100';
}
$yr_avt2 = ($yr_avt2 * '10');
$yr_pist2 = ($yr_pist2 * '10');
}
if($user_id == '10706') {
if ($yr_avt1 < '1') {
$yr_avt1 = '100';
}
if ($yr_pist1 < '1') {
$yr_pist1 = '100';
}
$yr_avt1 = ($yr_avt1 * '10');
$yr_pist1 = ($yr_pist1 * '10');
}
?>
<?php if ($tip == '1' and $time_pr > $now) {?>
  <script type="text/javascript">
  document.location.href = "arena2.php";
  </script>
  <?php
  exit();
}
?>
<?php if ($tip == '2' and $time_wr > $now) {?>
  <script type="text/javascript">
  document.location.href = "arena2.php";
  </script>
  <?php
  exit();
}
?>
<?php if ($arena1 != '1' or $arena2 != '1') {?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
  <?php
  exit();
}
?>
<?php 
if ($tip == '1') {?>
<?php
$query = "update users set hp=hp-'$yr_pist1' where id = '$vrag_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_q = "update users set hp=hp-'$yr_pist2' where id = '$user_id' limit 1";
$result_q = mysqli_query($dbc, $query_q) or die ('Ошибка передачи запроса к БД');
$query_s = "update users set opit=opit+'$yr_pist1', time_p=NOW() where id = '$user_id' limit 1";
$result_s = mysqli_query($dbc, $query_s) or die ('Ошибка передачи запроса к БД');
$query_ss = "update arena_log set yron1=yron1+'$yr_pist1', yron2=yron2+'$yr_pist2' where user_id = '$user_id' order by time desc limit 1";
$result_ss = mysqli_query($dbc, $query_ss) or die ('Ошибка передачи запроса к БД');
$opit = ($opit + $yr_pist1);
?>
<?php }
if ($tip == '2') {?>
<?php
$query = "update users set hp=hp-'$yr_avt1' where id = '$vrag_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_q = "update users set hp=hp-'$yr_avt2' where id = '$user_id' limit 1";
$result_q = mysqli_query($dbc, $query_q) or die ('Ошибка передачи запроса к БД');
$query_s = "update users set opit=opit+'$yr_avt1', time_w=NOW() where id = '$user_id' limit 1";
$result_s = mysqli_query($dbc, $query_s) or die ('Ошибка передачи запроса к БД');
$query_ss = "update arena_log set yron1=yron1+'$yr_avt1', yron2=yron2+'$yr_avt2' where user_id = '$user_id' order by time desc limit 1";
$result_ss = mysqli_query($dbc, $query_ss) or die ('Ошибка передачи запроса к БД');
$opit = ($opit + $yr_avt1);
?>
<?php }
?>
<?php
$lvl3_opit = ($lvl3_opit * '100');
if ($opit > $lvl3_opit and $lvl < '50') {?>
<?php
$query = "update users set lvl=lvl+'1' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>

<script type="text/javascript">
  document.location.href = "arena2.php";
</script>
</body>
</html>