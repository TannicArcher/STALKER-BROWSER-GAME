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
$page_title = 'Лот';
require_once('conf/head.php');
require_once('conf/top.php');
$lot = $_GET['lot'];
$lot = htmlentities($lot, ENT_QUOTES);
$lot = mysqli_real_escape_string($dbc, trim($lot));
if (empty($lot)) {
  ?>
  <script type="text/javascript">
  document.location.href = "a_clothes.php";
  </script>
  <?php
  exit();
}
  $query_lot = "Select  thing_id, price,price_now, price_user from auction where id_lot='$lot' limit 1";
  $result_lot = mysqli_query($dbc, $query_lot) or die ('Ошибка передачи запроса к БД');
  $row_lot = mysqli_fetch_array($result_lot);
if ($row_lot == 0) {
  ?>
  <script type="text/javascript">
  document.location.href = "a_clothes.php";
  </script>
  <?php
  exit();
}
$thing=$row_lot['thing_id'];

$query_ = "Select * from things where thing_id='$thing' limit 1";
$result_ = mysqli_query($dbc, $query_) or die ('Ошибка передачи запроса к БД2');
$row_ = mysqli_fetch_array($result_);
$h_id = $row_['user_id'];
$query_user1 = "Select * from users where id='$h_id' limit 1";
$result_user1 = mysqli_query($dbc, $query_user1) or die ('Ошибка передачи запроса к БД2');
$row_user1 = mysqli_fetch_array($result_user1);

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
if ($type == 1) {
  $query_inf = "Select name,screen,klass from clothes where clothes_id = '$inf_cl' limit 1";
  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
  $row_inf = mysqli_fetch_array($result_inf);
}//Назваине брони
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
?>
<div id="main">
<div class="stats">
<p class="podmenu"><?php echo $row_inf['name'];?></p>
</div>
<div class="stats">
<p><img src="img/ico/left.png" /> <a href="a_clothes.php">Назад к аукциону</a></p>
</div>
<?php
$err=$_GET['err'];
if (!empty($err)) {
?>
<div id="error">
<?php
if ($err == 1) {echo 'Недостаточно денег чтобы сделать ставку';}
if ($err == 2) {echo 'Недостаточно денег чтобы приобрести эту вещь';}

?>
</div>
<?php
}
  $user_id = $_SESSION['id'];
  $query_u = "Select lvl,money, habar from users where id = '$user_id'";
  $result_u = mysqli_query($dbc, $query_u) or die ('Ошибка передачи запроса к БД');
  $row_u = mysqli_fetch_array($result_u);
  $money = $row_u['money'];
  $habar = $row_u['habar'];
  $lvl = $row_u['lvl'];
  ?>
  <div class="stats">
    <p>[<img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo "$money"; ?></span>] [<img src="img/ico/materials.png" width="12" height="12"/> <span class="white"><?php echo "$habar"; ?></span>]</p>
  </div>
