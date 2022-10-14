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
$page_title = 'Союзная битва';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$yron = $_GET['yron'];
$err = $_GET['err'];
$at0 = $_GET['at'];
$br0 = $_GET['br'];
$query = "update users set location = 'bitva_o' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_use = "Select * from users where id='$user_id' limit 1";
$result_use = mysqli_query($dbc, $query_use) or die ('Ошибка передачи запроса к БД');
$row_use = mysqli_fetch_array($result_use);
$clan = $row_use['clan'];
$clan_r = $row_use['clan_rang'];
$query_bit = "Select * from bitva_o where clan3='$clan' or clan4='$clan' limit 1";
$result_bit = mysqli_query($dbc, $query_bit) or die ('Ошибка передачи запроса к БД');
$row_bit = mysqli_fetch_array($result_bit);
$n_b = mysqli_num_rows($result_bit);
$clan1 = $row_bit['clan1'];
$clan2 = $row_bit['clan2'];
$clan3 = $row_bit['clan3'];
$clan4 = $row_bit['clan4'];
$query_b10 = "Select * from users where clan='$clan1' order by bit_y desc limit 1";
$result_b10 = mysqli_query($dbc, $query_b10) or die ('Ошибка передачи запроса к БД');
$row_b10 = mysqli_fetch_array($result_b10);
$id_b101 = $row_b10['id'];
$nick_b101 = $row_b10['nick'];
$query_b11 = "Select * from users where clan='$clan2' order by bit_y desc limit 1";
$result_b11 = mysqli_query($dbc, $query_b11) or die ('Ошибка передачи запроса к БД');
$row_b11 = mysqli_fetch_array($result_b11);
$id_b102 = $row_b11['id'];
$nick_b102 = $row_b11['nick'];
$clan1_y = $row_bit['clan1_y'];
$clan2_y = $row_bit['clan2_y'];
$hab_clan1 = $row_bit['hab_clan1'];
$mon_clan1 = $row_bit['mon_clan1'];
$hab_clan2 = $row_bit['hab_clan2'];
$mon_clan2 = $row_bit['mon_clan2'];
$time_bitva = $row_bit['time'];
$time_bitva = strtotime("$time_bitva");
$now = (date("Y-m-d H:i:s"));
$now1 = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$time_bittva = ($time_bitva + '1800');
$time_b = ($time_bittva - $now);
$time_llast = ($time_bitva + '12600');
$time_asus = ($time_llast - $now);
if ($clan == $clan3) {
$gauss_time = $row_bit['gauss_time1'];
}
if ($clan == $clan4) {
$gauss_time = $row_bit['gauss_time2'];
}

$query_1 = "Select * from clans where clan_id='$clan1' limit 1";
$result_1 = mysqli_query($dbc, $query_1) or die ('Ошибка передачи запроса к БД');
$row_1 = mysqli_fetch_array($result_1);
$clan1_n = $row_1['name'];
$ata1 = $row_1['oruzhie'];
$bro1 = $row_1['bronya'];
$gruppa1 = $row_1['gruppa'];
$query_2 = "Select * from clans where clan_id='$clan2' limit 1";
$result_2 = mysqli_query($dbc, $query_2) or die ('Ошибка передачи запроса к БД');
$row_2 = mysqli_fetch_array($result_2);
$clan2_n = $row_2['name'];
$ata2 = $row_2['oruzhie'];
$bro2 = $row_2['bronya'];
$gruppa2 = $row_2['gruppa'];
$query_2p = "Select * from clans where clan_id='$clan3' limit 1";
$result_2p = mysqli_query($dbc, $query_2p) or die ('Ошибка передачи запроса к БД');
$row_2p = mysqli_fetch_array($result_2p);
$clan3_n = $row_2p['name'];
$gruppa3 = $row_2p['gruppa'];
$query_21p = "Select * from clans where clan_id='$clan4' limit 1";
$result_21p = mysqli_query($dbc, $query_21p) or die ('Ошибка передачи запроса к БД');
$row_21p = mysqli_fetch_array($result_21p);
$clan4_n = $row_21p['name'];
$gruppa4 = $row_21p['gruppa'];
$h_clan1 = $row_1['clan_habar'];
$hab_clan1 = ($h_clan1 / '2');
$m_clan1 = $row_1['clan_money'];
$mon_clan1 = ($m_clan1 / '3');
$h_clan2 = $row_2['clan_habar'];
$hab_clan2 = ($h_clan2 / '2');
$m_clan2 = $row_2['clan_money'];
$mon_clan2 = ($m_clan2 / '3');
$hab_clan1 = round("$hab_clan1");
$hab_clan2 = round("$hab_clan2");
$mon_clan1 = round("$mon_clan1");
$mon_clan2 = round("$mon_clan2");
$query_3 = "Select * from clans where clan_id='$clan' limit 1";
$result_3 = mysqli_query($dbc, $query_3) or die ('Ошибка передачи запроса к БД');
$row_3 = mysqli_fetch_array($result_3);
$minus_time = $row_3['minus_time'];
$war_c = $row_3['war'];
$time_psi = $row_3['time_psi'];
$time_psi = strtotime("$time_psi");
$time_psi = ($time_psi + '1800');
$time11 = ($time_psi - $now);
$speed_p = $row_use['speed_p'];
$time_p = $row_use['time_p'];
$time_p = strtotime("$time_p");
$time_pr = ($time_p + $speed_p);
$speed_w = $row_use['speed_w'];
$time_w = $row_use['time_w'];
$time_w = strtotime("$time_w");
$time_wr = ($time_w + $speed_w);
if ($clan == $clan3) {
$gauss = $row_1['gauss'];
}
if ($clan == $clan4) {
$gauss = $row_2['gauss'];
}
if ($clan == $clan3) {
$gauss_at = $row_1['gauss_at'];
}
if ($clan == $clan4) {
$gauss_at = $row_2['gauss_at'];
}
$rating1 = ($clan1_y - $clan2_y);
if ($rating1 < '1') {
$rating1 = '0';
}
$rating2 = ($clan2_y - $clan1_y);
if ($rating2 < '1') {
$rating2 = '0';
}
$minn_time = ($minus_time * '60');
$minn_time = ('3600' - $minn_time);
$gt = strtotime("$gauss_time");
$gt = ($gt + $minn_time);
$nu_da = ($gt - $now);
$query_us9 = "Select * from users where clan='$clan1' and clan_rang='9' limit 1";
$result_us9 = mysqli_query($dbc, $query_us9) or die ('Ошибка передачи запроса к БД');
$row_us9 = mysqli_fetch_array($result_us9);
$lider1 = $row_us9['id'];
$query_us99 = "Select * from users where clan='$clan2' and clan_rang='9' limit 1";
$result_us99 = mysqli_query($dbc, $query_us99) or die ('Ошибка передачи запроса к БД');
$row_us99 = mysqli_fetch_array($result_us99);
$lider2 = $row_us99['id'];
$time_apt = $row_use['time_apt'];
$time_apt = strtotime("$time_apt");
$time_apte = ($time_apt + '30');
$time_aptechka = ($time_apte - $now);
?>
<?php
$query_num2 = "Select id from users where clan='$clan1' " ;
$result_num2 = mysqli_query($dbc, $query_num2) or die ('Ошибка передачи запроса к БД');
$sosta1 = mysqli_num_rows($result_num2);
$query_num21 = "Select id from users where clan='$clan2' " ;
$result_num21 = mysqli_query($dbc, $query_num21) or die ('Ошибка передачи запроса к БД');
$sosta2 = mysqli_num_rows($result_num21);
?>
<?php
$query_us = "Select * from users where clan = '$clan1' order by slava DESC";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
while ($row_us = mysqli_fetch_array($result_us)) {
$ssq1 = '0';

$query_sub = "Select * from users where clan = '$clan1' order by lvl desc";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$slava11 = $row_sub['slava'];
?>
<?php
$slava_cool1 = ($slava11 * '0.025');
$ssq1 = ($ssq1 + $slava_cool1);
?>
<?php 
}
}
$minus_slava1 = ($ssq1 / $sosta2);
$minus_slava1 = round("$minus_slava1");
?>
<?php
$query_us = "Select * from users where clan = '$clan2' order by slava DESC";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
while ($row_us = mysqli_fetch_array($result_us)) {
$ssq2 = '0';

$query_sub = "Select * from users where clan = '$clan2' order by lvl desc";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$slava12 = $row_sub['slava'];
?>
<?php
$slava_cool2 = ($slava12 * '0.025');
$ssq2 = ($ssq2 + $slava_cool2);
?>
<?php 
}
}
$minus_slava2 = ($ssq2 / $sosta1);
$minus_slava2 = round("$minus_slava2");
?>

