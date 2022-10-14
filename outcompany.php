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
$query = "Select clan, clan_rang, nick from users where id = '$user_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$nick = $row['nick'];
$clan = $row['clan'];
$clan_rang = $row['clan_rang'];
$query_num2 = "Select id from users where clan='$clan' " ;
$result_num2 = mysqli_query($dbc, $query_num2) or die ('Ошибка передачи запроса к БД');
$sostav = mysqli_num_rows($result_num2); 
///Если клана не существует
if ($clan == 0) {
?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
  <?php
}
else {
    $query = "select people, war from clans where clan_id = '$clan'";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
    $row=mysqli_fetch_array($result);
$war = $row['war'];
	$count_people = $row['people'];
    if ($war != 0) {
    ?>
     <script type="text/javascript">
     document.location.href = "company.php?company_id=<?php echo "$clan";?>&err=war";
     </script>
    <?php
	exit();
	}
  if ($clan_rang == 10){///Если лидер и пользователей больше 1 то ошибка.
    if ($sostav > 1) {
    ?>
     <script type="text/javascript">
     document.location.href = "company.php?company_id=<?php echo "$clan";?>&err=out";
     </script>
    <?php
	exit();
	}
  }
  $people = ($sostav - '1');
  $query = "update clans set people = '$people' where clan_id = '$clan'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $query = "update users set clan = 0, clan_rang = 0, ko=0, mentor_time = NOW() - (60*60*3), c_mon=0, c_hab=0, clan_mes='0' where id = '$user_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $query = "DELETE FROM  in_clan WHERE id_in = '$user_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
} 
if ($sostav == '1') {
  $query = "DELETE FROM  clans WHERE clan_id = '$clan'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
if ($sostav > '1') {
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('530', '0', '$clan', 'Сталкер $nick вышел из отряда', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "update users set clan_mes=clan_mes+'1' where clan = '$clan' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
if ($sostav == '1') {
  $query = "DELETE FROM  clan_mail WHERE clan_id = '$clan'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
///////////////////////////////

mysqli_close($dbc);
?>
<script type="text/javascript">
document.location.href = "profile.php?id=<?php echo "$user_id";?>";
</script>