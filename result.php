<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "../reg.php";
  </script>
  <?php
  exit();
}
require_once('conf/head.php');
require_once('conf/top.php');
$result = $_GET['type'];
if (empty($_result)) {
$result = 'true';
}
$PI = $_GET['paymentId'];
$pay_user = $_GET['account'];
?>
<div class="ms-fon">
<?php if ($result == 'true') {?>


<?php
$query_pay = "Select * from `unitpay_payments` where `unitpayId`='$PI' and `account`='$pay_user' and `status`='1' limit 1";
$result_pay= mysqli_query($dbc, $query_pay) or die ('Ошибка передачи запроса к БД');
$row_pay = mysqli_fetch_array($result_pay);
$sum_pay = $row_pay['itemsCount'];
$time_pay = $row_pay['dateComplete'];

$query = "Select * from users where id='$pay_user' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$p_data = $row['premium_time'];
$vip = $row['premium'];
if ($vip == '1' and $p_data < $time_pay and $p_data <> '0000-00-00 00:00:00')
{
$query_vip = "insert into pay_vip (`id_user`, `sum`, `data`) values ('$pay_user', '$sum_pay', NOW())";
$result_vip = mysqli_query($dbc, $query_vip) or die ('Ошибка передачи запроса к БД');
$query = "delete from unitpay_payments where unitpayId='$PI' and account='$pay_user' and status='1' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$premium_bonus = '1337';
}
?>


<div class="stats">
  <center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Спасибо за покупку!</p></center>
</div>
<p class="lal2">Покупка успешно выполнена! RUB были успешно зачислены на ваш баланс.</p>
<?php if ($premium_bonus == '1337') {?>
<center><p class="lal2"  style="color: gold;"><small>Так же был зачислен бонус от VIP-режима.</small></p></center>
<?php }?>
<?php } else {?>
<div class="stats">
  <center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Ошибка :(</p></center>
</div>
<p class="lal2" style="color: red;">Извините, но произошла ошибка. Попробуйте повторить покупку.</p>
<?php }?>
<br/>
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>