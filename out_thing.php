<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((!isset($_SESSION['id'])) and (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "reg.php?err_login=1";
  </script>
  <?php
}
$H=getenv("HTTP_REFERER");
if (empty($H)) {
?>
<script type="text/javascript">
  document.location.href = "index.php";
</script>
<?php
exit();
}
$user_id = $_SESSION['id'];
$thing_id = $_GET['thing'];
$thing_id = htmlentities($thing_id, ENT_QUOTES);
$thing_id = mysqli_real_escape_string($dbc, trim($thing_id));	
$query_c = "Select sost from things where place<>2 and user_id = '$user_id' and thing_id = '$thing_id' limit 1";
$result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД1');
$count = mysqli_num_rows($result_c);
if ($count==0) {
  ?>
  <script type="text/javascript">
  document.location.href="<?php echo "$H" ?>";
  </script>
  <?php
  exit();
}
$row = mysqli_fetch_array($result_c);
$sost=$row['sost'];
if ($sost == 0) {$habar=0;}
if ($sost == 1) {$habar=30;}
if ($sost == 2) {$habar=60;}
if ($sost == 3) {$habar=90; }
if ($sost == 4) {$habar=120; }
if ($sost == 5) {$habar=150; }
if ($sost == 6) {$habar=180; }
if ($sost == 7) {$habar=210; }
if ($sost == 8) {$habar=240; }
$query = "delete from things where place<>2 and user_id = '$user_id' and thing_id = '$thing_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД8');
$query = "update users set habar=habar+'$habar' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД8');
?>
<script type="text/javascript">
         document.location.href="<?php echo "$H" ?>";
         </script>
<?php
mysqli_close($dbc);
?>