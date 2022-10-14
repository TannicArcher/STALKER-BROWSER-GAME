<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Профиль';
require_once('conf/head.php');
$user_id = $_GET['id'];
$user_id = mysqli_real_escape_string($dbc, trim($user_id));	
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
$user_iq = $_SESSION['id'];
$query_iq = "Select * from users where id = '$user_iq' limit 1";
$result_iq = mysqli_query($dbc, $query_iq) or die ('Ошибка передачи запроса к БД');
$row_iq = mysqli_fetch_array($result_iq);
$admin_ad = $row_iq['admin'];
$moder_ad = $row_iq['moder'];
$profile = $row_iq['profile'];
$llvll = $row_iq['lvl'];
$lllvll = ($llvll * '50');
$query = "Select * from users where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$user_id = $row['id'];
$ip_r = $row['ip'];
$p_ban = $row['p_ban'];
$c_ban = $row['c_ban'];

if ($row == 0) {
require_once('conf/notfound.php');
}
else {
$mentor_time = $row['mentor_time'];
$mentor_type = $row['mentor_type'];
$pistols_yron = 0;
$weapons_yron = 0;
$pistols_tochn = 0;
$weapons_tochn = 0;
$hp_cl = 0;
$prochn_cl = 0;
$last_active = $row['last_active'];
$last_active = strtotime("$last_active");
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$razn_last_act = ($now - $last_active);
?>
<?php if ($profile == '2') {?>
<script type="text/javascript">
  document.location.href = "user.php?id=<?php echo "$user_id";?>";
</script>
<?php }?>
<div id="main">
  <div class="slot">
    <table width="190" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
<td width="54" valign="top"><a href="ava.php?type=1"><img src="img/ava/<?php echo $row['avatar']; ?>.png" class="upl"/></a></td>
   <td width="116" valign="top">
	<div class="inf">
	  <p><span class="white"><?php
	  if ($row['gruppa'] == 'svoboda') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><?php }}
	  if ($row['gruppa'] == 'dolg') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><?php }}
	  if ($row['gruppa'] == 'naemniki') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><?php }}
	  if ($row['gruppa'] == 'mon') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><?php }}
	  echo ' ' . $row['nick']; 
	  ?></span></p>
