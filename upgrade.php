<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Кардан';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) or (isset($_SESSION['nick'])))  {
require_once('conf/top.php');;
}
$thing= $_GET['thing'];
$thing = htmlentities($thing, ENT_QUOTES);
$thing = mysqli_real_escape_string($dbc, trim($thing));	
$user_id = $_SESSION['id'];
if (empty($thing)) {
  ?>
  <script type="text/javascript">
  document.location.href = "clothes.php?id=<?php echo "$user_id"?>";
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
  document.location.href = "clothes.php?id=<?php echo "$user_id"?>";
  </script>
  <?php
  exit();
}
$row=mysqli_fetch_array($result);
$inf_cl = $row['inf_id'];
$type = $row['type'];
if ($type == 1) {
  $query_inf = "Select name,screen,klass from clothes where clothes_id = '$inf_cl' limit 1";
  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
  $row_inf = mysqli_fetch_array($result_inf);
}//Название брони
if ($type == 2) {
  $query_inf = "Select name,screen,klass from pistols where pistols_id = '$inf_cl' limit 1";
  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
  $row_inf = mysqli_fetch_array($result_inf);
}//Название Пистолета
if ($type== 3) {
  $query_inf = "Select name,screen,klass from weapons where weapons_id = '$inf_cl' limit 1";
  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
  $row_inf = mysqli_fetch_array($result_inf);
}//Название оружия
$user_set = $row['user_id'];
$query_user = "Select nick,last_active,gruppa, money, habar from users where id='$user_set' limit 1";
$result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД2');
$row_user=mysqli_fetch_array($result_user);
?>
<?php
$user_iddd = $_SESSION['id']; 
$query_userr = "Select nick,last_active,gruppa, money, habar from users where id='$user_iddd' limit 1";
$result_userr = mysqli_query($dbc, $query_userr) or die ('Ошибка передачи запроса к БД2');
$row_userr=mysqli_fetch_array($result_userr);
$money = $row_userr['money'];
$habar = $row_userr['habar'];
?>
<div id="main">
<?php 
if (isset($_SESSION['id']) and $_SESSION['id'] == $row['user_id']) {
?>
<div class="stats">
<p class="podmenu">Кардан</p>
</div>
<div class="stats">
<p><img src="img/ico/kardan.png"/></p>
<?php 
$err = $_GET['err'];
if (empty($err) or $err<>1 and $err <>2 and $err <>3) {?>
<p class="white"> - Надо бы выпить, без водки работа не пойдет... Что улучшить?</p>
<?php }
else {
if ($err == 1) {?><p class="bonus"> - Улучшить? Что еще? Я сделал все апгрейды.</p><?php }
if ($err == 2) {?><p class="bonus"> - Принесешь хабар - улучшу. И не забудь бутылку!</p><?php }
if ($err == 3) {?><p class="bonus"> - Улучшил, можешь забирать. Надеюсь, ты выпить принес? Надо бы обмыть хорошую работу...</p><?php }
}
} else {?><div class="stats">
<p class="podmenu">Список улучшений</p>
</div><?php }
?>
</div>
<div class="stats">
    <p>[<img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo "$money"; ?></span>] [<img src="img/ico/materials.png" width="12" height="12"/> <span class="white"><?php echo "$habar"; ?></span>]</p>
