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
$page_title = 'Прилавок';
require_once('conf/head.php');
require_once('conf/top.php');
$type = $_GET['type'];
$thing_id = $_GET['thing'];
$thing_id = htmlentities($thing_id, ENT_QUOTES);
$type = mysqli_real_escape_string($dbc, trim($type));
$thing_id = mysqli_real_escape_string($dbc, trim($thing_id));
if (empty($thing_id) or empty($type)) {
  ?>
  <script type="text/javascript">
  document.location.href = "salesman.php";
  </script>
  <?php
  exit();
}
if ($type <> 6) {
  ?>
  <script type="text/javascript">
  document.location.href = "salesman.php";
  </script>
  <?php
  exit();
}
if ($type == 1) {
  $query_c = "Select * from clothes where clothes_id = '$thing_id' limit 1";
  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
  $row_cl = mysqli_fetch_array($result_c);
}
if ($type == 2) {
  $query_c = "Select * from pistols where pistols_id = '$thing_id' limit 1";
  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
  $row_cl = mysqli_fetch_array($result_c);
}
if ($type == 3) {
  $query_c = "Select * from weapons where weapons_id = '$thing_id' limit 1";
  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
  $row_cl = mysqli_fetch_array($result_c);
}
if ($type == 4) {
  $query_c = "Select * from helmets where helmet_id = '$thing_id' limit 1";
  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
  $row_cl = mysqli_fetch_array($result_c);
}
if ($type == 5) {
  $query_c = "Select * from ava where ava_id = '$thing_id' limit 1";
  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
  $row_cl = mysqli_fetch_array($result_c);
}
if ($type == 6) {
  $query_c = "Select * from art where art_id = '$thing_id' limit 1";
  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
  $row_cl = mysqli_fetch_array($result_c);
}
if ($row_cl == 0) {
  ?>
  <script type="text/javascript">
  document.location.href = "salesman.php";
  </script>
  <?php
  exit();
}
?>
<div id="main">
  <div class="stats">
    <p class="podmenu">Прилавок</p>
  </div>
  <div class="stats">
    <p><a href="boroda.php?type=2" class="menu"><img src="img/ico/left.png" /> Назад к Бороде</a></p>
  </div>
  <?php 
  $user_id = $_SESSION['id'];
  $query = "Select lvl,money, habar from users where id = '$user_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $row = mysqli_fetch_array($result);
  $money = $row['money'];
  $habar = $row['habar'];
  $lvl = $row['lvl'];
  ?>
  <div class="stats">
    <p>[<img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo "$money"; ?></span>] [<img src="img/ico/materials.png" width="12" height="12"/> <span class="white"><?php echo "$habar"; ?></span>]</p>
  </div>
  <?php
  $err = $_GET['err'];
  if (!empty($err)) {?>
  <div id="error">
  <?php if ($err == 1) {echo 'У вас недостаточно средств';}?>
  </div>
  <?php
  }
  if ($row['lvl'] < $row_cl['lvl_need']) {
  ?>
  <div id="error">
  <p>Если вы купите эту вещь - вы не сможете её одеть пока не достигните <?php echo $row_cl['lvl_need'];?> уровня или выше</p>
  </div>
  <?php
  }
  ?>
  <div class="stats">
  <?php
  if ($type == 1) {
  ?>
  <table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/clothes/<?php echo $row_cl['screen'];?>" width="80" height="100"/></td>
      <td width="136" valign="top">
	  <div class="clothes">
	    <p>
		<?php
		if ($row_cl['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?><span class="white"><?php echo $row_cl['name'];?></span></p>
        <p><span class="white"><?php echo $row_cl['lvl_need'];?></span> ур, новый</p>
		<p>Броня: <span class="white"><?php echo $row_cl['max_stats_bronya'] .'-'. $row_cl['min_stats_bronya'];?></span> </p>
        <p>Здор: <span class="white"><?php echo $row_cl['max_stats_hp'] .'-'. $row_cl['min_stats_hp'];?></span> </p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	  <div class="clothes">
	  <p>Прочность: <span class="white"><?php echo $row_cl['max_stats_razriv'] .'-'. $row_cl['min_stats_razriv'];?></span></p>
	  <p>Рад. защ: <span class="white"><?php echo $row_cl['max_stats_rad'] .'-'. $row_cl['min_stats_rad'];?></span> </p>
	  <p>- - - - - - - - - - - -</p>
	  <p>Состояние:  <span class="white">8/8</span></p>
	  </div>
	  <div class="zx"><?php if ($row_cl['price_hab'] >=0) {
	  ?>[<a href="buy_thing.php?thing=<?php echo "$thing_id";?>&type=1&money=1">Купить за <img src="img/ico/materials.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price_hab'];?></span></a>] <br /><?php }  else {?><p class="clothes"><span class="bonus">[Mожно получить на <a href="monsters.php">рейде</a>  или приобрести на <a href="auction.php">аукционе</a>]</span></p>
	  <?php }
	  if ($row_cl['price'] >=0) {
	  ?>[<a href="buy_thing.php?thing=<?php echo "$thing_id";?>&type=1&money=2">Купить за <img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price'];?></span></a>]<?php }
	  ?></p>
	  </div>
	  <?php
  }
  if ($type == 2) {
  ?>
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
		?><span class="white"><?php echo $row_cl['name'];?></span></p>
        <p><span class="white"><?php echo $row_cl['lvl_need'];?></span> ур, новый</p>
		<p>Урон: <span class="white"><?php echo $row_cl['max_stats_yron'] .'-'. $row_cl['min_stats_yron'];?></span> </p>
        <p>Точн: <span class="white"><?php echo $row_cl['max_stats_tochn'] .'-'. $row_cl['min_stats_tochn'];?></span> </p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	  <div class="clothes">
	  <p>Надёжность: <span class="white"><?php echo $row_cl['max_stats_safety'] .'-'. $row_cl['min_stats_safety'];?></span></p>
	  <p>Скорострельность: <span class="white"><?php echo $row_cl['speed'];?> сек</span> </p>
	  <p>- - - - - - - - - - - -</p>
	  <p>Состояние:  <span class="white">8/8</span></p>
	  </div>
	  <div class="zx"><?php if ($row_cl['price_hab'] >=0) {
	  ?>[<a href="buy_thing.php?thing=<?php echo "$thing_id";?>&type=2&money=1">Купить за <img src="img/ico/materials.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price_hab'];?></span></a>] <br /><?php }    else {?><p class="clothes"><span class="bonus">[Mожно получить на <a href="monsters.php">рейде</a>  или приобрести на <a href="auction.php">аукционе</a>]</span></p>
	  <?php }
	  if ($row_cl['price'] >=0) {
	  ?>[<a href="buy_thing.php?thing=<?php echo "$thing_id";?>&type=2&money=2">Купить за <img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price'];?></span></a>]<?php }
	  ?></p>
	  </div>
	  <?php
  }
  if ($type == 3) {
  ?>
  <img src="img/weapons/<?php echo $row_cl['screen'];?>" alt="Слот №1" />
	  <div class="clothes">
	    <p>
		<?php
		if ($row_cl['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?><span class="white"><?php echo $row_cl['name'];?></span></p>
        <p><span class="white"><?php echo $row_cl['lvl_need'];?></span> ур, новый</p>
		<p>Урон: <span class="white"><?php echo $row_cl['max_stats_yron'] .'-'. $row_cl['min_stats_yron'];?></span> </p>
        <p>Точн: <span class="white"><?php echo $row_cl['max_stats_tochn'] .'-'. $row_cl['min_stats_tochn'];?></span> </p>
      </div>
	  <div class="clothes">
	  <p>Надёжность: <span class="white"><?php echo $row_cl['max_stats_safety'] .'-'. $row_cl['min_stats_safety'];?></span></p>
	  <p>Скорострельность: <span class="white"><?php echo $row_cl['speed'];?> сек</span> </p>
	  <p>- - - - - - - - - - - -</p>
	  <p>Состояние:  <span class="white">8/8</span></p>
	  </div>
    <div class="zx"><?php if ($row_cl['price_hab'] >=0) {
	  ?>[<a href="buy_thing.php?thing=<?php echo "$thing_id";?>&type=3&money=1">Купить за <img src="img/ico/materials.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price_hab'];?></span></a>] <br /><?php }    else {?><p class="clothes"><span class="bonus">[Mожно получить на <a href="monsters.php">рейде</a>  или приобрести на <a href="auction.php">аукционе</a>]</span></p>
    <?php }
	  if ($row_cl['price'] >=0) {
	  ?>[<a href="buy_thing.php?thing=<?php echo "$thing_id";?>&type=3&money=2">Купить за <img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price'];?></span></a>]<?php }
	  ?></p>
    </div>
	  <?php
  }
  if ($type == 4) {
  ?>
  <table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/helmets/<?php echo $row_cl['screen'];?>" width="45" height="45"/></td>
      <td width="136" valign="top">
	  <div class="clothes">
	    <p>
		<?php
		if ($row_cl['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?><span class="white"><?php echo $row_cl['name'];?></span></p>
        <p><span class="white"><?php echo $row_cl['lvl_need'];?></span> ур, новый</p>
		<p>Броня: <span class="white"><?php echo $row_cl['max_stats_bronya'] .'-'. $row_cl['min_stats_bronya'];?></span> </p>
        <p>Здор: <span class="white"><?php echo $row_cl['max_stats_hp'] .'-'. $row_cl['min_stats_hp'];?></span> </p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	  <div class="clothes">
	  <p>Рад. защ: <span class="white"><?php echo $row_cl['max_stats_rad'] .'-'. $row_cl['min_stats_rad'];?></span> </p>
	  <p>- - - - - - - - - - - -</p>
	  <p>Состояние:  <span class="white">8/8</span></p>
	  </div>
	  <div class="zx"><?php if ($row_cl['price_hab'] >=0) {
	  ?>[<a href="buy_thing.php?thing=<?php echo "$thing_id";?>&type=4&money=1">Купить за <img src="img/ico/materials.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price_hab'];?></span></a>] <br /><?php }  else {?><p class="clothes"><span class="bonus">[Купить шлем можно только за RUB]</span></p>
	  <?php }
	  if ($row_cl['price'] >=0) {
	  ?>[<a href="buy_thing.php?thing=<?php echo "$thing_id";?>&type=4&money=2">Купить за <img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price'];?></span></a>]<?php }
	  ?></p>
	  </div>
	  <?php
  }
  if ($type == 6) {
  ?>
<div style="border-style: double;">
 <div class="stats">
	<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"><?php echo $row_cl['name'];?></p>
	<p><img src="img/art/<?php echo $row_cl['screen'];?>"/></p>
	<p><b>Бонус:</b></p> 
	<p><span class="bonus">Регенерация: <?php echo $row_cl['speed'];?></span><br />
 </div>
	  <div class="zx">
<?php if ($row_cl['price_hab'] >=0) {
	  ?>[<a href="buy_thing.php?thing=<?php echo "$thing_id";?>&type=6&money=1" onclick="return confirm ('Уверены?')">Купить за <img src="img/ico/materials.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price_hab'];?></span></a>] <br /><?php }  else {?><p class="clothes"><span class="red">[Данный артефакт можно купить только за RUB]</span></p>
	  <?php }
	  if ($row_cl['price'] >=0) {
	  ?>[<a href="buy_thing.php?thing=<?php echo "$thing_id";?>&type=6&money=2" onclick="return confirm ('Уверены?')">Купить за <img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price'];?></span></a>]<?php }
	  ?></p>
	  </div>
</div>
	  <?php
  }
  ?>
</div>
<div class="stats">
</div>
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);
?>

</body>
</html>