<p>(id: <?php echo "$user_id";?>)</p>
	  <?php
	  if ($row['gruppa'] <> 'mytants' and $row['gruppa'] <> 'bandits' and $row['gruppa'] <> 'monolits' and $row['gruppa'] <> 'zombie') {
	  ?>
      <p><b class="white"><?php
	  $query_lvl = "Select lvl, opit from opit order by lvl desc";
	  $result_lvl = mysqli_query($dbc, $query_lvl) or die ('Ошибка передачи запроса к БД');
	  $row_lvl = mysqli_fetch_array($result_lvl);
	  $big_next_lvl = $row_lvl['opit'];
	  $lvl=$row_lvl['lvl'];
	  while (($row['opit']/100)< $row_lvl['opit']) {
	  $next_lvl = $row_lvl['opit'];
	  $lvl=($lvl-1);
	  $row_lvl = mysqli_fetch_array($result_lvl);
	  }
	  if ($next_lvl == 0) {
	    $next_lvl = "$big_next_lvl" ;
	  } 
	  $inv2="$lvl";
	 echo "$lvl"; ?></b> ур,<?php 
	 }///////Если не мутанты
	  if ($row['gruppa'] == 'zombie') { echo 'Зомбированные';} 
	  if ($row['gruppa'] == 'bandits') { echo 'Бандиты';} 
	  if ($row['gruppa'] == 'mytants') { echo 'Мутанты';}
	  if ($row['gruppa'] == 'svoboda') { echo 'Свобода';}
	  if ($row['gruppa'] == 'dolg') { echo 'Долг';}
	  if ($row['gruppa'] == 'naemniki') { echo 'Одиночки';} 
	  if ($row['gruppa'] == 'mon') { echo 'Монолит';} 
	  ?> 
	  </p>
	  <?php
	  $clan = $row['clan'];
	  $inv = $row['clan'];
	  if ($row['gruppa'] <> 'mytants') {
	  if (!empty($clan)) {
	  $query_clan = "select name, clan_id, mentor from clans where clan_id = '$clan' limit 1";
	  $result_clan = mysqli_query($dbc, $query_clan) or die ('Ошибка передачи запроса к БД');
	  $row_clan = mysqli_fetch_array($result_clan); 
	  $mentor_clan = $row_clan['mentor'];
	  ?>
      <p>  <?php
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
	  $rank = $row['clan_rang'];
	  ?> 
<a href="company.php?company_id=<?php echo $row_clan['clan_id'];?>"><?php echo $row_clan['name']; ?></a>
	  <?php
	  if ($row['clan_rang'] == '1') {?>(Рекрут)<?php }
	  if ($row['clan_rang'] == '2') {?>(Рядовой)<?php }
	  if ($row['clan_rang'] == '3') {?>(Сержант)<?php }
	  if ($row['clan_rang'] == '4') {?>(Лейтенант)<?php }
	  if ($row['clan_rang'] == '5') {?>(Капитан)<?php }
	  if ($row['clan_rang'] == '6') {?>(Майор)<?php }
	  if ($row['clan_rang'] == '7') {?>(Полковник)<?php }
	  if ($row['clan_rang'] == '8') {?>(Генерал)<?php }
	  if ($row['clan_rang'] == '9') {?>(Маршал)<?php } 
	  if ($row['clan_rang'] == '10') {?>(Лидер)<?php } 
	  $rank = $row['clan_rang'];
	  ?> </p>
      <?php
	  }
	  }
	  ?>
	</div>
	</td>
    </tr>
    </tbody>
    </table>
  </div>
  <?php if ($row['gruppa'] <> 'mytants' and $row['gruppa'] <> 'bandits' and $row['gruppa'] <> 'monolits' and $row['gruppa'] <> 'zombie') { ?>
<center><p><img src="img/anketa/<?php if ($row['gruppa'] <> 'null') {if ($razn_last_act < 600 ) {?>on<?php } else {?>off<?php }}?><?php echo $row['gruppa']; ?><?php
if ($row['admin'] == 1 and $user_id <> '10033') {echo '1';}
if ($row['moder'] == 1) {echo '2';}
if ($user_id == '10033') {echo '3';}
if ($row['user'] == 0 and $row['moder'] == 0 and $row['admin'] == 0) {echo '3';}
if ($row['user'] == 1 and $row['ban'] == 0) {echo '3';}
if ($row['user'] == 1 and $row['ban'] == 1) {echo '4';}
?>.PNG" width="117" height="83" alt="анкета" /></p></center>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
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
<b>Пояс артефактов</b>
<table cellpadding="5" border="5">
<tr>
<td>	<?php
	$query_cl = "Select inf_id from things where user_id = '$user_id' and type = '6' and place = 2 limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	if ($row_cl != 0) {
	$art_id = $row_cl['inf_id'];
	$query_cl = "Select screen, name from art where art_id = '$art_id' limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	?><p><a href="boroda.php?type=2"><span class="clothes"><img src="img/art/<?php echo $row_cl['screen'];?>"/></span></a></p><?php }else{?><p><span class="red">пояс пуст</span></p><?php } ?></td>
</tr>
</table>
</center>

	<p><img src="img/ico/shield.png" width="12" height="12"/> <a href="clothes.php?id=<?php echo $row['id']; ?>">Снаряжение</a></p>
<?php if ($moder_ad == '1') {
?>
<p style="border-style: solid; border-width: 1px; border-color: #444e4f;"><span class="bonus">---</span><br />(модер-панель)<br />
<?php if ($row['user'] == 1 or $row['user'] == 2) {?><a href="moderator.php?type=7&avtor=<?php echo "$user_id";?>"><?php if ($row['f_ban'] == 0) {?>[Бан на форум]<?php } else {?><span class="red">[Разбан на форум]</span><?php }?></a><?php } else {?>[Блок форума не возможен]<?php }?></span><br />
<?php if ($row['user'] == 1 or $row['user'] == 2) {?><?php if ($p_ban == '0') {?><a href="bann.php?type=1&id=<?php echo "$user_id";?>&tip=on">[Блокировка почты]</a><?php } if ($p_ban == '1'){?><a class="red" href="bann.php?type=1&id=<?php echo "$user_id";?>&tip=off">[Разблокировка почты]</a><?php }?> <?php } else {?>[Блок почты не возможен]<?php }?></span><br />
<?php if ($row['user'] == 1 or $row['user'] == 2) {?><?php if ($c_ban == '0') {?><a href="bann.php?type=2&id=<?php echo "$user_id";?>&tip=on">[Блокировка чата]</a><?php } if ($c_ban == '1'){?><a class="red" href="bann.php?type=2&id=<?php echo "$user_id";?>&tip=off">[Разблокировка чата]</a><?php }?> <?php } else {?>[Блок чата не возможен]<?php }?></span><br />
<span class="bonus">---</span>
<?php } ?></p>
    <?php
	$id = $_SESSION['id'];
	$query = "Select admin, id, gruppa from users where id = '$id' limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
    $row2 = mysqli_fetch_array($result);
	if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
      if ($row2['admin'] == 0) {
	    if ($row['admin'] <> 1) { 
	      if (($id != $user_id) and ($row['gruppa'] == $row2['gruppa'])) {
	      ?>
	      <p><img src="img/ico/mail3.png"  alt="п"width="12" height="12"/> <a href="mail4.php?id=<?php echo "$user_id"?>">Отправить сообщение</a></p>
	      <?php
		  }
	    }
		else {
		?>
	      <p><img src="img/ico/mail3.png"  alt="п"width="12" height="12"/> <a href="mail4.php?id=<?php echo "$user_id"?>">Отправить сообщение</a></p>
	      <?php
		}
	  }
	  else {
	    if ($id != $user_id) {
	    ?>
<p style="border-top: solid 1px #444e4f;"></p>
	    <p><center><img src="img/ico/mail3.png"  alt="п"width="12" height="12"/> <a href="mail4.php?id=<?php echo "$user_id"?>">Отправить сообщение</a></p>
	  <?php if ($row2['admin'] == 1) {?><p>[<a href="moderator.php?type=7&avtor=<?php echo "$user_id";?>"><?php if ($row['f_ban'] == 0) {?>Бан на форум<?php } else {?><span class="red">Разбан на форум</span><?php }?></a>] [<?php if ($row['ban'] == 0) {?>
	    <a href="moderator.php?profile=<?php echo "$user_id"; ?>&type=8">Бан на игру</a><?php } else {?><a class="red" href="anti-ban.php?id=<?php echo "$user_id";?>">Разбан на игру</a><?php }?>]<br />
<?php if ($row['user'] == 1 or $row['user'] == 2) {?><?php if ($p_ban == '0') {?><a href="bann.php?type=1&id=<?php echo "$user_id";?>&tip=on">[Блокировка почты]</a><?php } if ($p_ban == '1'){?><a class="red" href="bann.php?type=1&id=<?php echo "$user_id";?>&tip=off">[Разблокировка почты]</a><?php }?> <?php } else {?>[Блок почты не возможен]<?php }?></span>
<?php if ($row['user'] == 1 or $row['user'] == 2) {?><?php if ($c_ban == '0') {?><a href="bann.php?type=2&id=<?php echo "$user_id";?>&tip=on">[Блокировка чата]</a><?php } if ($c_ban == '1'){?><a class="red" href="bann.php?type=2&id=<?php echo "$user_id";?>&tip=off">[Разблокировка чата]</a><?php }?> <?php } else {?>[Блок чата не возможен]<?php }?></span>
	  </center><p><?php }
	  }
	  }
	  if ((empty($inv)) and ($row['gruppa'] == $row2['gruppa']) and ($inv2 >= 5)) {
	  $inv_id = $_SESSION['id'];
	  $query_inv = "Select clan, clan_rang from users where id = '$inv_id'";
      $result_inv = mysqli_query($dbc, $query_inv) or die ('Ошибка передачи запроса к БД'); 
      $row_inv = mysqli_fetch_array($result_inv);
	  $rank = $row_inv['clan_rang'];
	  $clan_inv = $row_inv['clan'];
	    if ((!empty($clan_inv)) and ($rank > 5)) {
	      ?>
    <p><img src="img/ico/flag1.png"  alt=""width="12" height="12"/> <a href="invite.php?set_id=<?php echo "$user_id";?>">Пригласить в отряд</a></p>
	      <?php
	    }
	  }
    }
  ?>
