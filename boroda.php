<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "reg.php";
  </script>
  <?php
  exit();
}
$page_title = 'Борода';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
  <?php
$type=$_GET['type'];
if (empty($type) or $type <> 1 and $type <> 2  and $type <> 3 and $type <> 4 and $type <> 5 and $type <> 6) {
  $type=1;
}
?>

  <?php
if ($type == 1) {
  ?>
<div id="main">
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Борода</p>
  <p><img src="img/ico/boroda.png"/></p>

  <div class="stats">
 <p><span class="bonus">Как говориться: "Добро пожаловать на борт нашего, болотного ледокола!"</p><br />
  <p><a href="boroda.php?type=3" class="menu">- Мне нужен детектор. Какие у тебя есть?</a></p>
  <p><a href="boroda.php?type=2" class="menu">- Хотелось бы купить артефакт. Какие можешь продать?</a></p>
  <p><a href="boroda.php?type=4" class="menu">- Нашел несколько артефактов в аномалиях. Не хочешь взглянуть?</a></p>
  <p><a href="skadovsk.php" class="menu">- Зайду позже</a></p>
  </div>
</div>
<?php
}
if ($type == 2) {
  ?>
<div class="stats">
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Борода</p>
  <p><img src="img/ico/boroda.png"/></p>
   <p><span class="bonus">- Вот, выбирай:</p><br />
  <p><img src="img/art/1.gif" width="12" height="12" /><a href="sale_art.php?thing=1&type=6">Кристалл</a></p>
  <p><img src="img/art/2.png" width="12" height="12" /><a href="sale_art.php?thing=2&type=6">Кровь камня</a></p>
  <p><img src="img/art/3.gif" width="12" height="12" /><a href="sale_art.php?thing=3&type=6">Ломоть мяса</a></p>
  <p><img src="img/art/4.gif" width="12" height="12" /><a href="sale_art.php?thing=4&type=6">Огненный шар</a></p>
  <p><img src="img/art/5.gif" width="12" height="12" /><a href="sale_art.php?thing=5&type=6">Бенгальский огонь</a></p>
  <p><img src="img/art/6.gif" width="12" height="12" /><a href="sale_art.php?thing=6&type=6">Выверт</a></p>
  <p><img src="img/art/7.png" width="12" height="12" /><a href="sale_art.php?thing=7&type=6">Глаз</a></p>
  <p><img src="img/art/8.png" width="12" height="12" /><a href="sale_art.php?thing=8&type=6">Мамины бусы</a></p>
  <p><img src="img/art/9.gif" width="12" height="12" /><a href="sale_art.php?thing=9&type=6">Лунный свет</a></p>
  <p><img src="img/art/10.png" width="12" height="12" /><a href="sale_art.php?thing=10&type=6">Душа</a></p>
  <p><img src="img/art/11.gif" width="12" height="12" /><a href="sale_art.php?thing=11&type=6">Снежинка</a></p>
  <p><img src="img/art/12.png" width="12" height="12" /><a href="sale_art.php?thing=12&type=6">Пламя</a></p>
  <p><img src="img/art/13.gif" width="12" height="12" /><a href="sale_art.php?thing=13&type=6">Батарейка</a></p>
  <p><img src="img/art/14.png" width="12" height="12" /><a href="sale_art.php?thing=14&type=6">Грави</a></p>
  <p><img src="img/art/15.gif" width="12" height="12" /><a href="sale_art.php?thing=15&type=6">Светляк</a></p>
  <p><img src="img/art/16.png" width="12" height="12" /><a href="sale_art.php?thing=16&type=6">Компас</a></p>
  <p><img src="img/art/17.png" width="12" height="12" /><a href="sale_art.php?thing=17&type=6">Пустышка</a></p>
  <p><img src="img/art/18.png" width="12" height="12" /><a href="sale_art.php?thing=18&type=6">Золотая рыбка</a></p>
<p>- - - - -</p>
  <p><a href="boroda.php?type=1" class="menu">- Ну и цены у тебя...</a></p>
  </div>
<?php
}
if ($type == 3) {
  ?>
<div class="stats">
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Борода</p>
  <p><img src="img/ico/boroda.png"/></p>
   <p><span class="bonus">- Вот, выбирай:</p><br />
  <p><a href="sale_dec.php?thing=1&type=7" class="menu"><img src="img/dec/otklik.gif" width="12" height="12" />Отклик</a></p>
  <p><a href="sale_dec.php?thing=2&type=7" class="menu"><img src="img/dec/medved.gif" width="12" height="12" />Медведь</a></p>
  <p><a href="sale_dec.php?thing=3&type=7" class="menu"><img src="img/dec/veles.gif" width="12" height="12" />Велес</a></p>
  <p><a href="sale_dec.php?thing=4&type=7" class="menu"><img src="img/dec/svarog.gif" width="12" height="12" />Сварог</a></p>
<p>- - - - -</p>
  <p><a href="boroda.php?type=1" class="menu">- Ну и цены у тебя...</a></p>
  </div>
<?php
}
if ($type == 4) {
  ?>
<div class="stats">
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Борода</p>
  <p><img src="img/ico/boroda.png"/></p>
   <p><span class="bonus">- Что будешь продавать?</p><br />
  <p><a href="boroda.php?type=5&id=1" class="menu"><img src="img/art/4.gif" width="12" height="12" /> Огненный шар <span class="white">[1200 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=2" class="menu"><img src="img/art/1.gif" width="12" height="12" /> Кристалл <span class="white">[1000 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=3" class="menu"><img src="img/art/7.png" width="12" height="12" /> Глаз <span class="white">[1600 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=4" class="menu"><img src="img/art/6.gif" width="12" height="12" /> Выверт <span class="white">[1400 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=5" class="menu"><img src="img/art/8.png" width="12" height="12" /> Мамины бусы <span class="white">[1800 <img src="img/chek.png" />]</span></a></p>
<p>- - - - -</p>
  <p><a href="boroda.php?type=1" class="menu">- Уже ничего</a></p>
  </div>
<?php
}
if ($type == 5) {
  ?>
<?php
$art_id = $_GET['id'];
$user_id = $_SESSION['id'];
$query_lal = "Select * from users where id='$user_id' limit 1";
$result_lal = mysqli_query($dbc, $query_lal) or die ('Ошибка передачи запроса к БД');
$row_lal = mysqli_fetch_array($result_lal);
if ($art_id == '1') {
$art = $row_lal['art1'];
}
if ($art_id == '2') {
$art = $row_lal['art2'];
}
if ($art_id == '3') {
$art = $row_lal['art3'];
}
if ($art_id == '4') {
$art = $row_lal['art4'];
}
if ($art_id == '5') {
$art = $row_lal['art5'];
}
?>
<div class="stats">
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Борода</p>
  <p><img src="img/ico/boroda.png"/></p>
   <p><span class="bonus">- И сколько продашь?</p><br />
<div class="stats">
<p class="white">
<?php
if ($art_id == '1') {?><img src="img/art/4.gif" width="12" height="12" /> Огненный шар<?php }?>
<?php
if ($art_id == '2') {?><img src="img/art/1.gif" width="12" height="12" /> Кристалл<?php }?>
<?php
if ($art_id == '3') {?><img src="img/art/7.png" width="12" height="12" /> Глаз<?php }
?>
<?php
if ($art_id == '4') {?><img src="img/art/6.gif" width="12" height="12" /> Выверт<?php }
?>
<?php
if ($art_id == '5') {?><img src="img/art/8.png" width="12" height="12" /> Мамины бусы<?php }
?>
:</p>
 <form enctype="multipart/form-data" method="post" action="boroda.php?type=6&id=<?php echo "$art_id";?>">
	 <input type="text" value="<?php echo "$art";?>" style="width:50%; height:18px;" class="input" name="sum" />
<input type="submit" style="width:70px;" class="input" value="продать" name="addchat"/>
     </form>
</div>
  <p><a href="boroda.php?type=5&id=1" class="menu"><img src="img/art/4.gif" width="12" height="12" /> Огненный шар <span class="white">[1200 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=2" class="menu"><img src="img/art/1.gif" width="12" height="12" /> Кристалл <span class="white">[1000 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=3" class="menu"><img src="img/art/7.png" width="12" height="12" /> Глаз <span class="white">[1600 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=4" class="menu"><img src="img/art/6.gif" width="12" height="12" /> Выверт <span class="white">[1400 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=5" class="menu"><img src="img/art/8.png" width="12" height="12" /> Мамины бусы <span class="white">[1800 <img src="img/chek.png" />]</span></a></p>
<p>- - - - -</p>
  <p><a href="boroda.php?type=1" class="menu">- Уже ничего</a></p>
  </div>
<?php
}
$id = $_GET['id'];
if ($type == 6 and $id == '1') {
  ?>
<?php
$user_id = $_SESSION['id'];
$query_lal = "Select * from users where id='$user_id' limit 1";
$result_lal = mysqli_query($dbc, $query_lal) or die ('Ошибка передачи запроса к БД');
$row_lal = mysqli_fetch_array($result_lal);
$art1 = $row_lal['art1'];
$sum = $_POST['sum'];
$sum = mysqli_real_escape_string($dbc, trim($sum));
$summ = ($sum * '1200');
?>
<?php
$prover = ($art1 - $sum);
if ($prover < '0') {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php
$prover = ($art1 - $sum);
if ($prover > $art1) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($sum > $art1) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($sum < '1') {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php
$query = "update users set dengi=dengi+'$summ', art1=art1-'$sum' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<div class="stats">
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Борода</p>
  <p><img src="img/ico/boroda.png"/></p>
   <p><span class="bonus">- Вот, держи свои <?php echo "$summ";?> чеков. Будешь еще что-то продавать?</p><br />
  <p><a href="boroda.php?type=5&id=1" class="menu"><img src="img/art/4.gif" width="12" height="12" /> Огненный шар <span class="white">[1200 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=2" class="menu"><img src="img/art/1.gif" width="12" height="12" /> Кристалл <span class="white">[1000 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=3" class="menu"><img src="img/art/7.png" width="12" height="12" /> Глаз <span class="white">[1600 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=4" class="menu"><img src="img/art/6.gif" width="12" height="12" /> Выверт <span class="white">[1400 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=5" class="menu"><img src="img/art/8.png" width="12" height="12" /> Мамины бусы <span class="white">[1800 <img src="img/chek.png" />]</span></a></p>
<p>- - - - -</p>
  <p><a href="boroda.php?type=1" class="menu">- Нет</a></p>
  </div>
<?php
}
if ($type == 6 and $id == '2') {
  ?>
<?php
$user_id = $_SESSION['id'];
$query_lal = "Select * from users where id='$user_id' limit 1";
$result_lal = mysqli_query($dbc, $query_lal) or die ('Ошибка передачи запроса к БД');
$row_lal = mysqli_fetch_array($result_lal);
$art2 = $row_lal['art2'];
$sum = $_POST['sum'];
$sum = mysqli_real_escape_string($dbc, trim($sum));
$summ = ($sum * '1000');
?>
<?php
$prover = ($art2 - $sum);
if ($prover < '0') {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php
$prover = ($art2 - $sum);
if ($prover > $art2) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($sum > $art2) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($sum < '1') {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php
$query = "update users set dengi=dengi+'$summ', art2=art2-'$sum' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<div class="stats">
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Борода</p>
  <p><img src="img/ico/boroda.png"/></p>
   <p><span class="bonus">- Вот, держи свои <?php echo "$summ";?> чеков. Будешь еще что-то продавать?</p><br />
  <p><a href="boroda.php?type=5&id=1" class="menu"><img src="img/art/4.gif" width="12" height="12" /> Огненный шар <span class="white">[1200 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=2" class="menu"><img src="img/art/1.gif" width="12" height="12" /> Кристалл <span class="white">[1000 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=3" class="menu"><img src="img/art/7.png" width="12" height="12" /> Глаз <span class="white">[1600 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=4" class="menu"><img src="img/art/6.gif" width="12" height="12" /> Выверт <span class="white">[1400 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=5" class="menu"><img src="img/art/8.png" width="12" height="12" /> Мамины бусы <span class="white">[1800 <img src="img/chek.png" />]</span></a></p>
<p>- - - - -</p>
  <p><a href="boroda.php?type=1" class="menu">- Нет</a></p>
  </div>
<?php
}
if ($type == 6 and $id == '3') {
  ?>
<?php
$user_id = $_SESSION['id'];
$query_lal = "Select * from users where id='$user_id' limit 1";
$result_lal = mysqli_query($dbc, $query_lal) or die ('Ошибка передачи запроса к БД');
$row_lal = mysqli_fetch_array($result_lal);
$art3 = $row_lal['art3'];
$sum = $_POST['sum'];
$sum = mysqli_real_escape_string($dbc, trim($sum));
$summ = ($sum * '1600');
?>
<?php
$prover = ($art3 - $sum);
if ($prover < '0') {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php
$prover = ($art3 - $sum);
if ($prover > $art3) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($sum > $art3) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($sum < '1') {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php
$query = "update users set dengi=dengi+'$summ', art3=art3-'$sum' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<div class="stats">
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Борода</p>
  <p><img src="img/ico/boroda.png"/></p>
   <p><span class="bonus">- Вот, держи свои <?php echo "$summ";?> чеков. Будешь еще что-то продавать?</p><br />
  <p><a href="boroda.php?type=5&id=1" class="menu"><img src="img/art/4.gif" width="12" height="12" /> Огненный шар <span class="white">[1200 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=2" class="menu"><img src="img/art/1.gif" width="12" height="12" /> Кристалл <span class="white">[1000 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=3" class="menu"><img src="img/art/7.png" width="12" height="12" /> Глаз <span class="white">[1600 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=4" class="menu"><img src="img/art/6.gif" width="12" height="12" /> Выверт <span class="white">[1400 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=5" class="menu"><img src="img/art/8.png" width="12" height="12" /> Мамины бусы <span class="white">[1800 <img src="img/chek.png" />]</span></a></p>
<p>- - - - -</p>
  <p><a href="boroda.php?type=1" class="menu">- Нет</a></p>
  </div>
<?php
}
if ($type == 6 and $id == '4') {
  ?>
<?php
$user_id = $_SESSION['id'];
$query_lal = "Select * from users where id='$user_id' limit 1";
$result_lal = mysqli_query($dbc, $query_lal) or die ('Ошибка передачи запроса к БД');
$row_lal = mysqli_fetch_array($result_lal);
$art4 = $row_lal['art4'];
$sum = $_POST['sum'];
$sum = mysqli_real_escape_string($dbc, trim($sum));
$summ = ($sum * '1400');
?>
<?php
$prover = ($art4 - $sum);
if ($prover < '0') {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php
$prover = ($art4 - $sum);
if ($prover > $art4) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($sum > $art4) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($sum < '1') {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php
$query = "update users set dengi=dengi+'$summ', art4=art4-'$sum' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<div class="stats">
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Борода</p>
  <p><img src="img/ico/boroda.png"/></p>
   <p><span class="bonus">- Вот, держи свои <?php echo "$summ";?> чеков. Будешь еще что-то продавать?</p><br />
  <p><a href="boroda.php?type=5&id=1" class="menu"><img src="img/art/4.gif" width="12" height="12" /> Огненный шар <span class="white">[1200 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=2" class="menu"><img src="img/art/1.gif" width="12" height="12" /> Кристалл <span class="white">[1000 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=3" class="menu"><img src="img/art/7.png" width="12" height="12" /> Глаз <span class="white">[1600 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=4" class="menu"><img src="img/art/6.gif" width="12" height="12" /> Выверт <span class="white">[1400 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=5" class="menu"><img src="img/art/8.png" width="12" height="12" /> Мамины бусы <span class="white">[1800 <img src="img/chek.png" />]</span></a></p>
<p>- - - - -</p>
  <p><a href="boroda.php?type=1" class="menu">- Нет</a></p>
  </div>
<?php
}
if ($type == 6 and $id == '5') {
  ?>
<?php
$user_id = $_SESSION['id'];
$query_lal = "Select * from users where id='$user_id' limit 1";
$result_lal = mysqli_query($dbc, $query_lal) or die ('Ошибка передачи запроса к БД');
$row_lal = mysqli_fetch_array($result_lal);
$art5 = $row_lal['art5'];
$sum = $_POST['sum'];
$sum = mysqli_real_escape_string($dbc, trim($sum));
$summ = ($sum * '1800');
?>
<?php
$prover = ($art5 - $sum);
if ($prover < '0') {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php
$prover = ($art5 - $sum);
if ($prover > $art5) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($sum > $art5) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($sum < '1') {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php
$query = "update users set dengi=dengi+'$summ', art5=art5-'$sum' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<div class="stats">
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Борода</p>
  <p><img src="img/ico/boroda.png"/></p>
   <p><span class="bonus">- Вот, держи свои <?php echo "$summ";?> чеков. Будешь еще что-то продавать?</p><br />
  <p><a href="boroda.php?type=5&id=1" class="menu"><img src="img/art/4.gif" width="12" height="12" /> Огненный шар <span class="white">[1200 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=2" class="menu"><img src="img/art/1.gif" width="12" height="12" /> Кристалл <span class="white">[1000 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=3" class="menu"><img src="img/art/7.png" width="12" height="12" /> Глаз <span class="white">[1600 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=4" class="menu"><img src="img/art/6.gif" width="12" height="12" /> Выверт <span class="white">[1400 <img src="img/chek.png" />]</span></a></p>
  <p><a href="boroda.php?type=5&id=5" class="menu"><img src="img/art/8.png" width="12" height="12" /> Мамины бусы <span class="white">[1800 <img src="img/chek.png" />]</span></a></p>
<p>- - - - -</p>
  <p><a href="boroda.php?type=1" class="menu">- Нет</a></p>
  </div>
<?php
}
?>
</div>
<?php

//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>