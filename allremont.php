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
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$habar = $row_us['habar'];
$query_th1 = "Select * from things where  user_id='$user_id' and type='1' and place='2'  limit 1";
$result_th1 = mysqli_query($dbc, $query_th1) or die ('Ошибка передачи запроса к БД');
$row_th1 = mysqli_fetch_array($result_th1);
$thing_id1 = $row_th1['thing_id'];
$query_th2 = "Select * from things where  user_id='$user_id' and type='2' and place='2'  limit 1";
$result_th2 = mysqli_query($dbc, $query_th2) or die ('Ошибка передачи запроса к БД');
$row_th2 = mysqli_fetch_array($result_th2);
$thing_id2 = $row_th2['thing_id'];
$query_th3 = "Select * from things where  user_id='$user_id' and type='3' and place='2'  limit 1";
$result_th3 = mysqli_query($dbc, $query_th3) or die ('Ошибка передачи запроса к БД');
$row_th3 = mysqli_fetch_array($result_th3);
$thing_id3 = $row_th3['thing_id'];
?>
<?php if ($habar < '1000') {?>
  <script type="text/javascript">
  document.location.href = "clothes.php?id=<?php echo "$user_id";?>";
  </script>
  <?php
  exit();
}
?>
<?php
$query1 = "update things set sost='8' where thing_id='$thing_id1' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$query2 = "update things set sost='8' where thing_id='$thing_id2' limit 1";
$result2 = mysqli_query($dbc, $query2) or die ('Ошибка передачи запроса к БД');
$query3 = "update things set sost='8' where thing_id='$thing_id3' limit 1";
$result3 = mysqli_query($dbc, $query3) or die ('Ошибка передачи запроса к БД');
$query4 = "update users set habar=habar-'1000', sost_cl='8', sost_p='8', sost_w='8' where id='$user_id' limit 1";
$result4 = mysqli_query($dbc, $query4) or die ('Ошибка передачи запроса к БД');

?>
<script type="text/javascript">
  document.location.href = "clothes.php?id=<?php echo "$user_id";?>";
</script>
</body>
</html>