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

$query = "Select habar, clan from users where id = '$user_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$habar = $row['habar'];
$clan_id = $row['clan'];
$query = "Select mentor, clan_opit from clans where clan_id = '$clan_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
////Проверка на превышение ЛВЛ клана
$clan_opit = $row['clan_opit'];
$mentor = $row['mentor'];
$next_mentor = ($mentor +1);
$query_lvl = "Select lvl, opit from clan_opit order by lvl desc";
	  $result_lvl = mysqli_query($dbc, $query_lvl) or die ('Ошибка передачи запроса к БД');
	  $row_lvl = mysqli_fetch_array($result_lvl);
	  $big_next_lvl = $row_lvl['opit'];
	  $lvl=$row_lvl['lvl'];
while (($clan_opit/1000)< $row_lvl['opit']) {
	  $next_lvl = $row_lvl['opit'];
	  $lvl=($lvl-1);
	  $row_lvl = mysqli_fetch_array($result_lvl);
	  }
if ($lvl < $next_mentor) {
  ?>
  <script type="text/javascript">
  document.location.href = "mentor.php?company_id=<?php echo "$clan_id";?>&err=2";
  </script>
  <?php
  exit();
}
  
//////////////////////////////////
$need_habar = ($next_mentor * 150000);
if ($need_habar > $habar) {
 ?>
  <script type="text/javascript">
  document.location.href = "mentor.php?company_id=<?php echo "$clan_id";?>&err=1";
  </script>
  <?php
  exit();
}
$habar = ($habar - $need_habar);
$mentor = ($mentor +1);
$query_user = "update users set habar = '$habar' where id = '$user_id'";
$result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
$query_clan = "update clans set mentor = '$mentor' where clan_id = '$clan_id'";
$result_clan = mysqli_query($dbc, $query_clan) or die ('Ошибка передачи запроса к БД');
///Назад
?>
  <script type="text/javascript">
  document.location.href = "mentor.php?company_id=<?php echo "$clan_id";?>&end=1";
  </script>
<?php
   mysqli_close($dbc);

?>