<div class="slot">
<?php
/////////////////////////////////////Начало БРОНИ
if ($type == 1) {
?>
<img src="img/clothes/<?php echo $row_inf['screen'];?>" alt="Слот №1" width="80" height="100"/>

	  <div class="clothes">
	    <p><?php
		if ($row_inf['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?> <span class="white"><?php echo $row_inf['name']; ?></span> (
		<span class="bonus"><?php echo $row['need_lvl'];?> ур,</span><?php if ($row['privat'] == 0) { echo " новый";}
	if ($row['privat'] == 1) { echo " личный";}?>)</p>
        <p><img src="img/ico/shield.png" alt="Броня"/><?php
		if ($row['upgrade_stat2'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat2'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat2'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat2'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Броня: <span class="white"><?php echo $row['stat2'];?></span></p>
        <p><img src="img/ico/life.png" alt="Здоровье"/><?php
		if ($row['upgrade_stat1'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat1'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat1'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat1'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Здоровье: <span class="white"><?php echo $row['stat1'];?></span></p>
	  <p><img src="img/ico/shield.png" alt="Прочность"/><?php
		if ($row['upgrade_stat3'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat3'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat3'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat3'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Прочность: <span class="white"><?php echo $row['stat3'];?></span></p>
	  <p><img src="img/ico/goodrad.png" alt="Рад.защита"/><?php
		if ($row['upgrade_speed'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_speed'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_speed'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_speed'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Рад.защита: <span class="white"><?php echo $row['speed'];?></span></p>
<p><img src="img/ico/profile.png" alt="Профиль" width="12"/> Владелец: 
<?php
$gruppa = $row_user1['gruppa'];
if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
if ($gruppa == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="s"/><?php }
if ($gruppa == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="s"/><?php }
?><a class="white" href="profile.php?id=<?php echo $row_user1['id'];?>"><?php echo $row_user1['nick'];?></a></p>
	  </div>
	 
<?php
}
//////////////////////////////////////Конец БРОНИ

/////////////////////////////////////Начало пистолета
if ($type == 2) {
?>
<img src="img/weapons/<?php echo $row_inf['screen'];?>" alt="Слот №1" width="60" height="50"/>

	  <div class="clothes">
	    <p><?php
		if ($row_inf['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?> <span class="white"><?php echo $row_inf['name']; ?></span> (
		<span class="bonus"><?php echo $row['need_lvl'];?> ур,</span><?php if ($row['privat'] == 0) { echo " новый";}
	if ($row['privat'] == 1) { echo " личный";}?>)</p>
        <p><img src="img/ico/to4nost.png" alt="Урон"/><?php
		if ($row['upgrade_stat1'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat1'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat1'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat1'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Урон: <span class="white"><?php echo $row['stat1'];?></span></p>
        <p><img src="img/ico/to4nost.png" alt="Урон"/><?php
		if ($row['upgrade_stat2'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat2'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat2'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat2'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Точность: <span class="white"><?php echo $row['stat2'];?></span></p>
	  		<p><img src="img/ico/to4nost.png" alt="Урон"/><?php
		if ($row['upgrade_stat3'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat3'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat3'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat3'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Надёжность: <span class="white"><?php echo $row['stat3'];?></span></p>
			<p><img src="img/ico/speed.png" alt="Урон"/><?php
		if ($row['upgrade_speed'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>-1сек)</span><?php }
		if ($row['upgrade_speed'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>-2сек)</span><?php }
		if ($row['upgrade_speed'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>-3сек)</span><?php }
		if ($row['upgrade_speed'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>-4сек)</span><?php }
		?> Перезарядка: <span class="white"><?php echo $row['speed'];?>сек</span></p>
<p><img src="img/ico/profile.png" alt="Профиль" width="12"/> Владелец: 
<?php
$gruppa = $row_user1['gruppa'];
if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
if ($gruppa == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="s"/><?php }
if ($gruppa == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="s"/><?php }
?><a class="white" href="profile.php?id=<?php echo $row_user1['id'];?>"><?php echo $row_user1['nick'];?></a></p>
	  </div>
<?php
}
/////////////////////////////////////Конец пистолета

////////////////////////Автомат НАЧАЛО!!!
if ($type == 3) {
?>	
<img src="img/weapons/<?php echo $row_inf['screen'];?>" alt="Слот №1" width="145" height="50"/>

	  <div class="clothes">
	    <p><?php
		if ($row_inf['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row_inf['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?> <span class="white"><?php echo $row_inf['name']; ?></span> (
		<span class="bonus"><?php echo $row['need_lvl'];?> ур,</span><?php if ($row['privat'] == 0) { echo " новый";}
	if ($row['privat'] == 1) { echo " личный";}?>)</p>
   <p><img src="img/ico/to4nost.png" alt="Урон"/><?php
		if ($row['upgrade_stat1'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat1'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat1'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat1'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Урон: <span class="white"><?php echo $row['stat1'];?></span></p>
    <p><img src="img/ico/to4nost.png" alt="Урон"/><?php
		if ($row['upgrade_stat2'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat2'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat2'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat2'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Точность: <span class="white"><?php echo $row['stat2'];?></span></p>
	<p><img src="img/ico/to4nost.png" alt="Урон"/><?php
		if ($row['upgrade_stat3'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($row['upgrade_stat3'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($row['upgrade_stat3'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($row['upgrade_stat3'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Надёжность: <span class="white"><?php echo $row['stat3'];?></span></p>
    <p><img src="img/ico/speed.png" alt="Урон"/><?php
		if ($row['upgrade_speed'] == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>-15%)</span><?php }
		if ($row['upgrade_speed'] == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>-25%)</span><?php }
		if ($row['upgrade_speed'] == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>-50%)</span><?php }
		if ($row['upgrade_speed'] >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>-75%)</span><?php }
		?> Перезарядка: <span class="white"><?php echo $row['speed'];?>сек</span></p>
<p><img src="img/ico/profile.png" alt="Профиль" width="12"/> Владелец: 
<?php
$gruppa = $row_user1['gruppa'];
if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
if ($gruppa == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="s"/><?php }
if ($gruppa == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="s"/><?php }
?><a class="white" href="profile.php?id=<?php echo $row_user1['id'];?>"><?php echo $row_user1['nick'];?></a></p>
	  </div>
	  <?php
}
///////////////////////////////
if ($row['user_id'] == $_SESSION['id']) {
?>
<div class="zx">
<p class="bonus"><b>[Ваш лот]</b></p>
<p>Ставка: [<span class="white"><img src="img/ico/money.png" width="12" height="12"/> <?php echo $row_lot['price_now']?></span>]</p>
<p>Выкуп: [<span class="white"><img src="img/ico/money.png" width="12" height="12"/> <?php echo $row_lot['price']?></span>]</p>
</div>
<?php
}
else {
?>
<div class="zx">
<?php
$new_price= ($row_lot['price_now']+($row_lot['price_now']*0.10));
$new_price = round($new_price);
if ($row_lot['price'] > $new_price) {
?>
<p>Ставка: [<span class="white"><img src="img/ico/money.png" width="12" height="12"/> <?php echo $row_lot['price_now']?></span>][<img src="img/ico/top.png" width="12" height="12"/> <a href="lot_price.php?type=1&lot=<?php echo "$lot" ?>">повысить до <img src="img/ico/money.png" width="12" height="12"/><?php echo "$new_price"  ?></a>]</p>
<?php
}
?>
<p>Выкуп: [<span class="white"><img src="img/ico/money.png" width="12" height="12"/> <?php echo $row_lot['price']?></span>][<img src="img/ico/money.png" width="12" height="12"/> <a href="lot_price.php?type=2&lot=<?php echo "$lot" ?>">выкупить</a>]</p>
</div>
<?php if ($row_lot['price_user'] == $_SESSION['id']) {?><div class="zx"><p class="bonus">[Ваша ставка]</p></div><?php }
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