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
$h=getenv("HTTP_REFERER");
$user_id = $_SESSION['id'];
$post_id = $_GET['post_id'];
$post_id = mysqli_real_escape_string($dbc, trim($post_id));
$query_us = "Select money, loto_time, user from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$user = $row_us['user'];
$money = $row_us['money'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$loto_time = $row_us['loto_time'];
$loto_time = strtotime("$loto_time");
$time = ($loto_time - $now);
?>
<?php if ($user == '1') {?>
  <script type="text/javascript">
  document.location.href = "<?php echo "$h";?>";
  </script>
<?php
exit();
}
?>
<?php
$query = "delete from chat where chat_id='$post_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<script type="text/javascript">
  document.location.href = "<?php echo "$h";?>";
</script>
</body>
</html>