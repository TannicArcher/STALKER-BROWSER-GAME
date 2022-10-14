<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Вещь';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) or (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
$thing= $_GET['thing'];
$thing = htmlentities($thing, ENT_QUOTES);
$thing = mysqli_real_escape_string($dbc, trim($thing));	
$user_id = $_SESSION['id'];
$query = "Select * from auction where thing_id='$thing'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row_a = mysqli_fetch_array($result);
$auct = $row_a['price_user'];
if ($auct != '0') {
  ?>
  <script type="text/javascript">
  document.location.href = "auc.php";
  </script>
  <?php
  exit();
}
if (empty($thing)) {
  ?>
  <script type="text/javascript">
  document.location.href = "thingnotfound.php";
  </script>
  <?php
  exit();
}
$query = "Select * from things where thing_id='$thing' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД2');
$total = mysqli_num_rows($result);
if ($total == 0) {
  ?>
  <script type="text/javascript">
  document.location.href = "thingnotfound.php";
  </script>
  <?php
  exit();
}
$row=mysqli_fetch_array($result);
$user_set = $row['user_id'];
$query_user = "Select nick,last_active,gruppa from users where id='$user_set' limit 1";
$result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД2');
$row_user=mysqli_fetch_array($result_user);
$inf_cl = $row['inf_id'];
$type = $row['type'];
$last_active = $row_user['last_active'];
$last_active = strtotime("$last_active");
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$razn_last_act = ($now - $last_active);
if ($type == 1) {
  $query_inf = "Select name,screen,klass,price from clothes where clothes_id = '$inf_cl' limit 1";
  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
  $row_inf = mysqli_fetch_array($result_inf);
}//Название брони
if ($type == 2) {
  $query_inf = "Select name,screen,klass,price from pistols where pistols_id = '$inf_cl' limit 1";
  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
  $row_inf = mysqli_fetch_array($result_inf);
}//Название Пистолета
if ($type== 3) {
  $query_inf = "Select name,screen,klass,price from weapons where weapons_id = '$inf_cl' limit 1";
  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
  $row_inf = mysqli_fetch_array($result_inf);
}//Название оружия
if ($type== 4) {
  $query_inf = "Select name,screen,klass,price from helmets where helmet_id = '$inf_cl' limit 1";
  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
  $row_inf = mysqli_fetch_array($result_inf);
}//Название шлема
if ($type== 5) {
  $query_inf = "Select name,screen,klass,price from ava where ava_id = '$inf_cl' limit 1";
  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
  $row_inf = mysqli_fetch_array($result_inf);
}//Название аватара
if ($type== 6) {
  $query_inf = "Select name,screen,klass,price from art where art_id = '$inf_cl' limit 1";
  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
  $row_inf = mysqli_fetch_array($result_inf);
}//Название arta
if ($type== 7) {
  $query_inf = "Select name,screen,klass,price from detectors where dec_id = '$inf_cl' limit 1";
  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
  $row_inf = mysqli_fetch_array($result_inf);
}//Название детектора
?>
<div id="main">
<div class="stats">
<p class="podmenu"><?php echo $row_inf['name'];?></p>
</div>
<?php
if ($row['place'] != '3') {
$_GET['lot'] = '';
}
$err=$_GET['err'];
if ($user_set == $user_id and !empty($_GET['lot']) and $row['place'] == 3) {


	$query_isset = "update things set place=0 where thing_id='$thing' limit 1";
    $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД');
	$query_isset = "DELETE FROM `auction` where thing_id = '$thing'";
    $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД');
    ?>
	<div class="stats">
    <p><img src="img/ico/shield.png" width="12" height="12"/> <a href="auc.php">Моё снаряжение</a></p>
    </div>
	<div class="stats"><p class="bonus">Эта вещь успешно убрана с аукциона.</p></div><?php
	require_once('conf/navig.php');
    require_once('conf/foot.php');
	exit();
}
//////////////////
?>
<div class="stats">
<p><img src="img/ico/shield.png" width="12" height="12"/> <a href="auc.php">Моё снаряжение</a></p>
</div>
<?php
if (!empty($err)) {
?>
<div id="error">
<?php
if ($err == 1) {echo 'Снаряжение и так целое';}
if ($err == 2) {echo 'Недостаточно хабара для ремонта';}
if ($err == 3) {echo 'Снаряжение удачно отремонтировано';}
if ($err == 4) { ?><span class="bonus"><?php echo 'Вы успешно приобрели эту вещь';?></span><?php }
if ($err == 5) { echo 'Стартовая цена должна быть меньше выкупа'; }
if ($err == 6) { echo 'Стартовая цена должна быть больше 20'; }
if ($err == 7) { echo 'Выкуп должен быть больше 20'; }
if ($err == 8) { echo 'Введите число'; }
if ($err == 9) { echo 'Недостаточно средств'; }
if ($err == 10) { echo 'Стартовая цена должна быть меньше выкупа'; }
if ($err == 11) { echo 'Ставка на данный лот должна быть не менее' . " $price1 RUB"; }
?>
</div>
<?php
}
?>
<div class="slot">
<?php
/////////////////////////////////////Начало БРОНИ
if ($type == 1) {
?>
<table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/clothes/<?php echo $row_inf['screen'];?>" width="80" height="100"/></td>
      <td width="136" valign="top">
	  <?php
	  ?>
	  <div class="clothes">
	    <p><?php
		if ($row_inf['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?><span class="white"><?php echo $row_inf['name']; ?></span><br />
		<span class="white"><?php echo $row['need_lvl'];?> ур, <?php if ($row['privat'] == 1) {?>личный<?php } else {?><span class="bonus">новый</span><?php }?></span></p>
        <p><?php
		if ($row['upgrade_stat2'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat2'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat2'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat2'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Броня: <span class="white"><?php echo $row['stat2'];?></span></p>
        <p><?php
		if ($row['upgrade_stat1'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat1'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat1'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat1'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Здор: <span class="white"><?php echo $row['stat1'];?></span></p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	  <div class="clothes">
	  <p><?php
		if ($row['upgrade_stat3'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat3'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat3'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat3'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Прочность: <span class="white"><?php echo $row['stat3'];?></span></p>
	  <p><?php
		if ($row['upgrade_speed'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_speed'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_speed'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_speed'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Рад.защ: <span class="white"><?php echo $row['speed'];?></span></p>
	  </div>
	  <div class="zx">
	<div class="clothes">
      <p>Состояние: <span class="white"><?php echo $row['sost'];?>/8</span></p>
	  </div>
	  <p>Владелец: <span class="white">
	  <?php 
  if ($row_user['gruppa'] == 'svoboda') {if ($razn_last_act < 3000 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'dolg') {if ($razn_last_act < 3000 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'naemniki') {if ($razn_last_act < 3000 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'mon') {if ($razn_last_act < 3000 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}?>
	  <a  class="white" href="profile.php?id=<?php echo "$user_set"?>"><?php echo $row_user['nick'];?></a></span></p>
	  </div>
	  </div>
	  </div>
<div class="link"><a href="thing1.php?thing=<?php echo "$thing";?>&lot=1" class="link">Убрать с аукциона</a></div>
<?php
}
//////////////////////////////////////Конец БРОНИ


/////////////////////////////////////Начало шлема
if ($type == 4) {
?>
<table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/helmets/<?php echo $row_inf['screen'];?>" width="39" height="39"/></td>
      <td width="136" valign="top">
	  <?php
	  ?>
	  <div class="clothes">
	    <p><?php
		if ($row_inf['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?><span class="white"><?php echo $row_inf['name']; ?></span><br />
		<span class="white"><?php echo $row['need_lvl'];?> ур, <?php if ($row['privat'] == 1) {?>личный<?php } else {?><span class="bonus">новый</span><?php }?></span></p>
        <p><?php
		if ($row['upgrade_stat2'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat2'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat2'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat2'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Броня: <span class="white"><?php echo $row['stat2'];?></span></p>
        <p><?php
		if ($row['upgrade_stat1'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat1'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat1'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat1'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Здор: <span class="white"><?php echo $row['stat1'];?></span></p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	  <div class="clothes">
	  <p><?php
		if ($row['upgrade_speed'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_speed'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_speed'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_speed'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Рад.защ: <span class="white"><?php echo $row['speed'];?></span></p>
	  </div>
	  <div class="zx">
	<div class="clothes">
      <p>Состояние: <span class="white"><?php echo $row['sost'];?>/8</span></p>
	  </div>
	  <p>Владелец: <span class="white">
	  <?php 
  if ($row_user['gruppa'] == 'svoboda') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'dolg') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'naemniki') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'mon') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}?>
	  <a  class="white" href="profile.php?id=<?php echo "$user_set"?>"><?php echo $row_user['nick'];?></a></span></p>
	  </div>
<?php
/////////////////////Если это моя шмотка
  if ($user_set == $user_id) {
  ?><div class="zx"><?php
	 if ($row['sost'] == 0) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>1000</a></p>
	  <?php }
	   if ($row['sost'] == 1) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>800</a></p><?php }  
	   if ($row['sost'] == 2) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>180</a></p><?php } 
	   if ($row['sost'] == 3) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>150</a></p><?php } 
	   if ($row['sost']== 4) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>120</a></p><?php } 
	   if ($row['sost'] == 5) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>90</a></p><?php }
	   if ($row['sost'] == 6) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>60</a></p><?php }  
	   if ($row['sost']== 7) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>30</a></p><?php }
	  ?>
	  </div>
	  </div>
	<?php
  } 
}
//////////////////////////////////////Конец шлема


/////////////////////////////////////Начало Avatar
if ($type == 5) {
?>
<table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/ava/<?php echo $row_inf['screen'];?>" <?php 
if ($row_cl['screen'] == '14.png') {?>width="100" height="89"<?php }
if ($row_cl['screen'] == '18.png') {?>width="94" height="94"<?php }
if ($row_cl['screen'] <> '14.png' and $row_cl['screen'] <> '18.png') {?>width="100" height="100"<?php }
?>
/></td>
      <td width="136" valign="top">
	  <?php
	  ?>
	  </td>
      </tr>
      </tbody>
      </table>
	  <p>Владелец: <span class="white">
	  <?php 
  if ($row_user['gruppa'] == 'svoboda') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'dolg') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'naemniki') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'mon') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}?>
	  <a  class="white" href="profile.php?id=<?php echo "$user_set"?>"><?php echo $row_user['nick'];?></a></span></p>
<p><a href="bag.php">В рюкзак</a></p>
<?php
/////////////////////Если это моя шмотка
  if ($user_set == $user_id) {
  ?><div class="zx"><?php
	 if ($row['sost'] == 0) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>1000</a></p>
	  <?php }
	   if ($row['sost'] == 1) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>800</a></p><?php }  
	   if ($row['sost'] == 2) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>180</a></p><?php } 
	   if ($row['sost'] == 3) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>150</a></p><?php } 
	   if ($row['sost']== 4) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>120</a></p><?php } 
	   if ($row['sost'] == 5) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>90</a></p><?php }
	   if ($row['sost'] == 6) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>60</a></p><?php }  
	   if ($row['sost']== 7) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>30</a></p><?php }
	  ?>
	  </div>
	<?php
  } 
}
//////////////////////////////////////Конец Avatar

