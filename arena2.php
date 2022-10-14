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
$page_title = 'Бой';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$query = "update users set location='arrena' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query3 = "Select * from arena_log where user_id='$user_id' order by time desc limit 1";
$result3 = mysqli_query($dbc, $query3) or die ('Ошибка передачи запроса к БД');
$lol = mysqli_fetch_array($result3);
$id1 = $lol['user_id'];
$id2 = $lol['vrag_id'];
$yron1 = $lol['yron1'];
$yron2 = $lol['yron2'];
$habar1 = $lol['habar1'];
$habar2 = $lol['habar2'];
$dengi1 = $lol['dengi1'];
$dengi2 = $lol['dengi2'];
$end = $lol['end'];
$query1 = "Select * from users where id='$id1' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$row1 = mysqli_fetch_array($result1);
$nick1 = $row1['nick'];
$clan1 = $row1['clan'];
$hp1 = $row1['hp'];
$max_hp1 = $row1['max_hp'];
$lvl = $row1['lvl'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$speed_w = $row1['speed_w'];
$time_w = $row1['time_w'];
$time_w = strtotime("$time_w");
$time_wr = ($time_w + $speed_w);
$speed_p = $row1['speed_p'];
$time_p = $row1['time_p'];
$time_p = strtotime("$time_p");
$time_pr = ($time_p + $speed_p);
$query2 = "Select * from users where id='$id2' limit 1";
$result2 = mysqli_query($dbc, $query2) or die ('Ошибка передачи запроса к БД');
$row2 = mysqli_fetch_array($result2);
$nick2 = $row2['nick'];
$hp2 = $row2['hp'];
$clan2 = $row2['clan'];
$max_hp2 = $row2['max_hp'];
$mh = ($max_hp2 / '2');
$regen = $row2['regen'];
$lvll = $row2['lvl'];
if (($lvl - $lvll) < '0') {
$rating1 = '2';
}
if (($lvl - $lvll) == '0') {
$rating1 = '1';
}
if (($lvl - $lvll) > '0') {
$rating1 = '0';
}
if (($lvll - $lvl) < '0') {
$rating2 = '2';
}
if (($lvll - $lvl) == '0') {
$rating2 = '1';
}
if (($lvll - $lvl) > '0') {
$rating2 = '0';
}
$query_clan = "Select * from clans where  clan_id = '$clan1'  limit 1";
$result_clan = mysqli_query($dbc, $query_clan) or die ('Ошибка передачи запроса к БД2');
$row_clan = mysqli_fetch_array($result_clan);
$mentor1 = $row_clan['mentor'];
$mentor1 = ($mentor1 + '100');
$query_clan = "Select * from clans where  clan_id = '$clan2'  limit 1";
$result_clan = mysqli_query($dbc, $query_clan) or die ('Ошибка передачи запроса к БД2');
$row_clan1 = mysqli_fetch_array($result_clan);
$mentor2 = $row_clan1['mentor'];
$mentor2 = ($mentor2 + '100');
$max_hp1 = (($max_hp1 / '100') * $mentor1);
$max_hp2 = (($max_hp2 / '100') * $mentor2);
$max_hp1 = round("$max_hp1");
$max_hp2 = round("$max_hp2");
?>
<div id="main">
<?php if ($lol == 0) {?>
<div class="stats">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Бой с <?php echo "$nick2";?></p></center>
</div>
<p class="red">Вы не участвуете в бое.</p>
<?php } else {?>
<?php
if ($hp1 < '1' and $end == '0') {?>
<?php
$query_1 = "update users set habar=habar+'$habar1', dengi=dengi+'$dengi1', arena1='0', arena_time1=NOW(), slava=slava+'$rating2', events=events+'1', win=win+'1' where id = '$id2' limit 1";
$result_1 = mysqli_query($dbc, $query_1) or die ('Ошибка передачи запроса к БД');
$query_2 = "update users set habar=habar-'$habar1', dengi=dengi-'$dengi1', arena='0', arena_time=NOW(), last=last+'1' where id = '$id1' limit 1";
$result_2 = mysqli_query($dbc, $query_2) or die ('Ошибка передачи запроса к БД');
$query_3 = "update arena_log set end='1' where user_id='$user_id' and vrag_id='$id2' order by time desc limit 1";
$result_3 = mysqli_query($dbc, $query_3) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into arena_inf (`time`, `user_id`, `vrag_id`, `yron1`, `yron2`, `habar1`, `habar2`, `dengi1`, `dengi2`, `rat1`, `rat2`, `hp1`, `hp2`, `win`) values (NOW(), '$id1', '$id2', '$yron1', '$yron2', '$habar1', '$habar2', '$dengi1', '$dengi2', '$rating1', '$rating2', '$hp1', '$hp2', '$id2')";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "delete from arena_log where user_id='$user_id' and vrag_id='$id2' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<script type="text/javascript">
  document.location.href = "arena_win.php?id=<?php echo "$id2";?>";
</script>
<?php }?>
<?php
if ($hp2 < '1' and $end == '0') {?>
<?php
$query_1 = "update users set habar=habar+'$habar2', dengi=dengi+'$dengi2', arena='0', arena_time=NOW(), slava=slava+'$rating1', win=win+'1' where id = '$id1' limit 1";
$result_1 = mysqli_query($dbc, $query_1) or die ('Ошибка передачи запроса к БД');
$query_2 = "update users set habar=habar-'$habar2', dengi=dengi-'$dengi2', arena1='0', arena_time1=NOW(), events=events+'1', hp='$mh', last=last+'1' where id = '$id2' limit 1";
$result_2 = mysqli_query($dbc, $query_2) or die ('Ошибка передачи запроса к БД');
$query_3 = "update arena_log set end='1' where user_id='$user_id' and vrag_id='$id2' order by time desc limit 1";
$result_3 = mysqli_query($dbc, $query_3) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into arena_inf (`time`, `user_id`, `vrag_id`, `yron1`, `yron2`, `habar1`, `habar2`, `dengi1`, `dengi2`, `rat1`, `rat2`, `hp1`, `hp2`, `win`) values (NOW(), '$id1', '$id2', '$yron1', '$yron2', '$habar1', '$habar2', '$dengi1', '$dengi2', '$rating1', '$rating2', '$hp1', '$hp2', '$id1')";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "delete from arena_log where user_id='$user_id' and vrag_id='$id2' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<script type="text/javascript">
  document.location.href = "arena_win.php?id=<?php echo "$id2";?>";
</script>
<?php }
?>
<?php
$query_3 = "update users set hp=hp+'$regen' where id = '$id2' limit 1";
$result_3 = mysqli_query($dbc, $query_3) or die ('Ошибка передачи запроса к БД');
?>
<div class="stats">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Бой с <?php echo "$nick2";?></p></center>
</div>
<p class="podmenu">Здоровье:</p>
<p><span class="bonus"><?php echo "$nick1";?>:</span> <img src="img/ico/life.png" width="12" height="12"/><?php echo "$hp1";?>/<?php echo "$max_hp1";?></p>
<p><span class="bonus"><?php echo "$nick2";?>:</span> <img src="img/ico/life.png" width="12" height="12"/><?php echo "$hp2";?>/<?php echo "$max_hp2";?></p>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<p class="podmenu">Урон:</p>
<p><span class="bonus"><?php echo "$nick1";?>:</span> <img src="img/ico/to4nost.png" width="12" height="12"/><?php echo "$yron1";?></p>
<p><span class="bonus"><?php echo "$nick2";?>:</span> <img src="img/ico/to4nost.png" width="12" height="12"/><?php echo "$yron2";?></p>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<p class="podmenu">Бой:</p>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php if ($time_pr > $now or $time_wr > $now) {?>
<center><p><a href="arena2.php"><img src="img/icon-refresh.png"/></a></p></center>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php }?>
<?php if ($time_pr > $now) {?>
<p class="red">Пистолет перезаряжается</p><?php } else {?>
<a href="arena_attack.php?tip=1&id=<?php echo "$id2";?>" class="menu"><img src="img/ico/link.png"/>Стрелять из пистолета</a><?php }?>
<?php if ($time_wr > $now) {?>
<p class="red">Автомат перезаряжается</p><?php } else {?>
<a href="arena_attack.php?tip=2&id=<?php echo "$id2";?>" class="menu"><img src="img/ico/link.png"/>Стрелять из автомата</a><?php }?>
<?php }
?>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
</div>
<center><a href="arenaon.php?not=118&id=<?php echo "$id2";?>" class="menu" onclick="return confirm ('Уверены?')"><img src="img/block.png"/>Сдаться</a></center>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
<?php
mysqli_close($dbc);
?>
</body>
</html>