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
$page_title = 'Бан';
require_once('conf/head.php');
require_once('conf/top.php');

$user_id122 = $_SESSION['id'];
$query123 = "Select moder, admin, nick from users where id = '$user_id122' limit 1";
$result123 = mysqli_query($dbc, $query123) or die ('Ошибка передачи запроса к БД');
$row123 = mysqli_fetch_array($result123);
$moder = $row123['moder'];
$admin = $row123['admin'];
$nick = $row123['nick'];

$id_ban = $_GET['id'];
$query321 = "Select moder, admin, nick from users where id = '$id_ban' limit 1";
$result321 = mysqli_query($dbc, $query321) or die ('Ошибка передачи запроса к БД');
$row321 = mysqli_fetch_array($result321);
$moder1 = $row321['moder'];
$admin1 = $row321['admin'];
$nick1 = $row321['nick'];
?>

<?php
$anb = $_GET['anb'];
if ($moder == '1' or $admin == '1')  {?>

<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////Проверяем Баны
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$ban_p = '0';
$ban_f = '0';
$ban_c = '0';
$blocked = '0';
$query_pb = "Select * from bans where user_id = '$id_ban' and type = '1'";
$result_pb = mysqli_query($dbc, $query_pb) or die ('Ошибка передачи запроса к БД');
$row_pb = mysqli_fetch_array($result_pb);
if ($row_pb > '0') {
$ban_p = '1';
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$query_fb = "Select * from bans where user_id = '$id_ban' and type = '2'";
$result_fb = mysqli_query($dbc, $query_fb) or die ('Ошибка передачи запроса к БД');
$row_fb = mysqli_fetch_array($result_fb);
if ($row_fb > '0') {
$ban_f = '1';
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$query_cb = "Select * from bans where user_id = '$id_ban' and type = '3'";
$result_cb = mysqli_query($dbc, $query_cb) or die ('Ошибка передачи запроса к БД');
$row_cb = mysqli_fetch_array($result_cb);
if ($row_cb > '0') {
$ban_c = '1';
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$query_blb = "Select * from bans where user_id = '$id_ban' and type = '4'";
$result_blb = mysqli_query($dbc, $query_blb) or die ('Ошибка передачи запроса к БД');
$row_blb = mysqli_num_rows($result_blb);
if ($row_blb > '0') {
$blocked = '1';
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////Проверили
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<?php
if ($anb == '1') {
$query = "delete from bans where user_id = '$id_ban' and type = '1'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into mod_chat (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '1337', '<span class=default>Модератор <span class=bonus>$nick</span> (id: $user_id122) снял бан с игрока <span class=bonus>$nick1</span> (id: $id_ban) по категории <span class=red>Почта</span>.</span>', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "update users set mc=mc+'1' where user <> '1' and id != '$user_id' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
if ($anb == '2') {
$query = "delete from bans where user_id = '$id_ban' and type = '2'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into mod_chat (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '1337', '<span class=default>Модератор <span class=bonus>$nick</span> (id: $user_id122) снял бан с игрока <span class=bonus>$nick1</span> (id: $id_ban) по категории <span class=red>Форум</span>.</span>', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "update users set mc=mc+'1' where user <> '1' and id != '$user_id' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
if ($anb == '3') {
$query = "delete from bans where user_id = '$id_ban' and type = '3'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into mod_chat (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '1337', '<span class=default>Модератор <span class=bonus>$nick</span> (id: $user_id122) снял бан с игрока <span class=bonus>$nick1</span> (id: $id_ban) по категории <span class=red>Чат</span>.</span>', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "update users set mc=mc+'1' where user <> '1' and id != '$user_id' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
if ($anb == '4') {
$query = "delete from bans where user_id = '$id_ban' and type = '4'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into mod_chat (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '1337', '<span class=default>Модератор <span class=bonus>$nick</span> (id: $user_id122) снял бан с игрока <span class=bonus>$nick1</span> (id: $id_ban) по категории <span class=red>Полная блокировка персонажа</span>.</span>', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "update users set mc=mc+'1' where user <> '1' and id != '$user_id' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
?>

<div style="background-color: #1E1E1E; margin-top: 4px;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>Дать бан сталкеру <?php echo "$nick1";?>:</b></center>
<p style="border-top:1px solid #444e4f;"></p>
</div>
<div class="regf" style="background:#000001 url(http://stalkeronlinegame.epizy.com/img/dlfon.gif) repeat;">
<center>
<?php
$type = $_POST['type'];
$wtf = $_POST['wtf'];
$time = $_POST['time'];
$link = $_GET['link'];
$wtf1 = str_replace(' ', '', $wtf);
$wtf2 = iconv_strlen($wtf1, 'UTF-8');
if ($type == '1') {
$cat = 'Почта';
}
if ($type == '2') {
$cat = 'Форум';
}
if ($type == '3') {
$cat = 'Чат';
}
if ($type == '4') {
$cat = 'Полная блокировка персонажа';
}
?>
<div class="r3">
<?php if ($ban_p > '0' or $ban_f > '0' or $ban_c > '0' or $blocked > '0') {?>
<p><b>Уже имеющиеся баны:</b></p>
<p>
<?php
if ($ban_p > '0' and $anb <> '1') { echo "Бан почты [<a href='ban.php?id=$id_ban&anb=1'>x</a>]<br/>";}
if ($ban_f > '0' and $anb <> '2') { echo "Бан форума [<a href='ban.php?id=$id_ban&anb=2'>x</a>]<br/>";}
if ($ban_c > '0' and $anb <> '3') { echo "Бан чата [<a href='ban.php?id=$id_ban&anb=3'>x</a>]<br/>";}
if ($blocked > '0' and $anb <> '4') { echo "Блокировка аккаунта [<a href='ban.php?id=$id_ban&anb=4'>x</a>]<br/>";}
?>
<?php }?>
</div>
<?php
if ($link == 'true' and $wtf2 > '5' and $admin1 != '1'  and $time > '0' and $type > '0') {
$query_q = "insert into bans (`user_id`, `mod_id`, `time_ban`, `time_type`, `type`, `wtf`) values ('$id_ban', '$user_id122', NOW(), '$time', '$type', '$wtf')";
$result_q = mysqli_query($dbc, $query_q) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into mod_chat (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '1337', '<span class=default>Модератор <span class=bonus>$nick</span> (id: $user_id122) забанил игрока <span class=bonus>$nick1</span> (id: $id_ban) на <b><span class=white>$time</span></b> минут по категории <span class=red>$cat</span>, указав при этом причину:<br/><span class=red><i>$wtf.</i></span></span>', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "update users set mc=mc+'1' where user <> '1' and id != '$user_id' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
echo "Игрок $nick1 заблокирован на $time минут по категории $cat <br/>Причина: $wtf";
}
?>

<?php
if ($wtf2 < '5' and $link == 'true') {
echo "Слишком короткая причина";
}
if ($type < '1' and $link == 'true') {
echo "Вы не выбрали категорию";
}
if ($admin1 == '1' and $link == 'true') {
echo "У вас нет прав для блокировки этого пользователя";
}
?>

<?php if ($id_ban > '0') {?>
  <div id="error">

<div class="r6">
<span w:id="navigation">
<div class="brunches-block">
<form enctype="multipart/form-data" method="post" action="ban.php?id=<?php echo "$id_ban";?>&link=true">
<span class="white">
  <label for="type">Категория:</label><br />
  <select name="type" class="input" style="width: 90%;" size="1">
   <option value="" <? if ($_POST['type'] == '') {?>selected="selected"<?php }?>>Выбрать</option>
   <?php if ($ban_p == '0') {?>
<option value="1" <? if ($_POST['type'] == p_ban) {?>selected="selected"<?php }?>>Почта</option>
<?php }?>
<?php if ($ban_f == '0') {?>
   <option value="2" <? if ($_POST['type'] == f_ban) {?>selected="selected"<?php }?>>Форум</option>
<?php }?>
<?php if ($ban_c == '0') {?>
   <option value="3" <? if ($_POST['type'] == f_ban) {?>selected="selected"<?php }?>>Чат</option>
<?php }?>
<?php if ($blocked == '0') {?>
   <option value="4" <? if ($_POST['type'] == blocked) {?>selected="selected"<?php }?> >Блокировка персонажа</option>
<?php }?>
  </select><br />

  <label for="time">Время:</label><br />
  <select name="time" class="input" style="width: 90%;" size="1">
   <option value="60" <? if ($_POST['time'] == 60) {?>selected="selected"<?php }?>>1 час</option>
   <option value="180" <? if ($_POST['time'] == 180) {?>selected="selected"<?php }?>>3 часа</option>
   <option value="360" <? if ($_POST['time'] == 360) {?>selected="selected"<?php }?>>6 часов</option>
   <option value="720" <? if ($_POST['time'] == 720) {?>selected="selected"<?php }?> >12 часов</option>
   <option value="1440" <? if ($_POST['time'] == 1440) {?>selected="selected"<?php }?> >1 сутки</option>
   <option value="4320" <? if ($_POST['time'] == 4320) {?>selected="selected"<?php }?> >3 суток</option>
   <option value="10080" <? if ($_POST['time'] == 10080) {?>selected="selected"<?php }?> >1 неделя</option>
<?php if ($admin == '1') {?>
   <option value="100800" <? if ($_POST['time'] == 100800) {?>selected="selected"<?php }?> >10 недель</option>
<?php }?>
  </select><br />

  <label for="wtf">Причина:</label><br />
  <input type="text" class="input" style="width: 90%;" value="" name="wtf" /><br />
  <div class="knopka">
  <input type="submit" class="input" value="Забанить" name="reg" />
  </div></b></span>
</form>
</div>
</span>
</div>
<?php } else {?>
<h1>Fatal Error</h1>
<?php }?>
</center>

 <?php } ?>
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>