<?php if ($row['gruppa'] != $row2['gruppa'] and $row['admin'] != '1' and $row2['admin'] != '1') {?>
<p><img src="img/ico/mail3.png"  alt="п"width="12" height="12"/> <a href="mail4.php?id=<?php echo "$user_id"?>">Отправить сообщение</a></p>
<?php }?>
<?php if ($user_id != $user_iq) {?>
<p><img src="img/ico/ohotniki.gif" width="12" height="12"/> <a href="arenaon1.php?id=<?php echo "$user_id";?>">Напасть</a> <span class="bonus">(-<?php echo "$lllvll";?><img src="img/ico/materials.png"/>)</span></p>
<?php }?>
</div>
  <?php
  if ($user_id == $_SESSION['id']) {
  ?>
  <div class="stats">
	<p><img src="img/star.png" width="12" height="12"/> <a href="events.php">События</a>
	<p><img src="img/6.png" width="12" height="12"/> <a href="ava.php?type=1">Купить аватар</a>
	<p><img src="img/ico/sumka.png" width="12" height="12"/> <a href="bag.php">Рюкзак</a>
	<?php
	$query_c = "Select user_id from things where place=0 and user_id = '$user_id' limit 20";
    $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
    $count = mysqli_num_rows($result_c);
	echo"($count)";
	?>
	</p>
	<p><img src="img/ico/inventar.png" width="12" height="12"/> <a href="stash.php">Тайник</a>
	<?php
	$query_c = "Select user_id from things where place=1 and user_id = '$user_id' limit 20";
    $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
    $count = mysqli_num_rows($result_c);
	echo"($count)";
	?></p>
<?php
$art_sum = ($row['art1'] + $row['art2'] + $row['art3'] + $row['art4'] + $row['art5']);
if ($row['art1'] > '0' or $row['art2'] > '0' or $row['art3'] > '0' or $row['art4'] > '0' or $row['art5'] > '0') {?>
<p><a href="art_belt.php"><img src="img/art/12.png" width="12" height="12"/> Контейнеры артефактов <?php
	echo"($art_sum)";
	?></a></p>
<?php }?>
	<p><img src="img/ico/mail3.png"  alt="п"width="12" height="12"/> <a href="mailbox.php">Почта</a></p>
  </div>
<?php
}
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$mentor_time = strtotime("$mentor_time");
$razn_mentor_user = ($now - $mentor_time);
if ($razn_mentor_user < 3600) {
$mentor_flag = 1;
  if ($mentor_type == 1) { 
    $mentor_clan = ($mentor_clan/2);
  }
}
else {
$mentor_flag = 0;
}

