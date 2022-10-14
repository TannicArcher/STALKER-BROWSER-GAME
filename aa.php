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
$query_us1 = "Select * from users where  id = '$id'  limit 1";
$result_us1 = mysqli_query($dbc, $query_us1) or die ('Ошибка передачи запроса к БД');
$row_us1 = mysqli_fetch_array($result_us1);
$clan2 = $row_us1['clan'];
?>


<?php
$query = "update users set clan='0' where clan = '557'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>



<script type="text/javascript">
  document.location.href = "company.php?company_id=<?php echo "$clan1";?>";
</script>
</body>
</html>