<?
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Техническая поддержка';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
?>
<p class="bonus">*занятость - количество отправленных вопросов, на которые еще не дан ответ.</p>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Модераторы:</p>
<?php
$query_subb = "Select * from users where moder = '1' order by last_active desc limit 15";
$result_subb = mysqli_query($dbc, $query_subb) or die ('Ошибка передачи запроса к БД');
while ($row_subb = mysqli_fetch_array($result_subb)) {
$idd = $row_subb['id'];
$nickd = $row_subb['nick'];
$mesd = $row_subb['message'];
$last_active = $row_subb['last_active'];
$last_active = strtotime("$last_active");
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$razn_last_act = ($now - $last_active);
?>
<p><?php if ($row_subb['gruppa'] == 'svoboda') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
if ($row_subb['gruppa'] == 'dolg') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
if ($row_subb['gruppa'] == 'naemniki') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
if ($row_subb['gruppa'] == 'mon') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}
?> <a href="profile.php?id=<?php echo "$idd" ; ?>"><?php echo "$nickd" ; ?></a> <span class="red">(занятость: <?php echo "$mesd" ; ?>)</span> [<img src="img/ico/mail3.png" width="12" height="12"/><a href="mail4.php?id=<?php echo "$idd" ; ?>">написать</a>]</p>
<?php 
}
?>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Администраторы:</p>
<?php
$query_sub = "Select * from users where admin = '1' and id <> '8800' order by last_active desc limit 10";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$id = $row_sub['id'];
$nick = $row_sub['nick'];
$mes = $row_sub['message'];
$last_active = $row_sub['last_active'];
$last_active = strtotime("$last_active");
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$razn_last_act = ($now - $last_active);
?>
<p><?php if ($row_sub['gruppa'] == 'svoboda') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
if ($row_sub['gruppa'] == 'dolg') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
if ($row_sub['gruppa'] == 'naemniki') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
if ($row_sub['gruppa'] == 'mon') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}
?> <a <?php if ($id == '530') {?>class="blue"<?php }?> href="profile.php?id=<?php echo "$id" ; ?>"><?php echo "$nick" ; ?></a> <span class="red">(занятость: <?php echo "$mes" ; ?>)</span> [<img src="img/ico/mail3.png" width="12" height="12"/><a href="mail4.php?id=<?php echo "$id" ; ?>">написать</a>]</p>
<?php 
}
?>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?
require_once('conf/navig.php');
require_once('conf/foot.php'); 
?>