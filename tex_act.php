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
$say = $_POST['say'];
$flag = $_GET['flag'];
$id2 = $_GET['mes'];
$id1 = $user_id;
$type = $_GET['type'];
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД1');
$row_us = mysqli_fetch_array($result_us);
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$lvl = $row_us['lvl'];
$say = str_replace('<','&lt;', $say);
$say = str_replace('>','&gt;', $say);
$say = str_replace('"','&quot', $say);
$say = stripslashes("$say");
$say =  mysqli_real_escape_string($dbc, trim($say));
$text = $say;
$text = str_replace(' ', '', $text);
$long_text = iconv_strlen($text, 'UTF-8');
$query_ti = "Select * from texpod where time > NOW() - (500) and ot = '$user_id'";
$result_ti = mysqli_query($dbc, $query_ti) or die ('Ошибка передачи запроса к БД1');
$row_ti = mysqli_fetch_array($result_ti);
?>
<?php if ($flag == '1') {?>
<?php
$query = "update texpod set reading_in='1', otvet='$say', time1=NOW() where ot = '$id2' order by time desc limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php } else {?>
<?php if ($long_text < '5') {?>
  <script type="text/javascript">
  document.location.href = "<?php echo "$h";?>&err=1";
  </script>
  <?php
  exit();
}
?>
<?php if (!empty($row_ti)) {?>
  <script type="text/javascript">
  document.location.href = "<?php echo "$h";?>&err=2";
  </script>
  <?php
  exit();
}
?>
<?php
$query = "insert into texpod (`type`, `ot`, `text`, `time`) values ('$type', '$id1', '$say', NOW())";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД2'); 
?>
<?php }?>
<script type="text/javascript">
  document.location.href = "mailbox.php";
</script>
</body>
</html>