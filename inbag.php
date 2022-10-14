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
$query = "Select * from users where id='$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$clan = $row['clan'];
$querywar = "Select * from clans where clan_id='$clan' limit 1";
$resultwar = mysqli_query($dbc, $querywar) or die ('Ошибка передачи запроса к БД');
$rowwar = mysqli_fetch_array($resultwar);
$war = $rowwar['war'];
$thing_id = $_GET['thing'];
$thing_id = mysqli_real_escape_string($dbc, trim($thing_id));	
$query_c = "Select user_id from things where place=0 and user_id = '$user_id' limit 20";
$result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД1');
$count = mysqli_num_rows($result_c);
if ($count==20) {
?>
<script type="text/javascript">
document.location.href="bag.php?err=3";
</script>
<?php
exit();
}
$query = "Select user_id from things where thing_id='$thing_id' and place=1 and user_id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД2');
$total = mysqli_num_rows($result);
if (!empty($total)) {
  $query = "Update things set place = '0' where user_id = '$user_id' and thing_id = '$thing_id' limit 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД3');
}
$query = "Select type from things where thing_id='$thing_id' and place=2 and user_id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД4');
$total = mysqli_num_rows($result);
if (!empty($total)) {
  $user = mysqli_fetch_array($result);
  $type = $user['type'];
  if ($type == 1) {
    $query = "Update users set max_hp = '150', bronya = '0', radiation='0' where id = '$user_id' limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД5');
  }
  if ($type == 2) {
    $query = "Update users set tochn_p = '0', yron_p = '0', sost_p = '0', speed_p = '0' where id = '$user_id' limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД6');
  }
  if ($type == 3) {
    $query = "Update users set tochn_w = '0', yron_w = '0', sost_w = '0', speed_w = '0' where id = '$user_id' limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД7');
  }
  if ($type == 4) {
    $query = "Update users set regen='6' where id = '$user_id' limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД5');
  }
  if ($type == 6) {
    $query = "Update users set regen='6' where id = '$user_id' limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД5');
  }
  $query = "Update things set place = '0' where user_id = '$user_id' and thing_id = '$thing_id' limit 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД8');
}
?>
<script type="text/javascript">
         document.location.href="<?php echo "$H" ?>";
         </script>
<?php
mysqli_close($dbc);
?>