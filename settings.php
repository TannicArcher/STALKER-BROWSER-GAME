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
if (!empty($_POST['change'])) {
  $user_id=$_SESSION['id'];
  $query = "Select password, salt from users where id = '$user_id' limit 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $row = mysqli_fetch_array($result);
  $pass=$_POST['pass'];	
  $pass1=$_POST['pass1'];	
  $pass2=$_POST['pass2'];	
  $pass =  mysqli_real_escape_string($dbc, trim($pass));
  $pass1 =  mysqli_real_escape_string($dbc, trim($pass1));
  $pass2 =  mysqli_real_escape_string($dbc, trim($pass2));
  if(empty($pass)) {$err=1;}
  if(empty($pass1)) {$err=2;}
  if(empty($pass2)) {$err=3;}
  if ($err==0) {
    $salt=$row['salt'];
    $pass = ($pass.$salt);
	$query = "Select id from users where id = '$user_id' and password = sha('$pass') limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
    $row = mysqli_fetch_array($result);
	if (empty($row)) {$err=4;}
	else {
	  if ($pass1==$pass2) {
	    $new_pass = ($pass1.$salt);
	    $query = "update users set password = sha('$new_pass') where id = '$user_id' limit 1";
        $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
		$err=8;
	  } 
	  else {
	  $err=7;
	  }
	}
  }
}
$page_title = 'Настройки';
require_once('conf/head.php');
require_once('conf/top.php');
?>
<?php
$user_id=$_SESSION['id'];
$tip = $_GET['tip'];
$query_p = "Select * from users where id='$user_id' limit 1";
$result_p = mysqli_query($dbc, $query_p) or die ('Ошибка передачи запроса к БД');
$row_p = mysqli_fetch_array($result_p);
$polosa = $row_p['polosa'];
$pokaz = $row_p['pokaz'];
$profile = $row_p['profile'];
$pg_ramka = $row_p['pg'];
$ajax_ = $row_p['ajax_mail'];
?>
<div class="bg_wave">
<div id="main">
<div class="stats">
<p class="podmenu">Настройки</p>
</div>
  <?php if(!empty($_GET['error'])) {?><div id="error">
   <?php if ($_GET['error']==1) {echo 'Недостаточно средств';}?>
   <?php if ($_GET['error']==2) {echo '<span class="bonus"><b>Ник успешно изменен</b></span>';}?>
   <?php if ($_GET['error']==3) {echo '<span class="bonus"><b>Группировка успешно изменена</b></span>';}?>
   </div><?php } ?>
  <p><a href="changenick.php">Сменить ник <img src="img/ico/money.png" width="12" height="12"/> 3000</a></p>
  <p><a href="changegroup.php">Сменить группировку <img src="img/ico/money.png" width="12" height="12"/> 3000</a></p>
<br/>
<div style="background: #303030 url(/img/bg.jpg);">
<p style="border-top: solid 1px #444e4f;"></p>
<b>
<form name=form1 method=get action="set_type.php">
<p class="bonus">Скрывать полосу опыта:</p>
<input type="checkbox" <?php if ($polosa == '1') {?>checked="checked"<?php }?> name="polosa">

<p class="bonus">Скрывать рамку:</p>
<input type="checkbox" <?php if ($pg_ramka == '0') {?>checked="checked"<?php }?> name="ramka">

<p class="bonus">Скрывать почтовое оповещение:</p>
<input type="checkbox" <?php if ($pokaz == '0') {?>checked="checked"<?php }?> name="mail_o">

<p class="bonus">Скрывать новый вид профиля:</p>
<input type="checkbox" <?php if ($profile == '1') {?>checked="checked"<?php }?> name="profile">

<p class="bonus">Отключать новый режим почты:</p>
<input type="checkbox" <?php if ($ajax_ == '0') {?>checked="checked"<?php }?> name="ajax_mail">
<br/><br/>
	<input type=submit value="Принять" style="width: 30%">
</form>
</b>
<p style="border-top: solid 1px #444e4f;"></p>
</div>


  <div class="stats">
   <p class="podmenu">Смена пароля</p>
   <?php if(!empty($err)) {?><div id="error">
   <?php if ($err==1) {echo 'Вы не ввели текущий пароль';}?>
   <?php if ($err==3) {echo 'Вы не ввели повтор пароля';}?>
   <?php if ($err==2) {echo 'Вы не ввели новый пароль';}?>
   <?php if ($err==4) {echo 'Неверный текущий пароль';}?>
   <?php if ($err==5) {echo 'Текущий пароль превышает 20 символов';}?>
   <?php if ($err==6) {echo 'Текущий пароль меньше 3 символов';}?>
   <?php if ($err==7) {echo 'Пароли не совпадают';}?>
   <?php if ($err==8) {echo '<span class="bonus"><b>Пароль успешно изменен</b></span>';}?>
   </div><?php } ?>
  <form enctype="multipart/form-data" method="post" action="<? $_SERVER['PHP_SELF']; ?>">
  <label for="pass">Текущий пароль:</label><br />
  <input type="password" class="input" name="pass" value="" /><br />
  <label for="pass1">Новый пароль:</label><br />
  <input type="password" class="input" name="pass1" value="" /><br />
  <label for="pass2">Повтор нового пароля:</label><br />
  <input type="password" class="input" name="pass2" value="" /><br />
  <div class="knopka">
  <input type="submit" class="input" value="Сменить" name="change" />
  </div>
  </form>
  </div>
</div>
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);
?>

</body>
</html>