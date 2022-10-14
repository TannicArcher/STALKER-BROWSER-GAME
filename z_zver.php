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
$page_title = 'Гонта';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$query_lal = "Select * from users where id='$user_id' limit 1";
$result_lal = mysqli_query($dbc, $query_lal) or die ('Ошибка передачи запроса к БД');
$row_lal = mysqli_fetch_array($result_lal);
$lvl = $row_lal['lvl'];
$t_1 = $row_lal['t_1'];
$t_2 = $row_lal['t_2'];
$t_3 = $row_lal['t_3'];
$t_4 = $row_lal['t_4'];
$t_5 = $row_lal['t_5'];
$t_6 = $row_lal['t_6'];
$t_1s = ('250' * $lvl);
$t_2s = ('150' * $lvl);
$t_3s = ('500' * $lvl);
$t_4s = ('260' * $lvl);
$t_5s = ('650' * $lvl);
$t_6s = ('240' * $lvl);
$t_1ss = ($t_1s * $t_1);
$t_2ss = ($t_2s * $t_2);
$t_3ss = ($t_3s * $t_3);
$t_4ss = ($t_4s * $t_4);
$t_5ss = ($t_5s * $t_5);
$t_6ss = ($t_6s * $t_6);
$lal_sum = ($t_1ss + $t_2ss + $t_3ss + $t_4ss + $t_5ss + $t_6ss);
?>
<div id="main">
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Гонта</p>
  <p><img src="img/ico/gonta.png"/></p>
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
  <p><span class="bonus">- Мы со зверобоем - давние друзья. Если хочешь продать какую-нибудь часть тела мутанта, то я её куплю.</p>
<p style="border-top: 1px solid #444e4f;"></p>
<?php if ($t_1 > '0') {?>
<p class="net">Хвост пси-собаки: <span class="bonus"><?php echo "$t_1";?> шт.</span> <span class="white">(<img src="img/ico/materials.png"/><?php echo "$t_1s";?>*<?php echo "$t_1";?> = <img src="img/ico/materials.png"/><?php echo "$t_1ss";?>)</span></p>
 <form enctype="multipart/form-data" method="post" action="z_zver.php?type=2&id=1">
	 <input type="text" value="<?php echo "$t_1";?>" style="width:50%; height:18px;" class="input" name="sum1" />
<input type="submit" style="width:70px;" class="input" value="продать" name="addchat"/>
     </form><?php }?>
<?php if ($t_2 > '0') {?>
<p style="border-top: 1px solid #444e4f;"></p>
<p class="net">Глаз плоти: <span class="bonus"><?php echo "$t_2";?> шт.</span> <span class="white">(<img src="img/ico/materials.png"/><?php echo "$t_2s";?>*<?php echo "$t_2";?> = <img src="img/ico/materials.png"/><?php echo "$t_2ss";?>)</span></p>
 <form enctype="multipart/form-data" method="post" action="z_zver.php?type=2&id=2">
	 <input type="text" value="<?php echo "$t_2";?>" style="width:50%; height:18px;" class="input" name="sum2" />
<input type="submit" style="width:70px;" class="input" value="продать" name="addchat"/>
     </form><?php }?>
<?php if ($t_3 > '0') {?>
<p style="border-top: 1px solid #444e4f;"></p>
<p class="net">Нога снорка: <span class="bonus"><?php echo "$t_3";?> шт.</span> <span class="white">(<img src="img/ico/materials.png"/><?php echo "$t_3s";?>*<?php echo "$t_3";?> = <img src="img/ico/materials.png"/><?php echo "$t_3ss";?>)</span></p>
 <form enctype="multipart/form-data" method="post" action="z_zver.php?type=2&id=3">
	 <input type="text" value="<?php echo "$t_3";?>" style="width:50%; height:18px;" class="input" name="sum3" />
<input type="submit" style="width:70px;" class="input" value="продать" name="addchat"/>
     </form><?php }?>
<?php if ($t_4 > '0') {?>
<p style="border-top: 1px solid #444e4f;"></p>
<p class="net">Копыто кабана: <span class="bonus"><?php echo "$t_4";?> шт.</span> <span class="white">(<img src="img/ico/materials.png"/><?php echo "$t_4s";?>*<?php echo "$t_4";?> = <img src="img/ico/materials.png"/><?php echo "$t_4ss";?>)</span></p>
 <form enctype="multipart/form-data" method="post" action="z_zver.php?type=2&id=4">
	 <input type="text" value="<?php echo "$t_4";?>" style="width:50%; height:18px;" class="input" name="sum4" />
<input type="submit" style="width:70px;" class="input" value="продать" name="addchat"/>
     </form><?php }?>
<?php if ($t_5 > '0') {?>
<p style="border-top: 1px solid #444e4f;"></p>
<p class="net">Щупальца кровососа: <span class="bonus"><?php echo "$t_5";?> шт.</span> <span class="white">(<img src="img/ico/materials.png"/><?php echo "$t_5s";?>*<?php echo "$t_5";?> = <img src="img/ico/materials.png"/><?php echo "$t_5ss";?>)</span></p>
 <form enctype="multipart/form-data" method="post" action="z_zver.php?type=2&id=5">
	 <input type="text" value="<?php echo "$t_5";?>" style="width:50%; height:18px;" class="input" name="sum5" />
<input type="submit" style="width:70px;" class="input" value="продать" name="addchat"/>
     </form><?php }?>