?>
  <div class="stats">
<?php
if ($admin_ad == '1') {?>
<center>[<a class="blue" href="change_user.php?id=<?php echo "$user_id";?>">Редактировать персонажа</a>]</center>
<?php
}
?>
  <p class="white"><b>Данные:</b></p>
<div class="main">
<?php if ($admin_ad == '1') {
?>
<?php if ($user_id != '10033') {?>
<p class="podmenu" style="border-top:1px dashed #444e4f; background-color:#1c252f;"></p>
<p class="gold">Персонажи: <span class="blue">(</span><span class="white"><?php echo "$ip_r" ; ?></span><span class="blue">)</span></p>
<?php
$query_sub = "Select * from users where ip = '$ip_r' and id <> '10033' order by lvl desc limit 50";
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
if ($block == '1') {?><img src="img/block.png" width="12" height="12"/> <?php }
?><a href="profile.php?id=<?php echo "$id_top" ; ?>"><?php echo "$name" ; ?></a> [<a href="http://stalkeronlinegame.epizy.com/moderator.php?profile=<?php echo "$id_top" ; ?>&type=8" onclick="return confirm
('Уверены?')">бан</a>]</p>
<?php 
}
?>
<p class="podmenu" style="border-top:1px dashed #444e4f; background-color:#1c252f;"></p>
<?php } ?>
<?php } ?>
<span class="red"><?php if ($row['ban'] == 1) {?><span class="bonus">---</span><br/><span class="red">Заблокирован</span><br /><span class="white">Причина:</span> <br/><?php echo $row['why_ban']; ?> <br/><span class="bonus">---</span><?php } else {?><span class="bonus"> </span><?php }?></span></div></p>
<center>Достижения</center>
 <p class="podmenu" style="border-top:1px solid #444e4f; background- color:#1c252f;">
 <p class="podmenu" style="border-top:1px solid #444e4f; background- color:#1c252f;">
  <p>пол: <span class="white"><?php if ($row['sex'] == male) {?>мужской<?php } else {?><span class="white">женский</span><?php }?></span></p>
  <p>слава: <span class="white"><?php echo $row['slava']; ?></span></p>
  <p>убито мутантов: <span class="white"><?php echo $row['m_kill']; ?></span></p>
  <p>время взлома тайников: <span class="white"><?php echo $row['tainik_time']; ?></span> секунд</p>
  <p>выполнено заданий: <span class="white"><?php echo $row['quests']; ?></span></p>
  <p>ранг:<span class="white">
