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
};
$page_title = 'Прорыв';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$boy = $_GET['at'];
$query_use = "Select * from users where id='$user_id' limit 1";
$result_use = mysqli_query($dbc, $query_use) or die ('Ошибка передачи запроса к БД1');
$row_use = mysqli_fetch_array($result_use);
$hp_use = $row_use['hp'];
$prem = $row_use['premium'];
$max_hp_use = $row_use['max_hp'];
$min_hp = ($max_hp_use * '0.10');
if ($min_hp < '190') {
$min_hp = '190';
}
$lvl_use = $row_use['lvl'];
$clan = $row_use['clan'];
$clan_r = $row_use['clan_rang'];
$g_time = $row_use['gauss_t'];
$g_time1 = strtotime("$g_time");
$g_time2 = ($g_time1 + '3');
$query_bit = "Select * from bitva_o where clan1='$clan' or clan2='$clan' limit 1";
$result_bit = mysqli_query($dbc, $query_bit) or die ('Ошибка передачи запроса к БД2');
$row_bit = mysqli_fetch_array($result_bit);
$clan1 = $row_bit['clan1'];
$clan2 = $row_bit['clan2'];
$gauss1_y = $row_bit['gauss1_y'];
$gauss2_y = $row_bit['gauss2_y'];
$bit_id = $row_bit['bit_id'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$query_3 = "Select * from clans where clan_id='$clan' limit 1";
$result_3 = mysqli_query($dbc, $query_3) or die ('Ошибка передачи запроса к БД3');
$row_3 = mysqli_fetch_array($result_3);
$bg_t = $row_3['bg_time'];
$war_id = $row_3['war_id'];
$war_c = $row_3['war'];
$gauss_time = $row_3['gauss_time'];
$gauss_at = $row_3['gauss_at'];
$gauss = $row_3['gauss'];
$gt1 = strtotime("$gauss_time");
$gt2 = ($gt1 + '150');
$gt3 = ($gt2 - $now);
$gt_lal = ($gt3 - '90');
$g_time3 = ($g_time2 - $now);
$query_31 = "Select * from clans where clan_id='$war_id' limit 1";
$result_31 = mysqli_query($dbc, $query_31) or die ('Ошибка передачи запроса к БД3');
$row_31 = mysqli_fetch_array($result_31);
$gauss31 = $row_31['gauss'];
if ($clan == $clan1) {
$clan3 = $clan1;
$clan4 = $clan2;
$gauss_y = $gauss1_y;
}
if ($clan == $clan2) {
$clan3 = $clan2;
$clan4 = $clan1;
$gauss_y = $gauss2_y;
}
if ($gauss == '0') {
$gauss_yr = '500';
}
if ($gauss == '1') {
$gauss_yr = '3500';
}
if ($gauss == '2') {
$gauss_yr = '6000';
}
if ($gauss == '3') {
$gauss_yr = '9500';
}
if ($gauss == '4') {
$gauss_yr = '13500';
}
if ($gauss == '5') {
$gauss_yr = '17500';
}
if ($gauss == '6') {
$gauss_yr = '22500';
}
if ($gauss == '7') {
$gauss_yr = '29500';
}
if ($gauss == '8') {
$gauss_yr = '35000';
}
if ($gauss == '9') {
$gauss_yr = '40000';
}
if ($gauss == '10') {
$gauss_yr = '45000';
}
if ($gauss == '11') {
$gauss_yr = '50000';
}
if ($gauss == '12') {
$gauss_yr = '55000';
}
if ($gauss == '13') {
$gauss_yr = '75000';
}
if ($gauss == '14') {
$gauss_yr = '105000';
}
if ($gauss == '15') {
$gauss_yr = '150000';
}
if ($gauss == '16') {
$gauss_yr = '200000';
}
if ($gauss == '17') {
$gauss_yr = '250000';
}
if ($prem == '1') {
$gauss_yr = ($gauss_yr * '2');
}
if ($user_id == '10706' or $user_id == '153') {
$gauss_yr = ($gauss_yr * '2');
}
$gauss_yr = (($gauss_yr / '100') * ('100' + $lvl_use));
if ($hp < $min_hp) {
$gauss_yr = '0';
}
?>
<?php
if (empty($war_c)) {
$query = "update clans set gauss_at='0' where clan_id = '$clan' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД8');
}
?>
<?php if ($gt3 > '90') {?><p class="net">На сборы дано 60 секунд. Осталось еще <?php echo "$gt_lal";?>.</p> <p style="border-top: solid 1px #444e4f"></p>
<?php } else {?>
<div id="main">
<div class="stats">
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Прорыв</p>
</div>
<?php if ($war_c != '0' and $clan != '0' and $gauss_at != '0') {?>
<?php if ($boy == '1' and $g_time3 < '1' and $clan == $clan1 and $gt3 < ('90' + $bg_t)) {?>
<?php
$query = "update bitva_o set clan1_y=clan1_y+'$gauss_yr', gauss1_y=gauss1_y+'$gauss_yr' where bit_id = '$bit_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД4');
$query = "update users set bit_y=bit_y+'$gauss_yr', gauss_t=NOW() where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД5');
?>
<script type="text/javascript">
  document.location.href = "gauss.php";
</script>
<?php }?>
<?php if ($boy == '1' and $g_time3 < '1' and $clan == $clan2 and $gt3 < ('90' + $bg_t)) {?>
<?php
$query = "update bitva_o set clan2_y=clan2_y+'$gauss_yr', gauss2_y=gauss2_y+'$gauss_yr' where bit_id = '$bit_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД6');
$query = "update users set bit_y=bit_y+'$gauss_yr', gauss_t=NOW() where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД7');
?>
<script type="text/javascript">
  document.location.href = "gauss.php";
</script>
<?php }?>
<?php
$gt3 = ($gt3 + $bg_t);
if ($clan == $clan1 and $gt3 < '1') {?>
<?php
$query2 = "update bitva_o set gauss_time1=NOW() where clan1 = '$clan' limit 1";
$result2 = mysqli_query($dbc, $query2) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<?php
if ($clan == $clan2 and $gt3 < '1') {?>
<?php
$query3 = "update bitva_o set gauss_time2=NOW() where clan2 = '$clan' limit 1";
$result3 = mysqli_query($dbc, $query3) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<?php if ($gt3 < '1') {?>
<?php
$query = "update clans set gauss_at='0' where clan_id = '$clan' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД8');
?>
<?php
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '$clan', 'Ваш отряд успешно прорвал защиту противника. Нанесенный урон: $gauss_y.', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД9');
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '$clan4', 'Вражеский отряд успешно прорвал вашу защиту. Нанесенный урон: $gauss_y.', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД10');
$query = "update users set clan_mes=clan_mes+'1' where clan = '$clan' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД11');
$query = "update users set clan_mes=clan_mes+'1' where clan = '$clan4' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД12');
$query = "update bitva_o set gauss1_y='0', gauss2_y='0' where bit_id = '$bit_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД13');
?>
<script type="text/javascript">
  document.location.href = "bitva.php";
</script>
<?php }
?>
<p class="dan">Прорыв закончится через <?php echo "$gt3";?> секунд.</p>
<?php if ($hp > $min_hp) {?>
<p class="podmenu">Мощность оружия:</p>
<p class="<?php if ($prem == '1') {?>gold<?php } else {?>blue<?php }?>"><?php echo "$gauss_yr";?> <span class="bonus">(+<?php echo "$lvl_use";?>%)</span></p>
<?php } else {?><p class="red">Ваше здоровье меньше <?php echo "$min_hp";?></p>
<a href="apt.php" class="menu"><img src="img/ico/apte4ka.png"/> Использовать аптечку</a><?php }?>
<p class="podmenu">Общий урон:</p>
<p class="blue"><?php echo "$gauss_y";?></p>
<p style="border-top: dashed 1px #444e4f"></p>
<center><a href="gauss.php" class="menu1"><img src="img/icon-refresh.png"/></a></center>
<p style="border-top: dashed 1px #444e4f"></p>
<?php if ($g_time3 < '1') {?>
<center><p><a href="gauss.php?at=1" class="menu"><img src="img/ico/ohotniki.gif" width="12" height="12"/> Стрелять</a></p></center>
<?php } else {?>
<center><p class="red">Замена аккумулятора. Еще <?php echo "$g_time3";?> секунд</p></center>
<?php }?>
<p style="border-top: dashed 1px #444e4f"></p>
<?php } else {?>
<script type="text/javascript">
  document.location.href = "bitva.php";
</script>
<?php }?>
</div>
<?php }?>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>