<?php if ($t_6 > '0') {?>
<p style="border-top: 1px solid #444e4f;"></p>
<p class="net">Хвост слепого пса: <span class="bonus"><?php echo "$t_6";?> шт.</span> <span class="white">(<img src="img/ico/materials.png"/><?php echo "$t_6s";?>*<?php echo "$t_6";?> = <img src="img/ico/materials.png"/><?php echo "$t_6ss";?>)</span></p>
 <form enctype="multipart/form-data" method="post" action="z_zver.php?type=2&id=6">
	 <input type="text" value="<?php echo "$t_6";?>" style="width:50%; height:18px;" class="input" name="sum6" />
<input type="submit" style="width:70px;" class="input" value="продать" name="addchat"/>
     </form><?php }?>
<br/>
<p style="border-top: 1px solid #444e4f;"></p>
<p class="white">В сумме: <img src="img/ico/materials.png"/><?php echo "$lal_sum";?></p>
<p style="border-top: 1px solid #444e4f;"></p>
<p><a class="white" href="skadovsk.php">- До встречи</a></p>
  </div>
</div>
<?php
}
if ($type == 2) {
  ?>
<?php
$trofi = $_GET['id'];
?>
<?php
if ($trofi == '1') {?>
<?php
$sum = $_POST['sum1'];
$sum = mysqli_real_escape_string($dbc, trim($sum));
$summ = ($sum * $t_1s);
?>
<?php
$prover = ($t_1 - $sum);
if ($prover < '0') {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php
$prover = ($t_1 - $sum);
if ($prover > $t_1) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if (empty($sum)) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($sum < '1' or $t_1 < $sum) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php }?>
<?php
if ($trofi == '2') {?>
<?php
$sum = $_POST['sum2'];
$sum = mysqli_real_escape_string($dbc, trim($sum));
$summ = ($sum * $t_2s);
?>
<?php
$prover = ($t_2 - $sum);
if ($prover < '0') {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php
$prover = ($t_2 - $sum);
if ($prover > $t_2) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if (empty($sum)) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($sum < '1' or $t_2 < $sum) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php }?>
<?php
if ($trofi == '3') {?>
<?php
$sum = $_POST['sum3'];
$sum = mysqli_real_escape_string($dbc, trim($sum));
$summ = ($sum * $t_3s);
?>
<?php
$prover = ($t_3 - $sum);
if ($prover < '0') {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php
$prover = ($t_3 - $sum);
if ($prover > $t_3) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if (empty($sum)) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($sum < '1' or $t_3 < $sum) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php }?>
<?php
if ($trofi == '4') {?>
<?php
$sum = $_POST['sum4'];
$sum = mysqli_real_escape_string($dbc, trim($sum));
$summ = ($sum * $t_4s);
?>
<?php
$prover = ($t_4 - $sum);
if ($prover < '0') {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php
$prover = ($t_4 - $sum);
if ($prover > $t_4) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if (empty($sum)) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($sum < '1' or $t_4 < $sum) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php }?>
<?php
if ($trofi == '5') {?>
<?php
$sum = $_POST['sum5'];
$sum = mysqli_real_escape_string($dbc, trim($sum));
$summ = ($sum * $t_5s);
?>
<?php
$prover = ($t_5 - $sum);
if ($prover < '0') {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php
$prover = ($t_5 - $sum);
if ($prover > $t_5) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if (empty($sum)) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($sum < '1' or $t_5 < $sum) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php }?>
<?php
if ($trofi == '6') {?>
<?php
$sum = $_POST['sum6'];
$sum = mysqli_real_escape_string($dbc, trim($sum));
$summ = ($sum * $t_6s);
?>
<?php
$prover = ($t_6 - $sum);
if ($prover < '0') {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php
$prover = ($t_6 - $sum);
if ($prover > $_t6) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if (empty($sum)) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($sum < '1' or $t_6 < $sum) {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php }?>
<?php if ($trofi == '1') {?>
<?php
$query = "update users set habar=habar+'$summ', t_1=t_1-'$sum' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<?php if ($trofi == '2') {?>
<?php
$query = "update users set habar=habar+'$summ', t_2=t_2-'$sum' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<?php if ($trofi == '3') {?>
<?php
$query = "update users set habar=habar+'$summ', t_3=t_3-'$sum' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<?php if ($trofi == '4') {?>
<?php
$query = "update users set habar=habar+'$summ', t_4=t_4-'$sum' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<?php if ($trofi == '5') {?>
<?php
$query = "update users set habar=habar+'$summ', t_5=t_5-'$sum' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<?php if ($trofi == '6') {?>
<?php
$query = "update users set habar=habar+'$summ', t_6=t_6-'$sum' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<div id="main">
<p class="bonus"><b>Держи <?php echo "$summ";?> хабара, заслужил.</b></p><br />
  </div>
<div class="stats">
<p><a class="white" href="skadovsk.php">- До встречи</a></p>
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