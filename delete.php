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
$id = $_GET['id'];
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$clan1 = $row_us['clan'];
$clan_rang = $row_us['clan_rang'];
?>
<?php
if ($clan_rang > '7') {
$query = "delete from subforums where clan='$clan1' and id_subf='$id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
?>
<script type="text/javascript">
  document.location.href = "forum.php?type=company&company=<?php echo "$clan1";?>";
</script>