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
$l = $_GET['l'];
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$loc = $row_us['loc'];
$query_num = "Select id from users where loc = '$loc' and gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
$total = mysqli_num_rows($result_num); 
?>
<?php if ($total < '1') {?>
  <script type="text/javascript">
  document.location.href = "zonas.php";
  </script>
  <?php
  exit();
}
?>
<script type="text/javascript">
  document.location.href = "zonas.php";
</script>
</body>
</html>