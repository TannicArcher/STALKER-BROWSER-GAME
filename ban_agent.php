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
$user_id = $_SESSION['id'];
$id = $_GET['id'];
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
$query_pb = "Select * from users where id = '$id' ";
$result_pb = mysqli_query($dbc, $query_pb) or die ('Ошибка передачи запроса к БД');
$row_pb = mysqli_fetch_array($result_pb);
$agent = $row_pb['user_agent'];
$nick = $row_pb['nick'];
?>

<?php
if ($user_id == '10033') {
$query = "insert into ban_agent (`agent`, `comment`) values ('$agent', '$nick')";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
}
?>

  <script type="text/javascript">
  document.location.href = "user.php?id=<?php echo "$id";?>";
  </script>
