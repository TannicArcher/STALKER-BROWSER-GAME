<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$h=getenv("HTTP_REFERER");
if (empty($h)) {
?>
<script type="text/javascript">
  document.location.href = "index.php";
</script>
<?php
exit();
}
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
$log_id = $_SESSION['id'];
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
$query_pb = "Select * from bans where user_id = '$log_id' and type = '3'";
$result_pb = mysqli_query($dbc, $query_pb) or die ('Ошибка передачи запроса к БД');
$row_pb = mysqli_fetch_array($result_pb);
if ($row_pb > '0') {
$ban_c = '1';
}
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
$dlya = $_GET['dlya'];
$room = $_GET['room'];
$now1 = (date("Y-m-d H:i:s")); 
$query_ch = "Select c_ban, clan, clan_rang, regen from users where id = '$log_id'";
$result_ch = mysqli_query($dbc, $query_ch) or die ('Ошибка передачи запроса к БД1'); 
$row_ch = mysqli_fetch_array($result_ch);
$clan_ch = $row_ch['regen'];
$clan_rang_ch = $row_ch['clan_rang'];
$c_ban = $row_ch['c_ban'];
if (!empty($clan_ch)) {
    $i=$_POST['addad'];
    if(!empty($i)) {
	   $chat_err = 0;
	   $say_add = $_POST['msg'];
	   $say_add = mysqli_real_escape_string($dbc, trim($say_add));	
	   $say_num = strlen($say_add);
	   if ($say_num>1000) {
	     $chat_err = 1;
		 $err = $_GET['say_err'];
		 if (empty($err)){
		 ?>
         <script type="text/javascript">
         document.location.href = "chat.php?say_err=1";
         </script>
         <?php
		 } else {
		 ?>
         <script type="text/javascript">
         document.location.href = "<?php echo "$h";?>";
         </script>
         <?php
		 }
	   }
	   if ($say_num==0) {
	     $chat_err = 1;
		 $err = $_GET['say_err'];
		 if (empty($err)){
		 ?>
         <script type="text/javascript">
         document.location.href = "chat.php?say_err=2";
         </script>
         <?php
		 } else {
		 ?>
         <script type="text/javascript">
         document.location.href = "<?php echo "$h";?>";
         </script>
         <?php
		 }
	   }
if ($c_ban == '1') {?>
<script type="text/javascript">
  document.location.href = "chat.php?err=1";
</script>
<?php
exit();
}
if ($ban_c == '1') {?>
<script type="text/javascript">
  document.location.href = "chat.php?err=1";
</script>
<?php
exit();
}
	   if ($chat_err == 0) {
$say = $say_add;
$say = str_replace('<','&lt;', $say);
$say = str_replace('>','&gt;', $say);
$say = str_replace('"','&quot', $say);
$text = $say;
require_once('inc_smiles.php');
$say = $text;
$say = stripslashes("$say");
$say =  mysqli_real_escape_string($dbc, trim($say));
$say_add = $say;
$query_add_ch = "insert into chat (`user_id`, `dlya_id`, `rang`, `clan_id`, `say`, `time`, `type`) values ('$log_id', '$dlya', '$clan_rang_ch', '$clan_ch', '$say_add', '$now1', '$room')";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД2');
}
	   $i=0;
	 }
}
$h=getenv("HTTP_REFERER");
?>
  <script type="text/javascript">
  document.location.href = "chat.php?say_err=3&c=<?php echo "$room";?>";
  </script>
<?php
}
else {
?>
<script type="text/javascript">
  document.location.href = "reg.php?err_login=1";
</script>
<?php
}
mysqli_close($dbc);
?>