<?php 
if ($row['lvl'] == 1) { echo 'прибывший ';}
if ($row['lvl'] == 2) { echo 'прибывший ';}
if ($row['lvl'] == 3) { echo 'прибывший ';}
if ($row['lvl'] == 4) { echo 'новичок ';}
if ($row['lvl'] == 5) { echo ' новичок ';}
if ($row['lvl'] == 6) { echo ' новичок ';}
if ($row['lvl'] == 7) { echo ' опытный ';}
if ($row['lvl'] == 8) { echo ' опытный ';}
if ($row['lvl'] == 9) { echo ' опытный ';}
if ($row['lvl'] == 10) { echo 'сталкер ';}
if ($row['lvl'] == 11) { echo ' сталкер ';}
if ($row['lvl'] == 12) { echo ' сталкер ';}
if ($row['lvl'] == 13) { echo ' сталкер ';}
if ($row['lvl'] == 14) { echo ' сталкер ';}
if ($row['lvl'] == 15) { echo ' сталкер ';}
if ($row['lvl'] == 16) { echo ' опытный сталкер ';}
if ($row['lvl'] == 17) { echo ' опытный сталкер ';}
if ($row['lvl'] == 18) { echo ' опытный сталкер ';}
if ($row['lvl'] == 19) { echo ' опытный сталкер ';}
if ($row['lvl'] == 20) { echo ' младший ветеран ';}
if ($row['lvl'] == 21) { echo ' младший ветеран ';}
if ($row['lvl'] == 22) { echo ' младший ветеран ';}
if ($row['lvl'] == 23) { echo ' младший ветеран ';}
if ($row['lvl'] == 24) { echo ' младший ветеран ';}
if ($row['lvl'] == 25) { echo ' ветеран ';}
if ($row['lvl'] == 26) { echo ' ветеран ';}
if ($row['lvl'] == 27) { echo ' ветеран ';}
if ($row['lvl'] == 28) { echo ' начинающий мастер ';}
if ($row['lvl'] == 29) { echo ' начинающий мастер ';}
if ($row['lvl'] == 30) { echo ' начинающий мастер ';}
if ($row['lvl'] == 31) { echo ' мастер ';}
if ($row['lvl'] == 32) { echo ' мастер ';}
if ($row['lvl'] == 33) { echo ' мастер ';}
if ($row['lvl'] == 34) { echo ' мастер ';}
if ($row['lvl'] == 35) { echo 'призрак';}
if ($row['lvl'] == 36) { echo 'призрак';}
if ($row['lvl'] == 37) { echo 'призрак';}
if ($row['lvl'] == 38) { echo ' легенда Зоны ';}
if ($row['lvl'] == 39) { echo ' легенда Зоны ';}
if ($row['lvl'] == 40) { echo 'повелитель зоны';}
?></span></p>
   <p>где: <span class="white">
