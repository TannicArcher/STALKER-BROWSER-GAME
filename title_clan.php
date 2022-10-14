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
$c_id = $_GET['c_id'];
$c_id = mysqli_real_escape_string($dbc, trim($c_id));
$c_name = $_POST['c_name'];
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$habar = $row_us['habar'];
$money = $row_us['money'];
$clan = $row_us['clan'];
$c_id = $clan;
$id_u = $row_us['id'];
$c_rang = $row_us['clan_rang'];
$query_clan = "Select * from clans where  clan_id = '$c_id'  limit 1";
$result_clan = mysqli_query($dbc, $query_clan) or die ('Ошибка передачи запроса к БД');
$row_clan = mysqli_fetch_array($result_clan);
$clan_habar = $row_clan['clan_habar'];
$clan_money = $row_clan['clan_money'];
$query_clan1 = "Select * from clans where  name = '$c_name'";
$result_clan1 = mysqli_query($dbc, $query_clan1) or die ('Ошибка передачи запроса к БД');
$num_cn = mysqli_fetch_array($result_clan1);
?>
<?php
if ($clan != $c_id) {?>
<script type="text/javascript">
document.location.href = "csklad.php?c_id=<?php echo "$c_id";?>";
</script>
<?php
exit();
}
?>
<?php
if ($clan_money < 5000) {?>
<script type="text/javascript">
document.location.href = "csklad.php?c_id=<?php echo "$c_id";?>&err=1";
</script>
<?php
exit();
}
?>
<?php
if ($c_rang < 9) {?>
<script type="text/javascript">
document.location.href = "csklad.php?c_id=<?php echo "$c_id";?>&err=2";
</script>
<?php
exit();
}
?>
<?php
if (!empty($num_cn)) {?>
<script type="text/javascript">
document.location.href = "csklad.php?c_id=<?php echo "$c_id";?>&err=3";
</script>
<?php
exit();
}
?>
<?php
$long_name = iconv_strlen($c_name, 'UTF-8');
if ($long_name < '2' or $long_name > '16') {?>
<script type="text/javascript">
document.location.href = "csklad.php?c_id=<?php echo "$c_id";?>&err=4";
</script>
<?php
exit();
}
?>
<?php
$query = "update clans set clan_money=clan_money-'5000', name='$c_name' where clan_id = '$c_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<script type="text/javascript">
  document.location.href = "ccs.php?tip=2";
</script>
</body>
</html>