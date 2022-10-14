<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////Если есть куки
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  header ('Location: index.php');
}
else {
$page_title = 'Регистрация';
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<meta name="viewport" content="width=device-width; minimum-scale=1; maximum-scale=1"/>
<link rel="icon" href="/favicon4.ico" type="image/x-icon" />
<link rel="shortcut icon" href="/favicon4.ico" />
<meta name="interkassa-verification" content="fe80ab9fb246dd4bba8d09718aab943d" />
<meta name="interkassa-verification" content="c6e234d4822b791eee8ee50dc8464e08" />
<?php
  echo '<title>' . $page_title . '</title>';
?>

<link type="text/css" rel="stylesheet" href="/style/main1.css" />
</head>
<body>
<div class="blockk" style="background: #363636;">
<div class="r6">

<div class="regf" style="background: url(/img/dlfon.gif) repeat;">
<center>
<img src="/img/art_by_eptic1.jpg" width="100%"/></center><center>
<p style="border-top: solid 1px #444e4f;"></p>
  <?php
	$query_num = "Select id from users where gruppa <> 'huy'" ;
	$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
	$total = mysqli_num_rows($result_num);
	$gg = $total;
  ?>
	<p><i><?php echo " $gg "; ?> сталкеров уже осваивают Зону!</i></p><b>
 <?php
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////Если нет куки
  $err_login = $_GET['err_login'];
if ($err_login == '1') {?> <div id="error"><p>Для начала вам нужно пройти регистрацию или войти в свой профиль.</p></div><?php }
if ($err_login == '2') {?> <div id="error"><p>Ваш ip заблокирован администратором.</p></div><?php }
  if(isset($_POST['reg'])) {
  require_once('conf/dbc.php');
  $nick = mysqli_real_escape_string($dbc, trim($nick));	
  $pass =  mysqli_real_escape_string($dbc, trim($pass));
  $mail =  mysqli_real_escape_string($dbc, trim($mail));
  ?>
  <div id="error">
  <?php
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////Извлекаем данные
    $nick = $_POST['nick']; // Имя
    $nick1 = $_POST['nick']; // Имя1
    $group = $_POST['group']; // группировка
$group = 'odinochki';
    $sex = $_POST['sex']; // Пол
    $pass = $_POST['pass']; //Пароль
    $repass = $_POST['repass']; //Пароль
	$mail = $_POST['mail']; //Мыло
	$reg=1;
	$sgn = '#^[a-zA-Zа-яА-Я]+$#';
    $en = '#[a-zA-Z]#';
    $rus = '#[а-яА-Я]#';
	$formail = '#^[A-z0-9-\._]+@[A-z0-9]{2,}\.[A-z]{2,4}$#ui';
///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////Проверка ника   
	if ((empty($nick)) or (!isset($nick))){
	?>
	<p>Вы не ввели ник</p>
	<?php
	$reg = 0;
	}
	else {
      $query = "Select id from users where nick = '$nick1' limit 1";
	  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	  $row = mysqli_fetch_array($result);
	  if ($row != 0) {
	    ?>
	    <p>Такой ник уже есть</p>
	    <?php
	    $reg = 0;
	  }
	  $long_nick = strlen($nick1);
	  if (($long_nick<3) or ($long_nick>16)){
	    ?> <p>Ник должен быть в пределах от 3 до 16 символов</p>
	    <?php
	    $reg = 0;
	  }
    }
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////Проверка пола
    if ((isset($sex)) and (!empty($sex))) {
	  if (($sex != 'male') and ($sex != 'female')) {
	    ?> 
	    <p>Подмена данных</p>
	    <?php
	    $reg=0;
	  }
    }
	else {
	  ?> 
	  <p>Вы не выбрали пол</p>
	  <?php
	  $reg=0;
	}
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////Проверка мыла
    if ((isset($mail)) and (!empty($mail))) {
	  if (!preg_match($formail, $mail)) {
	  ?> 
	  <p>Неверный e-mail</p>
	  <?php
	  $reg=0;}
	  
	  $query = "Select * from users where mail = '$mail'";
	  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	  $row = mysqli_fetch_array($result);
	  if ($row != 0) {
	    ?>
	    <p>Такой e-mail уже есть</p>
	    <?php
	    $reg = 0;
	  }
    }
	else {
	  ?> 
	  <p>Вы не ввели e-mail</p>
	  <?php
$reg = 0;
	}
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////Проверка пароля и повтора пароля
     if ((isset($pass)) and (!empty($pass))) {
      if (strlen($pass)<3) {
	    ?> 
	    <p>Длина пароля меньше 3 символов</p>
	    <?php
        $reg = 0;
	  }
      if (strlen($pass)>16) {
	    ?> 
	    <p>Длина пароля превышает 16 символов</p>
	    <?php
        $reg = 0;
	  }
////////////////// 
      if ((isset($repass)) and (!empty($repass))) {
        if (($repass) <> ($pass)) {
	      ?> 
	      <p>Пароли не совпадают</p>
	      <?php
          $reg = 0;
        }
      }
      else {
	    ?> 
	    <p>Вы не ввели подтверждение пароля</p>
	    <?php
	    $reg = 0;
	  }
//////////////////
    }
	else { 
	  ?> 
	  <p>Вы не ввели пароль</p>
	  <?php
	  $reg = 0;
	}
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
    if ($reg == 1) {
	/////////////////////////////////////////////////////////////////
	  if ($group == 'odinochki') {
	    $group = 'naemniki';
	  }
	/////////////////////////////////////////////////////////////////
	  if ($sex == 'male') {
	    $avatar = '0';
	  }
	  else {
	    $avatar = '0';
	  }
	  /////////////////////////////
        $nick = strtr ($nick, 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯQWERTYUIOPASDFGHJKLZXCVBNM', 'абвгдеёжзийклмнопрстуфхцчшщъыьэюяqwertyuiopasdfghjklzxcvbnm');

	  /////////////////////////////
	  $user_top = $_SESSION['id'];
      $salt = '';
      $length = rand(10,16); // длина соли (от 5 до 10 сомволов)
      for($i=0; $i<$length; $i++) {
         $salt .= chr(rand(33,126)); // символ из ASCII-table
      }
	  $pass = ($pass.$salt);
	  $nickcode = ($salt.$nick1.$salt);
	  $ip = getenv("REMOTE_ADDR");
	  $query = "select id_invite from invite where ip='$ip' limit 1";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	  $row = mysqli_fetch_array($result);
	  $id_inv = $row['id_invite'];
	  $query = "delete from invite where ip='$ip'";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	  $query = "insert into users (`nick`, `nickcode`, `password`, `invite`, `salt`, `sex`, `gruppa`, `timereg`, `last_active`, `mail`, `avatar`, `aptechki`, `location`, `ip`) values ('$nick1', sha( '$nickcode ' ), sha( '$pass' ), '$id_inv', '$salt', '$sex', '$group', now(), now(), '$mail', '$avatar', '10', 'index', '$ip')";
	  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД16');
	  $query = "Select id, nick from users where nick = '$nick1'";
	  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД2');
	  $row = mysqli_fetch_array($result);
	  $user_id = $row['id'];
	  ///////////////////Создаём 2 нубовские шмотки игроку
	  
	  
	  
	  
	  
	  //1) Пистолет
	  $query_pist = "insert into things (`user_id`, `stat1`, `stat2`, `stat3`, `speed`, `sost`, `inf_id`,`privat`,`place`,`type`) values ('$user_id',350,350,72 ,6, '8', '1','1','2','2')";
	  $result_pist = mysqli_query($dbc, $query_pist) or die ('Ошибка передачи запроса к БД 2');
	  //2) Одежда
	  $query_cloth = "insert into things (`user_id`, `stat1`, `stat2`,`stat3`, `speed`,  `sost`, `inf_id`,`type`,`privat`,`place`) values ('$user_id','600', '600', '600', '3', '8', '1', '1', '1','2')";
	  $result_cloth = mysqli_query($dbc, $query_cloth) or die ('Ошибка передачи запроса к БД 4');
	  /////////////////////////////////////////////////////////////////////////
	  $query_hp = "update users set hp = '600', max_hp = '600', bronya = '600', razriv_cl='600', sost_cl = '8', speed_p = '6', tochn_p = '350', yron_p = '350',radiation='3', safety_p= '72', sost_p = '8'  where id = '$user_id'";
	  $result_hp = mysqli_query($dbc, $query_hp) or die ('Ошибка передачи запроса к БД1');
	  /////////////////////////////////////////////////////////////////////////Создаём куки новому пользователю если регистрация прошла успешно
	  
	  
	  
	  ////////////////////////////////////////////////////////////////////////
	  /////////////////////////////////////////////////////////////////////////Создаём куки новому пользователю если регистрация прошла успешно
	  $_SESSION['id'] = $row['id'];
      $_SESSION['nick'] = $row['nick'];
	  ?>
	  <script type="text/javascript">
      document.location.href = "study.php?step=1";
      </script>
	  <?php
	  exit();
	  /////////////////////////////////////////////////////////////////////////
	  /////////////////////////////////////////////////////////////////////////
	} 
  }
  $nickbot= $_POST['nick'];
  $nickbot = htmlentities($nickbot, ENT_QUOTES);
  $mailbot= $_POST['mail'];
  $mailbot = htmlentities($mailbot, ENT_QUOTES);
  $passbot= $_POST['pass'];
  $passbot = htmlentities($passbot, ENT_QUOTES);
  $repassbot= $_POST['repass'];
  $repassbot = htmlentities($repassbot, ENT_QUOTES);
  ?>
<form enctype="multipart/form-data" method="post" action="<? $_SERVER['PHP_SELF']; ?>">
<div class="stats"><span class="white">
  <label for="nick">Ник:</label><br />
  <input type="text" class="input" style="width: 90%;" value="<?php echo "$nickbot";?>" name="nick" /><br />
  <label for="sex">Пол:</label><br />
  <select name="sex" class="input" style="width: 91%;" size="1">
   <option value="male" <? if ($_POST['sex'] == male) {?>selected="selected"<?php }?>>Мужской</option>
   <option value="female" <? if ($_POST['sex'] == female) {?>selected="selected"<?php }?> >Женский</option>
  </select><br />
  <label for="mail">E-mail:</label></b><br />
  <input type="text" class="input" name="mail" style="width: 90%;" value="<?php echo "$mailbot"; ?>" placeholder="Пример: qwerty1@qwerty.ru"/><br /><span class="white"><b>
  <label for="pass">Пароль:</label><br />
  <input type="password" class="input" style="width: 90%;" name="pass" value="" /><br />
  <label for="repass">Повторите пароль:</label><br />
  <input type="password" class="input" style="width: 90%;" name="repass" value=""/>
  <div class="knopka">
  <input type="submit" class="input" value="Регистрация" name="reg" />
  </div></b></span>
  <p class="clothes">[Фактом регистрации вы принимаете <a href="accept.php">соглашение</a>]</p><br/>
</div>
</form></center>
<div class="link"><a href="login.php" class="link"><img src="img/ico/link.png"/> Уже зарегистрированы?</a></div>
</div>
</div>
<div style="background: #363636 url(/img/foot1337.png) repeat-x; margin-top: -2px; margin-bottom: -2px;">
<br/>

<br/>
</div>
<div class="r6" style="margin: 0;">
<center>
<div class="line">
<div id="foot">
<div class="wapstart-plus1-ad"></div>
<p>
<?php
$now = (date("H:i:s"));
echo "$now";
?>
</p>

<p>S.T.A.L.K.E.R 2022, 14+</p>
</div>
</div>
<i>
<a href="atg.php" style="text-decoration: none;">Об игре</a> | <a href="rules.php" style="text-decoration: none;">Правила</a> | <a href="accept.php" style="text-decoration: none;">Соглашение</a> 
</i>
</center>
</div>
 <?php
}
mysqli_close($dbc);
  ?>
</body>
</html>