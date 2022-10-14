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
$tip = $_GET['tip'];
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$lvl = $row_us['lvl'];
$clan = $row_us['clan'];
$prem = $row_us['premium'];
$b_op = '0';
if ($clan != '0') {
$query_clan = "Select * from clans where clan_id = '$clan'  limit 1";
$result_clan = mysqli_query($dbc, $query_clan) or die ('Ошибка передачи запроса к БД');
$row_clan = mysqli_fetch_array($result_clan);
$slava = $row_clan['slava'];
$b_op = ($slava / '500');
$b_op = round("$b_op");
$mentor = $row_clan['mentor'];
$mentor = ($mentor + '100');
}
$b_op = ($b_op + '100');
$regen = $row_us['regen'];
$hp = $row_us['hp'];
$opit = $row_us['opit'];
$lvl = $row_us['lvl'];
$loc = $row_us['loc'];//пистолет
$yron_pp = $row_us['yron_p'];
$yron_pp1 = ($yron_pp * '0.75');
$yron_pp2 = ($yron_pp * '1.25');
$yron_p1 = rand($yron_pp1,$yron_pp2);
$pistol1 = $yron_p1;
$bronya_1 = $row_us['bronya'];

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
$vid = $row_us['m_vid'];
$m_zd = $row_us['m_zd'];
$max_zd = $row_us['max_zd'];
$m_at = $row_us['m_at'];
if ($clan != '0') {
$yron_p1 = ($yron_p1 / '100');
$yron_p1 = ($yron_p1 * $mentor);
$yron_w1 = ($yron_w1 / '100');
$yron_w1 = ($yron_w1 * $mentor);
$bronya_1 = ($bronya_1 / '100');
$bronya_1 = ($bronya_1 * $mentor);
}
$bronya1 = ($bronya_1 / '2');
$yr_pist1 = $yron_p1;
$yr_avt1 = $yron_w1;
if ($prem == '1') {
$yr_pist1 = ($yr_pist1 * '2');
$yr_avt1 = ($yr_avt1 * '2');
}
$yr_pist111 = $yr_pist1;
$yr_avt111 = $yr_avt1;
$yr_pist11 = ($yr_pist1 * '100');
$yr_avt11 = ($yr_avt1 * '100');
$yr_pist11 = round("$yr_pist11");
$yr_avt11 = round("$yr_avt11");
$yr_pist111 = round("$yr_pist111");
$yr_avt111 = round("$yr_avt111");
if ($loc == 'shevchenko' and $vid == '1') {
$yron_m = ('155' * $lvl);
}
if ($loc == 'shevchenko' and $vid == '2') {
$yron_m = ('155' * $lvl);
}
if ($loc == 'shevchenko' and $vid == '3') {
$yron_m = ('115' * $lvl);
}
if ($loc == 'shevchenko' and $vid == '4') {
$yron_m = ('115' * $lvl);
}
if ($loc == 'shevchenko' and $vid == '5') {
$yron_m = ('250' * $lvl);
}
if ($loc == 'p_kran' and $vid == '1') {
$yron_m = ('160' * $lvl);
}
if ($loc == 'p_kran' and $vid == '2') {
$yron_m = ('160' * $lvl);
}
if ($loc == 'p_kran' and $vid == '3') {
$yron_m = ('175' * $lvl);
}
if ($loc == 'p_kran' and $vid == '4') {
$yron_m = ('175' * $lvl);
}
if ($loc == 'p_kran' and $vid == '5') {
$yron_m = ('325' * $lvl);
}
if ($loc == 'izumrudnoe' and $vid == '1') {
$yron_m = ('160' * $lvl);
}
if ($loc == 'izumrudnoe' and $vid == '2') {
$yron_m = ('160' * $lvl);
}
if ($loc == 'izumrudnoe' and $vid == '3') {
$yron_m = ('160' * $lvl);
}
if ($loc == 'izumrudnoe' and $vid == '4') {
$yron_m = ('165' * $lvl);
}
if ($loc == 'izumrudnoe' and $vid == '5') {
$yron_m = ('165' * $lvl);
}
$zash = ($bronya1);
$yron_m = ($yron_m - $zash);
if ($yron_m < '100') {
$yron_m = '100';
}
$hpr1 = ($m_zd - $yr_pist1);
$hpr2 = ($m_zd - $yr_avt1);
if ($prem == '0') {
$yr_pist11 = ($yr_pist11 / '2');
$yr_pist111 = ($yr_pist111 / '2');
$yr_avt11 = ($yr_avt11 / '2');
$yr_avt111 = ($yr_avt111 / '2');
}
if ($prem == '1') {
$yron_m = ($yron_m / '2');
}
$yr_avt111 = (($yr_avt111 / '100') * $b_op);
$yr_pist111 = (($yr_pist111 / '100') * $b_op);
$yr_avt11 = (($yr_avt11 / '100') * $b_op);
$yr_pist11 = (($yr_pist11 / '100') * $b_op);
?>
<?php if ($hp < '1') {?>
  <script type="text/javascript">
  document.location.href = "z_death.php";
  </script>
  <?php
  exit();
}
?>
<?php if ($tip == '1' and $time_pr > $now) {?>
  <script type="text/javascript">
  document.location.href = "zonas.php";
  </script>
  <?php
  exit();
}
?>
<?php if ($tip == '2' and $time_wr > $now) {?>
  <script type="text/javascript">
  document.location.href = "zonas.php";
  </script>
  <?php
  exit();
}
?>
<?php if ($m_at != '1') {?>
  <script type="text/javascript">
  document.location.href = "zonas.php";
  </script>
  <?php
  exit();
}
?>

