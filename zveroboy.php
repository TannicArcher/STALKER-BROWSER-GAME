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
?>
<?php
$el = '1';
if ($el == '1') {?>
<b>404 not found</b>
<?php
} else {?>
<?php
$page_title = 'Глухарь';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$type = $_GET['type'];
$user_id = $_SESSION['id'];
$query = "update users set location = 'zveroboy' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_q = "Select * from users where id='$user_id' limit 1";
$result_q = mysqli_query($dbc, $query_q) or die ('Ошибка передачи запроса к БД');
$row_q = mysqli_fetch_array($result_q);
$id_u = $row_q['id'];
$quest = $row_q['quest'];
$quest_time = $row_q['quest_time'];
$vid = rand(1,7);
$kol = rand(1,5);
$lal1 = rand(8000,13000);
$lal2 = rand(27000,50000);
$lal3 = rand(1000,3500);
$lal4 = rand(50000,100000);
$lal5 = rand(4000,7900);
$lal6 = rand(20000,30000);
$lal7 = rand(90000,190000);
$lal1 = ($lal1 * $kol);
$lal2 = ($lal2 * $kol);
$lal3 = ($lal3 * $kol);
$lal4 = ($lal4 * $kol);
$lal5 = ($lal5 * $kol);
$lal6 = ($lal6 * $kol);
$lal7 = ($lal7 * $kol);
?>
<div id="main">
<div class="stats">
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Глухарь</p>
<center><img src="img/gluhar.png"/></center>
</div>
<?php
if (empty($type) or $type <> 1 and $type <> 2 and $type <> 3) {
  $type=1;
}
?>
<?php 
if ($type == '1') {?>
<p class="blue">Не тяни время. Рассказывай, зачем пришел.</p><br />
<img src="img/ico/link.png"> <a class="white" href="zveroboy.php?type=2">Есть работа для меня? Хочу убить пару-тройку мутантов...</a>
<p class="podmenu" style="border-top:1px solid #444e4f"></p>
<?php }
if ($type == '2' and $vid == '1') {?>
<?php
$query = "update users set vid='$vid', priz_q='$lal1', kol='0', need_kol='$kol' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p class="blue">Есть, чего ж ей не быть...</p>
<p class="bonus">Возле 
<?php 
if ($vid == '1') {?>аномалии "Коготь" <?php }
if ($vid == '2') {?>вентиляционного комплекса <?php }
if ($vid == '3') {?>лесничества <?php }
if ($vid == '4') {?>гастронома <?php }
if ($vid == '5') {?>заправки <?php }
if ($vid == '6') {?>болота <?php }
if ($vid == '7') {?>ВНЗ круга <?php }
?>
<?php if ($vid == '1') {?>появилось логово снорков<?php } else {?>были замечены несколько мутантов<?php }?>... Убей <?php echo "$kol";?> 
<?php 
if ($vid == '1') {?>снорка<?php }
if ($vid == '2') {?>химеры<?php }
if ($vid == '3') {?>слепых пса<?php }
if ($vid == '4') {?>контролера<?php }
if ($vid == '5') {?>плоти<?php }
if ($vid == '6') {?>кровососа<?php }
if ($vid == '7') {?>псевдогиганта<?php }
?>. Плачу за это 
<?php 
if ($vid == '1') {?><?php echo "$lal1";?><?php }
if ($vid == '2') {?><?php echo "$lal2";?><?php }
if ($vid == '3') {?><?php echo "$lal3";?><?php }
if ($vid == '4') {?><?php echo "$lal4";?><?php }
if ($vid == '5') {?><?php echo "$lal5";?><?php }
if ($vid == '6') {?><?php echo "$lal6";?><?php }
if ($vid == '7') {?><?php echo "$lal7";?><?php }
?> <img src="img/ico/materials.png"/> хабара.</p>
<img src="img/ico/link.png"> <a class="white" href="zveroboy.php?type=2">Есть другая работа?</a><br />
<img src="img/ico/link.png"> <a class="white" href="zveroboy.php?type=3">Беру</a><br />
<img src="img/ico/link.png"> <a class="white" href="skadovsk.php">Зайду позже</a>
<p class="podmenu" style="border-top:1px solid #444e4f"></p>
<?php }
if ($type == '2' and $vid == '2') {?>
<?php
$query = "update users set vid='$vid', priz_q='$lal2', kol='0', need_kol='$kol' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p class="blue">Есть, чего ж ей не быть...</p>
<p class="bonus">Возле 
<?php 
if ($vid == '1') {?>аномалии "Коготь" <?php }
if ($vid == '2') {?>вентиляционного комплекса <?php }
if ($vid == '3') {?>лесничества <?php }
if ($vid == '4') {?>гастронома <?php }
if ($vid == '5') {?>заправки <?php }
if ($vid == '6') {?>болота <?php }
if ($vid == '7') {?>ВНЗ круга <?php }
?>
<?php if ($vid == '1') {?>появилось логово снорков<?php } else {?>были замечены несколько мутантов<?php }?>... Убей <?php echo "$kol";?> 
<?php 
if ($vid == '1') {?>снорка<?php }
if ($vid == '2') {?>химеры<?php }
if ($vid == '3') {?>слепых пса<?php }
if ($vid == '4') {?>контролера<?php }
if ($vid == '5') {?>плоти<?php }
if ($vid == '6') {?>кровососа<?php }
if ($vid == '7') {?>псевдогиганта<?php }
?>. Плачу за это 
<?php 
if ($vid == '1') {?><?php echo "$lal1";?><?php }
if ($vid == '2') {?><?php echo "$lal2";?><?php }
if ($vid == '3') {?><?php echo "$lal3";?><?php }
if ($vid == '4') {?><?php echo "$lal4";?><?php }
if ($vid == '5') {?><?php echo "$lal5";?><?php }
if ($vid == '6') {?><?php echo "$lal6";?><?php }
if ($vid == '7') {?><?php echo "$lal7";?><?php }
?> <img src="img/ico/materials.png"/> хабара.</p>
<img src="img/ico/link.png"> <a class="white" href="zveroboy.php?type=2">Есть другая работа?</a><br />
<img src="img/ico/link.png"> <a class="white" href="zveroboy.php?type=3">Беру</a><br />
<img src="img/ico/link.png"> <a class="white" href="skadovsk.php">Зайду позже</a>
<p class="podmenu" style="border-top:1px solid #444e4f"></p>
<?php }
if ($type == '2' and $vid == '3') {?>
<?php
$query = "update users set vid='$vid', priz_q='$lal3', kol='0', need_kol='$kol' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p class="blue">Есть, чего ж ей не быть...</p>
<p class="bonus">Возле 
<?php 
if ($vid == '1') {?>аномалии "Коготь" <?php }
if ($vid == '2') {?>вентиляционного комплекса <?php }
if ($vid == '3') {?>лесничества <?php }
if ($vid == '4') {?>гастронома <?php }
if ($vid == '5') {?>заправки <?php }
if ($vid == '6') {?>болота <?php }
if ($vid == '7') {?>ВНЗ круга <?php }
?>
<?php if ($vid == '1') {?>появилось логово снорков<?php } else {?>были замечены несколько мутантов<?php }?>... Убей <?php echo "$kol";?> 
<?php 
if ($vid == '1') {?>снорка<?php }
if ($vid == '2') {?>химеры<?php }
if ($vid == '3') {?>слепых пса<?php }
if ($vid == '4') {?>контролера<?php }
if ($vid == '5') {?>плоти<?php }
if ($vid == '6') {?>кровососа<?php }
if ($vid == '7') {?>псевдогиганта<?php }
?>. Плачу за это 
<?php 
if ($vid == '1') {?><?php echo "$lal1";?><?php }
if ($vid == '2') {?><?php echo "$lal2";?><?php }
if ($vid == '3') {?><?php echo "$lal3";?><?php }
if ($vid == '4') {?><?php echo "$lal4";?><?php }
if ($vid == '5') {?><?php echo "$lal5";?><?php }
if ($vid == '6') {?><?php echo "$lal6";?><?php }
if ($vid == '7') {?><?php echo "$lal7";?><?php }
?> <img src="img/ico/materials.png"/> хабара.</p>
<img src="img/ico/link.png"> <a class="white" href="zveroboy.php?type=2">Есть другая работа?</a><br />
<img src="img/ico/link.png"> <a class="white" href="zveroboy.php?type=3">Беру</a><br />
<img src="img/ico/link.png"> <a class="white" href="skadovsk.php">Зайду позже</a>
<p class="podmenu" style="border-top:1px solid #444e4f"></p>
<?php }
if ($type == '2' and $vid == '4') {?>
<?php
$query = "update users set vid='$vid', priz_q='$lal4', kol='0', need_kol='$kol' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p class="blue">Есть, чего ж ей не быть...</p>
<p class="bonus">Возле 
<?php 
if ($vid == '1') {?>аномалии "Коготь" <?php }
if ($vid == '2') {?>вентиляционного комплекса <?php }
if ($vid == '3') {?>лесничества <?php }
if ($vid == '4') {?>гастронома <?php }
if ($vid == '5') {?>заправки <?php }
if ($vid == '6') {?>болота <?php }
if ($vid == '7') {?>ВНЗ круга <?php }
?>
<?php if ($vid == '1') {?>появилось логово снорков<?php } else {?>были замечены несколько мутантов<?php }?>... Убей <?php echo "$kol";?> 
<?php 
if ($vid == '1') {?>снорка<?php }
if ($vid == '2') {?>химеры<?php }
if ($vid == '3') {?>слепых пса<?php }
if ($vid == '4') {?>контролера<?php }
if ($vid == '5') {?>плоти<?php }
if ($vid == '6') {?>кровососа<?php }
if ($vid == '7') {?>псевдогиганта<?php }
?>. Плачу за это 
<?php 
if ($vid == '1') {?><?php echo "$lal1";?><?php }
if ($vid == '2') {?><?php echo "$lal2";?><?php }
if ($vid == '3') {?><?php echo "$lal3";?><?php }
if ($vid == '4') {?><?php echo "$lal4";?><?php }
if ($vid == '5') {?><?php echo "$lal5";?><?php }
if ($vid == '6') {?><?php echo "$lal6";?><?php }
if ($vid == '7') {?><?php echo "$lal7";?><?php }
?> <img src="img/ico/materials.png"/> хабара.</p>
<img src="img/ico/link.png"> <a class="white" href="zveroboy.php?type=2">Есть другая работа?</a><br />
<img src="img/ico/link.png"> <a class="white" href="zveroboy.php?type=3">Беру</a><br />
<img src="img/ico/link.png"> <a class="white" href="skadovsk.php">Зайду позже</a>
<p class="podmenu" style="border-top:1px solid #444e4f"></p>
<?php }
if ($type == '2' and $vid == '5') {?>
<?php
$query = "update users set vid='$vid', priz_q='$lal5', kol='0', need_kol='$kol' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p class="blue">Есть, чего ж ей не быть...</p>
<p class="bonus">Возле 
<?php 
if ($vid == '1') {?>аномалии "Коготь" <?php }
if ($vid == '2') {?>вентиляционного комплекса <?php }
if ($vid == '3') {?>лесничества <?php }
if ($vid == '4') {?>гастронома <?php }
if ($vid == '5') {?>заправки <?php }
if ($vid == '6') {?>болота <?php }
if ($vid == '7') {?>ВНЗ круга <?php }
?>
<?php if ($vid == '1') {?>появилось логово снорков<?php } else {?>были замечены несколько мутантов<?php }?>... Убей <?php echo "$kol";?> 
<?php 
if ($vid == '1') {?>снорка<?php }
if ($vid == '2') {?>химеры<?php }
if ($vid == '3') {?>слепых пса<?php }
if ($vid == '4') {?>контролера<?php }
if ($vid == '5') {?>плоти<?php }
if ($vid == '6') {?>кровососа<?php }
if ($vid == '7') {?>псевдогиганта<?php }
?>. Плачу за это 
<?php 
if ($vid == '1') {?><?php echo "$lal1";?><?php }
if ($vid == '2') {?><?php echo "$lal2";?><?php }
if ($vid == '3') {?><?php echo "$lal3";?><?php }
if ($vid == '4') {?><?php echo "$lal4";?><?php }
if ($vid == '5') {?><?php echo "$lal5";?><?php }
if ($vid == '6') {?><?php echo "$lal6";?><?php }
if ($vid == '7') {?><?php echo "$lal7";?><?php }
?> <img src="img/ico/materials.png"/> хабара.</p>
<img src="img/ico/link.png"> <a class="white" href="zveroboy.php?type=2">Есть другая работа?</a><br />
<img src="img/ico/link.png"> <a class="white" href="zveroboy.php?type=3">Беру</a><br />
<img src="img/ico/link.png"> <a class="white" href="skadovsk.php">Зайду позже</a>
<p class="podmenu" style="border-top:1px solid #444e4f"></p>
<?php }
if ($type == '2' and $vid == '6') {?>
<?php
$query = "update users set vid='$vid', priz_q='$lal6', kol='0', need_kol='$kol' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p class="blue">Есть, чего ж ей не быть...</p>
<p class="bonus">Возле 
<?php 
if ($vid == '1') {?>аномалии "Коготь" <?php }
if ($vid == '2') {?>вентиляционного комплекса <?php }
if ($vid == '3') {?>лесничества <?php }
if ($vid == '4') {?>гастронома <?php }
if ($vid == '5') {?>заправки <?php }
if ($vid == '6') {?>болота <?php }
if ($vid == '7') {?>ВНЗ круга <?php }
?>
<?php if ($vid == '1') {?>появилось логово снорков<?php } else {?>были замечены несколько мутантов<?php }?>... Убей <?php echo "$kol";?> 
<?php 
if ($vid == '1') {?>снорка<?php }
if ($vid == '2') {?>химеры<?php }
if ($vid == '3') {?>слепых пса<?php }
if ($vid == '4') {?>контролера<?php }
if ($vid == '5') {?>плоти<?php }
if ($vid == '6') {?>кровососа<?php }
if ($vid == '7') {?>псевдогиганта<?php }
?>. Плачу за это 
<?php 
if ($vid == '1') {?><?php echo "$lal1";?><?php }
if ($vid == '2') {?><?php echo "$lal2";?><?php }
if ($vid == '3') {?><?php echo "$lal3";?><?php }
if ($vid == '4') {?><?php echo "$lal4";?><?php }
if ($vid == '5') {?><?php echo "$lal5";?><?php }
if ($vid == '6') {?><?php echo "$lal6";?><?php }
if ($vid == '7') {?><?php echo "$lal7";?><?php }
?> <img src="img/ico/materials.png"/> хабара.</p>
<img src="img/ico/link.png"> <a class="white" href="zveroboy.php?type=2">Есть другая работа?</a><br />
<img src="img/ico/link.png"> <a class="white" href="zveroboy.php?type=3">Беру</a><br />
<img src="img/ico/link.png"> <a class="white" href="skadovsk.php">Зайду позже</a>
<p class="podmenu" style="border-top:1px solid #444e4f"></p>
<?php }
if ($type == '2' and $vid == '7') {?>
<?php
$query = "update users set vid='$vid', priz_q='$lal7', kol='0', need_kol='$kol' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p class="blue">Есть, чего ж ей не быть...</p>
<p class="bonus">Возле 
<?php 
if ($vid == '1') {?>аномалии "Коготь" <?php }
if ($vid == '2') {?>вентиляционного комплекса <?php }
if ($vid == '3') {?>лесничества <?php }
if ($vid == '4') {?>гастронома <?php }
if ($vid == '5') {?>заправки <?php }
if ($vid == '6') {?>болота <?php }
if ($vid == '7') {?>ВНЗ круга <?php }
?>
<?php if ($vid == '1') {?>появилось логово снорков<?php } else {?>были замечены несколько мутантов<?php }?>... Убей <?php echo "$kol";?> 
<?php 
if ($vid == '1') {?>снорка<?php }
if ($vid == '2') {?>химеры<?php }
if ($vid == '3') {?>слепых пса<?php }
if ($vid == '4') {?>контролера<?php }
if ($vid == '5') {?>плоти<?php }
if ($vid == '6') {?>кровососа<?php }
if ($vid == '7') {?>псевдогиганта<?php }
?>. Плачу за это 
<?php 
if ($vid == '1') {?><?php echo "$lal1";?><?php }
if ($vid == '2') {?><?php echo "$lal2";?><?php }
if ($vid == '3') {?><?php echo "$lal3";?><?php }
if ($vid == '4') {?><?php echo "$lal4";?><?php }
if ($vid == '5') {?><?php echo "$lal5";?><?php }
if ($vid == '6') {?><?php echo "$lal6";?><?php }
if ($vid == '7') {?><?php echo "$lal7";?><?php }
?> <img src="img/ico/materials.png"/> хабара.</p>
<img src="img/ico/link.png"> <a class="white" href="zveroboy.php?type=2">Есть другая работа?</a><br />
<img src="img/ico/link.png"> <a class="white" href="zveroboy.php?type=3">Беру</a><br />
<img src="img/ico/link.png"> <a class="white" href="skadovsk.php">Зайду позже</a>
<p class="podmenu" style="border-top:1px solid #444e4f"></p>
<?php }
if ($type == '3') {?>
<?php
$query = "update users set quest='1' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p>Задание принято. <a class="white" href="monsters.php">Приступай</a> к выполнению.</p>
<p class="podmenu" style="border-top:1px solid #444e4f"></p>
<?php }
?>
</div>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
<?php }?>
</body>
</html>