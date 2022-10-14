<?php
//*******************************************************************//
//**///////////////////////Автор: Андрей Наумов////////////////////**//
//**//////Двиг был написан мною и никаких соавторов не имеется/////**//
//**////////////////////////VK: vk.com/linux8//////////////////////**//
//**/////Устроюсь как на временную, так и на постоянную работу/////**//
//**//////////Знаю: Php, MySQL, CSS, xhtml, photoshop//////////////**//
//**/////Цена договорная, зависит от сложности и объёма работы/////**//
//**///////////////////////////////////////////////////////////////**//
//**////////////Спасибо за использование моего движка//////////////**//
//**/////Буду рад радовать вас новыми и интересными движками///////**//
//*******************************************************************//

require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
?>
<script type="text/javascript">
  document.location.href = "reg.php?err_login=1";
</script>
<?php
}
$page_title = 'Чат отряда';
require_once('conf/head.php');
require_once('conf/top.php');
$log_id=$_SESSION['id'];
$query_out = "Select clan, clan_rang, nick from users where id = '$log_id'";
$result_out = mysqli_query($dbc, $query_out) or die ('Ошибка передачи запроса к БД');
$row_out = mysqli_fetch_array($result_out);
if ($row_out['clan'] == 0) {
?>
<script type="text/javascript">
  document.location.href = "index.php";
</script>
<?php
exit();
}
////////////////////////////ЧАТ!!!!
$query_ch = "Select clan, clan_rang from users where id = '$log_id'";
$result_ch = mysqli_query($dbc, $query_ch) or die ('Ошибка передачи запроса к БД'); 
$row_ch = mysqli_fetch_array($result_ch);
$clan_ch = $row_ch['clan'];
$clan_rang_ch = $row_ch['clan_rang'];
$query_user = "Select gruppa, nick from users where id = '$log_id'";
  $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД1');
  $row_user = mysqli_fetch_array($result_user);
  if (!empty($clan_ch)) {
    $say_err=$_GET['say_err'];
    if(!empty($say_err)) {
		 if ($say_err == 1) {?><span id="error">Длина сообщения должна быть не больше 64 символов</span><?php }
		 if ($say_err == 2) {?><span id="error">Длина сообщения должна быть не больше 64 символов</span><?php }
	 }
	  
   ?>
   <div class="stats"><p class="podmenu">Чат отряда</p></div> 
   <p><img src="img/ico/point.png" width="12" height="12"/> <a href="chatcompany.php">Обновить</a></p>
   <div class="stats">
	 <form enctype="multipart/form-data" method="post" action="addchatcompany.php">
	 <input type="text" style="width:50%; height:18px;" class="input" name="say" />
     <input type="submit" style="width:35px;" class="input" value="+" name="addchat"/>
     </form>
   <?php
  $query_chat = "SELECT * FROM `clan_chat` where clan_id = '$clan_ch' ORDER BY `time` DESC limit 15";
  $result_chat = mysqli_query($dbc, $query_chat) or die ('Ошибка передачи запроса к БД');
  $count_chat = mysqli_num_rows($result_chat);
  if (!empty($count_chat)) {
    while ($row_chat = mysqli_fetch_array($result_chat)) {
    $id_chat = $row_chat['user_id'];
	$query_ch = "Select nick from users where id = '$id_chat'";
    $result_ch = mysqli_query($dbc, $query_ch) or die ('Ошибка передачи запроса к БД'); 
	$row_ch=mysqli_fetch_array($result_ch);
	$say = $row_chat['say'];
	$time = $row_chat['time'];
	?><p><a href="profile.php?id=<?php echo $row_chat['user_id'];?>"><?php echo $row_ch['nick'];?></a>: <span class="white"><?php echo "$say";?></span></p>
<?php
    }
  }
  ?>
  </div>
  <?php
}
else {
  require_once('conf/notfound.php');
}
////////////////////////////////
///////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);
?>

</body>
</html>