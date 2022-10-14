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
$H=getenv("HTTP_REFERER");
if (empty($H)) {
  ?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
  <?php
  exit();
}
$user_id = $_SESSION['id'];
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
$query_pb = "Select * from bans where user_id = '$user_id' and type = '2'";
$result_pb = mysqli_query($dbc, $query_pb) or die ('Ошибка передачи запроса к БД');
$row_pb = mysqli_fetch_array($result_pb);
if ($row_pb > '0') {
$ban_f = '1';
}
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
$topic = $_GET['topic'];
$text = $_POST['text'];
$page = $_GET['page'];
$dlya = $_GET['id'];
$page = htmlentities($page, ENT_QUOTES);
if (empty($topic)) {
  ?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
  <?php
  exit();
}
if (empty($text)) {
  ?>
  <script type="text/javascript">
  document.location.href = "topic.php?topic=<?php echo "$topic";?>&err=1&page=<?php echo "$page";?>";
  </script>
  <?php
  exit();
}
$topic = mysqli_real_escape_string($dbc, trim($topic));	
/////////////////////////////Существует ли топик
$query_isset = "Select close, id_subf, fix from topics where id_top='$topic' limit 1";
$result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД');
$row_isset = mysqli_num_rows($result_isset);
$row_isset = mysqli_fetch_array($result_isset);
$id_subf = $row_isset['id_subf'];
if (empty($row_isset)) {
?>
<script type="text/javascript">
  document.location.href = "index.php";
</script>
<?php
exit();
}
/////////////
//////////////////////////Закрыт ли топик
if ($row_isset['close'] == 1) {
  ?>
  <script type="text/javascript">
  document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
  </script>
  <?php
  exit();
}
//////////////////////////////////////

$query_sub = "Select clan, rangs_read, rangs_com, rangs_cre, main from subforums where id_subf='$id_subf' limit 1";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
$row_sub = mysqli_fetch_array($result_sub);

$query_user = "Select gruppa, lvl, clan, clan_rang, admin, f_ban from users where id='$user_id' limit 1";
$result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
$row_user = mysqli_fetch_array($result_user);

if ($row_user['admin'] <> 1) {
  if ($row_sub['main'] == 0) {
    if ($row_user['clan'] == $row_sub['clan']) {
	  if ($row_user['clan_rang'] < $row_sub['rang_com']) {
	    ?>
        <script type="text/javascript">
        document.location.href = "topic.php?topic=<?php echo "$topic";?>";
        </script>
        <?php
        exit();
	  }
	}
	else {
	  if ($row_sub['rang_com'] <> 0) {
	    ?>
        <script type="text/javascript">
        document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
        </script>
        <?php
        exit();
	  }
	}
  } 
  else {
    if ($row_user['lvl'] < 10) {
	  ?>
      <script type="text/javascript">
      document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
      </script>
      <?php
      exit();
	}
	if($row_user['gruppa'] == $row_sub['gruppa'] or $row_sub['gruppa'] == 'all' and $row_user['f_ban'] <> 0) {
	  ?>
      <script type="text/javascript">
      document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
      </script>
      <?php
      exit();
	}
  }
  $text = str_replace('<','&lt;', $text);
  $text = str_replace('>','&gt;', $text);
  $text = str_replace('"','&quot', $text);
}
    if ($ban_f == '1') {
	  ?>
      <script type="text/javascript">
      document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
      </script>
      <?php
      exit();
	}
  $text = preg_replace('/(\r\n)+/', "\r\n", $text);
  $text = preg_replace('/(\r)+/', "\r", $text);
  $text = preg_replace('/(\n)+/', "\n", $text);
require_once('inc_smiles.php');
  $text=stripslashes("$text");
  $text =  mysqli_real_escape_string($dbc, trim($text));
$query = "insert into comments (`id_top`, `avtor`, `text`, `dlya`, `time_cre`) values ('$topic', '$user_id', '$text', '$dlya', NOW())";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
if ($row_isset['fix'] == 1) {
$query = "update topics set time_up = NOW()+1000000 where id_top='$topic'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
} 
else {
$query = "update topics set time_up = NOW() where id_top='$topic'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
$query = "select time_up from intopics where user_id='$user_id' and topic='$topic' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$number = mysqli_num_rows($result);
if ($number == 0) {
  $query = "insert into  intopics (`user_id`, `topic`, `time_up`) values ( '$user_id', '$topic', NOW())";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
} 
else {
  $query = "update intopics set time_up = NOW() where topic='$topic' and user_id='$user_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
}
?>
<script type="text/javascript">
  document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
</script>
<?php
mysqli_close($dbc);
?>