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
<?php
$thing_id = '1';
$type = '7';
?>
  <?php
}
if ($type <> 7) {
  ?>
<?php
$type = '7';
?>
  <?php
}
if ($type == 7) {
  $query_c = "Select * from detectors where dec_id = '$thing_id' limit 1";
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
    <p><a href="boroda.php?type=3" class="menu"><img src="img/ico/left.png" /> Назад к Бороде</a></p>
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
  if ($type == 7) {
  ?>
<div style="border-style: double; border-width: 1px;">
<?php
$speed = $row_cl['speed'];
$lal = ('100' - $speed);
?>
 <div class="stats">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"><?php echo $row_cl['name'];?></p>
	<p><img src="img/dec/<?php echo $row_cl['screen'];?>" <?php if ($row_cl['dec_id'] == '1') {?>width="65" height="75"<?php } else {?>width="66" height="65"<?php }?> /></p></center>
	<p><b>Характеристики:</b></p> 
	<p><span class="net">Шанс нахождения артефакта: <?php echo $row_cl['speed'];?>%</span><br />
	<p><span class="net">Шанс попадания в аномалию: <?php echo "$lal";?>%</span><br />
	<p><span class="net">Шанс удачной попытки достать: <?php echo $row_cl['speed'];?>%</span><br />
 	<p><span class="net">Прогресс при попытке достать: <?php echo $row_cl['min_stats_yron'];?>-<?php echo $row_cl['max_stats_yron'];?>%</span><br />
</div>
	  <div class="zx">
<?php if ($row_cl['price_hab'] >=0) {
	  ?><a href="buy_thing.php?thing=<?php echo "$thing_id";?>&type=7&money=1" class="menu" onclick="return confirm ('Уверены?')">[Купить за <img src="img/ico/materials.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price_hab'];?></span>]</a><?php }  else {?><p class="clothes"><span class="red">[Данный артефакт можно купить только за RUB]</span></p>
	  <?php }
	  if ($row_cl['price'] >=0) {
	  ?><a href="buy_thing.php?thing=<?php echo "$thing_id";?>&type=7&money=2" class="menu" onclick="return confirm ('Уверены?')">[Купить за <img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price'];?></span>]</a><?php }
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