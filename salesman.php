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
}
$page_title = 'Торговец Сыч';
require_once('conf/head.php');
require_once('conf/top.php');
  $user_id = $_SESSION['id'];
  $query = "Select lvl,money, habar from users where id = '$user_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $row = mysqli_fetch_array($result);
  $money = $row['money'];
  $habar = $row['habar'];
  $lvl = $row['lvl'];
  $type = $_GET['type'];
  $type = mysqli_real_escape_string($dbc, trim($type));	
  if ($type <> 1 and $type <> 2 and $type <> 3 and $type <> 4) {
    if ($lvl >=21) {$type = 4;}
    if ($lvl <21) {$type = 3;}
    if ($lvl <16) {$type = 2;}
    if ($lvl <8) {$type = 1;}
  }
?>
<div id="main">
  <div class="stats">
    <p class="podmenu">Торговец Сыч</p>
  </div>
  <div class="stats">
    <p><img src="img/ico/selesman.png"/></p>
    <p class="white"> - Да че ты топчешься? Если есть что - выкладывай,нет - проваливай.</p>
  </div>
  <div class="stats"><p>[<a <?php if ($type == 1) {?>class="white"<?php }?> href="salesman.php?type=1">Нов</a>] [<a <?php if ($type == 2) {?>class="white"<?php }?> href="salesman.php?type=2">Быв</a>] [<a <?php if ($type == 3) {?>class="white"<?php }?> href="salesman.php?type=3">Вет</a>] [<a <?php if ($type == 4) {?>class="white"<?php }?> href="salesman.php?type=4">Лег</a>]</p>
  </div>
  <?php 
  ?>
  <div class="stats">
    <p>[<img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo "$money"; ?></span>] [<img src="img/ico/materials.png" width="12" height="12"/> <span class="white"><?php echo "$habar"; ?></span>]</p>
	<div class="zx">
	<p class="bonus">Советы:</p>
	<p class="clothes"><span class="bonus"><img src="img/ico/money.png" width="12" height="12"/> 1000 RUB = 15 рублей реальных [<a class="bonus" href="payment.php">пополнить счет</a>]</span></p>
	<p class="clothes"><span class="bonus"><img src="img/ico/shield.png" width="12" height="12"/> Всё снаряжение можно приобрести дешевле, покупая его на <a class="bonus" href="auction.php">аукционе</a>. Кроме того, снаряжение можно получить и бесплатно, участвуя в <a href="monsters.php">рейдах</a>.</span></p>
	</div>
  </div>
  <div class="stats">
  <p class="podmenu"><?php 
  if ($type == 1) {?><img src="img/ico/class1.png" width="12" height="12"/> Новичок<?php }
  if ($type == 2) {?><img src="img/ico/class2.png" width="12" height="12"/> Бывалый<?php }
  if ($type == 3) {?><img src="img/ico/class3.png" width="12" height="12"/> Ветеран<?php }
  if ($type == 4) {?><img src="img/ico/class4.png" width="12" height="12"/> Легенда<?php }?>
  </p>
  </div>
  </div>
  <div class="stats">
    <p class="white" style="background-color:#1e2833;"><b>[Одежда]</b></p>
	<?php
	$query_c = "Select name,clothes_id,price, price_hab,lvl_need,screen,klass from clothes where klass = '$type'";
    $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
    while ($row_cl = mysqli_fetch_array($result_c)) {?>
	<div class="zx">
	<table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/clothes/<?php echo $row_cl['screen'];?>" width="60" height="60"/></td>
      <td width="136" valign="top">
	  <div class="clothes">
	    <p>
		<?php
		if ($row_cl['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?><a href="sale_thing.php?thing=<?php echo $row_cl['clothes_id'];?>&type=1"><?php echo $row_cl['name'];?></a></p>
		<p><span class="white"><?php echo $row_cl['lvl_need'];?></span> ур</p>
		<p>Цена:
		<?php $pr=0; if ($row_cl['price_hab'] >=0) { $pr=1;?>[<img src="img/ico/materials.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price_hab'];?></span>]<br /><?php }?>
		<?php if ($row_cl['price'] >=0) {$pr=1;?>[<img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price'];?></span>]<?php }?>
		<?php 
		if ($pr==0) {?>[не продаётся]<?php }?></p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	</div>
	<?php
	}
	////////////////////Конец одежде.
	////////////////////Пистолет
    ?>
	</div>
	<div class="stats">
	<p class="white" style="background-color:#1e2833;"><b>[Пистолеты]</b></p>
	<?php
	$query_c = "Select name,pistols_id,price, price_hab,lvl_need,screen,klass from pistols where klass = '$type'";
    $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
    while ($row_cl = mysqli_fetch_array($result_c)) {?>
	<div class="zx">
	<table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/weapons/<?php echo $row_cl['screen'];?>" alt="Слот №1" /></td>
      <td width="136" valign="top">
	  <div class="clothes">
	    <p>
		<?php
		if ($row_cl['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?><a href="sale_thing.php?thing=<?php echo $row_cl['pistols_id'];?>&type=2"><?php echo $row_cl['name'];?></a></p>
		<p><span class="white"><?php echo $row_cl['lvl_need'];?></span> ур</p>
		<p>Цена:
		<?php $pr=0; if ($row_cl['price_hab'] >=0) { $pr=1;?>[<img src="img/ico/materials.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price_hab'];?></span>]<br /><?php }?>
		<?php if ($row_cl['price'] >=0) {$pr=1;?>[<img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price'];?></span>]<?php }?>
		<?php 
		if ($pr==0) {?>[не продаётся]<?php }?></p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	</div>
	<?php
	}
    ?>
	</div>
	<div class="stats">
    <p class="white" style="background-color:#1e2833;"><b>[Автоматы]</b></p>
	<?php
	$query_c = "Select name,weapons_id,price, price_hab,lvl_need,screen,klass from weapons where klass = '$type'  order by lvl_need ASC";
    $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
    while ($row_cl = mysqli_fetch_array($result_c)) {?>
	<div class="zx">
	<p class="clothes">
		<?php
		if ($row_cl['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?><a href="sale_thing.php?thing=<?php echo $row_cl['weapons_id'];?>&type=3"><?php echo $row_cl['name'];?></a></p>
	<img src="img/weapons/<?php echo $row_cl['screen'];?>" alt="Слот №1" /></td>
	<div class="clothes">
		<p><span class="white"><?php echo $row_cl['lvl_need'];?></span> ур</p>
		<p>Цена:
		<?php $pr=0; if ($row_cl['price_hab'] >=0) { $pr=1;?>[<img src="img/ico/materials.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price_hab'];?></span>]<br /><?php }?>
		<?php if ($row_cl['price'] >=0) {$pr=1;?>[<img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price'];?></span>]<?php }?>
		<?php 
		if ($pr==0) {?>[не продаётся]<?php }?></p>
      </div>
	</div>
	<?php
	}
    ?>
	</div>
	
	
	
	
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);
?>

</body>
</html>