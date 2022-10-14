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
?>
<?php
$user_id = $_SESSION['id'];
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$clan = $row_us['clan'];
$clan_rang = $row_us['clan_rang'];
$query_us1 = "Select * from clans where clan_id = '$clan'  limit 1";
$result_us1 = mysqli_query($dbc, $query_us1) or die ('Ошибка передачи запроса к БД');
$row_us1 = mysqli_fetch_array($result_us1);
$war_id = $row_us1['war_id'];
$minus_time = $row_us1['minus_time'];
$gauss = $row_us1['gauss'];
$gauss_at = $row_us1['gauss_at'];
$query_bit = "Select * from bitva_o where clan1='$clan' or clan2='$clan' limit 1";
$result_bit = mysqli_query($dbc, $query_bit) or die ('Ошибка передачи запроса к БД');
$row_bit = mysqli_fetch_array($result_bit);
$clan1 = $row_bit['clan1'];
$clan2 = $row_bit['clan2'];
if ($clan == $clan1) {
$gauss_time = $row_bit['gauss_time1'];
}
if ($clan == $clan2) {
$gauss_time = $row_bit['gauss_time2'];
}
$minn_time = ($minus_time * '60');
$minn_time = ('3600' - $minn_time);
$gt = strtotime("$gauss_time");
$gt = ($gt + $minn_time);
$now = (date("Y-m-d H:i:s"));
$now1 = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$gt = ($gt - $now);
?>
<?php if ($gauss_at == '1') {?>
  <script type="text/javascript">
  document.location.href = "gauss.php";
  </script>
<?php
exit();
}
?>
<?php if ($gt > '0') {?>
  <script type="text/javascript">
  document.location.href = "bitva.php";
  </script>
<?php
exit();
}
?>
<?php if ($clan_rang < '8') {?>
  <script type="text/javascript">
  document.location.href = "bitva.php";
  </script>
<?php
exit();
}
?>
<?php
$query1 = "update clans set gauss_at='1', gauss_time=NOW() where clan_id = '$clan' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '$war_id', 'Вражеский отряд отправился в прорыв.', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД10');
$query = "update users set clan_mes=clan_mes+'1' where clan = '$war_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
if ($clan == $clan1) {?>
<?php
$query2 = "update bitva_o set gauss_time1=NOW() where clan1 = '$clan' limit 1";
$result2 = mysqli_query($dbc, $query2) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<?php
if ($clan == $clan2) {?>
<?php
$query3 = "update bitva_o set gauss_time2=NOW() where clan2 = '$clan' limit 1";
$result3 = mysqli_query($dbc, $query3) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<script type="text/javascript">
  document.location.href = "gauss.php";
</script>
</body>
</html>