<?php 
	  if ($row['location'] == 'index') { echo 'на главной';}
	  if ($row['location'] == 'chat') {?><a href="chat.php?nick=<?php echo $row['id']; ?>">в чате</a><?php }
	  if ($row['location'] == 'skadovsk') {?><a href="skadovsk.php">в скадовске</a><?php }
	  if ($row['location'] == 'mail') { echo 'в почте';}
	  if ($row['location'] == 'arena') { echo 'на арене';}
	  if ($row['location'] == 'events') { echo 'смотрит события';}
	  if ($row['location'] == 'bitva_o') { echo 'в битве';}
	  if ($row['location'] == 'forum') { echo 'в форуме';}
	  if ($row['location'] == 'zveroboy') { echo 'у глухаря';}
	  if ($row['location'] == 'base') { echo 'в деревне новичков';}
	  if ($row['location'] == 'secret') { echo 'в перестрелках';}
	  if ($row['location'] == 'kordon1') { echo 'в локации "скадовск"';}
	  if ($row['location'] == 'kordon2') { echo 'в земснаряде';}
	  if ($row['location'] == 'kordon3') { echo 'в "Железном лесу"';}
	  if ($row['location'] == 'kordon4') { echo 'в лесничестве';}
	  if ($row['location'] == 'svalka1') { echo 'в станции "Янов"';}
	  if ($row['location'] == 'svalka2') { echo 'в бункере Ученых';}
	  if ($row['location'] == 'svalka3') { echo 'в копачах';}
	  if ($row['location'] == 'svalka4') { echo 'в заводе "Юпитер"';}
	  if ($row['location'] == 'agroprom1') { echo 'в Оазисе';}
	  if ($row['location'] == 'agroprom2') { echo 'в Оазисе';}
	  if ($row['location'] == 'agroprom3') { echo 'в Оазисе';}
	  if ($row['location'] == 'agroprom4') { echo 'в Оазисе';}
	  if ($row['location'] == 'agroprom5') { echo 'в Оазисе';}
	  if ($row['location'] == 'agroprom6') { echo 'в Оазисе';}
	  if ($row['location'] == 'monster1') { echo 'в рейде на снорка';}
	  if ($row['location'] == 'monster2') { echo 'в рейде на химеру';}
	  if ($row['location'] == 'monster3') { echo 'в рейде на слепого пса';}
	  if ($row['location'] == 'monster4') { echo 'в рейде на контролера';}
	  if ($row['location'] == 'monster5') { echo 'в рейде на плоть';}
	  if ($row['location'] == 'monster6') { echo 'в рейде на химеру';}
	  if ($row['location'] == 'monster7') { echo 'в рейде на псевдогиганта';}
	  if ($row['location'] == 'monster8') { echo 'в рейде на бюрера';}
	  if ($row['location'] == 'monster9') { echo 'в рейде на кровососа';}
	  if ($row['location'] == 'monster10') { echo 'в рейде на беса';}
	  if ($row['location'] == 'yantar1') { echo 'в прачечной';}
	  if ($row['location'] == 'yantar2') { echo 'в КБО "Юбилейный"';}
	  if ($row['location'] == 'yantar3') { echo 'в детском саду';}
	  if ($row['location'] == 'yantar4') { echo 'в общежитии';}
	  if ($row['location'] == 'yantar5') { echo 'в кинотеатре "Прометей"';}
	  if ($row['location'] == 'yantar6') { echo 'в магазине "Книги"';}
	  if ($row['location'] == 'voensklad1') { echo 'в лаборатории Х-8';}
	  if ($row['location'] == 'voensklad2') { echo 'в лаборатории Х-8';}
	  if ($row['location'] == 'voensklad3') { echo 'в лаборатории Х-8';}
	  if ($row['location'] == 'voensklad4') { echo 'в лаборатории Х-8';}
	  if ($row['location'] == 'voensklad5') { echo 'в лаборатории Х-8';}
	  if ($row['location'] == 'voensklad6') { echo 'в лаборатории Х-8';}
	  if ($row['location'] == 'voensklad7') { echo 'в лаборатории Х-8';}