/////////////////////////////////////Начало артефакта
if ($type == 6) {
?>
<table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/art/<?php echo $row_inf['screen'];?>"/></td>
      <td width="136" valign="top">
	  <?php
	  ?>
        <p><?php
		if ($row['upgrade_stat2'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat2'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat2'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat2'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Регенерация: <span class="white"><?php echo $row['speed'];?></span></p>
	  </td>
      </tr>
      </tbody>
      </table>
	  <p>Владелец: <span class="white">
	  <?php 
  if ($row_user['gruppa'] == 'svoboda') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'dolg') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'naemniki') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'mon') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}?>
	  <a  class="white" href="profile.php?id=<?php echo "$user_set"?>"><?php echo $row_user['nick'];?></a></span></p>
<p><a href="bag.php">В рюкзак</a></p>
<?php
/////////////////////Если это моя шмотка
  if ($user_set == $user_id) {
  ?><div class="zx"><?php
	 if ($row['sost'] == 0) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>1000</a></p>
	  <?php }
	   if ($row['sost'] == 1) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>800</a></p><?php }  
	   if ($row['sost'] == 2) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>180</a></p><?php } 
	   if ($row['sost'] == 3) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>150</a></p><?php } 
	   if ($row['sost']== 4) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>120</a></p><?php } 
	   if ($row['sost'] == 5) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>90</a></p><?php }
	   if ($row['sost'] == 6) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>60</a></p><?php }  
	   if ($row['sost']== 7) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>30</a></p><?php }
	  ?>
	  </div>
	<?php
  } 
}
//////////////////////////////////////Конец артефакта

