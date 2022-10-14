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
$page_title = 'Отряд';
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
$rang_out = $roww['clan_rang'];
$gruppa1 = $roww['gruppa'];
$querylkj = "Select * from clans where clan_id='$clan1' limit 1";
$resultlkj = mysqli_query($dbc, $querylkj) or die ('Ошибка передачи запроса к БД');
$rowlkj = mysqli_fetch_array($resultlkj);
$wash_war = $rowlkj['war'];
$winn = $rowlkj['win'];
$overr = $rowlkj['over'];
$time_war1 = ($rowlkj['time_war'] + 50000);
$kof1 = ($winn - $overr);
if ($kof1 < '1') {
$kof1 = '0';
}
$clan_id = $_GET['id'];
if (empty($clan_id)) {
$clan_id = $clan1;
}
$vid = $_GET['vid'];
$query = "Select * from clans where clan_id='$clan_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$clan_id = $row['clan_id'];
$name = $row['name'];
$mentor = $row['mentor'];
$clan_opit = $row['clan_opit'];
$gruppa = $row['gruppa'];
$slava = $row['slava'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$warr = $row['war'];
$stalkers = $row['stalkers'];
$war_id = $row['war_id'];
$win = $row['win'];
$over = $row['over'];
$rating = $row['rating'];
$nadpis = $row['nadpis'];
$long_text = strlen("$nadpis");
$clan_money = $row['clan_money'];
$clan_habar = $row['clan_habar'];
$st_war = $row['st_war'];
$time_war = $row['time_war'];
$time_war = strtotime("$time_war");
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$time_llast = ($time_war + '18000');
$time_asus = ($time_llast - $now);
$kof = ($win - $over);
if ($kof < '1') {
$kof = '0';
}
if ($war_id != '0') {
$query = "Select * from clans where clan_id='$war_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$rowqa = mysqli_fetch_array($result);
$nameqa = $rowqa['name'];
$grqa = $rowqa['gruppa'];
}
$query_c = "Select id from users where clan = '$clan_id' and last_active > NOW() - (3000)";
$result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
$row_c = mysqli_num_rows($result_c);
$query_num2 = "Select id from users where clan='$clan_id' " ;
$result_num2 = mysqli_query($dbc, $query_num2) or die ('Ошибка передачи запроса к БД');
$sostav = mysqli_num_rows($result_num2); 
?>
<?php
if ($stalkers == '3') {
$cash = '30000';
}
if ($stalkers == '4') {
$cash = '60000';
}
if ($stalkers == '5') {
$cash = '100000';
}
if ($stalkers == '6') {
$cash = '200000';
}
if ($stalkers == '7') {
$cash = '300000';
}
if ($stalkers == '8') {
$cash = '500000';
}
if ($stalkers == '9') {
$cash = '1000000';
}
if ($stalkers > '9' and $stalkers < '31') {
$cash = ($stalkers * 300000);
}
if ($stalkers > '30' and $stalkers < '36') {
$cash = ($stalkers * 500000);
}
if ($stalkers > '35') {
$cash = ($stalkers * 550000);
}
?>
<?php
$query_lvl = "Select lvl, opit from clan_opit order by lvl desc";
$result_lvl = mysqli_query($dbc, $query_lvl) or die ('Ошибка передачи запроса к БД');
$row_lvl = mysqli_fetch_array($result_lvl);
$big_next_lvl = $row_lvl['opit'];
$lvl=$row_lvl['lvl'];
while (($clan_opit/1000)< $row_lvl['opit']) {
$next_lvl = $row_lvl['opit'];
$lvl=($lvl-1);
$row_lvl = mysqli_fetch_array($result_lvl);
}
if ($next_lvl == 0) {
$next_lvl = "$big_next_lvl" ;
} 
$next_lvl = ($next_lvl/100);
$clan_opit = ($clan_opit/100000);
$clan_opit = round($clan_opit,2);
$proc1 = ('100' / $next_lvl);
$proc1 = ($proc1 * $clan_opit);
$proc1 = round("$proc1");
$lalsw = ($cash / '100');
$lalsw2 = ('100' - $lvl);
$cash = ($lalsw2 * $lalsw);
?>
<?php if ($row == 0 or $clan_id == '0') {?>
<div class="stats">
<p class="red">Такого отряда нет!</p>
</div>
<?php } else {?>
<?php if ($_GET['err'] == '1') {?>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<b><span class="red">Такой отряд уже есть</b></span>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php }?>
<?php if ($_GET['err'] == '2') {?>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<b><span class="red">Недостаточно средств</b></span>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php }?>
<?php if ($war_id != '0' and $warr == '0' and $clan1 == $clan_id) {?>
<span class="white"><b>Последняя битва:</b></span><br/>
<img src="img/ico/otryad.gif"/> Битва с отрядом <img src="img/ico/<?php
if ($grqa == 'naemniki') {?>odinochki.png<?php }
if ($grqa == 'svoboda') {?>svoboda.png<?php }
if ($grqa == 'dolg') {?>dolg.png<?php }
if ($grqa == 'mon') {?>monolit.png<?php }
?>"/><a href="clan.php?id=<?php echo "$war_id";?>"><?php echo "$nameqa";?></a>, которая была <?php if ($st_war == '1') {?>выиграна<?php } else {?>проиграна<?php }?>.
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php }?>
<?php if ($clan1 == $clan_id) {?>
<div class="stats">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"><?php echo "$name";?></p>

<div style="background-color: #0b0b0b;">
<?php if ($row['gerb'] > '0') {?><img src="img/gerb/<?php echo $row['gerb']; ?>.jpg" class="upl"/><?php } else {?><img src="img/gerb/<?php
if ($gruppa == 'naemniki') {?>o<?php }
if ($gruppa == 'svoboda') {?>s<?php }
if ($gruppa == 'dolg') {?>d<?php }
if ($gruppa == 'mon') {?>m<?php }
?>.jpg"/><?php }?></center>
</div>

<div style="color:#B5B5B5;
font-size:14px;
font-weight:bold;
margin-top: 4px;
margin-bottom: 4px;
background: url(http://stalkeronlinegame.epizy.com/style/img/title.png) 100% no-repeat;
background-size: cover;">
<?php if ($long_text > 0) {?><?php echo "$nadpis";?><?php } else {?><?php
if ($gruppa == 'naemniki') {?>Вступайте в ряды Одиночек!<?php }
if ($gruppa == 'svoboda') {?>Вступайте в ряды Свободы!<?php }
if ($gruppa == 'dolg') {?>Вступайте в ряды Долга!<?php }
if ($gruppa == 'mon') {?>Вступи в Монолит, уничтожь неверных!<?php }
?><?php }?></div>
<div style="background-color: #1E1E1E;">
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<p class="white">
<img src="img/ico/lvl.gif" width="12" height="12"/> Уровень: <?php echo "$lvl";?> <span class="net">(<?php echo "$proc1";?>%)</span><br/>
<img src="img/star.png" width="12" height="12"/> Опыт: <span class="white"><?php echo "$clan_opit"; ?>к / <?php echo "$next_lvl";?>к</span><br/>
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
<img src="img/ico/chel.png" width="12" height="12"/> Состав: [<?php echo "$sostav";?> / <?php echo "$stalkers";?>] <?php if ($clan1 == $clan_id and $rang_out > '7' and $stalkers < '50') {?><small>[<a href="aaa.php" onclick="return confirm ('Уверены?')">+1</a>] (-<img src="img/ico/materials.png"/><?php echo "$cash";?> <small><span class="lal2">[-<?php echo "$lvl";?>%]</span></small>)</small><?php }?><br/>
<img src="img/slava.png" width="15" height="15"/> Слава: <?php echo "$slava";?><br/>
<?php if ($wash_war == '0' and $time_asus > '1') {?><img src="img/ico/time.png"/> Окончание отдыха через 
<?php
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
$time44 = ($time111 - '10800');
if ($time111 > '10799' and $time111 < '14400') {?>3 часа <?php if ($time44 > '59' and $time44 < '120') {?>1 минуту<?php }
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
$time44 = ($time111 - '14400');
if ($time111 > '14399' and $time111 < '18000') {?>4 часа <?php if ($time44 > '59' and $time44 < '120') {?>1 минуту<?php }
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
if ($time111 > '17999') {?>5 часов<?php }
?><br/>
<?php }?>
</p>
</div>
<?php if ($vid != 'sost' and $vid != 'dos' and $vid != 'mod' and $vid != 'adm') {
$vid = 'gl';
}
?>
<?php if (empty($vid) or $vid == 'gl') {?>
<div class="stats">
<a href="clan.php?id=<?php echo "$clan_id";?>&vid=sost" class="menu"><img src="img/ico/chel.png" width="12" height="12"/> Сталкеры отряда</a>
<a href="csklad.php?id=<?php echo "$clan_id";?>" class="menu"><img src="img/m-maintain.png" alt="п"width="12" height="12"/> Склад</a>
<a href="c_bonus.php" class="menu"><img src="img/m-ext.png" alt="п"width="12" height="12"/> Бонусы отряда</a>
<a href="cava.php" class="menu"><img src="img/ico/<?php
if ($gruppa == 'naemniki') {?>odinochki.png<?php }
if ($gruppa == 'svoboda') {?>svoboda.png<?php }
if ($gruppa == 'dolg') {?>dolg.png<?php }
if ($gruppa == 'mon') {?>monolit.png<?php }
?>
" width="12" height="12"/> Герб</a>
<a href="clan.php?id=<?php echo "$clan_id";?>&vid=dos" class="menu"><img src="img/dos.png" width="12" height="12"/> Достижения</a>
<?php if ($wash_war == '0' and $rang_out > '7' and $sostav > '4') {?><a href="scb.php" class="menu"><img src="img/ico/flag1.png" alt="п"width="12" height="12"/> Выбрать отряд для битвы</a>
<?php }?>
<a href="forum.php?type=company&company=<?php echo "$clan_id"?>" class="menu"><img src="img/ico/forum_new.png" width="12" height="12"/> Форум</a>
<a href="clanmail.php" class="menu"><img src="img/m-antispam.png" width="12" height="12"/>  Почта отряда</a>
<?php if ($rang_out > '5') {?><a href="ccs.php" class="menu"><img src="img/ico/remont.png" alt="п"width="12" height="12"/> Управление отрядом</a>
<?php }?>
<?php if ($rang_out < '10' and $wash_war == '0') {?><a href="agree.php?inf=company" class="menu"><img src="img/ico/point.png" width="12" height="12"/> Покинуть отряд</a>
<?php }?>
<?php if ($sostav == '1' and $wash_war == '0') {?><a href="agree.php?inf=company" class="menu"><img src="img/ico/point.png" width="12" height="12"/> Покинуть отряд</a>
<?php }?>
</div>
<?php }
if ($vid == 'sost') {?>
	<?php
	if (!empty($_GET['page'])) {
	$cur_page = $_GET['page'];
	}
	else {
	$cur_page = 1;
	}
	$result_per_page = 10;
	$skip = (($cur_page - 1) * $result_per_page);
	$num_page = ceil($sostav / $result_per_page);
	if ($num_page > 0) {
	  $query_us = "Select nick ,id, clan_rang, ko, last_active  from users where clan = '$clan_id' order by `on` DESC, clan_rang DESC, ko DESC limit $skip, $result_per_page";
      $result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
	  while ($row_us = mysqli_fetch_array($result_us)) {
	    $nick = $row_us['nick'];
	    $clan_rang = $row_us['clan_rang'];
	    $id_us = $row_us['id'];
		$ko = $row_us['ko'];
		$ko = ($ko/100000);
		$ko = round($ko,2);
		$last_active = $row_us['last_active'];
		$last_active = strtotime("$last_active");
		$now = (date("Y-m-d H:i:s"));
        $now = strtotime("$now");
		$razn_last_act = ($now - $last_active);
	    ?>
	    <div class="zx">
		<?php
	  if ($row_us['clan_rang'] == '1') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/rekryt.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/rangs/rekryton.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_us['clan_rang'] == '2') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/ryadovoy.png" width="12" height="12"alt="р"/><?php } else {?><img src="img/rangs/ryadovoyon.png" width="12" height="12"alt="р"/><?php }}
	  if ($row_us['clan_rang'] == '3') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/serjant.png" width="12" height="12" alt="с"/><?php } else {?><img src="img/rangs/serjanton.png" width="12" height="12" alt="с"/><?php }}
	  if ($row_us['clan_rang'] == '4') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/leitenant.png" width="12" height="12" alt="л"/><?php } else {?><img src="img/rangs/leitenanton.png" width="12" height="12" alt="л"/><?php }}
	  if ($row_us['clan_rang'] == '5') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/kapitan.png" width="12" height="12" alt="к"/><?php } else {?><img src="img/rangs/kapitanon.png" width="12" height="12" alt="к"/><?php }}
	  if ($row_us['clan_rang'] == '6') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/mayor.png" width="12" height="12" alt="м"/><?php } else {?><img src="img/rangs/mayoron.png" width="12" height="12" alt="м"/><?php }}
	  if ($row_us['clan_rang'] == '7') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/polkovnik.png" width="12" height="12" alt="п"/><?php } else {?><img src="img/rangs/polkovnikon.png" width="12" height="12" alt="п"/><?php }}
	  if ($row_us['clan_rang'] == '8') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/general.png" width="12" height="12" alt="г"/><?php } else {?><img src="img/rangs/generalon.png" width="12" height="12" alt="г"/><?php }}
	  if ($row_us['clan_rang'] == '9') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/zamoff.jpg" width="12" height="12" alt="л"/><?php } else {?><img src="img/rangs/zamon.jpg" width="12" height="12" alt="л"/><?php }} 
	  if ($row_us['clan_rang'] == '10') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/lider.png" width="12" height="12" alt="л"/><?php } else {?><img src="img/rangs/lideron.png" width="12" height="12" alt="л"/><?php }} 
	  ?>
	  <span class="white"><a href="profile.php?id=<?php echo "$id_us"; ?>"><?php echo "$nick";?></a> (<?php echo "$ko";?>к)</span> <?php if ($clan1 == $clan_id and $rang_out>$clan_rang) { if ($rang_out>($clan_rang+1)) {?>[<a href="rang.php?inf=up&id=<?php echo "$id_us";?>">Повысить</a>]<?php }  if (0<($clan_rang-1)) {?> [<a href="rang.php?inf=down&id=<?php echo "$id_us";?>">Понизить</a>]<?php } ?> [<a href="agree.php?inf=outuser&id=<?php echo "$id_us";?>">Исключить</a>]<?php }?> <?php if ($rang_out == '10' and $user_id1 != $id_us and $clan1 == $clan_id) {?>[<a href="lider.php?id=<?php echo "$id_us";?>"  onclick="return confirm
('Уверены, что хотите сделать этого игрока лидером отряда? Вы будете понижены до генерала.')">+Лидер</a>]<?php }?></div>
	  
	    <?php
	  }
	  ?>
	  <div class="zx">
<center>
	  <?php
	  $phpself= $_SERVER['PHP_SELF'];
	  $phpself = htmlentities($phpself, ENT_QUOTES);
$rule = 'sost';
	  if ($cur_page > 1) {
	  echo ' <a href="' . "$phpself" .  '?page=' . (1) . '&id=' .$clan_id . '&vid=' . $rule . '"><<</a> ';
      }
	  else {
	    echo '<< ';
	  }
	  if ($cur_page > 1) {
	    echo '<a href="' . "$phpself" . '?page=' . ($cur_page-1) . '&id=' .$clan_id . '&vid=' . $rule . '"><</a> ';
      }
	  else {
	    echo '<';
	  }
	/////
	  if (($cur_page-3)>0) {
	 $k = ($cur_page-3);
	    ?><a href="<?php echo "$phpself" . '?page=' . ($cur_page-3). '&id=' .$clan_id . '&vid=' . $rule  ?>"><?php echo "$k";?></a><?php
      }
	 if (($cur_page-2)>0) {
	 $k = ($cur_page-2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-2). '&id=' .$clan_id . '&vid=' . $rule?>"><?php echo "$k";?></a> <?php
      }
     if (($cur_page-1)>0) {
	 $k = ($cur_page-1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-1). '&id=' .$clan_id  . '&vid=' . $rule?>"><?php echo "$k";?></a> <?php
      }
	?> <span class="white"><?php echo " $cur_page ";?></span><?php
	 if (($cur_page+1)<=$num_page) {
	 $k = ($cur_page+1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+1). '&id=' .$clan_id . '&vid=' . $rule?>"><?php echo "$k";?></a> <?php
      }
	  	 if (($cur_page+2)<=$num_page) {
	 $k = ($cur_page+2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+2). '&id=' .$clan_id . '&vid=' . $rule ?>"><?php echo "$k";?></a> <?php
      }
	 if (($cur_page+3)<=$num_page) {
	 $k = ($cur_page+3);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+3). '&id=' .$clan_id . '&vid=' . $rule ?>"><?php echo "$k";?></a> <?php
      }
	/////
	if ($cur_page < $num_page) {
	  echo '<a href="' . "$phpself" . '?page=' . ($cur_page+1). '&id=' .$clan_id  . '&vid=' . $rule . '">></a> ';
    }
	else {
	  echo '>';
	}
	if ($cur_page < $num_page) {
	  echo ' <a href="' . "$phpself" .  '?page=' . $num_page . '&id=' .$clan_id . '&vid=' . $rule .  '">>></a> ';
    }
	else {
	  echo ' >>';
	}
	}
	?>
</center>
	</div>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php }
if ($vid == 'dos') {?>
<div class="stats">
<p><img src="img/star.png" width="12" height="12"/> Ранг: <span class="white"><?php echo "$rating"; ?></span></p>
<p><img src="img/ico/letterin1.png" width="12" height="12"/> Побед: <span class="white"><?php echo "$win"; ?></span></p>
<p><img src="img/ico/letterout1.png" width="12" height="12"/> Поражений: <span class="white"><?php echo "$over"; ?></span></p>
<p><img src="img/ico/link.png" width="12" height="12"/> Победность: <span class="white"><?php $qp = ($win + $over); $qp1 = ('100' / $qp); $qp2 = ($qp1 * $win); $qp2 = round("$qp2"); echo "$qp2";?>%</span></p>
</div>
<?php }
?>
<?php if ($vid == 'sost') {?>
<a href="onlinecom.php?company_id=<?php echo "$clan_id";?>" class="menu"><img src="img/ico/on.png" width="15" height="15"/> Онлайн <span class="white"><?php echo "$row_c";?></span></a>
<?php }?>
<?php if ($vid != 'gl' and !empty($vid)) {?>
<div class="stats">
<a href="clan.php?id=<?php echo "$clan_id";?>&vid=gl" class="menu"><img src="img/reload.gif" width="15" height="15"/> Назад</a>
</div>
<?php }?>


<?php } else {?>
<div class="stats">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"><img src="img/ico/<?php
if ($gruppa == 'naemniki') {?>odinochki.png<?php }
if ($gruppa == 'svoboda') {?>svoboda.png<?php }
if ($gruppa == 'dolg') {?>dolg.png<?php }
if ($gruppa == 'mon') {?>monolit.png<?php }
?>"/><?php echo "$name";?></p>
<div style="background-color: #0b0b0b;">
<?php if ($row['gerb'] > '0') {?><img src="img/gerb/<?php echo $row['gerb']; ?>.jpg" class="upl"/><?php } else {?><img src="img/gerb/<?php
if ($gruppa == 'naemniki') {?>o<?php }
if ($gruppa == 'svoboda') {?>s<?php }
if ($gruppa == 'dolg') {?>d<?php }
if ($gruppa == 'mon') {?>m<?php }
?>.jpg"/><?php }?></center>
</div>
<div style="color:#B5B5B5;
font-size:14px;
font-weight:bold;
margin-top: 4px;
margin-bottom: 4px;
background: url(http://stalkeronlinegame.epizy.com/style/img/title.png) 100% no-repeat;
background-size: cover;">
<?php if ($long_text > 0) {?><?php echo "$nadpis";?><?php } else {?><?php
if ($gruppa == 'naemniki') {?>Вступайте в ряды Одиночек!<?php }
if ($gruppa == 'svoboda') {?>Вступайте в ряды Свободы!<?php }
if ($gruppa == 'dolg') {?>Вступайте в ряды Долга!<?php }
if ($gruppa == 'mon') {?>Вступи в Монолит, уничтожь неверных!<?php }
?><?php }?></div>
<div style="background-color: #1E1E1E;">
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<img src="img/ico/lvl.gif" width="12" height="12"/> Уровень: <span class="white"><?php echo "$lvl";?></span> <span class="net">(<?php echo "$proc1";?>%)</span><br/>
<img src="img/star.png" width="12" height="12"/> Опыт: <span class="white"><?php echo "$clan_opit"; ?>к / <?php echo "$next_lvl";?>к</span><br/>
<img src="img/slava.png" width="15" height="15"/> Слава: <span class="white"><?php echo "$slava";?></span>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
</div>
<a href="forum.php?type=company&company=<?php echo "$clan_id"?>" class="menu"><img src="img/ico/forum_new.png" width="12" height="12"/> Форум</a>
<?php if ($vid != 'sost') {?>
<a href="clan.php?id=<?php echo "$clan_id";?>&vid=sost" class="menu"><img src="img/ico/chel.png" width="12" height="12"/> Состав: [<?php echo "$sostav";?> / <?php echo "$stalkers";?>]</a>
<?php }?>
<?php if ($vid != 'gl' and !empty($vid)) {?>
<a href="clan.php?id=<?php echo "$clan_id";?>&vid=gl" class="menu"><img src="img/reload.gif" width="15" height="15"/> Закрыть</a>
<?php }?>
<?php
if ($vid == 'sost') {?>
	<?php
	if (!empty($_GET['page'])) {
	$cur_page = $_GET['page'];
	}
	else {
	$cur_page = 1;
	}
	$result_per_page = 10;
	$skip = (($cur_page - 1) * $result_per_page);
	$num_page = ceil($sostav / $result_per_page);
	if ($num_page > 0) {
	  $query_us = "Select nick ,id, clan_rang, ko, last_active  from users where clan = '$clan_id' order by `on` DESC, clan_rang DESC, ko DESC limit $skip, $result_per_page";
      $result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
	  while ($row_us = mysqli_fetch_array($result_us)) {
	    $nick = $row_us['nick'];
	    $clan_rang = $row_us['clan_rang'];
	    $id_us = $row_us['id'];
		$ko = $row_us['ko'];
		$ko = ($ko/100000);
		$ko = round($ko,2);
		$last_active = $row_us['last_active'];
		$last_active = strtotime("$last_active");
		$now = (date("Y-m-d H:i:s"));
        $now = strtotime("$now");
		$razn_last_act = ($now - $last_active);
	    ?>
	    <div class="zx">
		<?php
	  if ($row_us['clan_rang'] == '1') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/rekryt.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/rangs/rekryton.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_us['clan_rang'] == '2') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/ryadovoy.png" width="12" height="12"alt="р"/><?php } else {?><img src="img/rangs/ryadovoyon.png" width="12" height="12"alt="р"/><?php }}
	  if ($row_us['clan_rang'] == '3') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/serjant.png" width="12" height="12" alt="с"/><?php } else {?><img src="img/rangs/serjanton.png" width="12" height="12" alt="с"/><?php }}
	  if ($row_us['clan_rang'] == '4') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/leitenant.png" width="12" height="12" alt="л"/><?php } else {?><img src="img/rangs/leitenanton.png" width="12" height="12" alt="л"/><?php }}
	  if ($row_us['clan_rang'] == '5') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/kapitan.png" width="12" height="12" alt="к"/><?php } else {?><img src="img/rangs/kapitanon.png" width="12" height="12" alt="к"/><?php }}
	  if ($row_us['clan_rang'] == '6') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/mayor.png" width="12" height="12" alt="м"/><?php } else {?><img src="img/rangs/mayoron.png" width="12" height="12" alt="м"/><?php }}
	  if ($row_us['clan_rang'] == '7') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/polkovnik.png" width="12" height="12" alt="п"/><?php } else {?><img src="img/rangs/polkovnikon.png" width="12" height="12" alt="п"/><?php }}
	  if ($row_us['clan_rang'] == '8') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/general.png" width="12" height="12" alt="г"/><?php } else {?><img src="img/rangs/generalon.png" width="12" height="12" alt="г"/><?php }}
	  if ($row_us['clan_rang'] == '9') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/zamoff.jpg" width="12" height="12" alt="л"/><?php } else {?><img src="img/rangs/zamon.jpg" width="12" height="12" alt="л"/><?php }} 
	  if ($row_us['clan_rang'] == '10') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/lider.png" width="12" height="12" alt="л"/><?php } else {?><img src="img/rangs/lideron.png" width="12" height="12" alt="л"/><?php }} 
	  ?>
	  <span class="white"><a href="profile.php?id=<?php echo "$id_us"; ?>"><?php echo "$nick";?></a> (<?php echo "$ko";?>к)</span> <?php if ($clan1 == $clan_id and $rang_out>$clan_rang) { if ($rang_out>($clan_rang+1)) {?>[<a href="rang.php?inf=up&id=<?php echo "$id_us";?>">Повысить</a>]<?php }  if (0<($clan_rang-1)) {?> [<a href="rang.php?inf=down&id=<?php echo "$id_us";?>">Понизить</a>]<?php } ?> [<a href="agree.php?inf=outuser&id=<?php echo "$id_us";?>">Исключить</a>]<?php }?> <?php if ($rang_out == '10' and $rule == '1' and $user_id != $id_us and $clan1 == $clan_id) {?>[<a href="lider.php?id=<?php echo "$id_us";?>"  onclick="return confirm
('Уверены, что хотите сделать этого игрока лидером отряда? Вы будете понижены до генерала.')">+Лидер</a>]<?php }?></div>
	  
	    <?php
	  }
	  ?>
	  <div class="zx">
<center>
	  <?php
	  $phpself= $_SERVER['PHP_SELF'];
	  $phpself = htmlentities($phpself, ENT_QUOTES);
$rule = 'sost';
	  if ($cur_page > 1) {
	  echo ' <a href="' . "$phpself" .  '?page=' . (1) . '&id=' .$clan_id . '&vid=' . $rule . '"><<</a> ';
      }
	  else {
	    echo '<< ';
	  }
	  if ($cur_page > 1) {
	    echo '<a href="' . "$phpself" . '?page=' . ($cur_page-1) . '&id=' .$clan_id . '&vid=' . $rule . '"><</a> ';
      }
	  else {
	    echo '<';
	  }
	/////
	  if (($cur_page-3)>0) {
	 $k = ($cur_page-3);
	    ?><a href="<?php echo "$phpself" . '?page=' . ($cur_page-3). '&id=' .$clan_id . '&vid=' . $rule  ?>"><?php echo "$k";?></a><?php
      }
	 if (($cur_page-2)>0) {
	 $k = ($cur_page-2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-2). '&id=' .$clan_id . '&vid=' . $rule?>"><?php echo "$k";?></a> <?php
      }
     if (($cur_page-1)>0) {
	 $k = ($cur_page-1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-1). '&id=' .$clan_id  . '&vid=' . $rule?>"><?php echo "$k";?></a> <?php
      }
	?> <span class="white"><?php echo " $cur_page ";?></span><?php
	 if (($cur_page+1)<=$num_page) {
	 $k = ($cur_page+1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+1). '&id=' .$clan_id . '&vid=' . $rule?>"><?php echo "$k";?></a> <?php
      }
	  	 if (($cur_page+2)<=$num_page) {
	 $k = ($cur_page+2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+2). '&id=' .$clan_id . '&vid=' . $rule ?>"><?php echo "$k";?></a> <?php
      }
	 if (($cur_page+3)<=$num_page) {
	 $k = ($cur_page+3);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+3). '&id=' .$clan_id . '&vid=' . $rule ?>"><?php echo "$k";?></a> <?php
      }
	/////
	if ($cur_page < $num_page) {
	  echo '<a href="' . "$phpself" . '?page=' . ($cur_page+1). '&id=' .$clan_id  . '&vid=' . $rule . '">></a> ';
    }
	else {
	  echo '>';
	}
	if ($cur_page < $num_page) {
	  echo ' <a href="' . "$phpself" .  '?page=' . $num_page . '&id=' .$clan_id . '&vid=' . $rule .  '">>></a> ';
    }
	else {
	  echo ' >>';
	}
	}
	?>
</center>
	</div>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php if ($vid == 'sost') {?>
<a href="onlinecom.php?company_id=<?php echo "$clan_id";?>" class="menu"><img src="img/ico/on.png" width="15" height="15"/> Онлайн <span class="white"><?php echo "$row_c";?></span></a>
<?php }?>
<?php }
?>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php if ($war_id != '0' and $warr == '0') {?>
<span class="white"><b>Последняя битва:</b></span><br/>
<img src="img/ico/otryad.gif"/> Битва с отрядом <img src="img/ico/<?php
if ($grqa == 'naemniki') {?>odinochki.png<?php }
if ($grqa == 'svoboda') {?>svoboda.png<?php }
if ($grqa == 'dolg') {?>dolg.png<?php }
if ($grqa == 'mon') {?>monolit.png<?php }
?>"/><a href="clan.php?id=<?php echo "$war_id";?>"><?php echo "$nameqa";?></a>, которая была <?php if ($st_war == '1') {?>выиграна<?php } else {?>проиграна<?php }?>.
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php }?>
<span class="white"><img src="img/star.png" width="12" height="12"/> Ранг:</span> <?php echo "$rating";?><br/>
<span class="white"><img src="img/ico/letterin1.png" width="12" height="12"/> Побед:</span> <?php echo "$win";?><br/>
<span class="white"><img src="img/ico/letterout1.png" width="12" height="12"/> Поражений:</span> <?php echo "$over";?><br/>
<span class="white"><img src="img/ico/link.png" width="12" height="12"/> Победность:</span> <?php $qp = ($win + $over); $qp1 = ('100' / $qp); $qp2 = ($qp1 * $win); $qp2 = round("$qp2"); echo "$qp2";?>%<br/>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php $rip1 = ($kof + $kof1); $rip2 = ('100' / $rip1); $rip3 = ($rip2 * $kof1); $rip3 = round("$rip3");?>
<?php if ($clan1 != $clan_id and $rang_out > '7' and $wash_war != '1' and $warr != '1') {?>
<center><a href="bitva_on.php?c_id=<?php echo "$clan_id";?>" class="menu" onclick="return confirm ('Уверены? Теоретически шанс вашей победы: <?php echo "$rip3";?>%')"><img src="img/s-1.png" width="12" height="12"/> <span class="red">Напасть!</span> (<?php echo "$rip3";?>%)</a></center>
<?php }?>
<?php if ($warr != '0') {?>
<center><a href="clan.php?id=<?php echo "$war_id";?>" class="menu"><span class="red">Воюет с отрядом <?php echo "$nameqa";?></span></a></center>
<?php }?>
<?php }?>
<?php }?>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>