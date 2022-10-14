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
$set_id = $_GET['set_id'];
$set_id = mysqli_real_escape_string($dbc, trim($set_id));	
$user_id = $_SESSION['id'];
///////Пустое ли ид приглашённого
if (empty($set_id))  {
  ?>
  <script type="text/javascript">
  document.location.href = "profile.php?id=<?php echo "$set_id";?>";
  </script>
  <?php
  exit();
}
////////////////////////////////

////////Данные приглашаемого
$query = "Select clan_rang, clan, gruppa, opit, nick from users where id = '$set_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$nick_ref = $row['nick'];
$clan_set = $row['clan'];
$gruppa_set = $row['gruppa'];
$opit_set = $row['opit'];
/////////////////////////////////

///////Данные приглашающего
$query = "Select clan_rang, nick, clan, gruppa from users where id = '$user_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$clan_rang_user = $row['clan_rang'];
$clan_user = $row['clan'];
$gruppa_user = $row['gruppa'];
$nick_user = $row['nick'];
/////////////////////////////////

///////Проверка на клан
if (empty($clan_user)) {
  ?>
  <script type="text/javascript">
  document.location.href = "profile.php?id=<?php echo "$set_id";?>";
  </script>
  <?php
  exit();
}
////////////////////////////////

///////Проверка на ранг
if ($clan_rang_user < 6) {
  ?>
  <script type="text/javascript">
  document.location.href = "profile.php?id=<?php echo "$set_id";?>";
  </script>
  <?php
  exit();
}
////////////////////////////////

//////Проверка на ЛВЛ >10
      $query_lvl = "Select lvl, opit from opit order by lvl desc";
	  $result_lvl = mysqli_query($dbc, $query_lvl) or die ('Ошибка передачи запроса к БД');
	  $row_lvl = mysqli_fetch_array($result_lvl);
	  $big_next_lvl = $row_lvl['opit'];
	  $lvl=$row_lvl['lvl'];
	  while (($opit_set/100)< $row_lvl['opit']) {
	  $next_lvl = $row_lvl['opit'];
	  $lvl=($lvl-1);
	  $row_lvl = mysqli_fetch_array($result_lvl);
	  }
if ($lvl < 5) {
  ?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
  <?php
  exit();
}
//////////////////////////////////

//////В одной ли группировке
if ($gruppa_set <> $gruppa_user) {
?>
  <script type="text/javascript">
  document.location.href = "profile.php?id=<?php echo "$set_id";?>";
  </script>
  <?php
  exit();
}
/////////////////////////////////

/// название клана
$query = "select name, stalkers, war from clans where clan_id = '$clan_user'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$name_clan = $row['name'];
$stalkers = $row['stalkers'];
$war = $row['war'];
$query_num2 = "Select id from users where clan='$clan_user' " ;
$result_num2 = mysqli_query($dbc, $query_num2) or die ('Ошибка передачи запроса к БД');
$sostav = mysqli_num_rows($result_num2); 
////////////////////////////////////
?>
<?php if ($sostav == $stalkers or $sostav > '49' or $war == '1' or $clan_set != '0') {?>
  <script type="text/javascript">
  document.location.href = "company.php?company_id=<?php echo "$clan_user";?>";
  </script>
  <?php
  exit();
}
?>
<?php

$query = "select id from in_clan where user_id = '$set_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$count = mysqli_num_rows($result);

if ($count <> 0) {
$query = "update in_clan set user_id = '$set_id', user_id_in = '$nick_user', clan_name='$name_clan', clan_id='$clan_user', id_in = '$user_id'  where user_id = '$set_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '$clan_user', 'Сталкер $nick_user выслал приглашение сталкеру $nick_ref', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "update users set clan_mes=clan_mes+'1' where clan = '$clan_user'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
else {
///ВСЁ НОРМАЛЬНО, ВЫСЫЛАЕМ ПРИГЛАШЕНИЕ.
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '$clan_user', 'Сталкер $nick_user выслал приглашение сталкеру $nick_ref', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "insert into in_clan (`user_id`, `user_id_in`, `clan_name`,  `clan_id`, `id_in`) values ('$set_id','$nick_user', '$name_clan', '$clan_user', '$user_id')";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "update users set clan_mes=clan_mes+'1' where clan = '$clan_user'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
////////////////////////////////
?>
  <script type="text/javascript">
  document.location.href = "profile.php?id=<?php echo "$set_id";?>";
  </script>
<?php

mysqli_close($dbc);

?>