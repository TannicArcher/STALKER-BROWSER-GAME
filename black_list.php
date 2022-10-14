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
$black_id = $_GET['id'];
?>

<?php
$query_ = "Select * from black_list where user_id='$user_id' and black_id='$black_id' limit 1";
$result_ = mysqli_query($dbc, $query_) or die ('Ошибка передачи запроса к БД5');
$row_ = mysqli_fetch_array($result_);
if ($row_ == 0) {
$query = "insert into black_list (`user_id`, `black_id`, `time`) values ('$user_id', '$black_id', NOW() )";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД6'); 
}
if ($row_ != 0) {
$query = "delete from black_list where user_id='$user_id' and black_id='$black_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
?>
<script type="text/javascript">
  document.location.href = "mail4.php?id=<?php echo "$black_id";?>";
</script>
</body>
</html>