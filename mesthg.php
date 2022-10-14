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
$h = $_SERVER['HTTP_REFERER'];
$user_id = $_SESSION['id'];
$id = $_GET['id'];
$id3 = $_GET['id3'];
$tip = $_GET['tip'];
$query0 = "Select * from message where message_id='$id3' limit 1";
$result0 = mysqli_query($dbc, $query0) or die ('Ошибка передачи запроса к БД1');
$row0 = mysqli_fetch_array($result0);
$thing0 = $row0['thing'];
$in = $row0['in'];
$query = "Select * from things where thing_id='$id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД1');
$row = mysqli_fetch_array($result);
$place = $row['place'];
$query1 = "Select thing_id, type, inf_id, stat1, stat2, speed, sost, privat, need_lvl from things where user_id='$user_id' and place=0 limit 20";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД2');
$total = mysqli_num_rows($result1);
?>
<?php 
if ($tip == '2') {?>
<?php if ($place != '3' or $total > '20' or $in == '1') {?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
<?php
exit();
}
?>
<?php
$query3 = "update things set user_id='$user_id', place='0' where thing_id = '$id' limit 1";
$result3 = mysqli_query($dbc, $query3) or die ('Ошибка передачи запроса к БД4');
$query = "update message set reading='1', `in`='1' where message_id = '$id3' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД5');
?>
<?php }
if ($tip == '3') {?>
<?php if ($in == '1') {?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
<?php
exit();
}
?>
<?php
$query = "update message set reading='1', `in`='1' where message_id = '$id3' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД6.1');
$query = "update users set money=money+'$thing0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД6.2');
?>
<?php }
if ($tip == '4') {?>
<?php if ($in == '1') {?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
<?php
exit();
}
?>
<?php
$query = "update message set reading='1', `in`='1' where message_id = '$id3' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД7.1');
$query = "update users set habar=habar+'$thing0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД7.2');
?>
<?php }
if ($tip == '5') {?>
<?php if ($in == '1') {?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
<?php
exit();
}
?>
<?php
$query = "update message set reading='1', `in`='1' where message_id = '$id3' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД8.1');
$query = "update users set aptechki=aptechki+'$thing0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД8.2');
?>
<?php }
?>
<script type="text/javascript">
  document.location.href = "<?php echo "$h";?>";
</script>
</body>
</html>