</div>
<div class="stats">
<p><b><a href="thing.php?thing=<?php echo "$thing";?>">[<?php echo $row_inf['name'];?>]</a></b></p>
<p>Состояние: <span class="white"><?php echo $row['sost'];?>/8</span></p>
<p>Владелец: <span class="white">
<?php 
 if ($row_user['gruppa'] == 'svoboda') {if ($razn_last_act < 600 ) {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/svoboda.png" width="12" height="12" alt="н"/><?php }}
if ($row_user['gruppa'] == 'dolg') {if ($razn_last_act < 600 ) {?><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/dolg.png" width="12" height="12" alt="н"/><?php }}
if ($row_user['gruppa'] == 'naemniki') {if ($razn_last_act < 600 ) {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/naemniki.png" width="12" height="12" alt="н"/><?php }}
if ($row_user['gruppa'] == 'mon') {if ($razn_last_act < 600 ) {?><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}?>
<a  class="white" href="profile.php?id=<?php echo "$user_set"?>"><?php echo $row_user['nick'];?></a></span></p>
</div>
	  
<?php
if (isset($_SESSION['id']) and $_SESSION['id'] == $row['user_id']) {
  $up1 = ($row['upgrade_stat1'] +1);
  $up2 = ($row['upgrade_stat2'] +1);
  $up3 = ($row['upgrade_stat3'] +1);
  $up4 = ($row['upgrade_speed'] +1);
  if ($type == 1) {
    ?>
	<div class="stats">
	<?php
if ($inf_cl > '13') {
$inf_cl = '13';
}
    if ($up1<=4) {
      $query_up = "Select name,about from upgrade_clothes where clothes_id='$inf_cl' and number_upgrade = '$up1' and stat = 'hp'";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
      $row_up = mysqli_fetch_array($result_up);
      ?>
       <p>- <a href="upgrade_thing.php?thing=<?php echo "$thing";?>&stat=1"><?php echo $row_up['name'];?></a><?php
	  /////////////////////
	  if ($up1 == 1) {?> <img src="img/ico/class1.png" width="12" height="12"/><span class="bonus">(+15% к здоровью)</span><span class="white"> [5.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
if ($up1 == 2) {?> <img src="img/ico/class2.png" width="12" height="12"/><span class="bonus">(+25% к здоровью)</span><span class="white"> [30.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up1 == 3) {?> <img src="img/ico/class3.png" width="12" height="12"/><span class="bonus">(+50% к здоровью)</span><span class="white"> [10.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  if ($up1 == 4) {?> <img src="img/ico/class4.png" width="12" height="12"/><span class="bonus">(+75% к здоровью)</span><span class="white"> [25.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  /////////////////////?>
	  </p>
	  <?php
	}
    if ($up2<=4) {
      $query_up = "Select name,about from upgrade_clothes where clothes_id='$inf_cl' and number_upgrade = '$up2' and stat = 'bronya'";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
      $row_up = mysqli_fetch_array($result_up);
      ?>
       <p>- <a href="upgrade_thing.php?thing=<?php echo "$thing";?>&stat=2"><?php echo $row_up['name'];?></a><?php
	  /////////////////////
	   if ($up2 == 1) {?> <img src="img/ico/class1.png" width="12" height="12"/><span class="bonus">(+15% к броне)</span><span class="white"> [5.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up2 == 2) {?> <img src="img/ico/class2.png" width="12" height="12"/><span class="bonus">(+25% к броне)</span><span class="white"> [30.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up2 == 3) {?> <img src="img/ico/class3.png" width="12" height="12"/><span class="bonus">(+50% к броне)</span><span class="white"> [10.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  if ($up2 == 4) {?> <img src="img/ico/class4.png" width="12" height="12"/><span class="bonus">(+75% к броне)</span><span class="white"> [25.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  /////////////////////?></p>
	  <?php
	}
	if ($up3<=4) {
      $query_up = "Select name,about from upgrade_clothes where clothes_id='$inf_cl' and number_upgrade = '$up3' and stat = 'prochn'";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
      $row_up = mysqli_fetch_array($result_up);
      ?>
       <p>- <a href="upgrade_thing.php?thing=<?php echo "$thing";?>&stat=3"><?php echo $row_up['name'];?></a><?php
	  /////////////////////
	   if ($up3 == 1) {?> <img src="img/ico/class1.png" width="12" height="12"/><span class="bonus">(+15% к прочности)</span><span class="white"> [5.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up3 == 2) {?> <img src="img/ico/class2.png" width="12" height="12"/><span class="bonus">(+25% к прочности)</span><span class="white"> [30.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up3 == 3) {?> <img src="img/ico/class3.png" width="12" height="12"/><span class="bonus">(+50% к прочности)</span><span class="white"> [10.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  if ($up3 == 4) {?> <img src="img/ico/class4.png" width="12" height="12"/><span class="bonus">(+75% к прочности)</span><span class="white"> [25.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  /////////////////////?></p>
	  <?php
	}
	if ($up4<=4) {
      $query_up = "Select name,about from upgrade_clothes where clothes_id='$inf_cl' and number_upgrade = '$up4' and stat = 'radiation'";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
      $row_up = mysqli_fetch_array($result_up);
      ?>
       <p>- <a href="upgrade_thing.php?thing=<?php echo "$thing";?>&stat=4"><?php echo $row_up['name'];?></a><?php
	  ////////////////////
      if ($up4 == 1) {?> <img src="img/ico/class1.png" width="12" height="12"/><span class="bonus">(+15% к радиозащите)</span><span class="white"> [5.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up4 == 2) {?> <img src="img/ico/class2.png" width="12" height="12"/><span class="bonus">(+25% к радиозащите)</span><span class="white"> [30.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up4 == 3) {?> <img src="img/ico/class3.png" width="12" height="12"/><span class="bonus">(+50% к радиозащите)</span><span class="white"> [10.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  if ($up4 == 4) {?> <img src="img/ico/class4.png" width="12" height="12"/><span class="bonus">(+75% к радиозащите)</span><span class="white"> [25.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  /////////////////////?>
	  </p>
	  <?php
	}
	?>
    </div>
  <?php
  }
if ($inf_cl > '9') {
$inf_cl = '9';
}
  if ($type == 2) {
    ?>
	<div class="stats">
	<?php
    if ($up1<=4) {
      $query_up = "Select name,about from upgrade_pistols where pistols_id='$inf_cl' and number_upgrade = '$up1' and stat = 'yron'";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
      $row_up = mysqli_fetch_array($result_up);
      ?>
       <p>- <a href="upgrade_thing.php?thing=<?php echo "$thing";?>&stat=1"><?php echo $row_up['name'];?></a><?php
	  /////////////////////
	  if ($up1 == 1) {?> <img src="img/ico/class1.png" width="12" height="12"/><span class="bonus">(+15% к урону)</span><span class="white"> [5.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up1 == 2) {?> <img src="img/ico/class2.png" width="12" height="12"/><span class="bonus">(+25% к урону)</span><span class="white"> [30.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up1 == 3) {?> <img src="img/ico/class3.png" width="12" height="12"/><span class="bonus">(+50% к урону)</span><span class="white"> [10.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  if ($up1 == 4) {?> <img src="img/ico/class4.png" width="12" height="12"/><span class="bonus">(+75% к урону)</span><span class="white"> [25.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  /////////////////////?>
	  </p>
	  <?php
	}
    if ($up2<=4) {
      $query_up = "Select name,about from upgrade_pistols where pistols_id='$inf_cl' and number_upgrade = '$up2' and stat = 'tochn'";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
      $row_up = mysqli_fetch_array($result_up);
      ?>
       <p>- <a href="upgrade_thing.php?thing=<?php echo "$thing";?>&stat=2"><?php echo $row_up['name'];?></a><?php
	  /////////////////////
	  if ($up2 == 1) {?> <img src="img/ico/class1.png" width="12" height="12"/><span class="bonus">(+15% к точности)</span><span class="white"> [5.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up2 == 2) {?> <img src="img/ico/class2.png" width="12" height="12"/><span class="bonus">(+25% к точности)</span><span class="white"> [30.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up2 == 3) {?> <img src="img/ico/class3.png" width="12" height="12"/><span class="bonus">(+50% к точности)</span><span class="white"> [10.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  if ($up2 == 4) {?> <img src="img/ico/class4.png" width="12" height="12"/><span class="bonus">(+75% к точности)</span><span class="white"> [25.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  /////////////////////?></p>
	  <?php
	}
	if ($up3<=4) {
      $query_up = "Select name,about from upgrade_pistols where pistols_id='$inf_cl' and number_upgrade = '$up3' and stat = 'safety'";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
      $row_up = mysqli_fetch_array($result_up);
      ?>
       <p>- <a href="upgrade_thing.php?thing=<?php echo "$thing";?>&stat=3"><?php echo $row_up['name'];?></a><?php
	  /////////////////////
	  if ($up3 == 1) {?> <img src="img/ico/class1.png" width="12" height="12"/><span class="bonus">(+15% к надёжности)</span><span class="white"> [5.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up3 == 2) {?> <img src="img/ico/class2.png" width="12" height="12"/><span class="bonus">(+25% к надёжности)</span><span class="white"> [30.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up3 == 3) {?> <img src="img/ico/class3.png" width="12" height="12"/><span class="bonus">(+50% к надёжности)</span><span class="white"> [10.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  if ($up3 == 4) {?> <img src="img/ico/class4.png" width="12" height="12"/><span class="bonus">(+75% к надёжности)</span><span class="white"> [25.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  /////////////////////?></p>
	  <?php
	}
	if ($up4<=4) {
      $query_up = "Select name,about from upgrade_pistols where pistols_id='$inf_cl' and number_upgrade = '$up4' and stat = 'speed'";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
      $row_up = mysqli_fetch_array($result_up);
      ?>
       <p>- <a href="upgrade_thing.php?thing=<?php echo "$thing";?>&stat=4"><?php echo $row_up['name'];?></a><?php
	  ////////////////////
	 if ($up4 == 1) {?> <img src="img/ico/class1.png" width="12" height="12"/><span class="bonus">(-1 сек перезарядки)</span><span class="white"> [5.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up4 == 2) {?> <img src="img/ico/class2.png" width="12" height="12"/><span class="bonus">(-2 сек перезарядки)</span><span class="white"> [30.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up4 == 3) {?> <img src="img/ico/class3.png" width="12" height="12"/><span class="bonus">(-3 сек перезарядки)</span><span class="white"> [10.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  if ($up4 == 4) {?> <img src="img/ico/class4.png" width="12" height="12"/><span class="bonus">(-4 сек перезарядки)</span><span class="white"> [25.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  /////////////////////?>
	  </p>
	  <?php
	}
	?>
    </div>
  <?php
  }
if ($inf_cl > '20') {
$inf_cl = '20';
}
  //
  if ($type == 3) {
    ?>
	<div class="stats">
	<?php
    if ($up1<=4) {
      $query_up = "Select name,about from upgrade_weapons where weapons_id='$inf_cl' and number_upgrade = '$up1' and stat = 'yron'";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
      $row_up = mysqli_fetch_array($result_up);
      ?>
       <p>- <a href="upgrade_thing.php?thing=<?php echo "$thing";?>&stat=1"><?php echo $row_up['name'];?></a><?php
	  /////////////////////
	  if ($up1 == 1) {?> <img src="img/ico/class1.png" width="12" height="12"/><span class="bonus">(+15% к урону)</span><span class="white"> [5.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up1 == 2) {?> <img src="img/ico/class2.png" width="12" height="12"/><span class="bonus">(+25% к урону)</span><span class="white"> [30.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up1 == 3) {?> <img src="img/ico/class3.png" width="12" height="12"/><span class="bonus">(+50% к урону)</span><span class="white"> [10.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  if ($up1 == 4) {?> <img src="img/ico/class4.png" width="12" height="12"/><span class="bonus">(+75% к урону)</span><span class="white"> [25.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  /////////////////////?>
	  </p>
	  <?php
	}
    if ($up2<=4) {
      $query_up = "Select name,about from upgrade_weapons where weapons_id='$inf_cl' and number_upgrade = '$up2' and stat = 'tochn'";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
      $row_up = mysqli_fetch_array($result_up);
      ?>
       <p>- <a href="upgrade_thing.php?thing=<?php echo "$thing";?>&stat=2"><?php echo $row_up['name'];?></a><?php
	  /////////////////////
	  if ($up2 == 1) {?> <img src="img/ico/class1.png" width="12" height="12"/><span class="bonus">(+15% к точности)</span><span class="white"> [5.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up2 == 2) {?> <img src="img/ico/class2.png" width="12" height="12"/><span class="bonus">(+25% к точности)</span><span class="white"> [30.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up2 == 3) {?> <img src="img/ico/class3.png" width="12" height="12"/><span class="bonus">(+50% к точности)</span><span class="white"> [10.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  if ($up2 == 4) {?> <img src="img/ico/class4.png" width="12" height="12"/><span class="bonus">(+75% к точности)</span><span class="white"> [25.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  /////////////////////?></p>
	  <?php
	}
	if ($up3<=4) {
      $query_up = "Select name,about from upgrade_weapons where weapons_id='$inf_cl' and number_upgrade = '$up3' and stat = 'safety'";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
      $row_up = mysqli_fetch_array($result_up);
      ?>
      <p>- <a href="upgrade_thing.php?thing=<?php echo "$thing";?>&stat=3"><?php echo $row_up['name'];?></a><?php
	  /////////////////////
	  if ($up3 == 1) {?> <img src="img/ico/class1.png" width="12" height="12"/><span class="bonus">(+15% к надёжности)</span><span class="white"> [5.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up3 == 2) {?> <img src="img/ico/class2.png" width="12" height="12"/><span class="bonus">(+25% к надёжности)</span><span class="white"> [30.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up3 == 3) {?> <img src="img/ico/class3.png" width="12" height="12"/><span class="bonus">(+50% к надёжности)</span><span class="white"> [10.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  if ($up3 == 4) {?> <img src="img/ico/class4.png" width="12" height="12"/><span class="bonus">(+75% к надёжности)</span><span class="white"> [25.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  /////////////////////?></p>
	  <?php
	}
	if ($up4<=4) {
      $query_up = "Select name,about from upgrade_weapons where weapons_id='$inf_cl' and number_upgrade = '$up4' and stat = 'speed'";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
      $row_up = mysqli_fetch_array($result_up);
      ?>
       <p>- <a href="upgrade_thing.php?thing=<?php echo "$thing";?>&stat=4"><?php echo $row_up['name'];?></a><?php
	  ////////////////////
	  if ($up4 == 1) {?> <img src="img/ico/class1.png" width="12" height="12"/><span class="bonus">(-15% к скорострельности)</span><span class="white"> [5.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up4 == 2) {?> <img src="img/ico/class2.png" width="12" height="12"/><span class="bonus">(-25% к скорострельности)</span><span class="white"> [30.000 <img src="img/ico/materials.png" width="12" height="12"/>]</span><?php }
	  if ($up4 == 3) {?> <img src="img/ico/class3.png" width="12" height="12"/><span class="bonus">(-50% к скорострельности)</span><span class="white"> [10.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  if ($up4 == 4) {?> <img src="img/ico/class4.png" width="12" height="12"/><span class="bonus">(-75% к скорострельности)</span><span class="white"> [25.000 <img src="img/ico/money.png" width="12" height="12"/>RUB]</span><?php }
	  /////////////////////?>
	  </p>
	  <?php
	}
	?>
    </div>
  <?php
  }
  //
}
?>
<div class="stats">
<p class="podmenu">Уже установлено</p>
</div>
<?php ///////////////////////Улучшения для одежды ТИП 1
if ($inf_cl > '13') {
$inf_cl = '13';
}
if ($type == 1) {
  ?><div class="stats"><p class="white" style="background-color:#1e2833;"><b>[Здоровье]</b></p>
  <div class="clothes">
  <?php
  $upgrade_stat1= $row['upgrade_stat1'];
  $query_up = "Select number_upgrade, name,about from upgrade_clothes where clothes_id='$inf_cl' and number_upgrade <= '$upgrade_stat1' and stat = 'hp' order by number_upgrade asc";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
  while ($row_up = mysqli_fetch_array($result_up)) {?>
    <div class="zx">
    <?php
    if ($row_up['number_upgrade'] == 1) {?>
	  <p><img src="img/ico/class1.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+15%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 2) {?>
	  <p><img src="img/ico/class2.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+25%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 3) {?>
	  <p><img src="img/ico/class3.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+50%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 4) {?>
	  <p><img src="img/ico/class4.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+75%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
  ?></div><?php
  }
  ?></div></div><?php
//Здоровье вывели
  ?><div class="stats"><p class="white" style="background-color:#1e2833;"><b>[Броня]</b></p>
  <div class="clothes">
  <?php
  $upgrade_stat2= $row['upgrade_stat2'];
  $query_up = "Select number_upgrade, name,about from upgrade_clothes where clothes_id='$inf_cl' and number_upgrade <= '$upgrade_stat2' and stat = 'bronya' order by number_upgrade asc";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
  while ($row_up = mysqli_fetch_array($result_up)) {?>
    <div class="zx">
    <?php
    if ($row_up['number_upgrade'] == 1) {?>
	  <p><img src="img/ico/class1.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+15%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 2) {?>
	  <p><img src="img/ico/class2.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+25%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 3) {?>
	  <p><img src="img/ico/class3.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+50%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 4) {?>
	  <p><img src="img/ico/class4.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+75%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
  ?></div><?php
  }
  ?></div></div><?php
//Броню вывели
  ?><div class="stats"><p class="white" style="background-color:#1e2833;"><b>[Прочность]</b></p>
  <div class="clothes">
  <?php
  $upgrade_stat3= $row['upgrade_stat3'];
  $query_up = "Select number_upgrade, name,about from upgrade_clothes where clothes_id='$inf_cl' and number_upgrade <= '$upgrade_stat3' and stat = 'prochn' order by number_upgrade asc";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
  while ($row_up = mysqli_fetch_array($result_up)) {?>
    <div class="zx">
    <?php
    if ($row_up['number_upgrade'] == 1) {?>
	  <p><img src="img/ico/class1.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+15%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 2) {?>
	  <p><img src="img/ico/class2.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+25%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 3) {?>
	  <p><img src="img/ico/class3.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+50%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 4) {?>
	  <p><img src="img/ico/class4.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+75%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
  ?></div><?php
  }
  ?></div></div><?php
//Прочность вывели
  ?><div class="stats"><p class="white" style="background-color:#1e2833;"><b>[Радиозащита]</b></p>
  <div class="clothes">
  <?php
  $upgrade_speed= $row['upgrade_speed'];
  $query_up = "Select number_upgrade, name,about from upgrade_clothes where clothes_id='$inf_cl' and number_upgrade <= '$upgrade_speed' and stat = 'radiation' order by number_upgrade asc";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
  while ($row_up = mysqli_fetch_array($result_up)) {?>
    <div class="zx">
    <?php
    if ($row_up['number_upgrade'] == 1) {?>
	  <p><img src="img/ico/class1.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+15%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 2) {?>
	  <p><img src="img/ico/class2.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+25%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 3) {?>
	  <p><img src="img/ico/class3.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+50%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 4) {?>
	  <p><img src="img/ico/class4.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+75%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
  ?></div><?php
  }
  ?></div></div><?php
}

/////////////////////////////////////////
/////////////////////////////Улучшения для пистолета ТИП 2
if ($inf_cl > '9') {
$inf_cl = '9';
}
if ($type == 2) {
  ?><div class="stats"><p class="white" style="background-color:#1e2833;"><b>[Урон]</b></p>
  <div class="clothes">
  <?php
  $upgrade_stat1= $row['upgrade_stat1'];
  $query_up = "Select number_upgrade, name,about from upgrade_pistols where pistols_id='$inf_cl' and number_upgrade <= '$upgrade_stat1' and stat = 'yron' order by number_upgrade asc";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
  while ($row_up = mysqli_fetch_array($result_up)) {?>
    <div class="zx">
    <?php
    if ($row_up['number_upgrade'] == 1) {?>
	  <p><img src="img/ico/class1.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+15%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 2) {?>
	  <p><img src="img/ico/class2.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+25%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 3) {?>
	  <p><img src="img/ico/class3.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+50%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 4) {?>
	  <p><img src="img/ico/class4.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+75%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
  ?></div><?php
  }
  ?></div></div><?php
//Здоровье вывели
  ?><div class="stats"><p class="white" style="background-color:#1e2833;"><b>[Точность]</b></p>
  <div class="clothes">
  <?php
  $upgrade_stat2= $row['upgrade_stat2'];
  $query_up = "Select number_upgrade, name,about from upgrade_pistols where pistols_id='$inf_cl' and number_upgrade <= '$upgrade_stat2' and stat = 'tochn' order by number_upgrade asc";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
  while ($row_up = mysqli_fetch_array($result_up)) {?>
    <div class="zx">
    <?php
    if ($row_up['number_upgrade'] == 1) {?>
	  <p><img src="img/ico/class1.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+15%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 2) {?>
	  <p><img src="img/ico/class2.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+25%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 3) {?>
	  <p><img src="img/ico/class3.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+50%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 4) {?>
	  <p><img src="img/ico/class4.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+75%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
  ?></div><?php
  }
  ?></div></div><?php
//Броню вывели
  ?><div class="stats"><p class="white" style="background-color:#1e2833;"><b>[Надёжность]</b></p>
  <div class="clothes">
  <?php
  $upgrade_stat3= $row['upgrade_stat3'];
  $query_up = "Select number_upgrade, name,about from upgrade_pistols where pistols_id='$inf_cl' and number_upgrade <= '$upgrade_stat3' and stat = 'safety' order by number_upgrade asc";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
  while ($row_up = mysqli_fetch_array($result_up)) {?>
    <div class="zx">
    <?php
    if ($row_up['number_upgrade'] == 1) {?>
	  <p><img src="img/ico/class1.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+15%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 2) {?>
	  <p><img src="img/ico/class2.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+25%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 3) {?>
	  <p><img src="img/ico/class3.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+50%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 4) {?>
	  <p><img src="img/ico/class4.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+75%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
  ?></div><?php
  }
  ?></div></div><?php
//Прочность вывели
  ?><div class="stats"><p class="white" style="background-color:#1e2833;"><b>[Скорострельность]</b></p>
  <div class="clothes">
  <?php
  $upgrade_speed= $row['upgrade_speed'];
  $query_up = "Select number_upgrade, name,about from upgrade_pistols where pistols_id='$inf_cl' and number_upgrade <= '$upgrade_speed' and stat = 'speed' order by number_upgrade asc";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
  while ($row_up = mysqli_fetch_array($result_up)) {?>
    <div class="zx">
    <?php
    if ($row_up['number_upgrade'] == 1) {?>
	  <p><img src="img/ico/class1.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (-1сек)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 2) {?>
	  <p><img src="img/ico/class2.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (-2сек)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 3) {?>
	  <p><img src="img/ico/class3.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (-3сек)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 4) {?>
	  <p><img src="img/ico/class4.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (-4сек)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
  ?></div><?php
  }
  ?></div></div><?php
}
///////////////////////////////////////
/////////////////////////////Улучшения для автомата ТИП 3
if ($inf_cl > '20') {
$inf_cl = '20';
}
if ($type == 3) {
  ?><div class="stats"><p class="white" style="background-color:#1e2833;"><b>[Урон]</b></p>
  <div class="clothes">
  <?php
  $upgrade_stat1= $row['upgrade_stat1'];
  $query_up = "Select number_upgrade, name,about from upgrade_weapons where weapons_id='$inf_cl' and number_upgrade <= '$upgrade_stat1' and stat = 'yron' order by number_upgrade asc";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
  while ($row_up = mysqli_fetch_array($result_up)) {?>
    <div class="zx">
    <?php
    if ($row_up['number_upgrade'] == 1) {?>
	  <p><img src="img/ico/class1.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+15%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 2) {?>
	  <p><img src="img/ico/class2.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+25%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 3) {?>
	  <p><img src="img/ico/class3.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+50%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 4) {?>
	  <p><img src="img/ico/class4.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+75%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
  ?></div><?php
  }
  ?></div></div><?php
//Здоровье вывели
  ?><div class="stats"><p class="white" style="background-color:#1e2833;"><b>[Точность]</b></p>
  <div class="clothes">
  <?php
  $upgrade_stat2= $row['upgrade_stat2'];
  $query_up = "Select number_upgrade, name,about from upgrade_weapons where weapons_id='$inf_cl' and number_upgrade <= '$upgrade_stat2' and stat = 'tochn' order by number_upgrade asc";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
  while ($row_up = mysqli_fetch_array($result_up)) {?>
    <div class="zx">
    <?php
    if ($row_up['number_upgrade'] == 1) {?>
	  <p><img src="img/ico/class1.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+15%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 2) {?>
	  <p><img src="img/ico/class2.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+25%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 3) {?>
	  <p><img src="img/ico/class3.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+50%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 4) {?>
	  <p><img src="img/ico/class4.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+75%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
  ?></div><?php
  }
  ?></div></div><?php
//Броню вывели
  ?><div class="stats"><p class="white" style="background-color:#1e2833;"><b>[Надёжность]</b></p>
  <div class="clothes">
  <?php
  $upgrade_stat3= $row['upgrade_stat3'];
  $query_up = "Select number_upgrade, name,about from upgrade_weapons where weapons_id='$inf_cl' and number_upgrade <= '$upgrade_stat3' and stat = 'safety' order by number_upgrade asc";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
  while ($row_up = mysqli_fetch_array($result_up)) {?>
    <div class="zx">
    <?php
    if ($row_up['number_upgrade'] == 1) {?>
	  <p><img src="img/ico/class1.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+15%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 2) {?>
	  <p><img src="img/ico/class2.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+25%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 3) {?>
	  <p><img src="img/ico/class3.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+50%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 4) {?>
	  <p><img src="img/ico/class4.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (+75%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
  ?></div><?php
  }
  ?></div></div><?php
//Прочность вывели
  ?><div class="stats"><p class="white" style="background-color:#1e2833;"><b>[Скорострельность]</b></p>
  <div class="clothes">
  <?php
  $upgrade_speed= $row['upgrade_speed'];
  $query_up = "Select number_upgrade, name,about from upgrade_weapons where weapons_id='$inf_cl' and number_upgrade <= '$upgrade_speed' and stat = 'speed' order by number_upgrade asc";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД2');
  while ($row_up = mysqli_fetch_array($result_up)) {?>
    <div class="zx">
    <?php
    if ($row_up['number_upgrade'] == 1) {?>
	  <p><img src="img/ico/class1.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (-15%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 2) {?>
	  <p><img src="img/ico/class2.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (-25%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 3) {?>
	  <p><img src="img/ico/class3.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (-50%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
	if ($row_up['number_upgrade'] == 4) {?>
	  <p><img src="img/ico/class4.png" width="12" height="12"/><span class="white"><?php echo $row_up['name'];?></span> (-75%)<p>
	  <p>[<?php echo $row_up['about'];?>]</p>
	<?php 
	}
  ?></div><?php
  }
  ?></div></div><?php
}
///////////////////////////////////////

?>
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);
?>

</body>
</html>