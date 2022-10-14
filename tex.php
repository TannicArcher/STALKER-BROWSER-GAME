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
$page_title = 'Техподдержка';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$err = $_GET['err'];
$type = $_GET['type'];
if ($err == '1') {
echo '<p class="red">В запросе слишком мало символов.</p>';
}
if ($err == '2') {
echo '<p class="red">Запросы в тех поддержку можно отправлять не чаще одного раза в 5 минут.</p>';
}
?><small>
<p class="lal2">*Правильно выбранный тип запроса ускорит его обработку</p>
<p class="lal2">**Ответы на ваши запросы хранятся в почте 48 часов</p>
</small>
<p class="podmenu">Техподдержка</p>
<?php if ($type != '1' and $type != '2') {?>
<a href="tex.php?type=1" class="menu">
<p class="podmenu" style="border-top:1px solid #444e4f;"></p>
<img src="img/ico/link.png"/> Задать вопрос</a>
<p style="border-top:1px dashed #444e4f;"></p>
<a href="/donate/" class="menu">
<img src="img/ico/link.png"/> Купить RUB
<p class="podmenu" style="border-top:1px solid #444e4f;"></p></a>
<?php
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$query_ti = "Select * from texpod where ot = '$user_id' and otvet <> '' order by time desc";
$result_ti = mysqli_query($dbc, $query_ti) or die ('Ошибка передачи запроса к БД1');
while ($row_ti = mysqli_fetch_array($result_ti)) {
$text = $row_ti['text'];
$otvet = $row_ti['otvet'];
$time = $row_ti['time'];
$time1 = $row_ti['time1'];
?>
<p class="podmenu">Пришёл ответ на один из запросов:</p>
<p class="white"><span style="color: royalblue">Вы:</span> <?php echo "$text";?> <span style="color: #444e4f;"><small>(<?php echo "$time";?>)</small></span></p>
<p class="white"><span style="color: royalblue">Ответ:</span> <?php echo "$otvet";?> <span style="color: #444e4f;"><small>(<?php echo "$time1";?>)</small></span></p>
<?php
$query = "delete from texpod where time1 < NOW() - (480000) and ot = '$user_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
$query = "update texpod set reading_in='0' where reading_in='1' and ot='$user_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
}
?>
<?php }?>
<?php if ($type == '1' or $type == '2') {?>
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
  <p><?php if ($type == '1') {?>Задать:<?php } else {?><script type="text/javascript">
  document.location.href = "mail4.php?id=530";
</script><small>Если хотите, чтобы ваш запрос был обработан быстрее - отправьте заявку <b><a href="mail4.php?id=530">администратору</a></b> игры.</small><p class="podmenu" style="border-top:1px solid #444e4f;"></p>
Заявка:<?php }?></p>
<center>
<form enctype="multipart/form-data" method="post" action="tex_act.php?type=<?php echo "$type";?>">
<textarea rows="2" style="width:98%; height:60px;" cols="35px" name="say"></textarea>
<div class="knopka">
<input type="submit" style="width:74px;" class="input" value="Отправить" name="addad"/>
</div>
</form></center>
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
<?php }?>

<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>