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
$tip = $_GET['tip'];
$id = $_POST['id'];
$nick = $_POST['nick'];
$query_us = "Select * from users where nick='$nick' limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$id_n = $row_us['id'];
?>
<?php 
if ($tip == '1' and $row_us != 0) {?>
<script type="text/javascript">
  document.location.href = "mail4.php?id=<?php echo "$id_n";?>";
</script>
<?php }
if ($tip == '1' and $row_us == 0) {?>
<script type="text/javascript">
  document.location.href = "mail2.php";
</script>
<?php }
if ($tip == '2') {?>
<script type="text/javascript">
  document.location.href = "mail4.php?id=<?php echo "$id";?>";
</script>
<?php }
?>
</body>
</html>