<?php 
if ($tip == '1') {?>
<?php
$query = "update users set m_zd=m_zd-'$yr_pist1', hp=hp-'$yron_m' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_s = "update users set opit=opit+'$yr_pist111', ko=ko+'$yr_pist11', time_p=NOW() where id = '$user_id' limit 1";
$result_s = mysqli_query($dbc, $query_s) or die ('Ошибка передачи запроса к БД');
$query_s = "update clans set clan_opit=clan_opit+'$yr_pist11' where clan_id = '$clan' limit 1";
$result_s = mysqli_query($dbc, $query_s) or die ('Ошибка передачи запроса к БД');
$opit = ($opit + $yr_pist111);
?>
<?php }
if ($tip == '2') {?>
<?php
$query_q = "update users set m_zd=m_zd-'$yr_avt1', hp=hp-'$yron_m' where id = '$user_id' limit 1";
$result_q = mysqli_query($dbc, $query_q) or die ('Ошибка передачи запроса к БД');
$query_s = "update users set opit=opit+'$yr_avt111', ko=ko+'$yr_avt11', time_w=NOW() where id = '$user_id' limit 1";
$result_s = mysqli_query($dbc, $query_s) or die ('Ошибка передачи запроса к БД');
$query_s = "update clans set clan_opit=clan_opit+'$yr_avt11' where clan_id = '$clan' limit 1";
$result_s = mysqli_query($dbc, $query_s) or die ('Ошибка передачи запроса к БД');
$opit = ($opit + $yr_avt111);
?>
<?php }
?>
<?php 
if ($tip == '1') {?>
<?php if ($hpr1 < '1') {?>
<?php
$query = "update users set m_col=m_col+'1', mon_d='1', m_zd='$max_zd', m_kill=m_kill+'1' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<?php }
if ($tip == '2') {?>
<?php if ($hpr2 < '1') {?>
<?php
$query = "update users set m_col=m_col+'1', mon_d='1', m_zd='$max_zd', m_kill=m_kill+'1' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<?php }
?>
<?php
$lvl3_opit = ($lvl3_opit * '100');
if ($opit > $lvl3_opit and $lvl < '58') {?>
<?php
$query = "update users set lvl=lvl+'1' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<?php if ($tip == '1') {?>
<script type="text/javascript">
  document.location.href = "zonas.php?m=<?php echo "$yron_m";?>&yr=<?php echo "$yr_pist1";?>";
</script>
<?php } else {?>
<script type="text/javascript">
  document.location.href = "zonas.php?m=<?php echo "$yron_m";?>&yr=<?php echo "$yr_avt1";?>";
</script>
<?php }?>
</body>
</html>