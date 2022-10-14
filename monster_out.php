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
$user_id = $_SESSION['id'];
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$clan1 = $row_us['clan'];
$clan_rang = $row_us['clan_rang'];
?>
<?php if ($clan_rang < '8') {?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
<?php
exit();
}
?>
<?php
$query1 = "update m_fight set start='0' where clan_id = '$clan1' and start = '1'";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<script type="text/javascript">
  document.location.href = "clan.php";
</script>
</body>
</html>