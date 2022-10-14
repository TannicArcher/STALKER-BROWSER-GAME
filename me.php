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
$query = "update users set admin='0' where user = '1' and admin = '1'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>

<?php
$query = "delete from message where time < NOW() - (21600000) and type = '1'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
$query = "update users set `on`='1' where last_active > NOW() - (3000) and `on`='0'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
$query = "update users set `on`='0' where last_active < NOW() - (3000) and `on`='1'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
$query = "update message set `text`='.' where `text` LIKE  '%rentgen%'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
$query = "update message set `text`='.' where `text` LIKE  '%wapstalker%'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>

<?php
$query = "update users set ban='1', why_ban='Ошибка №1. RUB, чеки или хабар ушли в минус.' where money < '-15' and admin != '1' or habar < '-5000' and admin != '1' or dengi < '-1000' and admin != '1'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
$query = "update users set aptechki='0', habar='0', money='0', dengi='0', slava='0' where aptechki < '0'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
$query = "update users set aptechki='0', habar='0', money='0', dengi='0', slava='0', antirad='0' where antirad < '0'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
$query = "update users set clan_mes='0' where clan = '0'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
$query = "update users set mc='0' where moder = '0'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
$query = "update users set habar='1000000000'  where habar > '1000000000' and admin != '1'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
$user_id = $_SESSION['id'];
$query = "Select * from users where id='$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$lvl = $row['lvl'];
$money = $row['money'];
$habar = $row['habar'];
$dengi = $row['dengi'];
$nick = $row['nick'];
$prem = $row['premium'];
$popka = round("$proc");
$prem_time = $row['premium_time'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$loto_time = $row['premium_time'];
$loto_time = strtotime("$loto_time");
$loto_time = ($loto_time + 604800);
$time11 = ($loto_time - $now);
?>




<?php
$query_bv = "Select * from pay_vip where id_user = '$user_id' limit 1";
$result_bv = mysqli_query($dbc, $query_bv) or die ('Ошибка передачи запроса к БД');
$row_bv = mysqli_fetch_array($result_bv);
if ($row_bv > '0') {
$sum = $row_bv['sum'];
$sum_bon = ($sum * '9');
$query = "update users set money=money+'$sum_bon' where id = '$user_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$money = ($money + $sum_bon);
$query = "delete from pay_vip where id_user = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
?>






<div id="main">
<div class="stats">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Сталкер <?php echo "$nick";?></p>
<img src="img/ava/<?php echo $row['avatar']; ?>.png" / class="upl"></center>
</div>
<div style="background-color: #1E1E1E;">
<br/>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
</div>
<div style="background:#2e2e2d url(http://stalkeronlinegame.epizy.com/link.png) repeat-x top;">
<?php
if ($prem == '1' and $time11 < '0') {?>
<?php
$query = "update users set premium='0' where id='$user_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?
}
if ($prem == '1') {?>
<img src="img/star.png" width="12" height="12"/> <span class="gold">VIP закончится через <?php if ($time11 > '86399') {?><span class="bonus"><?php } else {?><span class="red"><?php }?>
<?php
if ($time11 < '60') {?><?php echo "$time11";?>сек.<?php }
if ($time11 > '59' and $time11 < '120') {?>1мин.<?php }
if ($time11 > '119' and $time11 < '180') {?>2мин.<?php }
if ($time11 > '179' and $time11 < '240') {?>3мин.<?php }
if ($time11 > '239' and $time11 < '300') {?>4мин.<?php }
if ($time11 > '299' and $time11 < '360') {?>5мин.<?php }
if ($time11 > '359' and $time11 < '420') {?>6мин.<?php }
if ($time11 > '419' and $time11 < '480') {?>7мин.<?php }
if ($time11 > '479' and $time11 < '540') {?>8мин.<?php }
if ($time11 > '539' and $time11 < '600') {?>9мин.<?php }
if ($time11 > '599' and $time11 < '660') {?>10мин.<?php }
if ($time11 > '659' and $time11 < '720') {?>11мин.<?php }
if ($time11 > '719' and $time11 < '780') {?>12мин.<?php }
if ($time11 > '779' and $time11 < '840') {?>13мин.<?php }
if ($time11 > '839' and $time11 < '900') {?>14мин.<?php }
if ($time11 > '899' and $time11 < '960') {?>15мин.<?php }
if ($time11 > '959' and $time11 < '1020') {?>16мин.<?php }
if ($time11 > '1019' and $time11 < '1080') {?>17мин.<?php }
if ($time11 > '1079' and $time11 < '1140') {?>18мин.<?php }
if ($time11 > '1139' and $time11 < '1200') {?>19мин.<?php }
if ($time11 > '1199' and $time11 < '1260') {?>20мин.<?php }
if ($time11 > '1259' and $time11 < '1320') {?>21мин.<?php }
if ($time11 > '1319' and $time11 < '1380') {?>22мин.<?php }
if ($time11 > '1379' and $time11 < '1440') {?>23мин.<?php }
if ($time11 > '1439' and $time11 < '1500') {?>24мин.<?php }
if ($time11 > '1499' and $time11 < '1560') {?>25мин.<?php }
if ($time11 > '1559' and $time11 < '1620') {?>26мин.<?php }
if ($time11 > '1619' and $time11 < '1680') {?>27мин.<?php }
if ($time11 > '1679' and $time11 < '1740') {?>28мин.<?php }
if ($time11 > '1739' and $time11 < '1800') {?>29мин.<?php }
if ($time11 > '1799' and $time11 < '1860') {?>30мин.<?php }
if ($time11 > '1859' and $time11 < '1920') {?>31мин.<?php }
if ($time11 > '1919' and $time11 < '1980') {?>32мин.<?php }
if ($time11 > '1979' and $time11 < '2040') {?>33мин.<?php }
if ($time11 > '2039' and $time11 < '2100') {?>34мин.<?php }
if ($time11 > '2099' and $time11 < '2160') {?>35мин.<?php }
if ($time11 > '2159' and $time11 < '2220') {?>36мин.<?php }
if ($time11 > '2219' and $time11 < '2280') {?>37мин.<?php }
if ($time11 > '2279' and $time11 < '2340') {?>38мин.<?php }
if ($time11 > '2339' and $time11 < '2400') {?>39мин.<?php }
if ($time11 > '2399' and $time11 < '2460') {?>40мин.<?php }
if ($time11 > '2459' and $time11 < '2520') {?>41мин.<?php }
if ($time11 > '2519' and $time11 < '2580') {?>42мин.<?php }
if ($time11 > '2579' and $time11 < '2640') {?>43мин.<?php }
if ($time11 > '2639' and $time11 < '2700') {?>44мин.<?php }
if ($time11 > '2699' and $time11 < '2760') {?>45мин.<?php }
if ($time11 > '2759' and $time11 < '2820') {?>46мин.<?php }
if ($time11 > '2819' and $time11 < '2880') {?>47мин.<?php }
if ($time11 > '2879' and $time11 < '2940') {?>48мин.<?php }
if ($time11 > '2939' and $time11 < '3000') {?>49мин.<?php }
if ($time11 > '2999' and $time11 < '3060') {?>50мин.<?php }
if ($time11 > '3059' and $time11 < '3120') {?>51мин.<?php }
if ($time11 > '3119' and $time11 < '3180') {?>52мин.<?php }
if ($time11 > '3179' and $time11 < '3240') {?>53мин.<?php }
if ($time11 > '3239' and $time11 < '3300') {?>54мин.<?php }
if ($time11 > '3299' and $time11 < '3360') {?>55мин.<?php }
if ($time11 > '3359' and $time11 < '3420') {?>56мин.<?php }
if ($time11 > '3419' and $time11 < '3480') {?>57мин.<?php }
if ($time11 > '3479' and $time11 < '3540') {?>58мин.<?php }
if ($time11 > '3539' and $time11 < '3600') {?>59мин.<?php }
if ($time11 > '3599' and $time11 < '3660') {?>60мин.<?php }
if ($time11 > '3659' and $time11 < '7200') {?>1час.<?php }
if ($time11 > '7199' and $time11 < '10800') {?>2час.<?php }
if ($time11 > '10799' and $time11 < '14400') {?>3час.<?php }
if ($time11 > '14399' and $time11 < '18000') {?>4час.<?php }
if ($time11 > '17999' and $time11 < '21600') {?>5час.<?php }
if ($time11 > '21599' and $time11 < '25200') {?>6час.<?php }
if ($time11 > '25199' and $time11 < '28800') {?>7час.<?php }
if ($time11 > '28799' and $time11 < '32400') {?>8час.<?php }
if ($time11 > '32399' and $time11 < '36000') {?>9час.<?php }
if ($time11 > '35999' and $time11 < '39600') {?>10час.<?php }
if ($time11 > '39599' and $time11 < '43200') {?>11час.<?php }
if ($time11 > '43199' and $time11 < '46800') {?>12час.<?php }
if ($time11 > '46799' and $time11 < '50400') {?>13час.<?php }
if ($time11 > '50399' and $time11 < '54000') {?>14час.<?php }
if ($time11 > '53999' and $time11 < '57600') {?>15час.<?php }
if ($time11 > '57599' and $time11 < '61200') {?>16час.<?php }
if ($time11 > '61199' and $time11 < '64800') {?>17час.<?php }
if ($time11 > '64799' and $time11 < '68400') {?>18час.<?php }
if ($time11 > '68399' and $time11 < '72000') {?>19час.<?php }
if ($time11 > '71999' and $time11 < '75600') {?>20час.<?php }
if ($time11 > '75599' and $time11 < '79200') {?>21час.<?php }
if ($time11 > '79199' and $time11 < '82800') {?>22час.<?php }
if ($time11 > '82799' and $time11 < '86400') {?>23час.<?php }
if ($time11 > '86399' and $time11 < '90000') {?>1день<?php }
if ($time11 > '89999' and $time11 < '172800') {?>2дня<?php }
if ($time11 > '171799' and $time11 < '259200') {?>3дня<?php }
if ($time11 > '259199' and $time11 < '345600') {?>4дня<?php }
if ($time11 > '345599' and $time11 < '432000') {?>5дней<?php }
if ($time11 > '431999' and $time11 < '518400') {?>6дней<?php }
if ($time11 > '518399' and $time11 < '619200') {?>7дней<?php }
?>
</span>
</span>
<?php }?>
</div>
<div style="background-color: #1E1E1E;">
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
  <p><img src="img/ico/money.png" width="12" height="12"/> деньги: <span class="white"><?php echo $money; ?> RUB</span></p>
  <p><img src="img/chek.png" width="12" height="12"/> чеки: <span class="white"><?php echo $row['dengi']; ?></span></p>
  <p><img src="img/ico/materials.png" width="12" height="12"/> хабар: <span class="white"><?php echo $row['habar']; ?></span></p>
  <p><img src="img/ico/apte4ka.png" width="12" height="12"/> аптечки: <span class="white"><?php echo $row['aptechki']; ?></span></p>
  <p><img src="img/ico/antirad.png" width="12" height="12"/> антирад: <span class="white"><?php echo $row['antirad']; ?></span>
  <?php
  $time = (date("Y-m-d H:i:s"));
  $time = strtotime("$time");
  $antirad_time = $row['antirad_time'];
  $antirad_time = strtotime("$antirad_time");
  $antirad_time = ($time - $antirad_time);
  if ($antirad_time <= 7200) {
  $echo_time = (7200 - $antirad_time);
  $hours_time = ($echo_time/3600);
  $hours_time = floor($hours_time);
  $minutes_time = ($echo_time - (3600 * $hours_time));
  $minutes_time = ($minutes_time/60);
  $minutes_time = floor($minutes_time);
  $seconds = ($echo_time - ($hours_time*3600) - ($minutes_time*60));
  ?><span class="bonus">[<?php echo "$hours_time:$minutes_time:$seconds";?>]</span><?php 
  } 
  ?></p>
<p><img src="img/ico/point.png" width="12" height="12"/> активность: <span class="white"><?php echo $row['activ']; ?></span></p>
<p><img src="img/ico/point.png" width="12" height="12"/> опыт: <span class="white">
<?php
$row_us['opit'] = $row['opit'];
$opit = $row['opit'];
if ($row_us['opit'] >= 1000000000000) {
	$opit = ($opit/100000000000);
	$opit = round($opit);
	echo ($opit/10); ;}
if ($row_us['opit'] > 999999999 and $row_us['opit'] < 1000000000000) {
	$opit = ($opit/100000000);
	$opit = round($opit);
	echo ($opit/10); ;}
if ($row_us['opit'] > 1000000 and $row_us['opit'] < 1000000000) {
	$opit = ($opit/100000);
	$opit = round($opit);
	echo ($opit/10); ;}
if ($row_us['opit'] > 999 and $row_us['opit'] < 1000000) {
	$opit = ($opit/100);
	$opit = round($opit);
	echo ($opit/10); ;}
if ($row_us['opit'] < 1000) {
echo $opit;
;}
?>
<?php
if ($row_us['opit'] >= 1000000000000) {echo 't';}
if ($row_us['opit'] > 999999999 and $row_us['opit'] < 1000000000000) {echo 'g';}
if ($row_us['opit'] > 1000000 and $row_us['opit'] < 1000000000) {echo 'm';}
if ($row_us['opit'] > 999 and $row_us['opit'] < 1000000) {echo 'k';}
?>
</span> (<?php echo "$popka";?>%)</p>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
</div>
<div style="background:#2e2e2d url(http://stalkeronlinegame.epizy.com/link.png) repeat-x top;">
<p class="net">Охота:</p>
</div>
<div style="background-color: #1E1E1E;">
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php if ($row['t_1'] > '0' or $row['t_2'] > '0' or $row['t_3'] > '0' or $row['t_4'] > '0' or $row['t_5'] > '0' or $row['t_6'] > '0') {?>
<?php if ($row['t_1'] > '0') {?>
<p>Хвост пси-собаки: <span class="white"><?php echo $row['t_1'];?> штук</span></p>
<?php }?>
<?php if ($row['t_2'] > '0') {?>
<p>Глаз плоти: <span class="white"><?php echo $row['t_2'];?> штук</span></p>
<?php }?>
<?php if ($row['t_3'] > '0') {?>
<p>Нога снорка: <span class="white"><?php echo $row['t_3'];?> штук</span></p>
<?php }?>
<?php if ($row['t_4'] > '0') {?>
<p>Копыто кабана: <span class="white"><?php echo $row['t_4'];?> штук</span></p>
<?php }?>
<?php if ($row['t_5'] > '0') {?>
<p>Щупальца кровососа: <span class="white"><?php echo $row['t_5'];?> штук</span></p>
<?php }?>
<?php if ($row['t_6'] > '0') {?>
<p>Хвост слепого пса: <span class="white"><?php echo $row['t_6'];?> штук</span></p>
<?php }?>
<?php } else {?>У вас нет трофеев.<?php }?>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
</div>
<div class="stats">
<a href="user.php?id=<?php echo "$user_id";?>" class="menu"><img src="img/i.jpeg"/> Профиль</a>
<a href="events.php" class="menu"><img src="img/star.png" width="12" height="12"/> События</a>
<a href="clothes.php?id=<?php echo "$user_id";?>" class="menu"><img src="img/ico/shield.png" width="12" height="12"/> Снаряжение</a>
<a href="bag.php" class="menu"><img src="img/ico/sumka.png" width="12" height="12"/> Рюкзак <?php
	$query_c = "Select user_id from things where place=0 and user_id = '$user_id' limit 20";
    $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
    $count = mysqli_num_rows($result_c);
	echo"($count)";
	?></a>
<a href="stash.php" class="menu"><img src="img/ico/inventar.png" width="12" height="12"/> Тайник <?php
	$query_c = "Select user_id from things where place=1 and user_id = '$user_id' limit 20";
    $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
    $count = mysqli_num_rows($result_c);
	echo"($count)";
	?></a>
<a href="auc.php" class="menu"><img src="img/ico/auc.png" width="12" height="12"/> Аукцион <?php
	$query_c = "Select user_id from things where place=3 and user_id = '$user_id'";
    $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
    $count = mysqli_num_rows($result_c);
	echo"($count)";
	?></a>
<?php
$art_sum = ($row['art1'] + $row['art2'] + $row['art3'] + $row['art4'] + $row['art5']);
if ($row['art1'] > '0' or $row['art2'] > '0' or $row['art3'] > '0' or $row['art4'] > '0' or $row['art5'] > '0') {?>
<a href="art_belt.php" class="menu"><img src="img/art/12.png" width="12" height="12"/> Контейнеры артефактов <?php
	echo"($art_sum)";
	?></a>
<?php }?>
<a href="cr_ank.php" class="menu"><img src="img/ank27.png" alt="п"width="12" height="12"/> Анкета</a>
<a href="nadpisi.php" class="menu"><img src="img/pencil1.png" width="12" height="12"/> Надписи</a>
<a href="ava.php?type=1" class="menu"><img src="img/6.png" width="12" height="12"/> Аватар</a>
<a href="ref.php" class="menu"><img src="img/ico/chel.png" width="12" height="12"/> Пригласить</a>
<a href="/donate/" class="menu" style="color: gold"><img src="img/ico/bonus.gif" width="12" height="12"/> Купить RUB</a>
<a href="settings.php" class="menu"><img src="img/ico/nastroiki.png" width="12" height="12"/> Настройки</a>
<a href="exit.php" class="menu"><img src="img/ico/out.png" width="12" height="12"/> Выход</a>
</div>
</div>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>