<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$h=getenv("HTTP_REFERER");
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

$polosa = $_GET['polosa'];
if (empty($polosa)) {
$polosa = 'off';
}
$ramka = $_GET['ramka'];
if (empty($ramka)) {
$ramka = 'off';
}
$mail_o = $_GET['mail_o'];
if (empty($mail_o)) {
$mail_o = 'off';
}
$profile = $_GET['profile'];
if (empty($profile)) {
$profile = 'off';
}
$ajax_mail = $_GET['ajax_mail'];
if (empty($ajax_mail)) {
$ajax_mail = 'off';
}
?>
<?php
if ($polosa == 'on') {
$query1 = "update users set polosa='1' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
} else {
$query1 = "update users set polosa='0' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
}
if ($ramka == 'on') {
$query1 = "update users set pg='0' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
} else {
$query1 = "update users set pg='1' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
}
if ($mail_o == 'on') {
$query1 = "update users set pokaz='0' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
} else {
$query1 = "update users set pokaz='1' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
}
if ($profile == 'on') {
$query1 = "update users set profile='1' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
} else {
$query1 = "update users set profile='2' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
}
if ($ajax_mail == 'on') {
$query1 = "update users set ajax_mail='0' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
} else {
$query1 = "update users set ajax_mail='1' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
}
?>
<script type="text/javascript">
  document.location.href = "<?php echo "$h";?>";
</script>
</body>
</html>