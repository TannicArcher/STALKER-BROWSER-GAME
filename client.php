<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "../reg.php";
  </script>
  <?php
  exit();
}
require_once('conf/head.php');
require_once('conf/top.php');


$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$_time = '2014-07-10 12:00:00';
$time11 = strtotime("$_time");
$time11 = ($time11 - $now);
?>
<div class="bg_wave">
<img src="img/client.jpg" width="100%"/>
<?php if ($time11 > '0') {?>
<div class="r4"><br/><b><center>
<p class="white">До выхода клиента осталось <span style="color: royalblue;">
<?php
if ($time11 < '60') {?><?php echo "$time11";?> секунд<?php }
if ($time11 > '59' and $time11 < '120') {?>1 минут<?php }
if ($time11 > '119' and $time11 < '180') {?>2 минут<?php }
if ($time11 > '179' and $time11 < '240') {?>3 минут<?php }
if ($time11 > '239' and $time11 < '300') {?>4 минут<?php }
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
if ($time11 > '1259' and $time11 < '1320') {?>21 минут<?php }
if ($time11 > '1319' and $time11 < '1380') {?>22 минут<?php }
if ($time11 > '1379' and $time11 < '1440') {?>23 минут<?php }
if ($time11 > '1439' and $time11 < '1500') {?>24 минут<?php }
if ($time11 > '1499' and $time11 < '1560') {?>25 минут<?php }
if ($time11 > '1559' and $time11 < '1620') {?>26 минут<?php }
if ($time11 > '1619' and $time11 < '1680') {?>27 минут<?php }
if ($time11 > '1679' and $time11 < '1740') {?>28 минут<?php }
if ($time11 > '1739' and $time11 < '1800') {?>29 минут<?php }
if ($time11 > '1799' and $time11 < '1860') {?>30 минут<?php }
if ($time11 > '1859' and $time11 < '1920') {?>31 минут<?php }
if ($time11 > '1919' and $time11 < '1980') {?>32 минут<?php }
if ($time11 > '1979' and $time11 < '2040') {?>33 минут<?php }
if ($time11 > '2039' and $time11 < '2100') {?>34 минут<?php }
if ($time11 > '2099' and $time11 < '2160') {?>35 минут<?php }
if ($time11 > '2159' and $time11 < '2220') {?>36 минут<?php }
if ($time11 > '2219' and $time11 < '2280') {?>37 минут<?php }
if ($time11 > '2279' and $time11 < '2340') {?>38 минут<?php }
if ($time11 > '2339' and $time11 < '2400') {?>39 минут<?php }
if ($time11 > '2399' and $time11 < '2460') {?>40 минут<?php }
if ($time11 > '2459' and $time11 < '2520') {?>41 минут<?php }
if ($time11 > '2519' and $time11 < '2580') {?>42 минут<?php }
if ($time11 > '2579' and $time11 < '2640') {?>43 минут<?php }
if ($time11 > '2639' and $time11 < '2700') {?>44 минут<?php }
if ($time11 > '2699' and $time11 < '2760') {?>45 минут<?php }
if ($time11 > '2759' and $time11 < '2820') {?>46 минут<?php }
if ($time11 > '2819' and $time11 < '2880') {?>47 минут<?php }
if ($time11 > '2879' and $time11 < '2940') {?>48 минут<?php }
if ($time11 > '2939' and $time11 < '3000') {?>49 минут<?php }
if ($time11 > '2999' and $time11 < '3060') {?>50 минут<?php }
if ($time11 > '3059' and $time11 < '3120') {?>51 минут<?php }
if ($time11 > '3119' and $time11 < '3180') {?>52 минут<?php }
if ($time11 > '3179' and $time11 < '3240') {?>53 минут<?php }
if ($time11 > '3239' and $time11 < '3300') {?>54 минут<?php }
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
if ($time11 > '172799' and $time11 < '259200') {?>3 дня<?php }
if ($time11 > '259199' and $time11 < '345600') {?>4 дня<?php }
if ($time11 > '345599' and $time11 < '432000') {?>5 дней<?php }
?></span>!
</p>
</b></center><br/>
</div>
<?php } else {?>
<div class="r4"><br/><b><center>
<a href="Stalker_Online.apk">Скачать <img src="down_4871.png"/></a>
</b></center><br/></div>
<?php }?>
<br/>
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>