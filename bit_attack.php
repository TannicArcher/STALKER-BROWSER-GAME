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
$vrag_id = $_GET['id'];
$tip = $_GET['tip'];
$cl = $_GET['cl'];
$query_us = "Select * from users where id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$clan1 = $row_us['clan'];//пистолет
$yron_pp = $row_us['yron_p'];
if ($user_id == '10706') {
$yron_pp = ($yron_pp * '5');
}
if ($vrag_id == '10706') {
$yron_pp = ($yron_pp / '5');
}
$yron_pp1 = ($yron_pp * '0.75');
$yron_pp2 = ($yron_pp * '1.25');
$yron_p1 = rand($yron_pp1,$yron_pp2);
$pistol1 = $yron_p1;
$bronya_1 = $row_us['bronya'];
$bronya1 = ($bronya_1 / '2');//автомат
$yron_ww = $row_us['yron_w'];
if ($user_id == '10706') {
$yron_ww = ($yron_ww * '10');
}
if ($vrag_id == '10706') {
$yron_ww = ($yron_ww / '10');
}
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
$clan2 = $row_us1['clan'];//пистолет
$yron_p2 = $row_us1['yron_p'];
$min_yron1 = ($yron_p2 / '1,5');
$pistol2 = $yron_p2;
$bronya_2 = $row_us1['bronya'];
$bronya2 = ($bronya_2 / '2');//автомат
$hp_v = $row_us1['hp'];
$query_cl = "Select * from clans where clan_id = '$clan1'  limit 1";
$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
$row_cl = mysqli_fetch_array($result_cl);
$war1 = $row_cl['war'];
$ataka = $row_cl['oruzhie'];
$query_cl1 = "Select * from clans where clan_id = '$clan2'  limit 1";
$result_cl1 = mysqli_query($dbc, $query_cl1) or die ('Ошибка передачи запроса к БД');
$row_cl1 = mysqli_fetch_array($result_cl1);
$war2 = $row_cl1['war'];
$zash = $row_cl1['bronya'];
$yr_pist1 = ($pistol1 - $bronya2);
if ($yr_pist1 < 1) {
$yr_pist1 = '0';
}
if ($yr_pist1 > $hp_v) {
$yr_pist1 = $hp_v;
}
if ($hp_us == '0') {
$yr_pist1 = '0';
}
$yr_avt1 = ($avtomat1 - $bronya2);
if ($yr_avt1 < 2) {
$yr_avt1 = '1';
}
if ($yr_avt1 > $hp_v) {
$yr_avt1 = $hp_v;
}
if ($hp_us == '0') {
$yr_avt1 = '0';
}
$barer1 = $zash;
$atak1 = $ataka;
if ($yr_pist1 > '0') {
$pr_p1 = ($yr_pist1 / '100');
$prrr = ($atak1 - $barer1);
$yr_pist1 = ($pr_p1 * ('100' + $prrr));
$at1 = ($pr_p1 * $atak1);
$br_1 = ($pr_p1 * $barer1);
}
if ($yr_avt1 > '0') {
$pr_w1 = ($yr_avt1 / '100');
$prr = ($atak1 - $barer1);
$yr_avt1 = ($pr_w1 * ('100' + $prr));
$at2 = ($pr_w1 * $atak1);
$br_2 = ($pr_w1 * $barer1);
}
if ($hp_us < '1') {
$yr_pist1 = '0';
$yr_avt1 = '0';
}
if ($yr_pist1 < '1') {
$yr_pist1 = '0';
}
if ($yr_avt1 < '2') {
$yr_avt1 = '1';
}
if ($hp_us < '1') {
$yr_avt1 = '0';
$yr_pist1 = '0';
}

?>
<?php if ($tip == '1' and $time_pr > $now) {?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
  <?php
  exit();
}
?>
<?php if ($tip == '2' and $time_wr > $now) {?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
  <?php
  exit();
}
?>
<?php if ($war1 != '1' or $war2 != '1') {?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
  <?php
  exit();
}
?>
<?php 
if ($tip == '1' and $cl == '1') {?>
<?php
$query = "update users set hp=hp-'$yr_pist1', bit_l=bit_l+'$yr_pist1' where id = '$vrag_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_s = "update users set bit_y=bit_y+'$yr_pist1', opit=opit+'$yr_pist1', time_p=NOW() where id = '$user_id' limit 1";
$result_s = mysqli_query($dbc, $query_s) or die ('Ошибка передачи запроса к БД');
$query_ss = "update bitva_o set clan2_y=clan2_y+'$yr_pist1' where clan2 = '$clan1' limit 1";
$result_ss = mysqli_query($dbc, $query_ss) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($tip == '1' and $cl == '2') {?>
<?php
$query = "update users set hp=hp-'$yr_pist1', bit_l=bit_l+'$yr_pist1' where id = '$vrag_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_s = "update users set bit_y=bit_y+'$yr_pist1', opit=opit+'$yr_pist1', time_p=NOW() where id = '$user_id' limit 1";
$result_s = mysqli_query($dbc, $query_s) or die ('Ошибка передачи запроса к БД');
$query_ss = "update bitva_o set clan1_y=clan1_y+'$yr_pist1' where clan1 = '$clan1' limit 1";
$result_ss = mysqli_query($dbc, $query_ss) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($tip == '2' and $cl == '1') {?>
<?php
$query = "update users set hp=hp-'$yr_avt1', bit_l=bit_l+'$yr_avt1' where id = '$vrag_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_s = "update users set bit_y=bit_y+'$yr_avt1', opit=opit+'$yr_avt1', time_w=NOW() where id = '$user_id' limit 1";
$result_s = mysqli_query($dbc, $query_s) or die ('Ошибка передачи запроса к БД');
$query_ss = "update bitva_o set clan2_y=clan2_y+'$yr_avt1' where clan2 = '$clan1' limit 1";
$result_ss = mysqli_query($dbc, $query_ss) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($tip == '2' and $cl == '2') {?>
<?php
$query = "update users set hp=hp-'$yr_avt1', bit_l=bit_l+'$yr_avt1' where id = '$vrag_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_s = "update users set bit_y=bit_y+'$yr_avt1', opit=opit+'$yr_avt1', time_w=NOW() where id = '$user_id' limit 1";
$result_s = mysqli_query($dbc, $query_s) or die ('Ошибка передачи запроса к БД');
$query_ss = "update bitva_o set clan1_y=clan1_y+'$yr_avt1' where clan1 = '$clan1' limit 1";
$result_ss = mysqli_query($dbc, $query_ss) or die ('Ошибка передачи запроса к БД');
?>
<?php }
?>

<?php if ($tip == '1') {?>
<script type="text/javascript">
  document.location.href = "bitva.php?yron=<?php echo "$yr_pist1";?>&at=<?php echo "$at1";?>&br=<?php echo "$br_1";?>";
</script>
<?php } else {?>
<script type="text/javascript">
  document.location.href = "bitva.php?yron=<?php echo "$yr_avt1";?>&at=<?php echo "$at2";?>&br=<?php echo "$br_2";?>";
</script><?php }?>
</body>
</html>