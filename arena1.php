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
$user_id = $_SESSION['id'];
$tip = $_GET['tip'];
$query = "Select * from users where id='$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$lol = mysqli_fetch_array($result);
$habar = $lol['habar'];
$lvl = $lol['lvl'];
$lvl1 = ($lvl+'1');
$lvl2 = $lvl;
$lvl3 = ($lvl-'1');
$h_lvl = ($lvl * '50');
if ($habar < $h_lvl) {?>
<script type="text/javascript">
  document.location.href = "arena.php?err=8";
</script>
<?php
exit();
}
$query = "update users set habar=habar-'$h_lvl' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
if ($tip == '1') {
$lvl4 = $lvl1;
}
if ($tip == '2') {
$lvl4 = $lvl2;
}
if ($tip == '3') {
$lvl4 = $lvl3;
}
?>
<?php
$query2 = "SELECT * FROM users where id='$user_id' LIMIT 1;";
$result2 = mysqli_query($dbc, $query2) or die ('Ошибка передачи запроса к БД');
$row2 = mysqli_fetch_array($result2);
$nick1 = $row2['nick'];
$id1 = $row2['id'];
$gruppa1 = $row2['gruppa'];
$avatar1 = $row2['avatar'];
$hp1 = $row2['hp'];
$bronya1 = $row2['bronya'];
$yron_p1 = $row2['yron_p'];
$yron_w1 = $row2['yron_w'];
$arena_time1 = $row2['arena_time'];
$arena_time1 = strtotime("$arena_time1");
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$tim1 = ($arena_time1 + '300');
$time11 = ($tim1 - $now);
$query1 = "SELECT * FROM users where lvl='$lvl4' and id != '$user_id' and arena1 = '0' ORDER BY RAND() LIMIT 1;";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$row1 = mysqli_fetch_array($result1);
$nick2 = $row1['nick'];
$id2 = $row1['id'];
$gruppa2 = $row1['gruppa'];
$avatar2 = $row1['avatar'];
$hp2 = $row1['hp'];
$bronya2 = $row1['bronya'];
$yron_p2 = $row1['yron_p'];
$yron_w2 = $row1['yron_w'];
$nadpis2 = $row1['nadpis2'];
$nadpis2 = str_replace('<','&lt;', $nadpis2);
$nadpis2 = str_replace('>','&gt;', $nadpis2);
$nadpis2 = str_replace('"','&quot', $nadpis2);
$nadpis2 = stripslashes("$nadpis2");
$long_text = strlen($nadpis2);
$ggg = rand(1,3);
?>
<?php if ($time11 > '0') {?>
<script type="text/javascript">
  document.location.href = "arena.php?err=4&time=<?php echo "$time11";?>";
</script>
<?php }?>
<div id="main">
<div class="stats">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Арена</p></center>
</div>
<div class="stats">
<center><b><?php echo "$nick1";?></b> против <b><a href="profile.php?id=<?php echo "$id2";?>"><?php echo "$nick2";?></a></b></center>
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p></center>
<p class="white" style="background: #303030;">Хочет сказать тебе: <span class="bonus"><?php if ($long_text > 0) {?><?php echo "$nadpis2";?><?php } else {?><?php
if ($ggg == '1') {?>О, еще один новичок! Давно не разминался... Нападай!<?php }
if ($ggg == '2') {?>Ну вот.. Мне уже трупы некуда складывать! Шучу, шучу, есть еще одно место...<?php }
if ($ggg == '3') {?>Видел мою снарягу? Или ты - самоубийца?<?php }
?><?php }?></span></p>
<div style="float: left;">
<img src="img/ava/<?php echo "$avatar1";?>.png" width="65" height="65"/><br/>
<img src="img/ico/lvl.gif"/><?php echo "$lvl";?><br/>
<img src="img/ico/life.png"/><?php echo "$hp1";?><br/>
<img src="img/ico/shield.png"/><?php echo "$bronya1";?><br/>
<img src="img/ico/to4nost.png"/><?php echo "$yron_p1";?> || <?php echo "$yron_w1";?><br/>
</div>
<div style="float: right;">
<img src="img/ava/<?php echo "$avatar2";?>.png" width="65" height="65"/><br/>
<img src="img/ico/lvl.gif"/><?php echo "$lvl4";?><br/>
<img src="img/ico/life.png"/><?php echo "$hp2";?><br/>
<img src="img/ico/shield.png"/><?php echo "$bronya2";?><br/>
<img src="img/ico/to4nost.png"/><?php echo "$yron_p2";?> || <?php echo "$yron_w2";?><br/>
</div>
</div>
</div>
<div style="clear:left; background: #303030;">
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<table>
<tr>
<td style="width:33%;padding-right:4px;">
<div style="position:relative;">
<a class="simple-but border gray mb1" href="arenaon.php?id=<?php echo "$id2";?>"><span><span>Напасть</span></span></a>

</div>
</td>
<td style="width:33%;padding-left:4px;">
<div style="position:relative;">
<a class="simple-but gray border mb1" href="arena1.php?tip=<?php echo "$tip";?>"><span><span>Следующий</span></span></a>

</div>
</td>
</tr>
</table>
<div class="link"><a href="arena.php" class="link"><img src="img/ico/arena.png" width="12" height="12"/> Арена</a></div>
</div>
<div style="clear:left;">
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</div>
</body>
</html>