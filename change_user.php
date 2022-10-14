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
$page_title = 'Редактирование игрока';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$id = $_GET['id'];
$query_us = "Select * from users where id='$user_id' limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$admin_n = $row_us['admin'];
$query_us1 = "Select * from users where id='$id' limit 1";
$result_us1 = mysqli_query($dbc, $query_us1) or die ('Ошибка передачи запроса к БД');
$row_us1 = mysqli_fetch_array($result_us1);
$nick = $row_us1['nick'];
$clan = $row_us1['clan'];
$cr = $row_us1['clan_rang'];
$money = $row_us1['money'];
$dengi = $row_us1['dengi'];
$habar = $row_us1['habar'];
$admin = $row_us1['admin'];
$moder = $row_us1['moder'];
$user = $row_us1['user'];
$gruppa = $row_us1['gruppa'];
$sex = $row_us1['sex'];
$apt = $row_us1['aptechki'];
$rad = $row_us1['antirad'];
$m_kill = $row_us1['m_kill'];
$opit = $row_us1['opit'];
$lvl = $row_us1['lvl'];
$password = $row_us1['password'];
$hp = $row_us1['hp'];
$m_fight = $row_us1['m_fight'];
$mail = $row_us1['mail'];
$slava = $row_us1['slava'];
$prem = $row_us1['premium'];
?>
<?php if ($admin_n == '0') {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($admin_n == '1') {?>
<p style="border-top: solid 1px #444e4f"></p>
<div id="main">
<center><span style="font-size: 16px">Редактирование игрока <span class="white"><b><?php echo "$nick";?></b></span></span></center>
<br />
<p style="border-top: dashed 1px #444e4f"></p>
<p class="podmenu">Отряд:</p>
<form enctype="multipart/form-data" method="post" action="change.php?tip=clan&id=<?php echo "$id";?>">
<input type="text" value="<?php echo "$clan";?>" style="width:75%; height:18px;" class="input" name="clan" />
<input type="submit" style="width:20%;" class="input" value="изменить" name="addchat"/>
</form>
<p class="podmenu">Ранг в отряде:</p>
<form enctype="multipart/form-data" method="post" action="change.php?tip=cr&id=<?php echo "$id";?>">
<input type="text" value="<?php echo "$cr";?>" style="width:75%; height:18px;" class="input" name="cr" />
<input type="submit" style="width:20%;" class="input" value="изменить" name="addchat"/>
</form>
<p class="podmenu">RUB:</p>
<form enctype="multipart/form-data" method="post" action="change.php?tip=money&id=<?php echo "$id";?>">
<input type="text" value="<?php echo "$money";?>" style="width:75%; height:18px;" class="input" name="money" />
<input type="submit" style="width:20%;" class="input" value="изменить" name="addchat"/>
</form>
<p class="podmenu">Чеки:</p> 
<form enctype="multipart/form-data" method="post" action="change.php?tip=dengi&id=<?php echo "$id";?>">
<input type="text" value="<?php echo "$dengi";?>" style="width:75%; height:18px;" class="input" name="dengi"/>
<input type="submit" style="width:20%;" class="input" value="изменить" name="addchat"/> 
</form>
<p class="podmenu">Хабар:</p>
<form enctype="multipart/form-data" method="post" action="change.php?tip=habar&id=<?php echo "$id";?>">
<input type="text" value="<?php echo "$habar";?>" style="width:75%; height:18px;" class="input" name="habar" />
<input type="submit" style="width:20%;" class="input" value="изменить" name="addchat"/>
</form>
<p class="podmenu">Аптечки:</p>
<form enctype="multipart/form-data" method="post" action="change.php?tip=apt&id=<?php echo "$id";?>">
<input type="text" value="<?php echo "$apt";?>" style="width:75%; height:18px;" class="input" name="apt" />
<input type="submit" style="width:20%;" class="input" value="изменить" name="addchat"/>
</form>
<p class="podmenu">Антирад:</p>
<form enctype="multipart/form-data" method="post" action="change.php?tip=rad&id=<?php echo "$id";?>">
<input type="text" value="<?php echo "$rad";?>" style="width:75%; height:18px;" class="input" name="rad" />
<input type="submit" style="width:20%;" class="input" value="изменить" name="addchat"/>
</form>
<p class="podmenu">Здоровье:</p>
<form enctype="multipart/form-data" method="post" action="change.php?tip=hp&id=<?php echo "$id";?>">
<input type="text" value="<?php echo "$hp";?>" style="width:75%; height:18px;" class="input" name="hp" />
<input type="submit" style="width:20%;" class="input" value="изменить" name="addchat"/>
</form>
<p class="podmenu">Убитые мутанты:</p>
<form enctype="multipart/form-data" method="post" action="change.php?tip=m_kill&id=<?php echo "$id";?>">
<input type="text" value="<?php echo "$m_kill";?>" style="width:75%; height:18px;" class="input" name="m_kill" />
<input type="submit" style="width:20%;" class="input" value="изменить" name="addchat"/>
</form>
<p class="podmenu">Слава:</p>
<form enctype="multipart/form-data" method="post" action="change.php?tip=slava&id=<?php echo "$id";?>">
<input type="text" value="<?php echo "$slava";?>" style="width:75%; height:18px;" class="input" name="slava" />
<input type="submit" style="width:20%;" class="input" value="изменить" name="addchat"/>
</form>
<p class="podmenu">Опыт:</p>
<form enctype="multipart/form-data" method="post" action="change.php?tip=opit&id=<?php echo "$id";?>">
<input type="text" value="<?php echo "$opit";?>" style="width:75%; height:18px;" class="input" name="opit" />
<input type="submit" style="width:20%;" class="input" value="изменить" name="addchat"/>
</form>
<p class="podmenu">Уровень:</p>
<form enctype="multipart/form-data" method="post" action="change.php?tip=lvl&id=<?php echo "$id";?>">
<input type="text" value="<?php echo "$lvl";?>" style="width:75%; height:18px;" class="input" name="lvl" />
<input type="submit" style="width:20%;" class="input" value="изменить" name="addchat"/>
</form>
<p class="podmenu">Ник:</p>
<form enctype="multipart/form-data" method="post" action="change.php?tip=nick&id=<?php echo "$id";?>">
<input type="text" value="<?php echo "$nick";?>" style="width:75%; height:18px;" class="input" name="nick" />
<input type="submit" style="width:20%;" class="input" value="изменить" name="addchat"/>
</form>
<p class="podmenu">E-mail:</p>
<form enctype="multipart/form-data" method="post" action="change.php?tip=mail&id=<?php echo "$id";?>">
<input type="text" value="<?php echo "$mail";?>" style="width:75%; height:18px;" class="input" name="mail" />
<input type="submit" style="width:20%;" class="input" value="изменить" name="addchat"/>
</form>
<p style="border-top: dashed 1px #444e4f"></p>
<p class="podmenu">Отправить на e-mail:</p>
<form enctype="multipart/form-data" method="post" action="change.php?tip=msg&id=<?php echo "$id";?>">
<input type="text" style="width:75%; height:18px;" class="input" name="msg" />
<input type="submit" style="width:20%;" class="input" value="отправить" name="addchat"/>
</form>
<?php if ($user_id == '10033') {?>
<p style="border-top: dashed 1px #444e4f"></p>
<p class="podmenu">VIP:</p>
<form enctype="multipart/form-data" method="post" action="change.php?tip=prem&id=<?php echo "$id";?>">
<input type="text" value="<?php echo "$prem";?>" style="width:75%; height:18px;" class="input" name="prem" />
<input type="submit" style="width:20%;" class="input" value="изменить" name="addchat"/>
</form>
<?php }?>
<br /><p style="border-top: dashed 1px #444e4f"></p>
<p class="podmenu">Группировка:</p>
<?php if ($gruppa != 'naemniki') {?><a href="change.php?tip=naemniki&id=<?php echo "$id";?>">Одиночки</a><?php } else {?><span class="bonus">Одиночки</span><?php }?> | <?php if ($gruppa != 'dolg') {?><a href="change.php?tip=dolg&id=<?php echo "$id";?>">Долг</a><?php } else {?><span class="bonus">Долг</span><?php }?> | <?php if ($gruppa != 'svoboda') {?><a href="change.php?tip=svoboda&id=<?php echo "$id";?>">Свобода</a><?php } else {?><span class="bonus">Свобода</span><?php }?> | <?php if ($gruppa != 'mon') {?><a href="change.php?tip=monolit&id=<?php echo "$id";?>">Монолит</a><?php } else {?><span class="bonus">Монолит</span><?php }?><br />
<p style="border-top: dashed 1px #444e4f"></p>
<p class="podmenu">Пол:</p>
<?php if ($sex == 'male') {?><a href="change.php?tip=woman&id=<?php echo "$id";?>">Женский</a> | <span class="bonus">Мужской</span><?php } else {?><span class="bonus">Женский</span> | <a href="change.php?tip=male&id=<?php echo "$id";?>">Мужской</a><?php }?><br />
<p style="border-top: dashed 1px #444e4f"></p>
<p class="podmenu">Статус:</p>
<?php if ($user == '0' and $id != '1') {?><p><a href="change.php?tip=user&id=<?php echo "$id";?>">Игрок</a></p><?php } else {?><p class="bonus">Игрок</p><?php }?>
<?php if ($moder == '0' and $id != '1') {?><p><a href="change.php?tip=moder&id=<?php echo "$id";?>">Модератор</a></p><?php } else {?><p class="bonus">Модератор</p><?php }?>
<?php if ($admin == '0' and $id != '1') {?><p><a href="change.php?tip=admin&id=<?php echo "$id";?>">Администратор</a></p><?php } else {?><p class="bonus">Администратор</p><?php }?>
<p style="border-top: dashed 1px #444e4f"></p>
<?php if ($moder == '1') {?>
<p><a href="change.php?tip=warning&id=<?php echo "$id";?>">Сделать предупреждение</a></p>
<p><a href="change.php?tip=warnings&id=<?php echo "$id";?>">Снять предупреждение</a></p>
<?php }?>
<p style="border-top: dashed 1px #444e4f"></p>
<p class="podmenu">Артефакты:</p>
<p><a href="change.php?tip=art_time&id=<?php echo "$id";?>">Пропустить паузу</a></p>
<p style="border-top: dashed 1px #444e4f"></p>
<p><span class="white">Восстановление пароля:</span> http://stalkeronlinegame.epizy.com/relostpass.php?nick=<?php echo"$id";?>&r=<?php echo "$password";?></p>
<p style="border-top: dashed 1px #444e4f"></p>
<br />
<p style="border-top: dotted 1px royalblue"></p>
<p><img src="img/reload.gif" width="12" height="12"/> <a href="user.php?id=<?php echo "$id";?>">Назад</a></p>
<p style="border-top: dotted 1px royalblue"></p>
</div>
<?php }
?>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>