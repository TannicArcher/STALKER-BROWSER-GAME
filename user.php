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
$page_title = 'Профиль';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php 
  header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
  header('Cache-Control: no-store, no-cache, must-revalidate'); 
  header('Cache-Control: post-check=0, pre-check=0', FALSE); 
  header('Pragma: no-cache'); 
?> 
<?php
$user_id1 = $_SESSION['id'];
$query1 = "Select * from users where id='$user_id1' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$roww = mysqli_fetch_array($result1);
$moder1 = $roww['moder'];
$admin1 = $roww['admin'];
$clan1 = $roww['clan'];
$clan_rang1 = $roww['clan_rang'];
$gruppa1 = $roww['gruppa'];
$user_id = $_GET['id'];
$vid = $_GET['vid'];
$query = "Select * from users where id='$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$user_id = $row['id'];
$bought = $row['bought'];
$prem = $row['premium'];
$nick = $row['nick'];
$mentor_time = $row['mentor_time'];
$mentor_type = $row['mentor_type'];
$last_active = $row['last_active'];
$last_active = strtotime("$last_active");
$now = (date("Y-m-d H:i:s"));
$sovsem = ($now - 240000);
$now = strtotime("$now");
$razn_last_act = ($now - $last_active);
$time11 = $razn_last_act;
$lvl = $row['lvl'];
$h_lvl = ($ahah * '50');
$gruppa = $row['gruppa'];
$clan = $row['clan'];
$clan_rang = $row['clan_rang'];
$slava = $row['slava'];
$admin = $row['admin'];
$moder = $row['moder'];
$user = $row['user'];
$ban = $row['ban'];
$ip_r = $row['ip'];
$f_ban = $row['f_ban'];
$c_ban = $row['c_ban'];
$p_ban = $row['p_ban'];
$device = $row['device'];
$agent = $row['user_agent'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$query1 = "Select * from clans where clan_id='$clan' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$row1 = mysqli_fetch_array($result1);
$clan_name = $row1['name'];
$query2 = "Select * from clans where clan_id='$clan1' limit 1";
$result2 = mysqli_query($dbc, $query2) or die ('Ошибка передачи запроса к БД');
$row2 = mysqli_fetch_array($result2);
$warr = $row2['war'];
$nadpis1 = $row['nadpis1'];
$nadpis1 = str_replace('<','&lt;', $nadpis1);
$nadpis1 = str_replace('>','&gt;', $nadpis1);
$nadpis1 = str_replace('"','&quot', $nadpis1);
$nadpis1 = stripslashes("$nadpis1");
$long_text = strlen($nadpis1);
$query_an = "Select * from anketa where user_id = '$user_id' limit 1";
$result_an = mysqli_query($dbc, $query_an) or die ('Ошибка передачи запроса к БД');
$row_an = mysqli_fetch_array($result_an);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$ban_c1 = '0';
$query_cb = "Select * from bans where user_id = '$user_id' and type = '4'";
$result_cb = mysqli_query($dbc, $query_cb) or die ('Ошибка передачи запроса к БД');
$row_cb = mysqli_fetch_array($result_cb);
if ($row_cb > '0') {
$ban_c1 = '1';
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<?php
$query123 = "Select opit, lvl from users where id = '$user_id' limit 1";
$result123 = mysqli_query($dbc, $query123) or die ('Ошибка передачи запроса к БД');
$row123 = mysqli_fetch_array($result123);
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
$proc1 = (( '100' / $lvl1_opit ) * $opit123 );
$proc1 = round($proc1);
?>

<div id="main">
<?php if ($row == 0) {?>
<div class="stats">
<p class="red">Такого игрока нет!</p>
</div>
<?php } else {?>
<div class="stats">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"><?php echo "$nick";?> (id: <?php echo "$user_id";?>)</p>
<div style="background-color: <?php if ($user_id == '10033') {?>#000000<?php } else {?>#0B0B0B<?php }?>;">
<img src="img/ava/<?php echo $row['avatar']; ?>.png" class="upl" <?php if ($prem == '1') {?>style="border: 3px outset gold;"<?php }?>/></center>
</div>
<div style="color:#B5B5B5;
font-size:14px;
font-weight:bold;
margin-top: 4px;
margin-bottom: 4px;
background: url(http://stalkeronlinegame.epizy.com/style/img/title.png) 100% no-repeat;
background-size: cover;">
<?php if ($long_text > 0) {?><?php echo "$nadpis1";?><?php } else {?><?php
if ($gruppa == 'naemniki') {?>За одиночек, братья!<?php }
if ($gruppa == 'svoboda') {?>За свободу, братья!<?php }
if ($gruppa == 'dolg') {?>За долг, братья!<?php }
if ($gruppa == 'mon') {?>Смерть, лютая смерть врагам монолита...<?php }
?><?php }?>
</div>
<div style="background-color: #1E1E1E;">
<p class="podmenu" style="border-top:1px solid #444e4f;"></p>
<p class="white">
<?php
if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/> Онлайн<?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/> Был<?php if ($row['sex'] == male) {?><?php } else {?>а<?php }?> онлайн <?php
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
if ($time11 > '1919' and $time11 < '1980') {?>32 минуты<?php }
if ($time11 > '1979' and $time11 < '2040') {?>33 минуты<?php }
if ($time11 > '2039' and $time11 < '2100') {?>34 минуты<?php }
if ($time11 > '2099' and $time11 < '2160') {?>35 минут<?php }
if ($time11 > '2159' and $time11 < '2220') {?>36 минут<?php }
if ($time11 > '2219' and $time11 < '2280') {?>37 минут<?php }
if ($time11 > '2279' and $time11 < '2340') {?>38 минут<?php }
if ($time11 > '2339' and $time11 < '2400') {?>39 минут<?php }
if ($time11 > '2399' and $time11 < '2460') {?>40 минут<?php }
if ($time11 > '2459' and $time11 < '2520') {?>41 минуту<?php }
if ($time11 > '2519' and $time11 < '2580') {?>42 минуты<?php }
if ($time11 > '2579' and $time11 < '2640') {?>43 минуты<?php }
if ($time11 > '2639' and $time11 < '2700') {?>44 минуты<?php }
if ($time11 > '2699' and $time11 < '2760') {?>45 минут<?php }
if ($time11 > '2759' and $time11 < '2820') {?>46 минут<?php }
if ($time11 > '2819' and $time11 < '2880') {?>47 минут<?php }
if ($time11 > '2879' and $time11 < '2940') {?>48 минут<?php }
if ($time11 > '2939' and $time11 < '3000') {?>49 минут<?php }
if ($time11 > '2999' and $time11 < '3060') {?>50 минут<?php }
if ($time11 > '3059' and $time11 < '3120') {?>51 минуту<?php }
if ($time11 > '3119' and $time11 < '3180') {?>52 минуты<?php }
if ($time11 > '3179' and $time11 < '3240') {?>53 минуты<?php }
if ($time11 > '3239' and $time11 < '3300') {?>54 минуты<?php }
if ($time11 > '3299' and $time11 < '3360') {?>55 минут<?php }
if ($time11 > '3359' and $time11 < '3420') {?>56 минут<?php }
if ($time11 > '3419' and $time11 < '3480') {?>57 минут<?php }
if ($time11 > '3479' and $time11 < '3540') {?>58 минут<?php }
if ($time11 > '3539' and $time11 < '3600') {?>59 минут<?php }
if ($time11 > '3599' and $time11 < '3660') {?>60 минут<?php }
if ($time11 > '3659' and $time11 < '7200') {?>1 час<?php }
if ($time11 > '7199' and $time11 < '10800') {?>2 часа<?php }
if ($time11 > '10799' and $time11 < '14400') {?>3 часа<?php }
if ($time11 > '14399' and $time11 < '18000') {?>4 часа<?php }
if ($time11 > '17999' and $time11 < '21600') {?>5 часов<?php }
if ($time11 > '21599' and $time11 < '25200') {?>6 часов<?php }
if ($time11 > '25199' and $time11 < '28800') {?>7 часов<?php }
if ($time11 > '28799' and $time11 < '32400') {?>8 часов<?php }
if ($time11 > '32399' and $time11 < '36000') {?>9 часов<?php }
if ($time11 > '35999' and $time11 < '39600') {?>10 часов<?php }
if ($time11 > '39599' and $time11 < '43200') {?>11 часов<?php }
if ($time11 > '43199' and $time11 < '46800') {?>12 часов<?php }
if ($time11 > '46799' and $time11 < '50400') {?>13 часов<?php }
if ($time11 > '50399' and $time11 < '54000') {?>14 часов<?php }
if ($time11 > '53999' and $time11 < '57600') {?>15 часов<?php }
if ($time11 > '57599' and $time11 < '61200') {?>16 часов<?php }
if ($time11 > '61199' and $time11 < '64800') {?>17 часов<?php }
if ($time11 > '64799' and $time11 < '68400') {?>18 часов<?php }
if ($time11 > '68399' and $time11 < '72000') {?>19 часов<?php }
if ($time11 > '71999' and $time11 < '75600') {?>20 часов<?php }
if ($time11 > '75599' and $time11 < '79200') {?>21 час<?php }
if ($time11 > '79199' and $time11 < '82800') {?>22 часа<?php }
if ($time11 > '82799' and $time11 < '86400') {?>23 часа<?php }
if ($time11 > '86399' and $time11 < '90000') {?>1 день<?php }
if ($time11 > '89999' and $time11 < '172800') {?>2 дня<?php }
if ($time11 > '171799' and $time11 < '259200') {?>3 дня<?php }
if ($time11 > '259199' and $time11 < '345600') {?>4 дня<?php }
if ($time11 > '345599' and $time11 < '432000') {?>5 дней<?php }
if ($time11 > '431999' and $time11 < '518400') {?>6 дней<?php }
if ($time11 > '518399' and $time11 < '619200') {?>7 дней<?php }
if ($time11 > '619199' and $time11 < '777600') {?>8 дней<?php }
if ($time11 > '777599' and $time11 < '864000') {?>9 дней<?php }
if ($time11 > '863999' and $time11 < '950400') {?>10 дней<?php }
if ($time11 > '950399' and $time11 < '1036800') {?>11 дней<?php }
if ($time11 > '1036799' and $time11 < '1123200') {?>12 дней<?php }
if ($time11 > '1123199' and $time11 < '1209600') {?>13 дней<?php }
if ($time11 > '1209599' and $time11 < '1296000') {?>14 дней<?php }
if ($time11 > '1295999' and $time11 < '1382400') {?>15 дней<?php }
if ($time11 > '1382399' and $time11 < '1468800') {?>16 дней<?php }
if ($time11 > '1468799' and $time11 < '1555200') {?>17 дней<?php }
if ($time11 > '1555199' and $time11 < '1641600') {?>18 дней<?php }
if ($time11 > '1641599' and $time11 < '1728000') {?>19 дней<?php }
if ($time11 > '1727999' and $time11 < '1814400') {?>20 дней<?php }
if ($time11 > '1814399' and $time11 < '1900800') {?>21 день<?php }
if ($time11 > '1900799' and $time11 < '1987200') {?>22 дня<?php }
if ($time11 > '1987199' and $time11 < '2073600') {?>23 дня<?php }
if ($time11 > '2073599' and $time11 < '2160000') {?>24 дня<?php }
if ($time11 > '2159999' and $time11 < '2246400') {?>25 дней<?php }
if ($time11 > '2246399' and $time11 < '2332800') {?>26 дней<?php }
if ($time11 > '2332799' and $time11 < '2419200') {?>27 дней<?php }
if ($time11 > '2419199' and $time11 < '2505600') {?>28 дней<?php }
if ($time11 > '2505599' and $time11 < '2592000') {?>29 дней<?php }
if ($time11 > '2591999' and $time11 < '5184000') {?>1 месяц<?php }
if ($time11 > '5183999' and $time11 < '7776000') {?>2 месяца<?php }
if ($time11 > '7775999' and $time11 < '10368000') {?>3 месяца<?php }
if ($time11 > '10367999' and $time11 < '12960000') {?>4 месяца<?php }
if ($time11 > '12959999' and $time11 < '15552000') {?>5 месяцев<?php }
if ($time11 > '15551999' and $time11 < '18144000') {?>6 месяцев<?php }
if ($time11 > '18143999' and $time11 < '20736000') {?>7 месяцев<?php }
if ($time11 > '20735999' and $time11 < '23328000') {?>8 месяцев<?php }
if ($time11 > '23327999' and $time11 < '25920000') {?>9 месяцев<?php }
if ($time11 > '25919999' and $time11 < '28512000') {?>10 месяцев<?php }
if ($time11 > '28511999' and $time11 < '31104000') {?>11 месяцев<?php }
if ($time11 > '31103999' and $time11 < '62208000') {?>1 год<?php }
if ($time11 > '62207999' and $time11 < '93312000') {?>2 года<?php }
if ($time11 > '93311999' and $time11 < '186624000') {?>3 года<?php }
if ($time11 > '186623999' and $time11 < '279936000') {?>4 года<?php }
if ($time11 > '279935999' and $time11 < '373248000') {?>5 лет<?php }
if ($time11 > '373248000') {?>более 5 лет<?php }
?> назад<?php }
if ($device == '1') {?>
 [ <img src="img/mobile.png" alt="мобильное устройство"/> ]
<?php }
if ($device == '2') {?>
 [ <img src="img/pc.png" alt="компьютер"/> ] 
<?php }
?>



<br/>
<?php
if ($razn_last_act < 1800 and $user_id1 != $user_id) {?><img src="img/clock.png" width="12" height="12"/> <span class="white">Последнее действие: <?php
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
?> назад</span><br/><?php }?>
<img src="img/ico/lvl.gif" width="12" height="12"/> Уровень: <?php echo "$lvl";?> <?php if ($lvl != '59') {?><span class="net">(<?php echo "$proc1";?>%)</span><?php }?><br/>
<img src="img/2.gif" width="15" height="15"/> Статус: <?php if ($user_id == '10033') {?><span class="blue">Администратор</span><?php }?> <?php
if ($admin == '0' and $moder == '0' and $user == '1' and $ban == '0' and $ban_c1 == '0') {?>Игрок<?php }
if ($admin == '0' and $moder == '1' and $user == '0' and $ban == '0' and $ban_c1 == '0') {?><span class="bonus">Модератор</span><?php }
if ($admin == '1' and $moder == '0' and $user == '0' and $ban == '0' and $ban_c1 == '0' and $user_id <> '10033') {?><span class="blue">Администратор</span><?php }
if ($ban == '1' or $ban_c1 == '1') {?><span class="red">Заблокирован</span><?php }
?> <?php if ($prem == '1') {?>
<span class="gold">(VIP)</span>
<?php }?><br/>
<img src="img/ico/<?php
if ($gruppa == 'naemniki') {?>odinochki.png<?php }
if ($gruppa == 'svoboda') {?>svoboda.png<?php }
if ($gruppa == 'dolg') {?>dolg.png<?php }
if ($gruppa == 'mon') {?>monolit.png<?php }
?>
" width="12" height="12"/> Группировка: <?php
if ($gruppa == 'naemniki') {?>Одиночки<?php }
if ($gruppa == 'svoboda') {?>Свобода<?php }
if ($gruppa == 'dolg') {?>Долг<?php }
if ($gruppa == 'mon') {?>Монолит<?php }
?><br/>
<?php
if (!empty($clan)) {
$query_clan = "select name, clan_id, mentor from clans where clan_id = '$clan' limit 1";
$result_clan = mysqli_query($dbc, $query_clan) or die ('Ошибка передачи запроса к БД');
$row_clan = mysqli_fetch_array($result_clan); 
$mentor_clan = $row_clan['mentor'];
$mentor_time = strtotime("$mentor_time");
$razn_mentor_user = ($now - $mentor_time);
if ($razn_mentor_user < 3600) {
$mentor_flag = 1;
}
?>
<img src="img/ico/flag1.png" width="12" height="12"/> Отряд: <?php
if ($row['clan_rang'] == '1') {?><img src="img/rangs/rekryton.png" width="12" height="12" alt="н"/><?php }
if ($row['clan_rang'] == '2') {?><img src="img/rangs/ryadovoyon.png" width="12" height="12"alt="р"/><?php }
if ($row['clan_rang'] == '3') {?><img src="img/rangs/serjanton.png" width="12" height="12" alt="с"/><?php }
if ($row['clan_rang'] == '4') {?><img src="img/rangs/leitenanton.png" width="12" height="12" alt="л"/><?php }
if ($row['clan_rang'] == '5') {?><img src="img/rangs/kapitanon.png" width="12" height="12" alt="к"/><?php }
if ($row['clan_rang'] == '6') {?><img src="img/rangs/mayoron.png" width="12" height="12" alt="м"/><?php }
if ($row['clan_rang'] == '7') {?><img src="img/rangs/polkovnikon.png" width="12" height="12" alt="п"/><?php }
if ($row['clan_rang'] == '8') {?><img src="img/rangs/generalon.png" width="12" height="12" alt="г"/><?php }
if ($row['clan_rang'] == '9') {?><img src="img/rangs/zamon.jpg" width="12" height="12" alt="л"/><?php } 
if ($row['clan_rang'] == '10') {?><img src="img/rangs/lideron.png" width="12" height="12" alt="л"/><?php } 
?><a href="company.php?company_id=<?php echo "$clan";?>"><?php echo "$clan_name";?></a> (<?php
if ($row['clan_rang'] == '1') {?>Рекрут<?php }
if ($row['clan_rang'] == '2') {?>Рядовой<?php }
if ($row['clan_rang'] == '3') {?>Сержант<?php }
if ($row['clan_rang'] == '4') {?>Лейтенант<?php }
if ($row['clan_rang'] == '5') {?>Капитан<?php }
if ($row['clan_rang'] == '6') {?>Майор<?php }
if ($row['clan_rang'] == '7') {?>Полковник<?php }
if ($row['clan_rang'] == '8') {?>Генерал<?php }
if ($row['clan_rang'] == '9') {?>Маршал<?php } 
if ($row['clan_rang'] == '10') {?>Лидер<?php } 
?>)<br/><?php }?>
<img src="img/slava.png" width="15" height="15"/> Слава: <?php echo "$slava";?><br/>
<?php if ($row['sex'] == male) {?><img src="img/man.png" width="12" height="12"/><?php } else {?><img src="img/women.png" width="12" height="12"/><?php }?> Пол: <span class="white"><?php if ($row['sex'] == male) {?>мужской<?php } else {?>женский<?php }?></span><br/>
<?php if ($clan_rang1 > '5' and $clan1 != '0' and $clan == '0' and $gruppa1 == $gruppa and $lvl > '4' and $warr != '1') {?>
<img src="img/ico/flag1.png"  alt=""width="12" height="12"/> <a href="invite.php?set_id=<?php echo "$user_id";?>">Пригласить в отряд</a><br/>
<?php }?>
<?php if ($user_id1 == '10033') {?>
<img src="img/ico/money.png" alt="RUB"> <span style="color: orange;">Вложено:</span> <span class="bonus"><?php echo "$bought";?>р.</span><br/>
<?php }?>
</p>
</div>
</div>
<?php if ($vid != 'stats' and $vid != 'dos' and $vid != 'mod' and $vid != 'adm') {
$vid = 'gl';
}
?>
<?php if (empty($vid) or $vid == 'gl') {?>
<div class="stats">
<a href="user.php?id=<?php echo "$user_id";?>&vid=stats" class="menu"><img src="img/ico/shield.png" width="12" height="12"/> Характеристики</a>
<?php if (!empty($row_an)) {?><a href="anketa.php?id=<?php echo "$user_id";?>" class="menu"><img src="img/ank27.png" alt="п"width="12" height="12"/> Анкета</a><?php }?>
<a href="user.php?id=<?php echo "$user_id";?>&vid=dos" class="menu"><img src="img/dos.png" alt="п"width="12" height="12"/> Достижения</a>
<?php if ($user_id == $user_id1) {?><p class="menu"><img src="img/ico/ohotniki.gif" width="12" height="12"/> Напасть</p><?php } else {?><a href="arenaon1.php?id=<?php echo "$user_id";?>" class="menu"><img src="img/ico/ohotniki.gif" width="12" height="12"/> Напасть <span class="red">(-<?php echo "$h_lvl";?><img src="img/ico/materials.png"/>)</span></a><?php }?>
<?php if ($user_id == $user_id1) {?><p class="menu"><img src="img/ico/mail2.png" width="12" height="12"/> Отправить сообщение</p><?php } else {?><a href="mail4.php?id=<?php echo "$user_id";?>" class="menu"><img src="img/ico/mail2.png" width="12" height="12"/> Отправить сообщение</a><?php }?>
<?php if ($moder1 == '1') {?><a href="user.php?id=<?php echo "$user_id";?>&vid=mod" class="menu"> Модер-панель</a><?php }?>
<?php if ($admin1 == '1') {?><a href="user.php?id=<?php echo "$user_id";?>&vid=adm" class="menu"> Админ-панель</a><?php }?>
</div>
<?php }
if ($vid == 'stats') {?>
  <div id="clothes"><center>
	<?php
	$query_cl = "Select inf_id from things where user_id = '$user_id' and type = '4' and place = 2 limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	if ($row_cl != 0) {
	$helmet_id = $row_cl['inf_id'];
	$query_cl = "Select screen from helmets where helmet_id = '$helmet_id' limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	?><p><span class="cloth"><img src="img/helmets/<?php echo $row_cl['screen'];?>" width="39" height="39" /></span></p><?php }else{?><p><img src="img/helmets/0.png" alt="Слот №1" width="39" height="39" /></p><?php }
	////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////<p>
	$query_cl = "Select inf_id from things where user_id = '$user_id' and type = '1' and place = 2 limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	if ($row_cl != 0) {
	$clothes_id = $row_cl['inf_id'];
	$query_cl = "Select screen from clothes where clothes_id = '$clothes_id' limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	?><span class="cloth"><img src="img/clothes/<?php echo $row_cl['screen'];?>" width="50" height="50" /></span><?php }else{?><img src="img/clothes/0.png" alt="Слот №1" width="50" height="50" /><?php }
	////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////
	$query_cl = "Select inf_id from things where user_id = '$user_id' and type = '2' and place = 2 limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	if ($row_cl != 0) {
	$pistols_id = $row_cl['inf_id'];
	$query_p = "Select screen from pistols where pistols_id = '$pistols_id'";
	$result_p = mysqli_query($dbc, $query_p) or die ('Ошибка передачи запроса к БД');
	$row_p = mysqli_fetch_array($result_p);
	?><span class="cloth"><img src="img/weapons/<?php echo $row_p['screen'];?>" width="50" height="50" /></span><?php }else{?> <span class="cloth"><img src="img/weapons/0pistol.png" width="50" height="50" /></span><?php }
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	$query_cl = "Select inf_id from things where user_id = '$user_id' and type = '3' and place = 2 limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	if ($row_cl != 0) {
	$weapons_id = $row_cl['inf_id'];
	$query_w = "Select screen from weapons where weapons_id = '$weapons_id'";
	$result_w = mysqli_query($dbc, $query_w) or die ('Ошибка передачи запроса к БД');
	$row_w = mysqli_fetch_array($result_w);
	  ?><p><span class="cloth"><img src="img/weapons/<?php echo $row_w['screen'];?>" width="145" height="50"/></span></p><?php } else { ?><p><span class="cloth"><img src="img/weapons/0weapon.png" width="145" height="50"/></span></p><?php } ?>
	<?php
	$query_cl = "Select inf_id from things where user_id = '$user_id' and type = '6' and place = 2 limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	if ($row_cl != 0) {
	$art_id = $row_cl['inf_id'];
	$query_cl = "Select screen, name from art where art_id = '$art_id' limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	?><p><a href="boroda.php?type=2"><span class="clothes"><img src="img/art/<?php echo $row_cl['screen'];?>"/></span></a><?php }else{?><p><img src="img/helmets/0.png" alt="Слот №1" width="39" height="39" /><?php } ?>
	<?php
	$query_cl = "Select inf_id from things where user_id = '$user_id' and type = '7' and place = 2 limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	if ($row_cl != 0) {
	$dec_id = $row_cl['inf_id'];
	$query_cl = "Select screen, name from detectors where dec_id = '$dec_id' limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	?><a href="boroda.php?type=3"><span class="clothes"><img src="img/dec/<?php echo $row_cl['screen'];?>" <?php if ($row_cl['screen'] == 'otklik.gif') {?>width="65" height="75"<?php } else {?>width="66" height="65"<?php }?> /></span></a></p><?php }else{?> <img src="img/helmets/0.png" alt="Слот №1" width="39" height="39" /></p><?php } ?>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<p><a href="clothes.php?id=<?php echo "$user_id";?>" class="menu">Снаряжение</a></p>
</center>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
  <p><img src="img/ico/life.png" width="12" height="12"/> здоровье: 
  <?php $max_hp = ($row['max_hp']+$row['max_hp']/100*$mentor_clan); $max_hp = round($max_hp);?><span class="white"><?php echo $row['hp']; ?> || <?php echo "$max_hp";?></span></p>
  <p><img src="img/ico/shield.png" width="12" height="12"/> броня:
  <?php $bronya = ($row['bronya']+$row['bronya']/100*$mentor_clan); $bronya = round($bronya);?><span class="white"><?php echo "$bronya";?></span></p>
  <p><img src="img/ico/shield.png" width="12" height="12"/> прочность:
  <?php $razriv_cl = ($row['razriv_cl']+$row['razriv_cl']/100*$mentor_clan); $razriv_cl = round($razriv_cl);?><span class="white"> <?php echo "$razriv_cl";?></span></p>
  <p><img src="img/ico/goodrad.png" width="12" height="12"/> рад.защита:
  <?php $radiation = ($row['radiation']+$row['radiation']/100*$mentor_clan); $radiation = round($radiation);?><span class="white"> <?php echo "$radiation";?></span></p>
  <p><img src="img/ico/regen.gif" width="12" height="12"/> регенерация: <span class="white"><?php echo $row['regen']; ?></span></p>

  <div class="block">
  <p><img src="img/ico/to4nost.png" width="12" height="12"/> урон: <?php $yron_p = ($row['yron_p']+$row['yron_p']/100*$mentor_clan); $yron_p = round($yron_p);?><span class="white"> <?php echo "$yron_p";?></span> ||
 <?php $yron_w = ($row['yron_w']+$row['yron_w']/100*$mentor_clan); $yron_w = round($yron_w);?><span class="white"> <?php echo "$yron_w";?></span></p>
  
  <p><img src="img/ico/to4nost.png" width="12" height="12"/> точность: <?php $tochn_p = ($row['tochn_p']+$row['tochn_p']/100*$mentor_clan); $tochn_p = round($tochn_p);?><span class="white"> <?php echo "$tochn_p";?></span> || 
  <?php $tochn_w = ($row['tochn_w']+$row['tochn_w']/100*$mentor_clan); $tochn_w = round($tochn_w);?><span class="white"> <?php echo "$tochn_w";?></span></p>
  
  <p><img src="img/ico/to4nost.png" width="12" height="12"/> надёжность: <span class="white"><?php echo $row['safety_p'];?> </span> || <span class="white"><?php echo $row['safety_w']; ?>%</span></p>
  <p><img src="img/ico/speed.png" width="12" height="12"/> скорострельность: <span class="white"><?php echo $row['speed_p'];?> </span>|| <span class="white"><?php echo $row['speed_w']; ?></span></p>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<a href="user.php?id=<?php echo "$user_id";?>" class="menu"><img src="img/reload.gif" width="15" height="15"/> Назад</a>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php }
?>
<?php }
if ($vid == 'dos') {?>
<p><img src="img/ico/letterin1.png"/> Побед: <span class="white"><?php echo $row['win']; ?></span></p>
<p><img src="img/ico/letterout1.png"/> Поражений: <span class="white"><?php echo $row['last']; ?></span></p>
<p><img src="img/ico/ohotniki.gif" width="12" height="12"/> Убито мутантов: <span class="white"><?php echo $row['m_kill']; ?></span></p>
<p><img src="img/ico/time.png"/> Время взлома тайников: <span class="white"><?php echo $row['tainik_time']; ?></span> секунд</p>
<p><img src="img/ico/yes.png"/> Выполнено заданий: <span class="white"><?php echo $row['quests']; ?></span></p>
<p><img src="img/ico/regen.gif"/> Найдено артефактов: <span class="white"><?php echo $row['art_n']; ?></span></p>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<a href="user.php?id=<?php echo "$user_id";?>" class="menu"><img src="img/reload.gif" width="15" height="15"/> Назад</a>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php }
if ($vid == 'mod') {?>
<?php if ($moder1 != '1') {?>
<script type="text/javascript">
  document.location.href = "user.php?id=<?php echo "$user_id";?>";
</script>
<?php
exit();
}
?>
<?php if ($user_id != '10033') {?>
<center>
<p class="podmenu" style="border-top:1px dashed #444e4f; background-color:#1c252f;"></p>
<p class="gold">Персонажи: <span class="blue">(</span><span class="white"><?php echo "$ip_r" ; ?></span><span class="blue">)</span></p>
<?php
$query_sub = "Select * from users where ip = '$ip_r' and id <> '10033' and last_active > NOW() - (240000) order by lvl desc limit 50";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$id_top = $row_sub['id'];
$name = $row_sub['nick'];
$group = $row_sub['gruppa'];
$block = $row_sub['ban'];
?>
<p><?php
if ($group == 'dolg' and $block == '0') {?><img src="img/ico/dolg.png"/> <?php }
if ($group == 'naemniki' and $block == '0') {?><img src="img/ico/odinochki.png"/> <?php }
if ($group == 'svoboda' and $block == '0') {?><img src="img/ico/svoboda.png"/> <?php }
if ($group == 'mon' and $block == '0') {?><img src="img/ico/monolit.png"/> <?php }
if ($block == '1') {?><img src="img/block.png" width="12" height="12"/> <?php }
?><a href="profile.php?id=<?php echo "$id_top" ; ?>"><?php echo "$name" ; ?></a></p>
<?php } ?>
<p class="podmenu" style="border-top:1px dashed #444e4f; background-color:#1c252f;"></p>
</center>
<?php }?><center>
<p style="border-style: solid; border-width: 1px; border-color: #444e4f;"><span class="bonus">---</span><br />(модер-панель)<br />
<a class="menu" href="ban.php?id=<?php echo "$user_id";?>">Забанить</a>
<span class="bonus">---</span><br/></center>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<a href="user.php?id=<?php echo "$user_id";?>" class="menu"><img src="img/reload.gif" width="15" height="15"/> Назад</a>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php }
if ($vid == 'adm') {?>
<?php if ($admin1 != '1') {?>
<script type="text/javascript">
  document.location.href = "user.php?id=<?php echo "$user_id";?>";
</script>
<?php
exit();
}
?>
<?php if ($user_id != '10033') {?>
<center>
<p class="podmenu" style="border-top:1px dashed #444e4f; background-color:#1c252f;"></p>
<p class="gold">Персонажи: <span class="blue">(</span><span class="white"><?php echo "$ip_r" ; ?></span><span class="blue">)</span></p>
<?php
$query_sub = "Select * from users where ip = '$ip_r' and id <> '10033' and last_active > NOW() - (240000) order by lvl desc limit 50";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$id_top = $row_sub['id'];
$name = $row_sub['nick'];
$group = $row_sub['gruppa'];
$block = $row_sub['ban'];
?>
<p><?php
if ($group == 'dolg' and $block == '0') {?><img src="img/ico/dolg.png"/> <?php }
if ($group == 'naemniki' and $block == '0') {?><img src="img/ico/odinochki.png"/> <?php }
if ($group == 'svoboda' and $block == '0') {?><img src="img/ico/svoboda.png"/> <?php }
if ($group == 'mon' and $block == '0') {?><img src="img/ico/monolit.png"/> <?php }
if ($block == '1') {?><img src="img/block.png" width="12" height="12"/> <?php }
?><a href="profile.php?id=<?php echo "$id_top" ; ?>"><?php echo "$name" ; ?></a> [<a href="moderator.php?profile=<?php echo "$id_top" ; ?>&type=8" onclick="return confirm
('Уверены?')">бан</a>]</p>
<?php } ?>
</center>
<?php }?><br/>

<center>
<p class="podmenu" style="border-top:1px dashed #444e4f; background-color:#1c252f;"></p>
<p class="gold">Персонажи: <span class="blue">(</span><span class="white"><?php echo "$agent" ; ?></span><span class="blue">)</span></p>
<?php
$query_sub = "Select * from users where user_agent = '$agent' and id <> '10033' and last_active > NOW() - (240000) order by lvl desc limit 50";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$id_top = $row_sub['id'];
$name = $row_sub['nick'];
$group = $row_sub['gruppa'];
$block = $row_sub['ban'];
?>
<p><?php
if ($group == 'dolg' and $block == '0') {?><img src="img/ico/dolg.png"/> <?php }
if ($group == 'naemniki' and $block == '0') {?><img src="img/ico/odinochki.png"/> <?php }
if ($group == 'svoboda' and $block == '0') {?><img src="img/ico/svoboda.png"/> <?php }
if ($group == 'mon' and $block == '0') {?><img src="img/ico/monolit.png"/> <?php }
if ($block == '1') {?><img src="img/block.png" width="12" height="12"/> <?php }
?><a href="profile.php?id=<?php echo "$id_top" ; ?>"><?php echo "$name" ; ?></a> [<a href="moderator.php?profile=<?php echo "$id_top" ; ?>&type=8" onclick="return confirm
('Уверены?')">бан</a>]</p>
<?php } ?>
</center>
<p class="podmenu" style="border-top:1px dashed #444e4f; background-color:#1c252f;"></p>
<center>
<?php
$query_sub = "Select * from users where user_agent = '$agent' and id <> '10033' order by lvl desc limit 50";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$id_top = $row_sub['id'];
$name = $row_sub['nick'];
$group = $row_sub['gruppa'];
$block = $row_sub['ban'];
?>
<p><?php
if ($group == 'dolg' and $block == '0') {?><img src="img/ico/dolg.png"/> <?php }
if ($group == 'naemniki' and $block == '0') {?><img src="img/ico/odinochki.png"/> <?php }
if ($group == 'svoboda' and $block == '0') {?><img src="img/ico/svoboda.png"/> <?php }
if ($group == 'mon' and $block == '0') {?><img src="img/ico/monolit.png"/> <?php }
if ($block == '1') {?><img src="img/block.png" width="12" height="12"/> <?php }
?><a href="profile.php?id=<?php echo "$id_top" ; ?>"><?php echo "$name" ; ?></a> [<a href="moderator.php?profile=<?php echo "$id_top" ; ?>&type=8" onclick="return confirm
('Уверены?')">бан</a>]</p>
<?php } ?>
</center>

<p class="podmenu" style="border-top:1px dashed #444e4f; background-color:#1c252f;"></p>
<?php if ($user_id1 == '10033') {?>
<a class="menu" href="/admin/index.php?id1=<?php echo "$user_id";?>">Просмотр почты</a>
<?php }?>
<a class="menu" href="ban.php?id=<?php echo "$user_id";?>">Забанить</a>
<a class="menu" href="ban_agent.php?id=<?php echo "$user_id";?>">Забанить по агенту</a>
<?php if ($row['ban'] == 0) {?>
<a href="moderator.php?profile=<?php echo "$user_id"; ?>&type=8" class="menu">Вечный бан на игру</a><?php } else {?><a href="anti-ban.php?id=<?php echo "$user_id";?>"  class="menu">Снять вечный бан</a><?php }?>
<a href="change_user.php?id=<?php echo "$user_id";?>" class="menu">Редактировать персонажа</a>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<a href="user.php?id=<?php echo "$user_id";?>" class="menu"><img src="img/reload.gif" width="15" height="15"/> Назад</a>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php }
?>
</div>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>