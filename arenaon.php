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
$id = $_GET['id'];
$not = $_GET['not'];
$id = mysqli_real_escape_string($dbc, trim($id));	
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$lvl = $row_us['lvl'];
$lvl1 = ($lvl + '1');
$lvl3 = ($lvl - '1');
$hp1 = $row_us['hp'];
$arena1 = $row_us['arena'];
$arena_time1 = $row_us['arena_time'];
$arena_time1 = strtotime("$arena_time1");
$h1 = $row_us['habar'];
$habar1 = ($h1 / '100');
$lal1 = rand(1,3);
$d1 = $row_us['dengi'];
$de1 = ($d1 / '100');
$den1 = ($de1 * '5');
$query_us1 = "Select * from users where  id = '$id'  limit 1";
$result_us1 = mysqli_query($dbc, $query_us1) or die ('Ошибка передачи запроса к БД');
$row_us1 = mysqli_fetch_array($result_us1);
$admin = $row_us1['admin'];
$hp2 = $row_us1['hp'];
$max_hp2 = $row_us1['max_hp'];
$blin = ($max_hp2 / '2');
$lvl2 = $row_us1['lvl'];
$id = $row_us1['id'];
$arena2 = $row_us1['arena1'];
$arena_time2 = $row_us1['arena_time1'];
$arena_time2 = strtotime("$arena_time2");
$h2 = $row_us1['habar'];
$habar2 = ($h2 / '100');
$lal2 = rand(1,3);
$d2 = $row_us1['dengi'];
$de2 = ($d2 / '100');
$den2 = ($de2 * '5');
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$tim1 = ($arena_time1 + '300');
$tim2 = ($arena_time2 + '1800');
$time1 = ($tim1 - $now);
$time2 = ($tim2 - $now);
?>
<?php
$dengi1 = '0';
$dengi2 = '0';
if ($lal1 == '1') {
$dengi1 = $den1;
}
if ($lal2 == '1') {
$dengi2 = $den2;
}
if ($habar1 < '1') {
$habar1 = '0';
}
if ($habar2 < '1') {
$habar2 = '0';
}
if ($dengi1 < '1') {
$dengi1 = '0';
}
if ($dengi2 < '1') {
$dengi2 = '0';
}
?>
<?php if ($not == '118') {?>
<?php
$query = "update users set arena='0', arena_time=NOW(), last=last+'1',habar=habar-'$habar1', dengi=dengi-'$dengi1' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "update users set arena1='0', arena_time=NOW(), win=win+'1',habar=habar+'$habar1', dengi=dengi+'$dengi1' where id = '$id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into arena_inf (`time`, `user_id`, `vrag_id`, `yron1`, `yron2`, `habar1`, `habar2`, `dengi1`, `dengi2`, `rat1`, `rat2`, `hp1`, `hp2`, `win`) values (NOW(), '$user_id', '$id', '0', '0', '$habar1', '$habar2', '$dengi1', '$dengi2', '0', '0', '$hp1', '$hp2', '$id')";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
?>
<script type="text/javascript">
  document.location.href = "arena.php";
</script>
<?php } else {?>
<?php if ($admin == '1') {?>
  <script type="text/javascript">
  document.location.href = "arena.php?err=10";
  </script>
<?php
exit();
}
?>
<?php if ($user_id == $id) {?>
  <script type="text/javascript">
  document.location.href = "arena.php?err=9";
  </script>
<?php
exit();
}
?>
<?php if ($hp1 == '0') {?>
  <script type="text/javascript">
  document.location.href = "arena.php?err=1";
  </script>
<?php
exit();
}
?>
<?php if ($lvl2 < $lvl3 or $lvl2 > $lvl1) {?>
  <script type="text/javascript">
  document.location.href = "arena.php?err=3";
  </script>
<?php
exit();
}
?>
<?php if ($time1 > '0') {?>
  <script type="text/javascript">
  document.location.href = "arena.php?err=4&time=<?php echo "$time1";?>";
  </script>
<?php
exit();
}
?>
<?php if ($time2 > '0') {?>
  <script type="text/javascript">
  document.location.href = "arena.php?err=5&time=<?php echo "$time2";?>";
  </script>
<?php
exit();
}
?>
<?php if ($arena1 == '1') {?>
  <script type="text/javascript">
  document.location.href = "arena.php?err=6";
  </script>
<?php
exit();
}
?>
<?php if ($arena2 == '1') {?>
  <script type="text/javascript">
  document.location.href = "arena.php?err=7";
  </script>
<?php
exit();
}
?>
<?php if ($id == '460' or $id == '3990') {?>
  <script type="text/javascript">
  document.location.href = "arena.php?err=7";
  </script>
<?php
exit();
}
?>
<?php
$query_add_ch = "insert into arena_log (`time`, `user_id`, `vrag_id`, `yron1`, `yron2`, `habar1`, `habar2`, `dengi1`, `dengi2`) values (NOW(), '$user_id', '$id', '0', '0', '$habar1', '$habar2', '$dengi1', '$dengi2')";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "update users set arena='1', arena_time=NOW() where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "update users set arena1='1', arena_time=NOW() where id = '$id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
if ($hp2 < $blin) {
$query = "update users set hp='$blin' where id = '$id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
?>
<script type="text/javascript">
  document.location.href = "arena2.php";
</script>
<?php }?>