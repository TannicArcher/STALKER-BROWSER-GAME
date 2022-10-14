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
$tip = $_GET['tip'];
$type = $_GET['type'];
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$user1 = $row_us['user'];
$query_us1 = "Select * from users where  id = '$id'  limit 1";
$result_us1 = mysqli_query($dbc, $query_us1) or die ('Ошибка передачи запроса к БД');
$row_us1 = mysqli_fetch_array($result_us1);
$user2 = $row_us1['user'];
?>
<?php 
if ($type == '1') {?>
<?php if ($user1 == '1' or $user2 != '1') {?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
<?php
exit();
}
?>
<?php
if ($tip == 'on') {
$query1 = "update users set p_ban='1' where id = '$id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'off') {
$query1 = "update users set p_ban='0' where id = '$id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
}
?>
<?php }
if ($type == '2') {?>
<?php if ($user1 == '1' or $user2 != '1') {?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
<?php
exit();
}
?>
<?php
if ($tip == 'on') {
$query1 = "update users set c_ban='1' where id = '$id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'off') {
$query1 = "update users set c_ban='0' where id = '$id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
}
?>
<?php }
?>
<script type="text/javascript">
  document.location.href = "user.php?id=<?php echo "$id";?>";
</script>
</body>
</html>