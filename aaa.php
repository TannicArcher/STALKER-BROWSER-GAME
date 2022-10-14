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
$query_us = "Select * from users where  id = '$user_id' limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД1');
$row_us = mysqli_fetch_array($result_us);
$clan = $row_us['clan'];
$clan_rang = $row_us['clan_rang'];
$query_cl = "Select * from clans where clan_id = '$clan' limit 1";
$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД2');
$row_cl = mysqli_fetch_array($result_cl);
$clan_habar = $row_cl['clan_habar'];
$clan_opit = $row_cl['clan_opit'];
$stalkers = $row_cl['stalkers'];
if ($stalkers == '3') {
$cash = '30000';
}
if ($stalkers == '4') {
$cash = '60000';
}
if ($stalkers == '5') {
$cash = '100000';
}
if ($stalkers == '6') {
$cash = '200000';
}
if ($stalkers == '7') {
$cash = '300000';
}
if ($stalkers == '8') {
$cash = '500000';
}
if ($stalkers == '9') {
$cash = '1000000';
}
if ($stalkers > '9' and $stalkers < '31') {
$cash = ($stalkers * 300000);
}
if ($stalkers > '30' and $stalkers < '36') {
$cash = ($stalkers * 500000);
}
if ($stalkers > '35') {
$cash = ($stalkers * 550000);
}
$bank = ($cash / '100');
?>
<?php
$query_lvl = "Select lvl, opit from clan_opit order by lvl desc";
$result_lvl = mysqli_query($dbc, $query_lvl) or die ('Ошибка передачи запроса к БД3');
$row_lvl = mysqli_fetch_array($result_lvl);
$big_next_lvl = $row_lvl['opit'];
$lvl=$row_lvl['lvl'];
while (($clan_opit/1000)< $row_lvl['opit']) {
$next_lvl = $row_lvl['opit'];
$lvl=($lvl-1);
$row_lvl = mysqli_fetch_array($result_lvl);
}
$pff = ('100' - $lvl);
$cash = ($bank * $pff);
?>
<?php if ($clan_rang < '8' or $stalkers > '49') {?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
  <?php
  exit();
}
?>
<?php if ($cash > $clan_habar) {?>
  <script type="text/javascript">
  document.location.href = "clan.php?err=2";
  </script>
  <?php
  exit();
}
?>
<?php
$query = "update clans set clan_habar=clan_habar-'$cash', stalkers=stalkers+'1' where clan_id = '$clan' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД4');
?>
<script type="text/javascript">
  document.location.href = "clan.php";
</script>
</body>
</html>