?>
   </span></p>
<p>последняя активность: <span class="white"><?php echo $row['last_active']; ?></span></p><br />
  <p class="white"><b>Одежда</b></p>
  <p><img src="img/ico/life.png" width="12" height="12"/> здоровье: 
  <?php if ($mentor_flag == 0) {?><span class="white"><?php echo $row['hp']; ?> || <?php echo $row['max_hp']; ?></span><?php } else {$max_hp = ($row['max_hp']+$row['max_hp']/100*$mentor_clan); $max_hp = round($max_hp);?><span class="bonus"><?php echo $row['hp']; ?> || <?php echo "$max_hp";?></span><?php }?></p>
  <p><img src="img/ico/shield.png" width="12" height="12"/> броня:
  <?php if ($mentor_flag == 0) {?><span class="white"><?php echo $row['bronya']; ?></span><?php } else {$bronya = ($row['bronya']+$row['bronya']/100*$mentor_clan); $bronya = round($bronya);?><span class="bonus"><?php echo "$bronya";?></span><?php }?></p>
  <p><img src="img/ico/shield.png" width="12" height="12"/> прочность:
  <?php if ($mentor_flag == 0) {?><span class="white"> <?php echo $row['razriv_cl']; ?></span><?php } else {$razriv_cl = ($row['razriv_cl']+$row['razriv_cl']/100*$mentor_clan); $razriv_cl = round($razriv_cl);?><span class="bonus"> <?php echo "$razriv_cl";?></span><?php }?></p>
  <p><img src="img/ico/goodrad.png" width="12" height="12"/> рад.защита:
  <?php if ($mentor_flag == 0) {?><span class="white"> <?php echo $row['radiation']; ?></span><?php } else {$radiation = ($row['radiation']+$row['radiation']/100*$mentor_clan); $radiation = round($radiation);?><span class="bonus"> <?php echo "$radiation";?></span><?php }?></p>
  <p><img src="img/ico/regen.gif" width="12" height="12"/> регенерация: <span class="white"><?php echo $row['regen']; ?></span></p>

  <div class="block">
  <p class="white"><b>Оружие</b></p>
  <p><img src="img/ico/to4nost.png" width="12" height="12"/> урон: <?php if ($mentor_flag == 0) {?><span class="white"> <?php echo $row['yron_p']; ?></span><?php } else {$yron_p = ($row['yron_p']+$row['yron_p']/100*$mentor_clan); $yron_p = round($yron_p);?><span class="bonus"> <?php echo "$yron_p";?></span><?php }?> ||
 <?php if ($mentor_flag == 0) {?><span class="white"> <?php echo $row['yron_w']; ?></span><?php } else {$yron_w = ($row['yron_w']+$row['yron_w']/100*$mentor_clan); $yron_w = round($yron_w);?><span class="bonus"> <?php echo "$yron_w";?></span><?php }?></p>
  
  <p><img src="img/ico/to4nost.png" width="12" height="12"/> точность: <?php if ($mentor_flag == 0) {?><span class="white"> <?php echo $row['tochn_p']; ?></span><?php } else {$tochn_p = ($row['tochn_p']+$row['tochn_p']/100*$mentor_clan); $tochn_p = round($tochn_p);?><span class="bonus"> <?php echo "$tochn_p";?></span><?php }?> || 
  <?php if ($mentor_flag == 0) {?><span class="white"> <?php echo $row['tochn_w']; ?></span><?php } else {$tochn_w = ($row['tochn_w']+$row['tochn_w']/100*$mentor_clan); $tochn_w = round($tochn_w);?><span class="bonus"> <?php echo "$tochn_w";?></span><?php }?></p>
  
  <p><img src="img/ico/to4nost.png" width="12" height="12"/> надёжность: <span class="white"><?php echo $row['safety_p'];?> </span> || <span class="white"><?php echo $row['safety_w']; ?>%</span></p>
  <p><img src="img/ico/speed.png" width="12" height="12"/> скорострельность: <span class="white"><?php echo $row['speed_p'];?> </span>|| <span class="white"><?php echo $row['speed_w']; ?></span></p>
  
  <?php
  if ($mentor_flag == 1) {
  ?>
  <p><img src="img/ico/point.png" width="12" height="12"/> напарник: <span class="bonus">+<?php 
  echo "$mentor_clan";
  ?>%</span> 
  <?php
  $time = (date("Y-m-d H:i:s"));
  $time = strtotime("$time");
  $mentor_time = ($time - $mentor_time);
  if ($mentor_time <= 3600) {
  $echo_time = (3600 - $mentor_time);
  $hours_time = ($echo_time/3600);
  $hours_time = floor($hours_time);
  $minutes_time = ($echo_time - (3600 * $hours_time));
  $minutes_time = ($minutes_time/60);
  $minutes_time = floor($minutes_time);
  $seconds = ($echo_time - ($hours_time*3600) - ($minutes_time*60));
  }
  ?></p>
  <?php
  }
  ?>
  </div>
  </div>
  <div class="stats">
  <?php
  if ($user_id == $_SESSION['id'] or $_SESSION['admin'] == 1) {
  ?>
  <p><img src="img/ico/money.png" width="12" height="12"/> деньги: <span class="white"><?php echo $row['money']; ?> RUB</span></p>
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

  ---
  <p>Ваш IP:<span class="white">
<?php
echo $row['ip'];
?> </span></p>
  ---
<?php
  }
  ?>
    <div class="block">
	<p><img src="img/ico/point.png" width="12" height="12"/> активность: <span class="white"><?php echo $row['activ']; ?></span></p>
	<p><img src="img/ico/point.png" width="12" height="12"/> опыт: <span class="white"><?php 
	if ($lvl <=2) {
	$opit = $row['opit'];
	echo ($opit);  $next_lvl = ($next_lvl*100); echo " / $next_lvl";?></span></p><?php
	} 
	else {
	$opit = ($row['opit']/100);
	$opit = round($opit,0);
	echo ($opit/10); ?>к<?php $next_lvl = ($next_lvl/10); echo " / $next_lvl";?>к  </span> </p>
	<?php
	}
	?>
	</div>
	<?php
    if ($user_id == $_SESSION['id']) {
    ?>
	<div class="block">
	<p><img src="img/ico/life.png" width="12" height="12"/> <a href="treatment.php">Лечение</a></p>
	<p><img src="img/ico/nastroiki.png" width="12" height="12"/> <a href="settings.php">Настройки</a></p>
	<p><img src="img/ico/chel.png" width="12" height="12"/> <a href="ref.php">Пригласить</a></p>
	<p><img src="img/ico/bonus.gif" width="12" height="12"/> <a href="payment.php">Пополнить баланс</a></p>
	<p><img src="img/ico/out.png" width="12" height="12"/> <a href="exit.php">Выход</a></p>
	</div>
	<?php
	}
	?>
  </div>
  </div>
  <?php
    }///ecли не мутанты
}  
  require_once('conf/navig.php');
  
    require_once('conf/foot.php');
	mysqli_close($dbc);
  ?>
</body>
</html>