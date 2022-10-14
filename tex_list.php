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
$mes = $_GET['mes'];
$user_id = $_SESSION['id'];
$query1 = "Select * from users where id='$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$row1 = mysqli_fetch_array($result1);
$admin = $row1['admin'];
$user = $row1['user'];
$query12 = "Select * from users where id='$mes' limit 1";
$result12 = mysqli_query($dbc, $query12) or die ('Ошибка передачи запроса к БД');
$row12 = mysqli_fetch_array($result12);
$nick = $row12['nick'];
$avatar = $row12['avatar'];
$gruppa = $row12['gruppa'];
$on = $row12['on'];
$query_num = "Select mes_id from texpod where reading = '0'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД0');
$total6 = mysqli_num_rows($result_num);
$message = $total6;
?>
<?php if ($user != '1') {?>
<?php if (!empty($mes)) {?>
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"><?php echo "$nick";?></p></center>
<div style="float: left;">
<img src="img/ava/<?php echo "$avatar";?>.png" width="50" height="50" />
</div> <?php
if ($gruppa == 'svoboda') {if ($on == '1' ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
if ($gruppa == 'dolg') {if ($on == '1' ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
if ($gruppa == 'naemniki') {if ($on == '1' ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
if ($gruppa == 'mon') {if ($on == '1' ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}
?><a href="profile.php?id=<?php echo "$mes";?>"><?php echo "$nick";?></a><br/>
<div style="clear: left;">
</div>
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
  <p>Сообщение:</p>
<center>
<form enctype="multipart/form-data" method="post" action="tex_act.php?mes=<?php echo "$mes";?>&flag=1">
<textarea rows="2" style="width:98%; height:60px;" cols="35px" name="say"></textarea>
<div class="knopka">
<input type="submit" style="width:74px;" class="input" value="Отправить" name="addad"/>
</div>
</form></center>
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
<?php
$query_us = "Select * from texpod where ot = '$mes' order by time DESC";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
while ($row_us = mysqli_fetch_array($result_us)) {
$idlo = $row_us['mes_id'];
$text = $row_us['text'];
$otvet = $row_us['otvet'];
$time = $row_us['time'];
$time1 = $row_us['time1'];
$reading = $row_us['reading'];
?>
<div style="background-color: <?php if ($reading == '0') {?>#575757<?php } else {?>#1E1E1E<?php }?>;">
<?php if (!empty($otvet)) {?><div style="background-color: #000000;">Я: <span class="white"><?php echo "$otvet";?></span> <small><?php echo "$time1";?></small></div><?php }?>
Он: <span class="white"><?php echo "$text";?></span> <small><?php echo "$time";?></small>
</div>
<?php
$query = "update texpod set reading='1' where mes_id = '$idlo' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
}
?>
<p class="podmenu" style="border-top:1px solid #444e4f;"></p>
<p><a href="tex_list.php" class="menu"><img src="img/reload.gif" width="12" height="12" /> Назад</a></p>
<p class="podmenu" style="border-top:1px solid #444e4f;"></p>
<?php } else {?>
<div class="stats">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Вопросы и заявки (<?php echo "$message";?>)</p></center>
</div>
<?php
$query_us = "Select * from users where gruppa <> 'lol' order by `on` DESC";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
while ($row_us = mysqli_fetch_array($result_us)) {
$id01 = $row_us['id'];
$gruppa = $row_us['gruppa'];
$on = $row_us['on'];
$avatar = $row_us['avatar'];
$nick = $row_us['nick'];
?>
<?php
$query_sub = "Select * from texpod where ot = '$id01' and otvet = ''";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
$row_sub = mysqli_fetch_array($result_sub);
$total_sub = mysqli_num_rows($result_sub);
?>
<?php if (!empty($row_sub)) {?>
<?php
$query_sub1 = "Select * from texpod where ot = '$id01' order by time desc limit 1";
$result_sub1 = mysqli_query($dbc, $query_sub1) or die ('Ошибка передачи запроса к БД');
$row_sub1 = mysqli_fetch_array($result_sub1);
$text4 = $row_sub1['text'];
$text4 = substr($text4,0,60);
$type = $row_sub1['type'];
$reading = $row_sub1['reading'];
?>
<?php
$query_sub = "Select * from texpod where ot = '$id01' and reading = '0'";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
$total_sub = mysqli_num_rows($result_sub);
?>
<div style="background-color: <?php if ($type == '2' and $reading == '0') {?>#575757<?php } else {?>#1E1E1E<?php }?>;">
<p class="podmenu" style="border-top:1px solid #444e4f;"></p>
<div style="float: left;">
<img src="img/ava/<?php echo "$avatar";?>.png" width="50" height="50" />
</div> <?php
if ($gruppa == 'svoboda') {if ($on == '1' ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
if ($gruppa == 'dolg') {if ($on == '1' ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
if ($gruppa == 'naemniki') {if ($on == '1' ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
if ($gruppa == 'mon') {if ($on == '1' ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}
?><a href="profile.php?id=<?php echo "$id01";?>"><?php echo "$nick";?></a> <?php if ($total_sub > '0') {?><span class="bonus">(+<?php echo "$total_sub";?>)</span><?php }?><br/>
<span class="white"><?php echo "$text4"; echo '...';?></span><br/>
<a href="tex_list.php?mes=<?php echo "$id01";?>"><img src="img/ico/link.png"/> К диалогу</a>
</div>
<div style="clear: left;">
</div>
<?php }?>
<?php
}
?>
<p class="podmenu" style="border-top:1px solid #444e4f;"></p>
<p><a href="mailbox.php" class="menu"><img src="img/reload.gif" width="12" height="12" /> Назад</a></p>
<p class="podmenu" style="border-top:1px solid #444e4f;"></p>
<?php }?>
<?php }?>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>