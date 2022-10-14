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

$acc = $_GET['acc'];
///////Пустой ли ответ
if (empty($acc))  {
  ?>
  <script type="text/javascript">
  document.location.href = "profile.php?id=<?php echo "$user_id";?>";
  </script>
  <?php
  exit();
}
///////////////////////////
$query_user = "select nick, gruppa from users where id = '$user_id'";
$result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
$row_user = mysqli_fetch_array($result_user);
$gruppa_us = $row_user['gruppa'];
$nick = $row_user['nick'];
$query_inv = "select id, user_id_in, clan_name, clan_id, id_in from in_clan where user_id = '$user_id'";
$result_inv = mysqli_query($dbc, $query_inv) or die ('Ошибка передачи запроса к БД');
$row_inv = mysqli_fetch_array($result_inv);
$user_id_in = $row_inv['user_id_in'];
$clan_name = $row_inv['clan_name'];
$clan_id = $row_inv['clan_id'];
$zapis_id = $row_inv['id'];
$id_in = $row_inv['id_in'];
$clan = $clan_id;
$count_inv = mysqli_num_rows($result_inv);
//////////////Если заявок нет
if (empty($count_inv)) {
  ?>
  <script type="text/javascript">
  document.location.href = "profile.php?id=<?php echo "$user_id";?>";
  </script>
  <?php
  exit();
}
/////////////////////////////

//////////////Существует ли клан
$query = "select * from clans where clan_id = '$clan_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$count_clan = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
$gruppa_clan = $row['gruppa'];
$people = $row['people'];
$stalkers = $row['stalkers'];
$war = $row['war'];
$query_num2 = "Select id from users where clan='$clan_id' " ;
$result_num2 = mysqli_query($dbc, $query_num2) or die ('Ошибка передачи запроса к БД');
$sostav = mysqli_num_rows($result_num2); 
$sostav = ($sostav + '1');
if ($sostav > $stalkers) {
$acc = '2';
}
if (empty($count_clan)) {
?>
  <script type="text/javascript">
  document.location.href = "profile.php?id=<?php echo "$user_id";?>";
  </script>
  <?php
  exit();
}
////////////////////////////////
if ($war == '1') {
$acc = '2';
}
if ($gruppa_us != $gruppa_clan) {
$acc = '2';
}
/////////////////////////Решение по клану.
if ($acc == 1) {//Если вступает
$people = ($people +1);
$query = "update clans set people = '$people' where clan_id = '$clan_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "update users set clan = '$clan_id', clan_rang = 1 where id = '$user_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "DELETE FROM in_clan WHERE user_id = '$user_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '$clan', 'Сталкер $nick вступил в отряд', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "update users set clan_mes=clan_mes+'1' where clan = '$clan' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
else {
$query = "DELETE FROM in_clan WHERE user_id = '$user_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
//////////////////////////////
?>
 <script type="text/javascript">
  document.location.href = "profile.php?id=<?php echo "$user_id";?>";
  </script>
  <?php
mysqli_close($dbc);

?>