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
$set_id = $_GET['id'];
$user_id = $_SESSION['id'];
$set_id = mysqli_real_escape_string($dbc, trim($set_id));	
$rang_inf = $_GET['inf'];
///Если не правильная инф в упро ранга
if ($rang_inf <> 'up' and $rang_inf <> 'down' and $rang_inf <> 'out') {
?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
	exit();
}

///////Пустое ли ид над кем управляют
if (empty($set_id))  {
  ?>
  <script type="text/javascript">
  document.location.href = "profile.php?id=<?php echo "$user_id";?>";
  </script>
  <?php
  exit();
}
////////////////////////////////

///////Данные приглашающего
$query = "Select * from users where id = '$user_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$nick_user = $row['nick'];
$clan_rang_user = $row['clan_rang'];
$clan_user = $row['clan'];
/////////////////////////////////

///////Проверка на клан
if (empty($clan_user)) {
  ?>
  <script type="text/javascript">
  document.location.href = "profile.php?id=<?php echo "$user_id";?>";
  </script>
  <?php
  exit();
}
////////////////////////////////

///////Проверка на ранг
if ($clan_rang_user < 6) {
  if ($clan_user == 0) {
  ?>
  <script type="text/javascript">
  document.location.href = "profile.php?id=<?php echo "$user_id";?>";
  </script>
  <?php
  exit();
  }
  else {
  ?>
  <script type="text/javascript">
  document.location.href = "company.php?company_id=<?php echo "$clan_id";?>";
  </script>
  <?php
  exit();
  }
}
////////////////////////////////

////////Данные приглашаемого
$query = "Select * from users where id = '$set_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$nick_set = $row['nick'];
$clan_set = $row['clan'];
$clan_rang_set = $row['clan_rang'];
/////////////////////////////////


//////В одном ли они клане
if ($clan_set <> $clan_user) {
if ($clan_user == 0) {
  ?>
  <script type="text/javascript">
  document.location.href = "profile.php?id=<?php echo "$user_id";?>";
  </script>
  <?php
  exit();
  }
  else {
  ?>
  <script type="text/javascript">
  document.location.href = "company.php?company_id=<?php echo "$clan_id";?>";
  </script>
  <?php
  exit();
  }
}
//////////////////////////////////

//////Если ранг У типа больше чем у того, кто хочет исправить
if ($clan_rang_set>=$clan_rang_user) {
  if ($clan_user == 0) {
  ?>
  <script type="text/javascript">
  document.location.href = "profile.php?id=<?php echo "$user_id";?>";
  </script>
  <?php
  exit();
  }
  else {
  ?>
  <script type="text/javascript">
  document.location.href = "company.php?company_id=<?php echo "$clan_id";?>";
  </script>
  <?php
  exit();
  }
}
/////////////////////////////////


/////Если нужно повысить
////////////////////////////////////////////////
if ($rang_inf == up) { 
  $clan_rang_set = ($clan_rang_set + 1);
  if ($clan_rang_set == $clan_rang_user) {
   ?>
  <script type="text/javascript">
  document.location.href = "company.php?rule=1&company_id=<?php echo "$clan_user";?>";
  </script>
  <?php
  exit();
  }
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '$clan_user', 'Сталкер $nick_set повышен по званию сталкером $nick_user.', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "update users set clan_mes=clan_mes+'1' where clan = '$clan_user' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
if ($clan_rang_set == '9') {
$zamm = "Select * from users where clan_rang = '9' and clan = '$clan_user'";
$lah = mysqli_query($dbc, $zamm) or die ('Ошибка передачи запроса к БД');
$go =  mysqli_num_rows($lah);
$go1 = mysqli_fetch_array($lah);
$zames = $go1['id'];
if ($go == '0') {
  $query = "update users set clan_rang = '$clan_rang_set'  where id = '$set_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
if ($go == '1') {
  $query = "update users set clan_rang = '9'  where id = '$set_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $query = "update users set clan_rang = '8'  where id = '$zames'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
} else {
  $query = "update users set clan_rang = '$clan_rang_set'  where id = '$set_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
}
////////////////////////////////////////////////
////////////////////////////////////////////////

/////Если нужно понизить
////////////////////////////////////////////////
if ($rang_inf == down) {
  if ($clan_rang_set == 1) {
  ?>
  <script type="text/javascript">
  document.location.href = "company.php?rule=1&company_id=<?php echo "$clan_user";?>";
  </script>
  <?php
  exit();
  }
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '$clan_user', 'Сталкер $nick_set понижен по званию сталкером $nick_user.', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "update users set clan_mes=clan_mes+'1' where clan = '$clan_user' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $clan_rang_set = ($clan_rang_set - 1);
  $query = "update users set clan_rang = '$clan_rang_set'  where id = '$set_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
////////////////////////////////////////////////
////////////////////////////////////////////////

/////Если нужно исключить
////////////////////////////////////////////////
if ($rang_inf == out) {
  $query = "select people, war from clans where clan_id='$clan_user'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $row=mysqli_fetch_array($result);
  $people = $row['people'];
$war = $row['war'];
  $people = ($people - 1);
if ($war != '1') {
  $query = "update clans set people = '$people' where clan_id = '$clan_user'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $query = "update users set clan = 0, clan_rang = 0, ko=0, mentor_time = NOW() - (60*60*3), c_hab=0, c_mon=0 where id = '$set_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $query = "DELETE FROM  in_clan WHERE id_in = '$set_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '$clan_user', 'Сталкер $nick_set исключен из отряда сталкером $nick_user.', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "update users set clan_mes=clan_mes+'1' where clan = '$clan_user' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}}
////////////////////////////////////////////////
////////////////////////////////////////////////
 ?>
  <script type="text/javascript">
  document.location.href = "company.php?rule=1&company_id=<?php echo "$clan_user";?>";
  </script>
  <?php


mysqli_close($dbc);

?>