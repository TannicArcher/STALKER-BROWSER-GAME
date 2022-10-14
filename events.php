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
$page_title = 'События';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$query = "update users set location = 'events', events='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<div id="main">
<div class="stats">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">События</p></center>
</div>
<div class="stats">
<?php
$query_num = "Select boy_id from arena_inf where vrag_id = '$user_id' or user_id = '$user_id' " ;
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
    $result_per_page = 10;
	$skip = (($cur_page - 1) * $result_per_page);
		$num_page = ceil($total5 / $result_per_page);
	if ($num_page > 0) {
$query_sub = "Select * from arena_inf where vrag_id = '$user_id' or user_id = '$user_id' order by time desc limit $skip, $result_per_page";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$id1 = $row_sub['user_id'];
$id2 = $row_sub['vrag_id'];
$yron1 = $row_sub['yron1'];
$yron2 = $row_sub['yron2'];
$habar1 = $row_sub['habar1'];
$habar2 = $row_sub['habar2'];
$dengi1 = $row_sub['dengi1'];
$dengi2 = $row_sub['dengi2'];
$hp1 = $row_sub['hp1'];
$hp2 = $row_sub['hp2'];
$rat1 = $row_sub['rat1'];
$rat2 = $row_sub['rat2'];
$time = $row_sub['time'];
$win = $row_sub['win'];
$query_nick = "Select * from users where id='$id1' limit 1";
$result_nick = mysqli_query($dbc, $query_nick) or die ('Ошибка передачи запроса к БД');
$nick = mysqli_fetch_array($result_nick);
$nick1 = $nick['nick'];
$query_nick1 = "Select * from users where id='$id2' limit 1";
$result_nick1 = mysqli_query($dbc, $query_nick1) or die ('Ошибка передачи запроса к БД');
$nick3 = mysqli_fetch_array($result_nick1);
$nick2 = $nick3['nick'];
?>
<p><div style="background:#2e2e2d url(http://stalkeronlinegame.epizy.com/link.png) repeat-x top;"><?php echo "$time";?></div></p>
<div style="background: url(http://stalkeronlinegame.epizy.com/images/header2.jpg) 100% no-repeat;
background-size: cover;">
<p style="border-top: dashed 1px #444e4f;"></p>
<?php if ($user_id == $id2) {?><p class="blue">На вас напал сталкер <a href="profile.php?id=<?php echo "$id1";?>"><?php echo "$nick1";?></a></p><?php } else {?><p class="bonus">Вы напали на сталкера <a href="profile.php?id=<?php echo "$id2";?>"><?php echo "$nick2";?></a></p><?php }?>
<p style="border-top: dashed 1px #444e4f;"></p>
<?php if ($user_id == $id2) {?>
<p><?php if ($win == $user_id) {?><span class="gold">Вы победили!</span><br/><span class="white">Вы отобрали <?php echo "$habar1";?> хабара<?php if ($dengi1 > '0') {?> и <?php echo "$dengi1";?> чеков<?php }?><?php if ($rat2 > '0') {?>, получили <?php echo "$rat2";?> славы<?php }?>.</span><?php } else {?><span class="red">Вас ограбили!</span><br/><span class="white">Потери: <?php echo "$habar2";?> хабара<?php if ($dengi2 > '0') {?> и <?php echo "$dengi2";?> чеков.<?php } else {?>.<?php }?></span><?php }?></p>
<?php } else {?>
<p><?php if ($win == $user_id) {?><span class="gold">Вы победили!</span><br/><span class="white">Вы отобрали <?php echo "$habar2";?> хабара<?php if ($dengi2 > '0') {?> и <?php echo "$dengi2";?> чеков<?php }?><?php if ($rat1 > '0') {?>, получили <?php echo "$rat1";?> славы<?php }?>.</span><?php } else {?><span class="red">Вас ограбили!</span><br/><span class="white">Потери: <?php echo "$habar1";?> хабара<?php if ($dengi1 > '0') {?> и <?php echo "$dengi1";?> чеков.<?php } else {?>.<?php }?></span><?php }?></p>
<?php }?>
<p style="border-top: dashed 1px #444e4f;"></p>
<p>Урон:</p>
<p class="bonus">Вы: <span class="red"><?php if ($user_id == $id2) {?><?php echo "$yron2";?><?php } else {?><?php echo "$yron1";?><?php }?></span></p>
<p class="white">Противник: <span class="red"><?php if ($user_id == $id2) {?><?php echo "$yron1";?><?php } else {?><?php echo "$yron2";?><?php }?></span></p>
<p style="border-top: solid 1px #444e4f;"></p>
</div>
<p style="border-top: solid 1px #444e4f;"></p>
<?php 
}
}
?>
</div>
<?php
require_once('conf/naviga.php');
?>
</div>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>