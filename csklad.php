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
$page_title = 'Склад отряда';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$c_id = $_GET['c_id'];
$query_us = "Select * from users where id='$user_id' limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$c_rang = $row_us['clan_rang'];
$clan_u = $row_us['clan'];
$lvl_u = $row_us['lvl'];
$c_id = $clan_u;
$query_clan = "Select * from clans where clan_id='$c_id' limit 1";
$result_clan = mysqli_query($dbc, $query_clan) or die ('Ошибка передачи запроса к БД');
$row_clan = mysqli_fetch_array($result_clan);
$clan_habar = $row_clan['clan_habar'];
$clan_money = $row_clan['clan_money'];
$name = $row_clan['name'];
$war = $row_clan['war'];
if ($lvl_u < '10') {
$dcms = ($lvl_u * '10000');
}
if ($lvl_u < '20' and $lvl_u > '9') {
$dcms = ($lvl_u * '300000');
}
if ($lvl_u < '30' and $lvl_u > '19') {
$dcms = ($lvl_u * '600000');
}
if ($lvl_u < '40' and $lvl_u > '29') {
$dcms = ($lvl_u * '1500000');
}
if ($lvl_u < '45' and $lvl_u > '39') {
$dcms = ($lvl_u * '3000000');
}
if ($lvl_u < '50' and $lvl_u > '44') {
$dcms = ($lvl_u * '5000000');
}
if ($lvl_u > '49') {
$dcms = ($lvl_u * '10000000');
}
?>
<?php if ($war == '1') {?>
<?php
echo "Во время битвы нельзя посещать склад";
require_once('conf/navig.php');
require_once('conf/foot.php');
exit;
?>
<?php }?>
<?php if ($clan_u == $c_id) {?>
<p style="border-top: solid 1px #444e4f"></p>
<p class="red">
<?php
$err = $_GET['err'];
if ($err == '1') {
echo "В складе недостаточно денег";
}
if ($err == '2') {
echo "Ошибка доступа";
}
if ($err == '3') {
echo "Отряд с таким названием уже существует";
}
if ($err == '4') {
echo "В названии отряда должно быть от 2-х до 16-и цифр";
}
if ($err == '5') {
echo "Вы превысили ежедневный лимит пополнения";
}
if ($err == '6') {
echo "У вас нет столько хабара";
}
?>
</p>
<?php
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
?>
<p style="border-top: solid 1px #444e4f"></p>
<div id="main">
<center><span style="font-size: 17px">Склад отряда <span class="white"><b><?php echo "$name";?></b></span></span></center>
<p style="border-top: dotted 1px royalblue"></p>
<p class="podmenu">В складе:</p>
<p><span class="white"><?php echo "$clan_habar";?></span> <img src="img/ico/materials.png"/>хабара</p>
<p><span class="white"><?php echo "$clan_money";?></span> <img src="img/ico/money.png"/>RUB</p>
<p style="border-top: dotted 1px royalblue"></p><br />
<p class="podmenu">Вложить:</p>
<span>Хабар</span> (<?php echo "$vkl";?> / <?php echo "$dcms";?>)
<form enctype="multipart/form-data" method="post" action="vklad_habar.php?c_id=<?php echo "$c_id";?>">
<input type="text" style="width:150px; height:18px;" class="input" name="habar" />
<input type="submit" style="width:60px;" class="input" value="вложить" name="addchat"/>
</form>
<span>RUB</span>
<form enctype="multipart/form-data" method="post" action="vklad_money.php?c_id=<?php echo "$c_id";?>">
<input type="text" style="width:150px; height:18px;" class="input" name="rub" />
<input type="submit" style="width:60px;" class="input" value="вложить" name="addchat"/>
</form>
<p style="border-top: solid 1px #444e4f"></p><?php if ($c_rang > '7') {?>
<p class="podmenu">Взять:</p>
<span>Хабар</span>
<form enctype="multipart/form-data" method="post" action="out_habar.php?c_id=<?php echo "$c_id";?>">
<input type="text" style="width:150px; height:18px;" class="input" name="habar" />
<input type="submit" style="width:60px;" class="input" value="взять" name="addchat"/>
</form><?php }?>
<p style="border-top: dotted 1px royalblue"></p>
<p><img src="img/ico/materials.png" width="12" height="12"/> <a href="rat.php?id=<?php echo "$c_id";?>&type=1">Рейтинг взносов</a></p>
<p><img src="img/reload.gif" width="12" height="12"/> <a href="clan.php">Назад</a></p>
<p style="border-top: dotted 1px royalblue"></p>
<p class="podmenu">Лог:</p>
<p style="border-top: dashed 1px #444e4f"></p>
<?php
$query_num = "Select * from clan_log where clan_id = '$c_id'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД11');
$total5 = mysqli_num_rows($result_num); 
?>
   <?php
if (!empty($_GET['page'])) {
  $cur_page = $_GET['page'];
}
else {
  $cur_page = 1;
}
    $result_per_page = 20;
	$skip = (($cur_page - 1) * $result_per_page);
		$num_page = ceil($total5 / $result_per_page);
	if ($num_page > 0) {
$query_sub = "Select * from clan_log where clan_id = '$c_id' order by time desc limit $skip, $result_per_page";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$log_id = $row_sub['log_id'];
$us_id = $row_sub['user_id'];
$tip = $row_sub['tip'];
$why = $row_sub['why'];
$num = $row_sub['num'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$loto_time = $row_sub['time'];
$loto_time = strtotime("$loto_time");
$time = ($now - $loto_time);
$time_min = ($time/60);
$time_clock = ($time_min/60);
$time_day = ($time_clock/24);
$query_gg = "Select * from users where id='$us_id' limit 1";
$result_gg = mysqli_query($dbc, $query_gg) or die ('Ошибка передачи запроса к БД');
$row_gg = mysqli_fetch_array($result_gg);
$nick_g = $row_gg['nick'];
$time11 = $time;
?>
<p>[<?php
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
if ($time11 > '619199' and $time11 < '777600') {?>8дней<?php }
if ($time11 > '777599' and $time11 < '864000') {?>9дней<?php }
if ($time11 > '863999' and $time11 < '950400') {?>10дней<?php }
if ($time11 > '950399' and $time11 < '1036800') {?>11дней<?php }
if ($time11 > '1036799' and $time11 < '1123200') {?>12дней<?php }
if ($time11 > '1123199' and $time11 < '1209600') {?>13дней<?php }
if ($time11 > '1209599' and $time11 < '1296000') {?>14дней<?php }
if ($time11 > '1295999' and $time11 < '1382400') {?>15дней<?php }
if ($time11 > '1382399' and $time11 < '1468800') {?>16дней<?php }
if ($time11 > '1468799' and $time11 < '1555200') {?>17дней<?php }
if ($time11 > '1555199' and $time11 < '1641600') {?>18дней<?php }
if ($time11 > '1641599' and $time11 < '1728000') {?>19дней<?php }
if ($time11 > '1727999' and $time11 < '1814400') {?>20дней<?php }
if ($time11 > '1814399' and $time11 < '1900800') {?>21день<?php }
if ($time11 > '1900799' and $time11 < '1987200') {?>22дня<?php }
if ($time11 > '1987199' and $time11 < '2073600') {?>23дня<?php }
if ($time11 > '2073599' and $time11 < '2160000') {?>24дня<?php }
if ($time11 > '2159999' and $time11 < '2246400') {?>25дней<?php }
if ($time11 > '2246399' and $time11 < '2332800') {?>26дней<?php }
if ($time11 > '2332799' and $time11 < '2419200') {?>27дней<?php }
if ($time11 > '2419199' and $time11 < '2505600') {?>28дней<?php }
if ($time11 > '2505599' and $time11 < '2592000') {?>29дней<?php }
if ($time11 > '2591999' and $time11 < '5184000') {?>1мес.<?php }
if ($time11 > '5183999' and $time11 < '7776000') {?>2мес.<?php }
if ($time11 > '7775999' and $time11 < '10368000') {?>3мес.<?php }
if ($time11 > '10367999' and $time11 < '12960000') {?>4мес.<?php }
if ($time11 > '12959999' and $time11 < '15552000') {?>5мес.<?php }
if ($time11 > '15551999' and $time11 < '18144000') {?>6мес.<?php }
if ($time11 > '18143999' and $time11 < '20736000') {?>7мес.<?php }
if ($time11 > '20735999' and $time11 < '23328000') {?>8мес.<?php }
if ($time11 > '23327999' and $time11 < '25920000') {?>9мес.<?php }
if ($time11 > '25919999' and $time11 < '28512000') {?>10мес.<?php }
if ($time11 > '28511999' and $time11 < '31104000') {?>11мес.<?php }
if ($time11 > '31103999' and $time11 < '62208000') {?>1год<?php }
if ($time11 > '62207999' and $time11 < '93312000') {?>2года<?php }
if ($time11 > '93311999' and $time11 < '186624000') {?>3года<?php }
if ($time11 > '186623999' and $time11 < '279936000') {?>4года<?php }
if ($time11 > '279935999' and $time11 < '373248000') {?>5лет<?php }
if ($time11 > '373248000') {?>более 5 лет<?php }
?>] <a class="white" href="profile.php?id=<?php echo "$us_id" ; ?>"><?php echo "$nick_g" ; ?></a> <b><?php if ($tip == '1') {?><span class="red">взял</span><?php } else {?><span class="bonus">вложил</span><?php }?></b> <span class="white"><?php echo "$num" ; ?></span> <?php if ($why == '1') {?><img src="img/ico/materials.png"/>хабара<?php } else {?><img src="img/ico/money.png"/>RUB<?php }?></p>
<p style="border-top: dashed 1px #444e4f"></p>
<?php 
}
require_once('conf/naviga.php');
}
?>
</div>
<p style="border-top: solid 1px #444e4f"></p><?php } else {?><span class="red">Вы пытаетесь зайти в чужой склад, а это запрещено.</span><?php }?>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>