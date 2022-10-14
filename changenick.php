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

$log_id = $_SESSION['id'];
$query_ch = "Select money from users where id = '$log_id'";
$result_ch = mysqli_query($dbc, $query_ch) or die ('Ошибка передачи запроса к БД'); 
$row_ch = mysqli_fetch_array($result_ch);
$clan_ch = $row_ch['clan'];
$money = $row_ch['money'];
if ($money<3000) {
  header ('Location: settings.php?error=1');
  exit();
}
  ////////////////////////////////////////////////////////////
  if (!empty($_POST['change'])) {
    $nick = $_POST['nick'];
	$sgn = '#^[a-zA-ZабвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ]+$#';
    $en = '#[a-zA-Z]#';
    $rus = '#[абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ]#';
	if ((empty($nick)) or (!isset($nick))){
	$err=1;
	}
	else {
      $query = "Select id from users where nick = '$nick' limit 1";
	  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	  $row = mysqli_fetch_array($result);
	  if ($row != 0) {

	    $err = 2;
	  }
$nick_n = str_replace(' ', '', $nick);
	  $long_nick = iconv_strlen($nick_n, 'UTF-8');
	  if (($long_nick < '3') or ($long_nick > '16')){
	    $err = 3;
	  }
    }
	if ($err == 0) {

	  $nick1 = strtr ($nick, 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯQWERTYUIOPASDFGHJKLZXCVBNM', 'абвгдеёжзийклмнопрстуфхцчшщъыьэюяqwertyuiopasdfghjklzxcvbnm');
	  $query = "update users set nick = '$nick', money=money-3000 where id = '$log_id' limit 1";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	  header ('Location: settings.php?error=2');
      exit();
	}
  }
  ////////////////////////////////////////////////////////////
  $page_title = 'Сменить ник';
  require_once('conf/head.php');
  require_once('conf/top.php');
  ?>
  <?php if(!empty($err)) {?><div id="error">
   <?php if ($err==1) {echo 'Вы не ввели ник';}?>
   <?php if ($err==2) {echo 'Такой ник уже есть';}?>
   <?php if ($err==3) {echo 'Ник должен быть в пределах от 3 до 16 символов';}?>
   <?php if ($err==4) {echo 'Ник должен содержать только русские или английские буквы';}?>
   <?php if ($err==5) {echo 'Имеются запрещенные символы или цифры в нике';}?>
   </div><?php } ?><?php echo "$long_nick";?>
   <div class="stats">
   <p>Новый ник:</p>
   <form enctype="multipart/form-data" method="post" action="<? $_SERVER['PHP_SELF']; ?>">
	 <input type="text" style="height:13px;" class="input" name="nick" />
	 <div class="knopka">
     <input type="submit" class="input" value="Сменить" name="change"/>
     </div>
	 </form>
  <p><span class="bonus">Стоимость:<img src="img/ico/money.png" width="12" height="12"/> 3000 RUB</span></p>
  </div>
  <?php  
   require_once('conf/navig.php');
   require_once('conf/foot.php'); 
//////////////////////////////////////////////  
mysqli_close($dbc);
?>