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
$vrag_id = $_GET['id'];
$tip = $_GET['tip'];
$cl = $_GET['cl'];
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$clan1 = $row_us['clan'];//пистолет
$hp_us = $row_us['hp'];
$clan_r = $row_us['clan_rang'];
$nick1 = $row_us['nick'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$query_us1 = "Select * from users where  id = '$vrag_id'  limit 1";
$result_us1 = mysqli_query($dbc, $query_us1) or die ('Ошибка передачи запроса к БД');
$row_us1 = mysqli_fetch_array($result_us1);
$clan2 = $row_us1['clan'];//пистолет
$hp_v = $row_us1['hp'];
$nick2 = $row_us1['nick'];
$query_cl = "Select * from clans where  clan_id = '$clan1'  limit 1";
$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
$row_cl = mysqli_fetch_array($result_cl);
$war1 = $row_cl['war'];
$war_id = $row_cl['war_id'];
$time_psi = $row_cl['time_psi'];
$time_psi = strtotime("$time_psi");
$clan_money = $row_cl['clan_money'];
$query_cl1 = "Select * from clans where  clan_id = '$clan2'  limit 1";
$result_cl1 = mysqli_query($dbc, $query_cl1) or die ('Ошибка передачи запроса к БД');
$row_cl1 = mysqli_fetch_array($result_cl1);
$war2 = $row_cl1['war'];
$time_psi1 = ($time_psi + '1800');
?>
<?php if ($clan_r < '8') {?>
  <script type="text/javascript">
  document.location.href = "bitva.php";
  </script>
  <?php
  exit();
}
?>
<?php if ($clan_money < '1000') {?>
  <script type="text/javascript">
  document.location.href = "bitva.php?err=2";
  </script>
  <?php
  exit();
}
?>
<?php if ($time_psi1 > $now) {?>
  <script type="text/javascript">
  document.location.href = "bitva.php?err=1";
  </script>
  <?php
  exit();
}
?>
<?php if ($hp_v == '0') {?>
  <script type="text/javascript">
  document.location.href = "bitva.php";
  </script>
  <?php
  exit();
}
?>
<?php if ($war1 != '1' or $war2 != '1') {?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
  <?php
  exit();
}
?>
<?php 
if ($tip == '1' and $cl == '1') {?>
<?php
$query = "update users set hp=hp-'$hp_v' where id = '$vrag_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_s = "update clans set time_psi=NOW(), clan_money=clan_money-'1000' where clan_id = '$clan1' limit 1";
$result_s = mysqli_query($dbc, $query_s) or die ('Ошибка передачи запроса к БД');
$query_ss = "update bitva_o set clan2_y=clan2_y+'$hp_v' where clan2 = '$clan1' limit 1";
$result_ss = mysqli_query($dbc, $query_ss) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($tip == '1' and $cl == '2') {?>
<?php
$query = "update users set hp=hp-'$hp_v' where id = '$vrag_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_s = "update clans set time_psi=NOW(), clan_money=clan_money-'1000' where clan_id = '$clan1' limit 1";
$result_s = mysqli_query($dbc, $query_s) or die ('Ошибка передачи запроса к БД');
$query_ss = "update bitva_o set clan1_y=clan1_y+'$hp_v' where clan1 = '$clan1' limit 1";
$result_ss = mysqli_query($dbc, $query_ss) or die ('Ошибка передачи запроса к БД');
?>
<?php }
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '$clan1', 'Сталкер $nick1 использовал пси-удар против сталкера $nick2. Урон пси-удара: $hp_v', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '$war_id', 'Сталкер $nick1 использовал пси-удар против сталкера $nick2. Урон пси-удара: $hp_v', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "update users set clan_mes=clan_mes+'1' where clan = '$clan1' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "update users set clan_mes=clan_mes+'1' where clan = '$war_id' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>

<script type="text/javascript">
  document.location.href = "bitva.php?yron=<?php echo "$hp_v";?>";
</script>
</body>
</html>