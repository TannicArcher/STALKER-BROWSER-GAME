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
$page_title = 'Лотерея';
require_once('conf/head.php');
require_once('conf/top.php');
?>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php
$user_id = $_SESSION['id'];
$query_us = "Select money, loto_time from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$money = $row_us['money'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$loto_time = $row_us['loto_time'];
$loto_time = strtotime("$loto_time");
$time = ($loto_time - $now);
?>
<?php if ($time > 0) {?>
  <script type="text/javascript">
  document.location.href = "sultan.php";
  </script>
<?php
exit();
}?>
<?php if ($money < '100') {?><span class="red">А деньги кто платить будет?!</span><?php } else {?><?php
$type = rand(1,7);
?>
<?php 
if ($type == '1') {?>
<?php
$rand = rand(5000,25000);
$query = "update users set habar=habar + $rand, money=money - '100', loto_time=NOW() + ('500') where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p class="bonus"><img src="img/ico/materials.png"/> Вы выиграли <?php echo "$rand"; ?> хабара</p>
<?php }
if ($type == '2') {?>
<?php
$rand = rand(50,300);
$query = "update users set money=money + ($rand - '100'), loto_time=NOW() + ('500') where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p class="bonus"><img src="img/ico/money.png"/> Вы выиграли <?php echo "$rand"; ?> RUB</p>
<?php }
if ($type == '3') {?>
<?php
$rand = rand(50,500);
$query = "update users set aptechki=aptechki + $rand, money=money - '100', loto_time=NOW() + ('500') where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p class="bonus"><img src="img/ico/apte4ka.png"/> Вы выиграли <?php echo "$rand"; ?> аптечек</p>
<?php }
if ($type == '4') {?>
<?php
$rand = rand(50,500);
$query = "update users set antirad=antirad + $rand, money=money - '100', loto_time=NOW() + ('500') where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p class="bonus"><img src="img/ico/antirad.png"/> Вы выиграли <?php echo "$rand"; ?> антирадов</p>
<?php }
if ($type <> '1' and $type <> '2' and $type <> '3' and $type <> '4') {?>
<?php
$query = "update users set money=money - '100', opit=opit+'10000', loto_time=NOW() + ('500') where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p class="red"><img src="img/smiles/buhoj.gif"/> Вы ничего не выиграли. Утешительный приз - 10k опыта</p>
<?php }
?>
<?php }?>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<p><img src="img/reload.gif" width="12" height="12"/> <a href="sultan.php">Назад</a></p>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>