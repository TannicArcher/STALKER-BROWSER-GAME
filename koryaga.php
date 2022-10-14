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
$page_title = 'Коряга';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$query_lal = "Select * from users where id='$user_id' limit 1";
$result_lal = mysqli_query($dbc, $query_lal) or die ('Ошибка передачи запроса к БД');
$row_lal = mysqli_fetch_array($result_lal);
$dengi = $row_lal['dengi'];
?>
<div id="main">
  <center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Коряга</p>
  <p><img src="img/ico/Коряга.png"/></p></center>
  <?php
$type=$_GET['type'];
if (empty($type) or $type <> 1 and $type <> 2 ) {
  $type=1;
}
?>
  <?php
if ($type == 1) {
  ?>
  <div class="stats">
<p style="border-top: solid 1px #444e4f"></p>
  <p><span class="bonus">- Не видишь? Занят я... Что хотел?</p>
<p style="border-top: solid 1px #444e4f"></p>
<p class="blue">Курс: 100 чеков = 10 RUB</p>
<p style="border-top: solid 1px #444e4f"></p><br />
<?php if ($dengi > '1000') {?>
<p class="white">Чеки: <span class="red">(минимум 1000)</span></p>
 <form enctype="multipart/form-data" method="post" action="koryaga.php?type=2">
	 <input type="text"  style="width:50%; height:18px;" class="input" name="sum" />
<input type="submit" style="width:70px;" class="input" value="обменять" name="addchat"/>
     </form><?php } else {?>
Для обмена у вас должно быть минимум 1000 чеков
<?php }?>
  </div>
</div>
<?php
}
if ($type == 2) {
  ?>
<?php
$sum = $_POST['sum'];
$sum = mysqli_real_escape_string($dbc, trim($sum));
$summ = ($sum / '100');
?>
<?php if (empty($sum)) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($sum < '1000' or $dengi < $sum) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php
$prover = ($dengi - $sum);
if ($prover < '0') {?>
<?php
echo "Недостаточно чеков";
exit();
?>
<?php }?>
<?php
$summ = ($summ * '10');
$query = "update users set dengi=dengi-'$sum', money=money+'$summ' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<div id="main">
<p style="border-top: solid 1px #444e4f"></p>
<p class="bonus"><b>Вот, забирай свои <?php echo "$summ";?> RUB.. и уходи! Не мешай мне.</a></b></p><br />
<p style="border-top: solid 1px #444e4f"></p>
  </div>
<div class="stats">
<p><a class="white" href="skadovsk.php">- Ладно, ухожу</a></p>
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