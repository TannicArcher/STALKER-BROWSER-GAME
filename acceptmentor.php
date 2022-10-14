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
$user_id = $_SESSION['id'];
$mentor_type = $_GET['mentor'];
if ($mentor_type <> 1 and $mentor_type <> 2) {
  ?>
  <script type="text/javascript">
  document.location.href = "profile.php?id=<?php echo "$user_id";?>";
  </script>
  <?php
  exit();
}
$query = "Select habar, money, clan from users where id = '$user_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$habar = $row['habar'];
$clan_id = $row['clan'];
$money = $row['money'];
if (empty($clan_id)) {
  ?>
  <script type="text/javascript">
  document.location.href = "profile.php?id=<?php echo "$user_id";?>";
  </script>
  <?php
  exit();
}
$query = "Select mentor from clans where clan_id = '$clan_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$mentor = $row['mentor'];
////////////////////////////////////////////
if  ($mentor_type == 1) {
$need_habar = ($mentor * 100);
if ($need_habar > $habar) {
 ?>
  <script type="text/javascript">
  document.location.href = "mentor.php?company_id=<?php echo "$clan_id";?>&err=1";
  </script>
  <?php
  exit();
}
$habar = ($habar - $need_habar);
$query_user = "update users set habar = '$habar', mentor_time = NOW(), mentor_type = 1 where id = '$user_id'";
$result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
}
else {
$need_money = ($mentor * 20);
if ($need_money > $money) {
 ?>
  <script type="text/javascript">
  document.location.href = "mentor.php?company_id=<?php echo "$clan_id";?>&err=1";
  </script>
  <?php
  exit();
}
$money = ($money - $need_money);
$query_user = "update users set money = '$money', mentor_time = NOW(), mentor_type = 2 where id = '$user_id'";
$result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
}
///Назад
?>
  <script type="text/javascript">
  document.location.href = "profile.php?id=<?php echo "$user_id";?>";
  </script>
<?php

   mysqli_close($dbc);

?>