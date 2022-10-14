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
$page_title = 'Арена';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$query_us = "Select * from arena_log where time < NOW() - ('3000') order by yron1 DESC";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
while ($row_us = mysqli_fetch_array($result_us)) {
$id1 = $row_us['user_id'];
$id2 = $row_us['vrag_id'];
$id3 = $row_us['boy_id'];
$hab = $row_us['habar1'];
$den = $row_us['dengi1'];
$rat = $row_us['rating2'];
$hp1 = $row_us['hp1'];
$hp2 = $row_us['hp2'];
?>
<?php
$query = "update users set arena='0', arena_time=NOW() where id = '$id1' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "update users set arena1='0', arena_time=NOW(), habar=habar+'$hab', dengi=dengi+'$den', slava=slava+'$rat' where id = '$id2' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "delete from arena_log where boy_id='$id3' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into arena_inf (`time`, `user_id`, `vrag_id`, `yron1`, `yron2`, `habar1`, `habar2`, `dengi1`, `dengi2`, `rat1`, `rat2`, `hp1`, `hp2`, `win`) values (NOW(), '$id1', '$id2', '0', '1', '$hab', '$hab', '$den', '$den', '$rat', '$rat', '$hp1', '$hp2', '$id2')";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
?>
<?php
}
?>
<?php
$user_id = $_SESSION['id'];
$err = $_GET['err'];
$time = $_GET['time'];
$time11 = $time;
$query = "update users set location = 'arena' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "Select * from users where id='$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$lol = mysqli_fetch_array($result);
$habar = $lol['habar'];
$lvl = $lol['lvl'];
$lvl1 = ($lvl+'1');
$lvl2 = $lvl;
$lvl3 = ($lvl-'1');
$h_lvl = ($lvl * '50');
$poisk_tip = $lol['poisk_tip'];
?>
<?php if ($poisk_tip == '1') {?>
 <script type="text/javascript">
  document.location.href = "vzlom.php";
  </script>
  <?php
  exit();
}
?>
<div id="main">
<?php if ($err != '') {?>
<br />
<?php }?>
<?php
if ($err == '1') {?>
<p style="border-top: solid 1px #444e4f;"></p>
<p class="red">У вас слишком мало здоровья. Используйте <a href="apt.php">аптечку</a>.</p>
<p style="border-top: solid 1px #444e4f;"></p>
<?php }
if ($err == '2') {?>
<p style="border-top: solid 1px #444e4f;"></p>
<p class="red">У выбранного вами сталкера слишком мало здоровья. Найдите другого противника.</p>
<p style="border-top: solid 1px #444e4f;"></p>
<?php }
if ($err == '3') {?>
<p style="border-top: solid 1px #444e4f;"></p>
<p class="red">Вы выбрали сталкера с неподходящим вам уровнем. Найдите другого противника.</p>
<p style="border-top: solid 1px #444e4f;"></p>
<?php }
if ($err == '4') {?>
<p style="border-top: solid 1px #444e4f;"></p>
<p class="red">Отдохните после прошлого боя ещё <?php
if ($time11 < '60') {?><?php echo "$time11";?> секунд<?php }
if ($time11 > '59' and $time11 < '120') {?>2 минуты<?php }
if ($time11 > '119' and $time11 < '180') {?>3 минуты<?php }
if ($time11 > '179' and $time11 < '240') {?>4 минуты<?php }
if ($time11 > '239' and $time11 < '300') {?>5 минут<?php }
if ($time11 > '299' and $time11 < '360') {?>6 минут<?php }
if ($time11 > '359' and $time11 < '420') {?>7 минут<?php }
if ($time11 > '419' and $time11 < '480') {?>8 минут<?php }
if ($time11 > '479' and $time11 < '540') {?>9 минут<?php }
if ($time11 > '539' and $time11 < '600') {?>10 минут<?php }
if ($time11 > '599' and $time11 < '660') {?>11 минут<?php }
if ($time11 > '659' and $time11 < '720') {?>12 минут<?php }
if ($time11 > '719' and $time11 < '780') {?>13 минут<?php }
if ($time11 > '779' and $time11 < '840') {?>14 минут<?php }
if ($time11 > '839' and $time11 < '900') {?>15 минут<?php }
if ($time11 > '899' and $time11 < '960') {?>16 минут<?php }
if ($time11 > '959' and $time11 < '1020') {?>17 минут<?php }
if ($time11 > '1019' and $time11 < '1080') {?>18 минут<?php }
if ($time11 > '1079' and $time11 < '1140') {?>19 минут<?php }
if ($time11 > '1139' and $time11 < '1200') {?>20 минут<?php }
if ($time11 > '1199' and $time11 < '1260') {?>21 минута<?php }
if ($time11 > '1259' and $time11 < '1320') {?>22 минуты<?php }
if ($time11 > '1319' and $time11 < '1380') {?>23 минуты<?php }
if ($time11 > '1379' and $time11 < '1440') {?>24 минуты<?php }
if ($time11 > '1439' and $time11 < '1500') {?>25 минут<?php }
if ($time11 > '1499' and $time11 < '1560') {?>26 минут<?php }
if ($time11 > '1559' and $time11 < '1620') {?>27 минут<?php }
if ($time11 > '1619' and $time11 < '1680') {?>28 минут<?php }
if ($time11 > '1679' and $time11 < '1740') {?>29 минут<?php }
if ($time11 > '1739' and $time11 < '1800') {?>30 минут<?php }
if ($time11 > '1799' and $time11 < '1860') {?>31 минута<?php }
if ($time11 > '1859' and $time11 < '1920') {?>32 минуты<?php }
?>.</p>
<p style="border-top: solid 1px #444e4f;"></p>
<?php }
if ($err == '5') {?>
<p style="border-top: solid 1px #444e4f;"></p>
<p class="red">Выбранный вами сталкер отдыхает после прошлого боя. Подождите ещё <?php
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
?>.</p>
<p style="border-top: solid 1px #444e4f;"></p>
<?php }
if ($err == '6') {?>
<p style="border-top: solid 1px #444e4f;"></p>
<p class="red">Вы уже участвуете в бое, третий - лишний.</p>
<p style="border-top: solid 1px #444e4f;"></p>
<?php }
if ($err == '7') {?>
<p style="border-top: solid 1px #444e4f;"></p>
<p class="red">Вы выбрали сталкера, который уже участвует в бое. Найдите другого противника.</p>
<p style="border-top: solid 1px #444e4f;"></p>
<?php }
if ($err == '8') {?>
<p style="border-top: solid 1px #444e4f;"></p>
<p class="red">У вас недостаточно хабара. Нужно <?php echo "$h_lvl";?> хабара, а у вас только <?php echo "$habar";?>.</p>
<p style="border-top: solid 1px #444e4f;"></p>
<?php }
if ($err == '9') {?>
<p style="border-top: solid 1px #444e4f;"></p>
<p class="red">Зачем вы нападаете на самого себя? Вам от этого станет веселее? Я так не думаю. Вы только создадите еще одну ошибку системы, при которой арена станет недоступной для вас.</p>
<p style="border-top: solid 1px #444e4f;"></p>
<?php }
if ($err == '10') {?>
<p style="border-top: solid 1px #444e4f;"></p>
<p class="red">Нападение на администраторов запрещено.</p>
<p style="border-top: solid 1px #444e4f;"></p>
<?php }
?>
<div class="stats">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Арена</p>
<img src="img/ico/logo3.png"/></center>
</div>
<p class="podmenu">Выберите противника: <small><span class="bonus">(-<?php echo "$h_lvl";?><img src="img/ico/materials.png"/>)</span></small></p>
<p style="border-top: solid 1px #444e4f;"></p>
<a href="arena1.php?tip=1" class="menu"><img src="img/ico/lvl1.gif"/> <?php echo "$lvl1";?> уровень</a></p> 
<p style="border-top: dashed 1px #444e4f;"></p>
<a href="arena1.php?tip=2" class="menu"><img src="img/ico/lvl2.gif"/> <?php echo "$lvl2";?> уровень</a></p>
<p style="border-top: dashed 1px #444e4f;"></p>
<a href="arena1.php?tip=3" class="menu"><img src="img/ico/lvl3.gif"/> <?php echo "$lvl3";?> уровень</a></p>
<p style="border-top: solid 1px #444e4f;"></p>
</div>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>