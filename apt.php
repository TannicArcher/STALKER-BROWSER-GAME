<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$h=getenv("HTTP_REFERER");
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
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД1');
$row_us = mysqli_fetch_array($result_us);
$clan = $row_us['clan'];
if ($clan != '0') {
$query_clan = "Select * from clans where  clan_id = '$clan'  limit 1";
$result_clan = mysqli_query($dbc, $query_clan) or die ('Ошибка передачи запроса к БД2');
$row_clan = mysqli_fetch_array($result_clan);
$mentor = $row_clan['mentor'];
$mentor = ($mentor + '100');
}
$art_apt = $row_us['art_apt'];
$apt = $row_us['aptechki'];
$max_hp = $row_us['max_hp'];
if ($clan != '0') {
$max_hp = ($max_hp / '100');
$max_hp = ($max_hp * $mentor);
}
$location = $row_us['location'];
$loc = $row_us['loc'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$time_apt = $row_us['time_apt'];
$time_apt = strtotime("$time_apt");
$time_apte = ($time_apt + '30');
$time_aptechka = ($time_apte - $now);
?>
<?php
if ($location == 'arrena') {?>
<script type="text/javascript">
  document.location.href = "arena2.php";
</script>
<?php
exit();
}
?>
<?php if ($apt == '0') {?>
  <script type="text/javascript">
  document.location.href = "tremor.php?sl=0";
  </script>
  <?php
  exit();
}
?>
<?php if ($time_aptechka > '0') {?>
  <script type="text/javascript">
  document.location.href = "<?php echo "$h";?>";
  </script>
  <?php
  exit();
}
?>
<?php if ($art_apt > '1000000000000000' and $loc == 'hutor') {?>
  <script type="text/javascript">
  document.location.href = "<?php echo "$h";?>";
  </script>
  <?php
  exit();
}
?>
<?php
$query = "update users set hp='$max_hp', aptechki=aptechki-'1', time_apt=NOW(), art_apt='1' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<script type="text/javascript">
  document.location.href = "<?php echo "$h";?>";
</script>
</body>
</html>