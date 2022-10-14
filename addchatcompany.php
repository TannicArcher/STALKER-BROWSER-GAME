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
$query_ch = "Select clan, clan_rang from users where id = '$log_id'";
$result_ch = mysqli_query($dbc, $query_ch) or die ('Ошибка передачи запроса к БД'); 
$row_ch = mysqli_fetch_array($result_ch);
$clan_ch = $row_ch['clan'];
$clan_rang_ch = $row_ch['clan_rang'];
if (!empty($clan_ch)) {
    $i=$_POST['addchat'];
    if(!empty($i)) {
	   $chat_err = 0;
	   $say_add = $_POST['say'];
	   $say_add = mysqli_real_escape_string($dbc, trim($say_add));	
	   $say_num = strlen($say_add);
	   if ($say_num>256) {
	     $chat_err = 1;
		 $err = $_GET['say_err'];
		 if (empty($err)){
		 ?>
         <script type="text/javascript">
         document.location.href = "<?php echo "$h";?>?say_err=1";
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
         document.location.href = "<?php echo "$h";?>?say_err=2";
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
	   if ($chat_err == 0) {
	        $say_add = str_replace("'",'&acute;', $say_add);
	        $say_add = str_replace('<','&lt;', $say_add);
	        $say_add = str_replace('>','&gt;', $say_add);
			$say_add = str_replace('"','&quot', $say_add);
			$say_add=stripslashes("$say_add");
	     $query_add_ch = "insert into clan_chat (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('$log_id', '$clan_rang_ch', '$clan_ch', '$say_add', NOW())";
         $result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД'); 
	   }
	   $i=0;
	 }
}
//////////////////////////////////////////////  
$h=getenv("HTTP_REFERER");
?>
  <script type="text/javascript">
  document.location.href = "<?php echo "$h";?>";
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