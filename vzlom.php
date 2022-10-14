<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "reg.php";
  </script>
  <?php
  exit();
}
$page_title = 'Взлом тайников';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$query_s = "Select * from users where id='$user_id' limit 1";
$result_s = mysqli_query($dbc, $query_s) or die ('Ошибка передачи запроса к БД');
$row_s = mysqli_fetch_array($result_s);
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$id_s = $row_s['id'];
$poisk_time = $row_s['poisk_time'];
$poisk_time = strtotime("$poisk_time");
$time = ($poisk_time - $now);
$time_p = ($now - $poisk_time);
$time_t1 = ('1800' - $time_p);
$time_t2 = ('5400' - $time_p);
$time_t3 = ('10800' - $time_p);
$time_t4 = ('21600' - $time_p);
$poisk_tip = $row_s['poisk_tip'];
$poisk = $row_s['poisk'];
$q1 = rand(0,3);
$q2 = rand(3,5);
$q3 = rand(5,10);
$l1 = rand(300,1000);//награда в хабаре
$l2 = rand(800,2500);
$l3 = rand(2250,7000);
$l4 = rand(6000,12000);
$a1 = rand(1,2);
$a2 = rand(2,3);
$r1 = rand(1,2);
$lvl = $row_s['lvl'];
$lol1 = ($l1 * $lvl);//итог хабара суммируясь с уровнем
$lol2 = ($l2 * $lvl);
$lol3 = ($l3 * $lvl);
$lol4 = ($l4 * $lvl);
$qw1 = ($q1 * $lvl);
$qw2 = ($q2 * $lvl);
$qw3 = ($q3 * $lvl);
$apt1 = ($a1 * $lvl);
$apt2 = ($a2 * $lvl);
$rad1 = ($r1 * $lvl);
?>
<div id="main">
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Взлом тайников</p>
<?php if ($poisk_tip == '0') {?>
  <div class="stats">
<div class="zx">
  <p><span class="white">Пришло время попрактиковаться в старом-добром деле - взломе тайников! Чем больше тайник - тем больше награда в нем, и тем больше времени уйдет на его взлом.</p>
<p style="border-top: dashed 1px #444e4f"></p>
<p class=white> Внимание! Во время взлома вы не сможете ходить в рейды, в Зону и в перестрелки.</span></p>
<p class="white">Чем больше ваш уровень - тем больше будет ваша награда</p>
</div>
<p style="border-top: dashed 1px #444e4f"></p>
<p><img src="img/ico/link.png"> <a class="white" href="process.php?tip=1">Маленький тайник</a> <span class="white">[30 минут]</span></p>
<p><img src="img/ico/link.png"> <a class="blue" href="process.php?tip=2">Средний тайник</a> <span class="white">[90 минут]</span></p>
<p><img src="img/ico/link.png"> <a class="bonus" href="process.php?tip=3">Большой тайник</a> <span class="white">[180 минут]</span></p>
<p><img src="img/ico/link.png"> <a class="gold" href="process.php?tip=4">Огромный тайник</a> <span class="white">[360 минут]</span></p>
  </div>
<?php }
if ($poisk_tip == '1' and $time > '-1800' and $poisk == '1') {?>
<p style="border-top: dashed 1px #444e4f"></p>
  <div class="stats">
<p class="white">Идет процесс взлома. Прошло <?php echo "$time_p";?> из 1800 секунд, ждите еще <?php echo "$time_t1";?> секунд.</p>
<p><img src="img/ico/no.png"/> <a class="red" href="del_poisk.php" onclick="return confirm
('Уверены?')">Отменить взлом</a></p>
</div>
<?php }
if ($poisk_tip == '1' and $time > '-5400' and $poisk == '2') {?>
<p style="border-top: dashed 1px #444e4f"></p>
  <div class="stats">
<p class="white">Идет процесс взлома. Прошло <?php echo "$time_p";?> из 5400 секунд, ждите еще <?php echo "$time_t2";?> секунд.</p>
<p><img src="img/ico/no.png"/> <a class="red" href="del_poisk.php" onclick="return confirm
('Уверены?')">Отменить взлом</a></p>
</div>
<?php }
if ($poisk_tip == '1' and $time > '-10800' and $poisk == '3') {?>
<p style="border-top: dashed 1px #444e4f"></p>
  <div class="stats">
<p class="white">Идет процесс взлома. Прошло <?php echo "$time_p";?> из 10800 секунд, ждите еще <?php echo "$time_t3";?> секунд.</p>
<p><img src="img/ico/no.png"/> <a class="red" href="del_poisk.php" onclick="return confirm
('Уверены?')">Отменить взлом</a></p>
</div>
<?php }
if ($poisk_tip == '1' and $time > '-21600' and $poisk == '4') {?>
<p style="border-top: dashed 1px #444e4f"></p>
  <div class="stats">
<p class="white">Идет процесс взлома. Прошло <?php echo "$time_p";?> из 21600 секунд, ждите еще <?php echo "$time_t4";?> секунд.</p>
<p><img src="img/ico/no.png"/> <a class="red" href="del_poisk.php" onclick="return confirm
('Уверены?')">Отменить взлом</a></p>
</div>
<?php }
if ($poisk_tip == '1' and $time < '-1800' and $poisk == '1') {?>
<?php
$query = "update users set habar=habar+'$lol1', poisk_tip='0', poisk='0', tainik_time=tainik_time+'1800', poisk_time=NOW() where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p style="border-top: dashed 1px #444e4f"></p>
<p class="bonus">В тайнике найдено: <span class="white"><?php echo "$lol1";?></span> хабара</p>
<p><a class="gold" href="vzlom.php">Забрать</a></p>
<p style="border-top: dashed 1px #444e4f"></p><?php }
if ($poisk_tip == '1' and $time < '-5400' and $poisk == '2') {?>
<?php
$query = "update users set habar=habar+'$lol2', dengi=dengi+'$qw1', poisk_tip='0', poisk='0', tainik_time=tainik_time+'5400', poisk_time=NOW() where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p style="border-top: dashed 1px #444e4f"></p>
<p class="bonus">В тайнике найдено: <span class="white"><?php echo "$lol2";?></span> хабара, <span class="white"><?php echo "$qw1";?></span> чеков</p>
<p><a class="gold" href="vzlom.php">Забрать</a></p>
<p style="border-top: dashed 1px #444e4f"></p><?php }
if ($poisk_tip == '1' and $time < '-10800' and $poisk == '3') {?>
<?php
$query = "update users set habar=habar+'$lol3', dengi=dengi+'$qw2', poisk_tip='0', poisk='0', tainik_time=tainik_time+'10800', poisk_time=NOW() where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p style="border-top: dashed 1px #444e4f"></p>
<p class="bonus">В тайнике найдено: <span class="white"><?php echo "$lol3";?></span> хабара, <span class="white"><?php echo "$qw2";?></span> чеков</p>
<p><a class="gold" href="vzlom.php">Забрать</a></p>
<p style="border-top: dashed 1px #444e4f"></p><?php }
if ($poisk_tip == '1' and $time < '-21600' and $poisk == '4') {?>
<?php
$query = "update users set habar=habar+'$lol4', dengi=dengi+'$qw3', poisk_tip='0', poisk='0', tainik_time=tainik_time+'21600', poisk_time=NOW() where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p style="border-top: dashed 1px #444e4f"></p>
<p class="bonus">В тайнике найдено: <span class="white"><?php echo "$lol4";?></span> хабара, <span class="white"><?php echo "$qw3";?></span> чеков</p>
<p><a class="gold" href="vzlom.php">Забрать</a></p>
<p style="border-top: dashed 1px #444e4f"></p><?php }
?>
</div>
<?php

//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>