<?php if ($time_b > '0') {?><p class="net">Битва между отрядами <a class="white" href="company.php?company_id=<?php echo "$clan1";?>"><?php echo "$clan1_n";?></a> и <a class="white" href="company.php?company_id=<?php echo "$clan2";?>"><?php echo "$clan2_n";?></a> начнётся через <?php
$timeb = $time_b;
if ($timeb < '60') {?><?php echo "$timeb";?> секунд<?php }
if ($timeb > '59' and $timeb < '120') {?>1 минуту<?php }
if ($timeb > '119' and $timeb < '180') {?>2 минуты<?php }
if ($timeb > '179' and $timeb < '240') {?>3 минуты<?php }
if ($timeb > '239' and $timeb < '300') {?>4 минуты<?php }
if ($timeb > '299' and $timeb < '360') {?>5 минут<?php }
if ($timeb > '359' and $timeb < '420') {?>6 минут<?php }
if ($timeb > '419' and $timeb < '480') {?>7 минут<?php }
if ($timeb > '479' and $timeb < '540') {?>8 минут<?php }
if ($timeb > '539' and $timeb < '600') {?>9 минут<?php }
if ($timeb > '599' and $timeb < '660') {?>10 минут<?php }
if ($timeb > '659' and $timeb < '720') {?>11 минут<?php }
if ($timeb > '719' and $timeb < '780') {?>12 минут<?php }
if ($timeb > '779' and $timeb < '840') {?>13 минут<?php }
if ($timeb > '839' and $timeb < '900') {?>14 минут<?php }
if ($timeb > '899' and $timeb < '960') {?>15 минут<?php }
if ($timeb > '959' and $timeb < '1020') {?>16 минут<?php }
if ($timeb > '1019' and $timeb < '1080') {?>17 минут<?php }
if ($timeb > '1079' and $timeb < '1140') {?>18 минут<?php }
if ($timeb > '1139' and $timeb < '1200') {?>19 минут<?php }
if ($timeb > '1199' and $timeb < '1260') {?>20 минут<?php }
if ($timeb > '1259' and $timeb < '1320') {?>21 минуту<?php }
if ($timeb > '1319' and $timeb < '1380') {?>22 минуты<?php }
if ($timeb > '1379' and $timeb < '1440') {?>23 минуты<?php }
if ($timeb > '1439' and $timeb < '1500') {?>24 минуты<?php }
if ($timeb > '1499' and $timeb < '1560') {?>25 минут<?php }
if ($timeb > '1559' and $timeb < '1620') {?>26 минут<?php }
if ($timeb > '1619' and $timeb < '1680') {?>27 минут<?php }
if ($timeb > '1679' and $timeb < '1740') {?>28 минут<?php }
if ($timeb > '1739' and $timeb < '1800') {?>29 минут<?php }
if ($timeb > '1799' and $timeb < '1860') {?>30 минут<?php }
if ($timeb > '1859' and $timeb < '1920') {?>31 минуту<?php }
?>. Есть время прихватить лишнюю обойму патронов.</p> <p style="border-top: solid 1px #444e4f"></p>
<?php } else {?>

<?php
$query_num = "Select id from users where hp>'0' and clan='$clan1' " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
$total1 = mysqli_num_rows($result_num); 
?>
<?php
$query_num1 = "Select id from users where hp>'0' and clan='$clan2' " ;
$result_num1 = mysqli_query($dbc, $query_num1) or die ('Ошибка передачи запроса к БД');
$total2 = mysqli_num_rows($result_num1); 
?>
<?php if ($time_asus < '1') {?>
<?php if ($clan2_y > $clan1_y) {?>
<?php
$boncl_h = ($hab_clan1 / $sosta2);
$boncl_h = round("$boncl_h");
$boncl_m = ($mon_clan1 / $sosta2);
$boncl_m = round("$boncl_m");
$bon10_h = ($hab_clan1 * '0.10');
$bon10_h = round("$bon10_h");
$bon10_m = ($mon_clan1 * '0.10');
$bon10_m = round("$bon10_m");
$msusd = ($minus_slava1 * '2');
$query_2 = "update clans set clan_habar=clan_habar+'$hab_clan1', clan_money=clan_money+'$mon_clan1', rating=rating+'$rating2', win=win+'1', war='0', gauss_at='0', time_war=NOW(), st_war='1' where clan_id = '$clan2' limit 1";
$result_2 = mysqli_query($dbc, $query_2) or die ('Ошибка передачи запроса к БД');
$query_1 = "update clans set clan_habar=clan_habar-'$hab_clan1', clan_money=clan_money-'$mon_clan1', rating=rating+'$rating1', over=over+'1', war='0', gauss_at='0', time_war=NOW(), st_war='0' where clan_id = '$clan1' limit 1";
$result_1 = mysqli_query($dbc, $query_1) or die ('Ошибка передачи запроса к БД');
$query_3 = "delete from bitva_o where clan1='$clan1' limit 1";
$result_3 = mysqli_query($dbc, $query_3) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '$clan2', 'Ваш отряд победил в битве. Вы получили $hab_clan1 хабара и $mon_clan1 RUB, а так же $rating2 ранга. Кроме того, каждый из участников отряда получил $minus_slava1 славы, $boncl_h хабара и $boncl_m RUB. $nick_b102 получил дополнительные $bon10_h хабара, $bon10_m RUB и $msusd славы.', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '$clan1', 'Ваш отряд проиграл в битве. Вы потеряли $hab_clan1 хабара и $mon_clan1 RUB, а так же получили $rating1 ранга.', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "update users set clan_mes=clan_mes+'1', bit_y='0', bit_l='0' where clan = '$clan1' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "update users set clan_mes=clan_mes+'1', bit_y='0', slava=slava+'$minus_slava1', bit_l='0', habar=habar+'$boncl_h', money=money+'$boncl_m' where clan = '$clan2' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "update users set habar=habar+'$bon10_h', money=money+'$bon10_m', slava=slava+'$msusd' where id = '$id_b102' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<script type="text/javascript">
  document.location.href = "bitva_win.php?cl=<?php echo "$clan2";?>&hab=<?php echo "$hab_clan1";?>&habb=<?php echo "$hab_clan1";?>&mon=<?php echo "$mon_clan1";?>&monn=<?php echo "$mon_clan1";?>&rat=<?php echo "$rating2";?>&ratt=<?php echo "$rating1";?>";
</script>
<?php } else {?>
<?php
$boncl_h = ($hab_clan2 / $sosta1);
$boncl_h = round("$boncl_h");
$boncl_m = ($mon_clan2 / $sosta1);
$boncl_m = round("$boncl_m");
$bon11_h = ($hab_clan2 * '0.10');
$bon11_h = round("$bon11_h");
$bon11_m = ($mon_clan2 * '0.10');
$bon11_m = round("$bon11_m");
$msusd = ($minus_slava2 * '2');
$query_2 = "update clans set clan_habar=clan_habar+'$hab_clan2', clan_money=clan_money+'$mon_clan2', rating=rating+'$rating1', win=win+'1', war='0', gauss_at='0', time_war=NOW(), st_war='1' where clan_id = '$clan1' limit 1";
$result_2 = mysqli_query($dbc, $query_2) or die ('Ошибка передачи запроса к БД');
$query_1 = "update clans set clan_habar=clan_habar-'$hab_clan2', clan_money=clan_money-'$mon_clan2', rating=rating+'$rating2', over=over+'1', war='0', gauss_at='0', time_war=NOW(), st_war='0' where clan_id = '$clan2' limit 1";
$result_1 = mysqli_query($dbc, $query_1) or die ('Ошибка передачи запроса к БД');
$query_3 = "delete from bitva_o where clan1='$clan1' limit 1";
$result_3 = mysqli_query($dbc, $query_3) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '$clan1', 'Ваш отряд победил в битве. Вы получили $hab_clan2 хабара и $mon_clan2 RUB, а так же $rating1 ранга. Кроме того, каждый из участников отряда получил $minus_slava2 славы, $boncl_h хабара и $boncl_m RUB. $nick_b101 получил дополнительные $bon11_h хабара, $bon11_m RUB и $msusd славы.', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '$clan2', 'Ваш отряд проиграл в битве. Вы потеряли $hab_clan2 хабара и $mon_clan2 RUB, а так же получили $rating2 ранга.', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "update users set clan_mes=clan_mes+'1', bit_y='0', slava=slava+'$minus_slava2', bit_l='0', habar=habar+'$boncl_h', money=money+'$boncl_m' where clan = '$clan1' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "update users set clan_mes=clan_mes+'1', bit_y='0', bit_l='0' where clan = '$clan2' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "update users set habar=habar+'$bon11_h', money=money+'$bon11_m', slava=slava+'$msusd' where id = '$id_b101' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<script type="text/javascript">
  document.location.href = "bitva_win.php?cl=<?php echo "$clan1";?>&hab=<?php echo "$hab_clan2";?>&habb=<?php echo "$hab_clan2";?>&mon=<?php echo "$mon_clan2";?>&monn=<?php echo "$mon_clan2";?>&rat=<?php echo "$rating1";?>&ratt=<?php echo "$rating2";?>";
</script>
<?php }?>
<?php }?>
<div id="main">
<div class="stats">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Битва отрядов</p></center>
<p style="border-top: solid 1px #444e4f"></p>
<center><p class="dan">Битва закончится через <?php
$time111 = $time_asus;
$time44 = ($time111 - '3600');
if ($time111 < '60') {?><?php echo "$time111";?> секунд<?php }
if ($time111 > '59' and $time111 < '120') {?>1 минуту<?php }
if ($time111 > '119' and $time111 < '180') {?>2 минуты<?php }
if ($time111 > '179' and $time111 < '240') {?>3 минуты<?php }
if ($time111 > '239' and $time111 < '300') {?>4 минуты<?php }
if ($time111 > '299' and $time111 < '360') {?>5 минут<?php }
if ($time111 > '359' and $time111 < '420') {?>6 минут<?php }
if ($time111 > '419' and $time111 < '480') {?>7 минут<?php }
if ($time111 > '479' and $time111 < '540') {?>8 минут<?php }
if ($time111 > '539' and $time111 < '600') {?>9 минут<?php }
if ($time111 > '599' and $time111 < '660') {?>10 минут<?php }
if ($time111 > '659' and $time111 < '720') {?>11 минут<?php }
if ($time111 > '719' and $time111 < '780') {?>12 минут<?php }
if ($time111 > '779' and $time111 < '840') {?>13 минут<?php }
if ($time111 > '839' and $time111 < '900') {?>14 минут<?php }
if ($time111 > '899' and $time111 < '960') {?>15 минут<?php }
if ($time111 > '959' and $time111 < '1020') {?>16 минут<?php }
if ($time111 > '1019' and $time111 < '1080') {?>17 минут<?php }
if ($time111 > '1079' and $time111 < '1140') {?>18 минут<?php }
if ($time111 > '1139' and $time111 < '1200') {?>19 минут<?php }
if ($time111 > '1199' and $time111 < '1260') {?>20 минут<?php }
if ($time111 > '1259' and $time111 < '1320') {?>21 минуту<?php }
if ($time111 > '1319' and $time111 < '1380') {?>22 минуты<?php }
if ($time111 > '1379' and $time111 < '1440') {?>23 минуты<?php }
if ($time111 > '1439' and $time111 < '1500') {?>24 минуты<?php }
if ($time111 > '1499' and $time111 < '1560') {?>25 минут<?php }
if ($time111 > '1559' and $time111 < '1620') {?>26 минут<?php }
if ($time111 > '1619' and $time111 < '1680') {?>27 минут<?php }
if ($time111 > '1679' and $time111 < '1740') {?>28 минут<?php }
if ($time111 > '1739' and $time111 < '1800') {?>29 минут<?php }
if ($time111 > '1799' and $time111 < '1860') {?>30 минут<?php }
if ($time111 > '1859' and $time111 < '1920') {?>31 минуту<?php }
if ($time111 > '1919' and $time111 < '1980') {?>32 минуты<?php }
if ($time111 > '1979' and $time111 < '2040') {?>33 минуты<?php }
if ($time111 > '2039' and $time111 < '2100') {?>34 минуты<?php }
if ($time111 > '2099' and $time111 < '2160') {?>35 минут<?php }
if ($time111 > '2159' and $time111 < '2220') {?>36 минут<?php }
if ($time111 > '2219' and $time111 < '2280') {?>37 минут<?php }
if ($time111 > '2279' and $time111 < '2340') {?>38 минут<?php }
if ($time111 > '2339' and $time111 < '2400') {?>39 минут<?php }
if ($time111 > '2399' and $time111 < '2460') {?>40 минут<?php }
if ($time111 > '2459' and $time111 < '2520') {?>41 минуту<?php }
if ($time111 > '2519' and $time111 < '2580') {?>42 минуты<?php }
if ($time111 > '2579' and $time111 < '2640') {?>43 минуты<?php }
if ($time111 > '2639' and $time111 < '2700') {?>44 минуты<?php }
if ($time111 > '2699' and $time111 < '2760') {?>45 минут<?php }
if ($time111 > '2759' and $time111 < '2820') {?>46 минут<?php }
if ($time111 > '2819' and $time111 < '2880') {?>47 минут<?php }
if ($time111 > '2879' and $time111 < '2940') {?>48 минут<?php }
if ($time111 > '2939' and $time111 < '3000') {?>49 минут<?php }
if ($time111 > '2999' and $time111 < '3060') {?>50 минут<?php }
if ($time111 > '3059' and $time111 < '3120') {?>51 минуту<?php }
if ($time111 > '3119' and $time111 < '3180') {?>52 минуты<?php }
if ($time111 > '3179' and $time111 < '3240') {?>53 минуты<?php }
if ($time111 > '3239' and $time111 < '3300') {?>54 минуты<?php }
if ($time111 > '3299' and $time111 < '3360') {?>55 минут<?php }
if ($time111 > '3359' and $time111 < '3420') {?>56 минут<?php }
if ($time111 > '3419' and $time111 < '3480') {?>57 минут<?php }
if ($time111 > '3479' and $time111 < '3540') {?>58 минут<?php }
if ($time111 > '3539' and $time111 < '3600') {?>59 минут<?php }
if ($time111 > '3599' and $time111 < '3660') {?>60 минут<?php }
if ($time111 > '3659' and $time111 < '7200') {?>1 час <?php if ($time44 > '59' and $time44 < '120') {?>1 минуту<?php }
if ($time44 > '119' and $time44 < '180') {?>2 минуты<?php }
if ($time44 > '179' and $time44 < '240') {?>3 минуты<?php }
if ($time44 > '239' and $time44 < '300') {?>4 минуты<?php }
if ($time44 > '299' and $time44 < '360') {?>5 минут<?php }
if ($time44 > '359' and $time44 < '420') {?>6 минут<?php }
if ($time44 > '419' and $time44 < '480') {?>7 минут<?php }
if ($time44 > '479' and $time44 < '540') {?>8 минут<?php }
if ($time44 > '539' and $time44 < '600') {?>9 минут<?php }
if ($time44 > '599' and $time44 < '660') {?>10 минут<?php }
if ($time44 > '659' and $time44 < '720') {?>11 минут<?php }
if ($time44 > '719' and $time44 < '780') {?>12 минут<?php }
if ($time44 > '779' and $time44 < '840') {?>13 минут<?php }
if ($time44 > '839' and $time44 < '900') {?>14 минут<?php }
if ($time44 > '899' and $time44 < '960') {?>15 минут<?php }
if ($time44 > '959' and $time44 < '1020') {?>16 минут<?php }
if ($time44 > '1019' and $time44 < '1080') {?>17 минут<?php }
if ($time44 > '1079' and $time44 < '1140') {?>18 минут<?php }
if ($time44 > '1139' and $time44 < '1200') {?>19 минут<?php }
if ($time44 > '1199' and $time44 < '1260') {?>20 минут<?php }
if ($time44 > '1259' and $time44 < '1320') {?>21 минуту<?php }
if ($time44 > '1319' and $time44 < '1380') {?>22 минуты<?php }
if ($time44 > '1379' and $time44 < '1440') {?>23 минуты<?php }
if ($time44 > '1439' and $time44 < '1500') {?>24 минуты<?php }
if ($time44 > '1499' and $time44 < '1560') {?>25 минут<?php }
if ($time44 > '1559' and $time44 < '1620') {?>26 минут<?php }
if ($time44 > '1619' and $time44 < '1680') {?>27 минут<?php }
if ($time44 > '1679' and $time44 < '1740') {?>28 минут<?php }
if ($time44 > '1739' and $time44 < '1800') {?>29 минут<?php }
if ($time44 > '1799' and $time44 < '1860') {?>30 минут<?php }
if ($time44 > '1859' and $time44 < '1920') {?>31 минуту<?php }
if ($time44 > '1919' and $time44 < '1980') {?>32 минуты<?php }
if ($time44 > '1979' and $time44 < '2040') {?>33 минуты<?php }
if ($time44 > '2039' and $time44 < '2100') {?>34 минуты<?php }
if ($time44 > '2099' and $time44 < '2160') {?>35 минут<?php }
if ($time44 > '2159' and $time44 < '2220') {?>36 минут<?php }
if ($time44 > '2219' and $time44 < '2280') {?>37 минут<?php }
if ($time44 > '2279' and $time44 < '2340') {?>38 минут<?php }
if ($time44 > '2339' and $time44 < '2400') {?>39 минут<?php }
if ($time44 > '2399' and $time44 < '2460') {?>40 минут<?php }
if ($time44 > '2459' and $time44 < '2520') {?>41 минуту<?php }
if ($time44 > '2519' and $time44 < '2580') {?>42 минуты<?php }
if ($time44 > '2579' and $time44 < '2640') {?>43 минуты<?php }
if ($time44 > '2639' and $time44 < '2700') {?>44 минуты<?php }
if ($time44 > '2699' and $time44 < '2760') {?>45 минут<?php }
if ($time44 > '2759' and $time44 < '2820') {?>46 минут<?php }
if ($time44 > '2819' and $time44 < '2880') {?>47 минут<?php }
if ($time44 > '2879' and $time44 < '2940') {?>48 минут<?php }
if ($time44 > '2939' and $time44 < '3000') {?>49 минут<?php }
if ($time44 > '2999' and $time44 < '3060') {?>50 минут<?php }
if ($time44 > '3059' and $time44 < '3120') {?>51 минуту<?php }
if ($time44 > '3119' and $time44 < '3180') {?>52 минуты<?php }
if ($time44 > '3179' and $time44 < '3240') {?>53 минуты<?php }
if ($time44 > '3239' and $time44 < '3300') {?>54 минуты<?php }
if ($time44 > '3299' and $time44 < '3360') {?>55 минут<?php }
if ($time44 > '3359' and $time44 < '3420') {?>56 минут<?php }
if ($time44 > '3419' and $time44 < '3480') {?>57 минут<?php }
if ($time44 > '3479' and $time44 < '3540') {?>58 минут<?php }
if ($time44 > '3539' and $time44 < '3600') {?>59 минут<?php }
if ($time44 > '3599' and $time44 < '3660') {?>60 минут<?php } ?><?php }
$time44 = ($time111 - '7200');
if ($time111 > '7199' and $time111 < '10800') {?>2 часа <?php if ($time44 > '59' and $time44 < '120') {?>1 минуту<?php }
if ($time44 > '119' and $time44 < '180') {?>2 минуты<?php }
if ($time44 > '179' and $time44 < '240') {?>3 минуты<?php }
if ($time44 > '239' and $time44 < '300') {?>4 минуты<?php }
if ($time44 > '299' and $time44 < '360') {?>5 минут<?php }
if ($time44 > '359' and $time44 < '420') {?>6 минут<?php }
if ($time44 > '419' and $time44 < '480') {?>7 минут<?php }
if ($time44 > '479' and $time44 < '540') {?>8 минут<?php }
if ($time44 > '539' and $time44 < '600') {?>9 минут<?php }
if ($time44 > '599' and $time44 < '660') {?>10 минут<?php }
if ($time44 > '659' and $time44 < '720') {?>11 минут<?php }
if ($time44 > '719' and $time44 < '780') {?>12 минут<?php }
if ($time44 > '779' and $time44 < '840') {?>13 минут<?php }
if ($time44 > '839' and $time44 < '900') {?>14 минут<?php }
if ($time44 > '899' and $time44 < '960') {?>15 минут<?php }
if ($time44 > '959' and $time44 < '1020') {?>16 минут<?php }
if ($time44 > '1019' and $time44 < '1080') {?>17 минут<?php }
if ($time44 > '1079' and $time44 < '1140') {?>18 минут<?php }
if ($time44 > '1139' and $time44 < '1200') {?>19 минут<?php }
if ($time44 > '1199' and $time44 < '1260') {?>20 минут<?php }
if ($time44 > '1259' and $time44 < '1320') {?>21 минуту<?php }
if ($time44 > '1319' and $time44 < '1380') {?>22 минуты<?php }
if ($time44 > '1379' and $time44 < '1440') {?>23 минуты<?php }
if ($time44 > '1439' and $time44 < '1500') {?>24 минуты<?php }
if ($time44 > '1499' and $time44 < '1560') {?>25 минут<?php }
if ($time44 > '1559' and $time44 < '1620') {?>26 минут<?php }
if ($time44 > '1619' and $time44 < '1680') {?>27 минут<?php }
if ($time44 > '1679' and $time44 < '1740') {?>28 минут<?php }
if ($time44 > '1739' and $time44 < '1800') {?>29 минут<?php }
if ($time44 > '1799' and $time44 < '1860') {?>30 минут<?php }
if ($time44 > '1859' and $time44 < '1920') {?>31 минуту<?php }
if ($time44 > '1919' and $time44 < '1980') {?>32 минуты<?php }
if ($time44 > '1979' and $time44 < '2040') {?>33 минуты<?php }
if ($time44 > '2039' and $time44 < '2100') {?>34 минуты<?php }
if ($time44 > '2099' and $time44 < '2160') {?>35 минут<?php }
if ($time44 > '2159' and $time44 < '2220') {?>36 минут<?php }
if ($time44 > '2219' and $time44 < '2280') {?>37 минут<?php }
if ($time44 > '2279' and $time44 < '2340') {?>38 минут<?php }
if ($time44 > '2339' and $time44 < '2400') {?>39 минут<?php }
if ($time44 > '2399' and $time44 < '2460') {?>40 минут<?php }
if ($time44 > '2459' and $time44 < '2520') {?>41 минуту<?php }
if ($time44 > '2519' and $time44 < '2580') {?>42 минуты<?php }
if ($time44 > '2579' and $time44 < '2640') {?>43 минуты<?php }
if ($time44 > '2639' and $time44 < '2700') {?>44 минуты<?php }
if ($time44 > '2699' and $time44 < '2760') {?>45 минут<?php }
if ($time44 > '2759' and $time44 < '2820') {?>46 минут<?php }
if ($time44 > '2819' and $time44 < '2880') {?>47 минут<?php }
if ($time44 > '2879' and $time44 < '2940') {?>48 минут<?php }
if ($time44 > '2939' and $time44 < '3000') {?>49 минут<?php }
if ($time44 > '2999' and $time44 < '3060') {?>50 минут<?php }
if ($time44 > '3059' and $time44 < '3120') {?>51 минуту<?php }
if ($time44 > '3119' and $time44 < '3180') {?>52 минуты<?php }
if ($time44 > '3179' and $time44 < '3240') {?>53 минуты<?php }
if ($time44 > '3239' and $time44 < '3300') {?>54 минуты<?php }
if ($time44 > '3299' and $time44 < '3360') {?>55 минут<?php }
if ($time44 > '3359' and $time44 < '3420') {?>56 минут<?php }
if ($time44 > '3419' and $time44 < '3480') {?>57 минут<?php }
if ($time44 > '3479' and $time44 < '3540') {?>58 минут<?php }
if ($time44 > '3539' and $time44 < '3600') {?>59 минут<?php }
if ($time44 > '3599' and $time44 < '3660') {?>60 минут<?php } ?><?php }
if ($time111 > '10799' and $time111 < '14400') {?>3 часа<?php }
?></p></center>
</div>
<?php if ($n_b != '0' and $clan != '0') {?>
<?php if ($err == '1') {?>
<p style="border-style: solid; border-width: 1px; border-color: white;"><span class="red">Произошла ошибка: подождите, пока пройдет 30 минут после прошлого пси-удара.</span></p>
<?php }?>
<?php if ($err == '2') {?>
<p style="border-style: solid; border-width: 1px; border-color: white;"><span class="red">Произошла ошибка: в складе вашего отряда должно быть минимум 1000 RUB.</span></p>
<?php }?>
<?php if ($clan == $clan1) {?>
<?php if ($yron != '') {?>
<p style="border-style: solid; border-width: 1px; border-color: white;"><span class="white">Вы нанесли <?php echo "$yron";?> урона вражескому отряду.<?php if ($ata1 > '0' and $yron > '0') {?><br/>Разрывные патроны: +<?php echo "$at0";?> урона<?php }?><?php if ($bro2 > '0' and $yron > '0') {?><br/>Дополнительная броня противника: -<?php echo "$br0";?> урона<?php }?></span></p>
<?php }?>
<?php } else {?>
<?php if ($yron != '') {?>
<p style="border-style: solid; border-width: 1px; border-color: white;"><span class="white">Вы нанесли <?php echo "$yron";?> урона вражескому отряду.<?php if ($ata2 > '0' and $yron > '0') {?><br/>Разрывные патроны: +<?php echo "$at0";?> урона<?php }?><?php if ($bro1 > '0' and $yron > '0') {?><br/>Дополнительная броня противника: -<?php echo "$br0";?> урона<?php }?></span></p>
<?php }?>
<?php }?>
<center>
Отряд <?php
if ($gruppa1 == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }
if ($gruppa1 == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }
if ($gruppa1 == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }
if ($gruppa1 == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }
?><a class="white" href="company.php?company_id=<?php echo "$clan1";?>"><?php echo "$clan1_n";?></a> напал на отряд <?php
if ($gruppa2 == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }
if ($gruppa2 == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }
if ($gruppa2 == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }
if ($gruppa2 == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }
?><a class="white" href="company.php?company_id=<?php echo "$clan2";?>"><?php echo "$clan2_n";?></a></center>
<p style="border-top: solid 1px #444e4f"></p>
<?php if (!empty($clan3) or !empty($clan4)) {?>
<p class="podmenu">Союзные отряды:</p>
<?php if (!empty($clan3)) {?>
<p><?php
if ($gruppa3 == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }
if ($gruppa3 == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }
if ($gruppa3 == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }
if ($gruppa3 == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }
?><a class="white" href="clan.php?id=<?php echo "$clan3";?>"><?php echo "$clan3_n";?></a> <small>(<?php echo "$clan1_n";?>)</small></p>
<?php }?>
<?php if (!empty($clan4)) {?>
<p><?php
if ($gruppa4 == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }
if ($gruppa4 == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }
if ($gruppa4 == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }
if ($gruppa4 == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }
?><a class="white" href="clan.php?id=<?php echo "$clan4";?>"><?php echo "$clan4_n";?></a> <small>(<?php echo "$clan2_n";?>)</small></p>
<?php }?>
<?php }?>
<p class="podmenu">Битва:</p>
<p class="net"><b>Урон:</b></p>
<p><span class="white"><?php echo "$clan1_n";?>:</span> <?php echo "$clan1_y";?></p>
<p><span class="white"><?php echo "$clan2_n";?>:</span> <?php echo "$clan2_y";?></p>
<?php if ($err == '3') {?>
<p class="net"><b>Награда в случае победы:</b></p>
<?php if ($clan == $clan3) {?>
<p><?php echo "$hab_clan2";?> хабара и <?php echo "$mon_clan2";?> RUB</p>
<?php } else {?><p><?php echo "$hab_clan1";?> хабара и <?php echo "$mon_clan1";?> RUB</p><?php }?>
<p class="net"><b>Потери в случае поражения:</b></p>
<?php if ($clan == $clan3) {?>
<p><?php echo "$hab_clan1";?> хабара и <?php echo "$mon_clan1";?> RUB</p>
<?php } else {?><p><?php echo "$hab_clan2";?> хабара и <?php echo "$mon_clan2";?> RUB</p><?php }?>
<?php } else {?><p style="border-top: dashed 1px #444e4f"></p>
<p><img src="img/ico/link.png"/> <a href="s_bitva.php?err=3">Рассчитать награды</a></p><?php }?>
<?php if ($gauss_at != '1' and $gt > $now) {?><p class="red"><img src="img/ico/no.png"/> Аккумуляторы разрядились. Идет процесс их зарядки. Осталось еще <?php
$time116 = $nu_da;
if ($time116 < '60') {?><?php echo "$time116";?> секунд<?php }
if ($time116 > '59' and $time116 < '120') {?>1 минута<?php }
if ($time116 > '119' and $time116 < '180') {?>2 минуты<?php }
if ($time116 > '179' and $time116 < '240') {?>3 минуты<?php }
if ($time116 > '239' and $time116 < '300') {?>4 минуты<?php }
if ($time116 > '299' and $time116 < '360') {?>5 минут<?php }
if ($time116 > '359' and $time116 < '420') {?>6 минут<?php }
if ($time116 > '419' and $time116 < '480') {?>7 минут<?php }
if ($time116 > '479' and $time116 < '540') {?>8 минут<?php }
if ($time116 > '539' and $time116 < '600') {?>9 минут<?php }
if ($time116 > '599' and $time116 < '660') {?>10 минут<?php }
if ($time116 > '659' and $time116 < '720') {?>11 минут<?php }
if ($time116 > '719' and $time116 < '780') {?>12 минут<?php }
if ($time116 > '779' and $time116 < '840') {?>13 минут<?php }
if ($time116 > '839' and $time116 < '900') {?>14 минут<?php }
if ($time116 > '899' and $time116 < '960') {?>15 минут<?php }
if ($time116 > '959' and $time116 < '1020') {?>16 минут<?php }
if ($time116 > '1019' and $time116 < '1080') {?>17 минут<?php }
if ($time116 > '1079' and $time116 < '1140') {?>18 минут<?php }
if ($time116 > '1139' and $time116 < '1200') {?>19 минут<?php }
if ($time116 > '1199' and $time116 < '1260') {?>20 минут<?php }
if ($time116 > '1259' and $time116 < '1320') {?>21 минута<?php }
if ($time116 > '1319' and $time116 < '1380') {?>22 минуты<?php }
if ($time116 > '1379' and $time116 < '1440') {?>23 минуты<?php }
if ($time116 > '1439' and $time116 < '1500') {?>24 минуты<?php }
if ($time116 > '1499' and $time116 < '1560') {?>25 минут<?php }
if ($time116 > '1559' and $time116 < '1620') {?>26 минут<?php }
if ($time116 > '1619' and $time116 < '1680') {?>27 минут<?php }
if ($time116 > '1679' and $time116 < '1740') {?>28 минут<?php }
if ($time116 > '1739' and $time116 < '1800') {?>29 минут<?php }
if ($time116 > '1799' and $time116 < '1860') {?>30 минут<?php }
if ($time116 > '1859' and $time116 < '1920') {?>31 минута<?php }
if ($time116 > '1919' and $time116 < '1980') {?>32 минуты<?php }
if ($time116 > '1979' and $time116 < '2040') {?>33 минуты<?php }
if ($time116 > '2039' and $time116 < '2100') {?>34 минуты<?php }
if ($time116 > '2099' and $time116 < '2160') {?>35 минут<?php }
if ($time116 > '2159' and $time116 < '2220') {?>36 минут<?php }
if ($time116 > '2219' and $time116 < '2280') {?>37 минут<?php }
if ($time116 > '2279' and $time116 < '2340') {?>38 минут<?php }
if ($time116 > '2339' and $time116 < '2400') {?>39 минут<?php }
if ($time116 > '2399' and $time116 < '2460') {?>40 минут<?php }
if ($time116 > '2459' and $time116 < '2520') {?>41 минута<?php }
if ($time116 > '2519' and $time116 < '2580') {?>42 минуты<?php }
if ($time116 > '2579' and $time116 < '2640') {?>43 минуты<?php }
if ($time116 > '2639' and $time116 < '2700') {?>44 минуты<?php }
if ($time116 > '2699' and $time116 < '2760') {?>45 минут<?php }
if ($time116 > '2759' and $time116 < '2820') {?>46 минут<?php }
if ($time116 > '2819' and $time116 < '2880') {?>47 минут<?php }
if ($time116 > '2879' and $time116 < '2940') {?>48 минут<?php }
if ($time116 > '2939' and $time116 < '3000') {?>49 минут<?php }
if ($time116 > '2999' and $time116 < '3060') {?>50 минут<?php }
if ($time116 > '3059' and $time116 < '3120') {?>51 минута<?php }
if ($time116 > '3119' and $time116 < '3180') {?>52 минуты<?php }
if ($time116 > '3179' and $time116 < '3240') {?>53 минуты<?php }
if ($time116 > '3239' and $time116 < '3300') {?>54 минуты<?php }
if ($time116 > '3299' and $time116 < '3360') {?>55 минут<?php }
if ($time116 > '3359' and $time116 < '3420') {?>56 минут<?php }
if ($time116 > '3419' and $time116 < '3480') {?>57 минут<?php }
if ($time116 > '3479' and $time116 < '3540') {?>58 минут<?php }
if ($time116 > '3539' and $time116 < '3600') {?>59 минут<?php }
if ($time116 > '3599' and $time116 < '3660') {?>60 минут<?php }
?>.</p><?php }?>
<p><img src="img/ico/link.png"/> <a href="bit_rat.php">Рейтинг по урону</a></p>
<p><img src="img/ico/link.png"/> <a href="bit_rat1.php">Рейтинг по потерям</a></p>
<p style="border-top: dashed 1px #444e4f"></p>
<center><?php if ($time_aptechka < '1') {?><p><a class="bonus" href="apt.php">Использовать аптечку</a></p><?php } else {?><p class="bonus">До следующего использования <span class="white"><?php echo "$time_aptechka";?></span> секунд</p><?php }?></center>
<center><a href="s_bitva.php"><img src="img/icon-refresh.png"/></a></center>
<p style="border-top: dashed 1px #444e4f"></p>
<?php
if (empty($clan4)) {
$clan4 = $clan2;
}
if ($clan == $clan3) {?>
<?php
$query_sub = "Select * from users where clan = '$clan2' and hp>'0' or clan = '$clan4' and hp>'0' order by hp desc limit 100";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$id_top = $row_sub['id'];
$name = $row_sub['nick'];
$hp = $row_sub['hp'];
?>
<p><span class="white"><b><?php if ($hp == '0') {?><s><?php }?><?php echo "$name" ; ?></span></b> <span class="bonus">hp: <?php echo "$hp";?></span><?php if ($hp == '0') {?></s><?php }?><?php if ($clan_r > '7') {?><br /><?php if ($time11 > '0') {?><span class="red">Ждите еще <?php
if ($time11 < '60') {?><?php echo "$time11";?> секунд<?php }
if ($time11 > '59' and $time11 < '120') {?>1 минуту<?php }
if ($time11 > '119' and $time11 < '180') {?>2 минуты<?php }
if ($time11 > '179' and $time11 < '240') {?>3 минуты<?php }
if ($time11 > '239' and $time11 < '300') {?>4 минуты<?php }
if ($time11 > '299' and $time11 < '360') {?>5 минут<?php }
if ($time11 > '359' and $time11 < '420') {?>6 минут<?php }
if ($time11 > '419' and $time11 < '480') {?>7 минут<?php }
if ($time11 > '479' and $time11 < '540') {?>8 минут<?php }
if ($time11 > '539' and $time11 < '600') {?>9 минут<?php }
if ($time11 > '599' and $time11 < '660') {?>10 минут<?php }
if ($time11 > '659' and $time11 < '720') {?>11 минут<?php }
if ($time11 > '719' and $time11 < '780') {?>12 минут<?php }
if ($time11 > '779' and $time11 < '840') {?>13 минут<?php }
if ($time11 > '839' and $time11 < '900') {?>14 минут<?php }
if ($time11 > '899' and $time11 < '960') {?>15 минут<?php }
if ($time11 > '959' and $time11 < '1020') {?>16 минут<?php }
if ($time11 > '1019' and $time11 < '1080') {?>17 минут<?php }
if ($time11 > '1079' and $time11 < '1140') {?>18 минут<?php }
if ($time11 > '1139' and $time11 < '1200') {?>19 минут<?php }
if ($time11 > '1199' and $time11 < '1260') {?>20 минут<?php }
if ($time11 > '1259' and $time11 < '1320') {?>21 минуту<?php }
if ($time11 > '1319' and $time11 < '1380') {?>22 минуты<?php }
if ($time11 > '1379' and $time11 < '1440') {?>23 минуты<?php }
if ($time11 > '1439' and $time11 < '1500') {?>24 минуты<?php }
if ($time11 > '1499' and $time11 < '1560') {?>25 минут<?php }
if ($time11 > '1559' and $time11 < '1620') {?>26 минут<?php }
if ($time11 > '1619' and $time11 < '1680') {?>27 минут<?php }
if ($time11 > '1679' and $time11 < '1740') {?>28 минут<?php }
if ($time11 > '1739' and $time11 < '1800') {?>29 минут<?php }
if ($time11 > '1799' and $time11 < '1860') {?>30 минут<?php }
if ($time11 > '1859' and $time11 < '1920') {?>31 минуту<?php }
?>.</span><?php } else {?><a class="blue" href="bit_dop.php?id=<?php echo "$id_top" ; ?>&tip=1&cl=2" onclick="return confirm ('Уверены? Из склада вашего отряда заберут 1000 RUB.')">Пси-удар</a><?php }?><?php }?><br/><?php if ($time_pr > $now) {?><span class="red">Пистолет перезаряжается</span><?php } else {?><a class="white" href="bit_attack.php?id=<?php echo "$id_top" ; ?>&tip=1&cl=2">Стрелять с пистолета</a><?php }?></p>
<p><?php if ($time_wr > $now) {?><span class="red">Автомат перезаряжается</span><?php } else {?><a class="white" href="bit_attack.php?id=<?php echo "$id_top" ; ?>&tip=2&cl=2">Стрелять с автомата</a><?php }?></p>
<p style="border-top: dashed 1px #444e4f"></p>
<?php 
}
?>
<?php } else {?>
<?php
if (empty($clan3)) {
$clan3 = $clan1;
}
$query_sub = "Select * from users where clan = '$clan1' and hp>'0' or clan = '$clan3' and hp>'0' order by hp desc limit 100";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$id_top = $row_sub['id'];
$name = $row_sub['nick'];
$hp = $row_sub['hp'];
?>
<p><b><?php if ($hp == '0') {?><s><?php }?><a href="profile.php?id=<?php echo "$id_top";?>" class="white"><?php echo "$name" ; ?></a></b> <span class="bonus">hp: <?php echo "$hp";?></span><?php if ($hp == '0') {?></s><?php }?><?php if ($clan_r > '7') {?><br /><?php if ($time11 > '0') {?><span class="red">Ждите еще <?php
if ($time11 < '60') {?><?php echo "$time11";?> секунд<?php }
if ($time11 > '59' and $time11 < '120') {?>1 минуту<?php }
if ($time11 > '119' and $time11 < '180') {?>2 минуты<?php }
if ($time11 > '179' and $time11 < '240') {?>3 минуты<?php }
if ($time11 > '239' and $time11 < '300') {?>4 минуты<?php }
if ($time11 > '299' and $time11 < '360') {?>5 минут<?php }
if ($time11 > '359' and $time11 < '420') {?>6 минут<?php }
if ($time11 > '419' and $time11 < '480') {?>7 минут<?php }
if ($time11 > '479' and $time11 < '540') {?>8 минут<?php }
if ($time11 > '539' and $time11 < '600') {?>9 минут<?php }
if ($time11 > '599' and $time11 < '660') {?>10 минут<?php }
if ($time11 > '659' and $time11 < '720') {?>11 минут<?php }
if ($time11 > '719' and $time11 < '780') {?>12 минут<?php }
if ($time11 > '779' and $time11 < '840') {?>13 минут<?php }
if ($time11 > '839' and $time11 < '900') {?>14 минут<?php }
if ($time11 > '899' and $time11 < '960') {?>15 минут<?php }
if ($time11 > '959' and $time11 < '1020') {?>16 минут<?php }
if ($time11 > '1019' and $time11 < '1080') {?>17 минут<?php }
if ($time11 > '1079' and $time11 < '1140') {?>18 минут<?php }
if ($time11 > '1139' and $time11 < '1200') {?>19 минут<?php }
if ($time11 > '1199' and $time11 < '1260') {?>20 минут<?php }
if ($time11 > '1259' and $time11 < '1320') {?>21 минуту<?php }
if ($time11 > '1319' and $time11 < '1380') {?>22 минуты<?php }
if ($time11 > '1379' and $time11 < '1440') {?>23 минуты<?php }
if ($time11 > '1439' and $time11 < '1500') {?>24 минуты<?php }
if ($time11 > '1499' and $time11 < '1560') {?>25 минут<?php }
if ($time11 > '1559' and $time11 < '1620') {?>26 минут<?php }
if ($time11 > '1619' and $time11 < '1680') {?>27 минут<?php }
if ($time11 > '1679' and $time11 < '1740') {?>28 минут<?php }
if ($time11 > '1739' and $time11 < '1800') {?>29 минут<?php }
if ($time11 > '1799' and $time11 < '1860') {?>30 минут<?php }
if ($time11 > '1859' and $time11 < '1920') {?>31 минуту<?php }
?>.</span><?php } else {?><a class="blue" href="bit_dop.php?id=<?php echo "$id_top" ; ?>&tip=1&cl=1" onclick="return confirm ('Уверены? Из склада вашего отряда заберут 1000 RUB.')">Пси-удар</a><?php }?><?php }?><br /><?php if ($time_pr > $now) {?><span class="red">Пистолет перезаряжается</span><?php } else {?><a class="white" href="bit_attack.php?id=<?php echo "$id_top" ; ?>&tip=1&cl=1">Стрелять с пистолета</a><?php }?></p>
<p><?php if ($time_wr > $now) {?><span class="red">Автомат перезаряжается</span><?php } else {?><a class="white" href="bit_attack.php?id=<?php echo "$id_top" ; ?>&tip=2&cl=1">Стрелять с автомата</a><?php }?></p>
<p style="border-top: dashed 1px #444e4f"></p>
<?php 
}
?>
<?php }?>
<?php } else {?><p class="red">Произошла ошибка. Возможные причины:<br />1.Ваш отряд не ведет перестрелку<br />2.Вы не состоите в каком-либо отряде</p>
<p style="border-top: solid 1px #444e4f"></p>
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