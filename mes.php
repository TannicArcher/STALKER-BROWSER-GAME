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
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
$query_pb = "Select * from bans where user_id = '$user_id' and type = '1'";
$result_pb = mysqli_query($dbc, $query_pb) or die ('Ошибка передачи запроса к БД');
$row_pb = mysqli_fetch_array($result_pb);
if ($row_pb > '0') {
$ban_p = '1';
}
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
$say = $_POST['say'];
if (empty($say)) {
$say = $_POST['msg'];
}
$id1 = $user_id;
$id2 = $_GET['id'];
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД1');
$row_us = mysqli_fetch_array($result_us);
$max_hp = $row_us['max_hp'];
$habar = $row_us['habar'];
$p_ban = $row_us['p_ban'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$clan_rang = $row_us['clan_rang'];
$clan = $row_us['clan'];
$lvl = $row_us['lvl'];
$moder =  $row_us['moder'];
$say = str_replace('<','&lt;', $say);
$say = str_replace('>','&gt;', $say);
$say = str_replace('"','&quot', $say);
$text = $say;
require_once('inc_smiles.php');
$say = $text;
$say = stripslashes("$say");
$say =  mysqli_real_escape_string($dbc, trim($say));
$long_text = strlen($say);
$query_list = "Select * from black_list where user_id='$user_id' and black_id='$id2' limit 1";
$result_list = mysqli_query($dbc, $query_list) or die ('Ошибка передачи запроса к БД45');
$row_list = mysqli_fetch_array($result_list);
$query_list1 = "Select * from black_list where user_id='$id2' and black_id='$user_id' limit 1";
$result_list1 = mysqli_query($dbc, $query_list1) or die ('Ошибка передачи запроса к БД46');
$row_list1 = mysqli_fetch_array($result_list1);
?>
<?php
if ($moder != '1') {?>
<?php if ($habar == '0') {?>
  <script type="text/javascript">
  document.location.href = "mail4.php?id=<?php echo "$id2";?>&err=1";
  </script>
  <?php
  exit();
}
?>
<?php if ($p_ban == '1' and $id2 != '530') {?>
  <script type="text/javascript">
  document.location.href = "mail4.php?id=<?php echo "$id2";?>&err=2";
  </script>
  <?php
  exit();
}
?>
<?php if ($row_list != 0) {?>
  <script type="text/javascript">
  document.location.href = "mail4.php?id=<?php echo "$id2";?>&err=3";
  </script>
  <?php
  exit();
}
?>
<?php if ($row_list1 != 0) {?>
  <script type="text/javascript">
  document.location.href = "mail4.php?id=<?php echo "$id2";?>&err=4";
  </script>
  <?php
  exit();
}
?>
<?php if ($long_text < '1') {?>
  <script type="text/javascript">
  document.location.href = "<?php echo "$h";?>";
  </script>
  <?php
  exit();
}
?>
<?php if ($ban_p == '1') {?>
  <script type="text/javascript">
  document.location.href = "<?php echo "$h";?>";
  </script>
  <?php
  exit();
}
?>
<?php }?>
<?php
$query = "insert into message (`type`, `ot`, `dlya`, `text`, `time`) values ('1', '$id1', '$id2', '$say', NOW())";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД2'); 
$query = "update users set message=message+'1' where id = '$id2' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД3');
$query = "update users set habar=habar-'1' where id = '$id1' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД4');
?>
<?php
$query_ = "Select * from kontakts where user_id='$id1' and drug_id='$id2' limit 1";
$result_ = mysqli_query($dbc, $query_) or die ('Ошибка передачи запроса к БД5');
$row_ = mysqli_fetch_array($result_);

$query_ = "Select * from kontakts where user_id='$id2' and drug_id='$id1' limit 1";
$result_ = mysqli_query($dbc, $query_) or die ('Ошибка передачи запроса к БД5');
$row_21 = mysqli_fetch_array($result_);

if ($row_ == 0) {
$query = "insert into kontakts (`user_id`, `drug_id`, `time`) values ('$id1', '$id2', NOW() )";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД6');
}
if ($row_21 == 0) {
$query0 = "insert into kontakts (`user_id`, `drug_id`, `time`) values ('$id2', '$id1', NOW() )";
$result0 = mysqli_query($dbc, $query0) or die ('Ошибка передачи запроса к БД7'); 
}
if ($row_ != 0) {
$query = "update kontakts set `time`=NOW() where user_id='$id1' and drug_id='$id2' or user_id='$id2' and drug_id='$id1' limit 2";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД8');
}
?>
<script type="text/javascript">
  document.location.href = "mail4.php?id=<?php echo "$id2";?>";
</script>
</body>
</html>