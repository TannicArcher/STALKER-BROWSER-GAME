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
  exit();
}
$page_title = 'Тайник';
require_once('conf/head.php');
require_once('conf/top.php');
?>
<div id="main">
<div class="stats">
<p class="podmenu">Ваш тайник</p>
</div>
<?php
$user_id = $_SESSION['id'];
$query = "Select thing_id, type, inf_id, stat1, stat2, speed, sost, privat, need_lvl from things where user_id='$user_id' and place=1 limit 20";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$total = mysqli_num_rows($result);
?>
<div class="stats">
<p class="white"> Вещей в тайнике [<?php echo "$total"; ?>/20]
<p><img src="img/ico/bag.png" width="12" height="12"/> <a href="bag.php">Открыть рюкзак</a></p>
</div>
<?php
$err = $_GET['err'];
if (!empty($err)) {
  if ($err == 1) {
  ?>
  <div id="error">
  Рюкзак переполнен.
  </div>
  <?php
  }
}
if ($total == 0) {
?>
<div class="stats">
<p>У вас ничего нет в тайнике</p>
</div>
<?php
}
else {
  $query_st = "Select max_hp, bronya, yron_p, lvl, tochn_p, yron_w, tochn_w from users where id = '$user_id'";
  $result_st = mysqli_query($dbc, $query_st) or die ('Ошибка передачи запроса к БД');
  $row_st = mysqli_fetch_array($result_st);
  $stat1_cl = $row_st['max_hp'];
  $stat2_cl = $row_st['bronya'];
  $stat1_p = $row_st['yron_p'];
  $stat2_p = $row_st['tochn_p'];
  $stat1_w = $row_st['yron_w'];
  $stat2_w = $row_st['tochn_w'];
  while ($row = mysqli_fetch_array($result)) {
    $thing_id = $row['thing_id'];
    $type = $row['type'];
	$inf_id = $row['inf_id'];
	$stat1 = $row['stat1'];
	$stat2 = $row['stat2'];
	$speed = $row['speed'];
	$sost = $row['sost'];
	$privat = $row['privat'];
	$bonus = $row['bonus'];
	$need_lvl = $row['need_lvl'];
	if ($type == 1) {////////Одежда
	$query_inf = "Select name, screen,klass from clothes where clothes_id='$inf_id' limit 1";
    $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	$row_inf = mysqli_fetch_array($result_inf);
	$screen = $row_inf['screen'];
	$name = $row_inf['name'];
	$klass = $row_inf['klass'];
	?>
	<div class="slot">
      <table width="160" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/clothes/<?php echo "$screen";?>" alt="<?php echo "$name";?>" width="70" height="70"/></td>
      <td width="106" valign="top">
	  <div class="clothes">
	  <?php
	  if ($klass == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($klass == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($klass == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($klass >= 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
	  ?>
	    <a href="thing.php?thing=<?php echo "$thing_id";?>" class="white"><?php echo "$name";?></a>
       <p><span class="white"><?php echo "$need_lvl";?> ур,</span><?php
	if ($privat == 0) { echo "новый";}
	if ($privat == 1) { echo "личный";}
	$better = (($stat1 - $stat1_cl) + ($stat2 - $stat2_cl));
	if ($better > 0) {?> <span class="bonus">(Лучше на <?php echo "+$better";?>)</span><?php }?>
	</p>
	  </div>
	  </td>
      </tr>
      </tbody>
      </table>
<p>[<a href="inbag.php?thing=<?php echo "$thing_id";?>">В рюкзак</a>] [<a href="upgrade.php?thing=<?php echo "$thing_id";?>">Улучшить</a>] [<a href="out_thing.php?thing=<?php echo "$thing_id"?>" onclick="return confirm
('Уверены?')">
<?

?><?php
	    if ($sost == 0) {?>Выкинуть<?php }
	    if ($sost == 1) {?>На <img src="img/ico/materials.png" width="12" height="12"/>30<?php }
		if ($sost == 2) {?>На <img src="img/ico/materials.png" width="12" height="12"/>60<?php }
		if ($sost == 3) {?>На <img src="img/ico/materials.png" width="12" height="12"/>90<?php }
		if ($sost == 4) {?>На <img src="img/ico/materials.png" width="12" height="12"/>120<?php }
		if ($sost == 5) {?>На <img src="img/ico/materials.png" width="12" height="12"/>150<?php }
		if ($sost == 6) {?>На <img src="img/ico/materials.png" width="12" height="12"/>180<?php }
		if ($sost == 7) {?>На <img src="img/ico/materials.png" width="12" height="12"/>210<?php }
		if ($sost == 8) {?>На <img src="img/ico/materials.png" width="12" height="12"/>240<?php }
	  ?></a>]</p>
	</div>
	
	<?php
	}
	if ($type == 4) {////////шлемы
	$query_inf = "Select name, screen,klass from helmets where helmet_id='$inf_id' limit 1";
    $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	$row_inf = mysqli_fetch_array($result_inf);
	$screen = $row_inf['screen'];
	$name = $row_inf['name'];
	$klass = $row_inf['klass'];
	?>
	<div class="slot">
      <table width="160" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/helmets/<?php echo "$screen";?>" alt="<?php echo "$name";?>" width="40" height="40"/></td>
      <td width="106" valign="top">
	  <div class="clothes">
	  <?php
	  if ($klass == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($klass == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($klass == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($klass >= 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
	  ?>
	    <a href="thing.php?thing=<?php echo "$thing_id";?>" class="white"><?php echo "$name";?></a>
       <p><span class="white"><?php echo "$need_lvl";?> ур,</span><?php
	if ($privat == 0) { echo "новый";}
	if ($privat == 1) { echo "личный";}
	$better = (($stat1 - $stat1_cl) + ($stat2 - $stat2_cl));
	if ($better > 0) {?> <span class="bonus">(Лучше на <?php echo "+$better";?>)</span><?php }?>
	</p>
	  </div>
	  </td>
      </tr>
      </tbody>
      </table>
<p>[<a href="inbag.php?thing=<?php echo "$thing_id";?>">В рюкзак</a>] [<a href="out_thing.php?thing=<?php echo "$thing_id"?>" onclick="return confirm
('Уверены?')">
<?

?><?php
	    if ($sost == 0) {?>Выкинуть<?php }
	    if ($sost == 1) {?>На <img src="img/ico/materials.png" width="12" height="12"/>30<?php }
		if ($sost == 2) {?>На <img src="img/ico/materials.png" width="12" height="12"/>60<?php }
		if ($sost == 3) {?>На <img src="img/ico/materials.png" width="12" height="12"/>90<?php }
		if ($sost == 4) {?>На <img src="img/ico/materials.png" width="12" height="12"/>120<?php }
		if ($sost == 5) {?>На <img src="img/ico/materials.png" width="12" height="12"/>150<?php }
		if ($sost == 6) {?>На <img src="img/ico/materials.png" width="12" height="12"/>180<?php }
		if ($sost == 7) {?>На <img src="img/ico/materials.png" width="12" height="12"/>210<?php }
		if ($sost == 8) {?>На <img src="img/ico/materials.png" width="12" height="12"/>240<?php }
	  ?></a>]</p>
	</div>
	
	<?php
	}
	if ($type == 5) {////////Avatar
	$query_inf = "Select name, screen,klass from ava where ava_id='$inf_id' limit 1";
    $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	$row_inf = mysqli_fetch_array($result_inf);
	$screen = $row_inf['screen'];
	$name = $row_inf['name'];
	$klass = $row_inf['klass'];
	?>
	<div class="slot">
      <table width="160" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/ava/<?php echo "$screen";?>" alt="<?php echo "$name";?>" width="80" height="80"/></td>
      <td width="106" valign="top">
	  <div class="clothes">
	  <?php
	    if ($klass == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($klass == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($klass == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($klass == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
	  ?>
	    <span class="bonus"><?php echo "$name";?></span>
	 </div>
	  </td>
      </tr>
      </tbody>
      </table>
<p>[<a href="inbag.php?thing=<?php echo "$thing_id";?>">В рюкзак</a>] [<a href="out_thing.php?thing=<?php echo "$thing_id"?>" onclick="return confirm
('Уверены?')">
<?

?><?php
	    if ($sost == 0) {?>Выкинуть<?php }
	    if ($sost == 1) {?>На <img src="img/ico/materials.png" width="12" height="12"/>30<?php }
		if ($sost == 2) {?>На <img src="img/ico/materials.png" width="12" height="12"/>60<?php }
		if ($sost == 3) {?>На <img src="img/ico/materials.png" width="12" height="12"/>90<?php }
		if ($sost == 4) {?>На <img src="img/ico/materials.png" width="12" height="12"/>120<?php }
		if ($sost == 5) {?>На <img src="img/ico/materials.png" width="12" height="12"/>150<?php }
		if ($sost == 6) {?>На <img src="img/ico/materials.png" width="12" height="12"/>180<?php }
		if ($sost == 7) {?>На <img src="img/ico/materials.png" width="12" height="12"/>210<?php }
		if ($sost == 8) {?>На <img src="img/ico/materials.png" width="12" height="12"/>240<?php }
	  ?></a>]</p>
	</div>
	<?php
	}
	if ($type == 2) {////////Пистолеты
	$query_inf = "Select name, screen,klass from pistols where pistols_id='$inf_id' limit 1";
    $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	$row_inf = mysqli_fetch_array($result_inf);
	$screen = $row_inf['screen'];
	$name = $row_inf['name'];
	$klass = $row_inf['klass'];
	?>
	<div class="slot">
      <table width="160" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/weapons/<?php echo "$screen";?>" alt="<?php echo "$name";?>" /></td>
      <td width="106" valign="top">
	  <div class="clothes">
	  <?php
	  if ($klass == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($klass == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($klass == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($klass >= 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
	  ?>
	    <a href="thing.php?thing=<?php echo "$thing_id";?>" class="white"><?php echo "$name";?></a>
       <p><span class="white"><?php echo "$need_lvl";?> ур,</span
	><?php
	if ($privat == 0) { echo "новый";}
	if ($privat == 1) { echo "личный";}
	$better = (($stat1 - $stat1_p) + ($stat2 - $stat2_p));
	if ($better > 0) {?> <span class="bonus">(Лучше на <?php echo "+$better";?>)</span><?php }?>
	</p>
	</div>
	  </td>
      </tr>
      </tbody>
      </table>
	  <p>[<a href="inbag.php?thing=<?php echo "$thing_id";?>">В рюкзак</a>] [<a href="upgrade.php?thing=<?php echo "$thing_id";?>">Улучшить</a>] [<a href="out_thing.php?thing=<?php echo "$thing_id"?>" onclick="return confirm
('Уверены?')">
<?

?><?php
	    if ($sost == 0) {?>Выкинуть<?php }
	    if ($sost == 1) {?>На <img src="img/ico/materials.png" width="12" height="12"/>30<?php }
		if ($sost == 2) {?>На <img src="img/ico/materials.png" width="12" height="12"/>60<?php }
		if ($sost == 3) {?>На <img src="img/ico/materials.png" width="12" height="12"/>90<?php }
		if ($sost == 4) {?>На <img src="img/ico/materials.png" width="12" height="12"/>120<?php }
		if ($sost == 5) {?>На <img src="img/ico/materials.png" width="12" height="12"/>150<?php }
		if ($sost == 6) {?>На <img src="img/ico/materials.png" width="12" height="12"/>180<?php }
		if ($sost == 7) {?>На <img src="img/ico/materials.png" width="12" height="12"/>210<?php }
		if ($sost == 8) {?>На <img src="img/ico/materials.png" width="12" height="12"/>240<?php }
	  ?></a>]</p>
	</div>
	<?php
	}
	if ($type == 7) {////////Детекторы
	$query_inf = "Select name, screen, klass, dec_id from detectors where dec_id='$inf_id' limit 1";
    $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	$row_inf = mysqli_fetch_array($result_inf);
	$screen = $row_inf['screen'];
	$name = $row_inf['name'];
	$klass = $row_inf['klass'];
	?>
	<div class="slot">
      <table width="160" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/dec/<?php echo "$screen";?>" alt="<?php echo "$name";?>" <?php if ($row_inf['dec_id'] == '1') {?>width="65" height="75"<?php } else {?>width="66" height="65"<?php }?> /></td>
      <td width="106" valign="top">
	  <div class="clothes">
	    <span class="bonus"><?php echo "$name";?></span>
	 </div>
	  </td>
      </tr>
      </tbody>
      </table>
	  <p>[<a href="inbag.php?thing=<?php echo "$thing_id"?>">В рюкзак</a>] [<a href="out_thing.php?thing=<?php echo "$thing_id"?>" onclick="return confirm
('Уверены?')">
<?

?><?php
	    if ($sost == 0) {?>Выкинуть<?php }
	    if ($sost == 1) {?>На <img src="img/ico/materials.png" width="12" height="12"/>30<?php }
		if ($sost == 2) {?>На <img src="img/ico/materials.png" width="12" height="12"/>60<?php }
		if ($sost == 3) {?>На <img src="img/ico/materials.png" width="12" height="12"/>90<?php }
		if ($sost == 4) {?>На <img src="img/ico/materials.png" width="12" height="12"/>120<?php }
		if ($sost == 5) {?>На <img src="img/ico/materials.png" width="12" height="12"/>150<?php }
		if ($sost == 6) {?>На <img src="img/ico/materials.png" width="12" height="12"/>180<?php }
		if ($sost == 7) {?>На <img src="img/ico/materials.png" width="12" height="12"/>210<?php }
		if ($sost == 8) {?>На <img src="img/ico/materials.png" width="12" height="12"/>240<?php }
	  ?>
	  </a>]</p>
	</div>
	<?php
	}
	if ($type == 3) {////////Автоматы
	$query_inf = "Select name, screen,klass from weapons where weapons_id='$inf_id' limit 1";
    $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	$row_inf = mysqli_fetch_array($result_inf);
	$screen = $row_inf['screen'];
	$name = $row_inf['name'];
	$klass = $row_inf['klass'];
    ?>
	<div class="slot">
	<div class="clothes">
    <img src="img/weapons/<?php echo "$screen";?>" alt="<?php echo "$name";?>" width="145" height="50"/>
	<p>
	<?php
	  if ($klass == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($klass == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($klass == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($klass >= 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
	  ?><a href="thing.php?thing=<?php echo "$thing_id";?>" class="white"><?php echo "$name";?></a></p>
    <p><span class="white"><?php echo "$need_lvl";?> ур,</span
	><?php
	if ($privat == 0) { echo "новый";}
	if ($privat == 1) { echo "личный";}
	$better = (($stat1 - $stat1_w) + ($stat2 - $stat2_w));
	if ($better > 0) {?> <span class="bonus">(Лучше на <?php echo "+$better";?>)</span><?php }?>
	</p>
	</div>
	<p>[<a href="inbag.php?thing=<?php echo "$thing_id";?>">В рюкзак</a>] [<a href="upgrade.php?thing=<?php echo "$thing_id";?>">Улучшить</a>] [<a href="out_thing.php?thing=<?php echo "$thing_id"?>" onclick="return confirm
('Уверены?')">
<?

?><?php
	    if ($sost == 0) {?>Выкинуть<?php }
	    if ($sost == 1) {?>На <img src="img/ico/materials.png" width="12" height="12"/>30<?php }
		if ($sost == 2) {?>На <img src="img/ico/materials.png" width="12" height="12"/>60<?php }
		if ($sost == 3) {?>На <img src="img/ico/materials.png" width="12" height="12"/>90<?php }
		if ($sost == 4) {?>На <img src="img/ico/materials.png" width="12" height="12"/>120<?php }
		if ($sost == 5) {?>На <img src="img/ico/materials.png" width="12" height="12"/>150<?php }
		if ($sost == 6) {?>На <img src="img/ico/materials.png" width="12" height="12"/>180<?php }
		if ($sost == 7) {?>На <img src="img/ico/materials.png" width="12" height="12"/>210<?php }
		if ($sost == 8) {?>На <img src="img/ico/materials.png" width="12" height="12"/>240<?php }
	  ?></a>]</p>
	</div>
    <?php
	}
  }
}
?>
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);
?>

</body>
</html>