/////////////////////////////////////Начало детектора
if ($type == 7) {
?>
<table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/dec/<?php echo $row_inf['screen'];?>" <?php if ($row_inf['screen'] == 'otklik.gif') {?>width="65" height="75"<?php } else {?>width="66" height="65"<?php }?> /></td>
      <td width="136" valign="top">
	  <?php
	  ?>
  </td>
      </tr>
      </tbody>
      </table>
	  <p>Владелец: <span class="white">
	  <?php 
  if ($row_user['gruppa'] == 'svoboda') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'dolg') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'naemniki') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'mon') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}?>
	  <a  class="white" href="profile.php?id=<?php echo "$user_set"?>"><?php echo $row_user['nick'];?></a></span></p>
<p><a href="bag.php">В рюкзак</a></p>
<?php
/////////////////////Если это моя шмотка
  if ($user_set == $user_id) {
  ?><div class="zx"><?php
	 if ($row['sost'] == 0) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>1000</a></p>
	  <?php }
	   if ($row['sost'] == 1) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>800</a></p><?php }  
	   if ($row['sost'] == 2) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>180</a></p><?php } 
	   if ($row['sost'] == 3) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>150</a></p><?php } 
	   if ($row['sost']== 4) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>120</a></p><?php } 
	   if ($row['sost'] == 5) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>90</a></p><?php }
	   if ($row['sost'] == 6) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>60</a></p><?php }  
	   if ($row['sost']== 7) {?><p><a href="fix.php?thing=<?php echo "$thing";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>30</a></p><?php }
	  ?>
	  </div>
	<?php
  } 
}
//////////////////////////////////////Конец детектора
/////////////////////////////////////Начало пистолета
if ($type == 2) {
?>
<table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/weapons/<?php echo $row_inf['screen'];?>" alt="Слот №1" /></td>
      <td width="136" valign="top">
	  <div class="clothes">
	    <p><?php
		if ($row_inf['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?><span class="white"><?php echo $row_inf['name']; ?></span><br /><span class="white"><?php echo $row['need_lvl'];?> ур, <?php if ($row['privat'] == 1) {?>личный<?php } else {?><span class="bonus">новый</span><?php }?></span></p>
        <p><?php
		if ($row['upgrade_stat1'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat1'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat1'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat1'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Урон: <span class="white"><?php echo $row['stat1'];?></span></p>
        <p><?php
		if ($row['upgrade_stat2'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat2'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat2'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat2'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Точн: <span class="white"><?php echo $row['stat2'];?></span></p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	  <div class="clothes">
	  		<p><?php
		if ($row['upgrade_stat3'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat3'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat3'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat3'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Надёжность: <span class="white"><?php echo $row['stat3'];?></span></p>
			<p><?php
		if ($row['upgrade_speed'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>-1сек)</span><?php }
		if ($row['upgrade_speed'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>-2сек)</span><?php }
		if ($row['upgrade_speed'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>-3сек)</span><?php }
		if ($row['upgrade_speed'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>-4сек)</span><?php }
		?> Перезарядка: <span class="white"><?php echo $row['speed'];?>сек</span></p>
	  </div>
	  <div class="zx">
	<div class="clothes">
      <p>Состояние: <span class="white"><?php echo $row['sost'];?>/8</span></p>
	  </div>
	  <p>Владелец: <span class="white">
	  <?php 
  if ($row_user['gruppa'] == 'svoboda') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'dolg') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'naemniki') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'mon') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}?> 
	  <a  class="white" href="profile.php?id=<?php echo "$user_set"?>"><?php echo $row_user['nick'];?></a></span></p>
	  </div>
<div class="link"><a href="thing1.php?thing=<?php echo "$thing";?>&lot=1" class="link">Убрать с аукциона</a></div>

<?php
}
/////////////////////////////////////Конец пистолета

////////////////////////Автомат НАЧАЛО!!!
if ($type == 3) {
?>	
	<div class="clothes">
	<p><?php
		if ($row_inf['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?><span class="white"><?php echo $row_inf['name']; ?></span><br /><span class="white"><?php echo $row['need_lvl'];?> ур, <?php if ($row['privat'] == 1) {?>личный<?php } else {?><span class="bonus">новый</span><?php }?></span></p>
    <img src="img/weapons/<?php echo $row_inf['screen'];?>" alt="Слот №3" width="145" height="50"/>
   <p><?php
		if ($row['upgrade_stat1'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat1'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat1'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat1'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Урон: <span class="white"><?php echo $row['stat1'];?></span></p>
    <p><?php
		if ($row['upgrade_stat2'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat2'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat2'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat2'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Точность: <span class="white"><?php echo $row['stat2'];?></span></p>
	<p><?php
		if ($row['upgrade_stat3'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat3'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat3'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat3'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Надёжность: <span class="white"><?php echo $row['stat3'];?></span></p>
    <p><?php
		if ($row['upgrade_speed'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>-15%)</span><?php }
		if ($row['upgrade_speed'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>-25%)</span><?php }
		if ($row['upgrade_speed'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>-50%)</span><?php }
		if ($row['upgrade_speed'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>-75%)</span><?php }
		?> Перезарядка: <span class="white"><?php echo $row['speed'];?>сек</span></p>
    <p> - - - - - -</p>
     <p>Состояние: <span class="white"><?php echo $row['sost'];?>/8</span></p>
	 </div>
	 <p>Владелец: <span class="white">
	  <?php 
  if ($row_user['gruppa'] == 'svoboda') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'dolg') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'naemniki') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_user['gruppa'] == 'mon') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}?>
	  <a  class="white" href="profile.php?id=<?php echo "$user_set"?>"><?php echo $row_user['nick'];?></a></span></p>
<div class="link"><a href="thing1.php?thing=<?php echo "$thing";?>&lot=1" class="link">Убрать с аукциона</a></div>
<?php
}
?>
</div>
</div>
<?php


	
?>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);
?>

</body>
</html>