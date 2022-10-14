<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'S.T.A.L.K.E.R. mobile';
require_once('conf/head.php');
?>
<?php
$ip = getenv("REMOTE_ADDR");
$query_del = "DELETE FROM `login` WHERE `ip` = '$ip' LIMIT 1";
$result_del = mysqli_query($dbc, $query_del) or die ('Ошибка передачи запроса к БД');
$invite_id = $_GET['inv'];
$adress = getenv("HTTP_REFERER");
$time_beg=microtime();
$ip = mysqli_real_escape_string($dbc, trim($ip));
$invite_id =  mysqli_real_escape_string($dbc, trim($invite_id));
$adress =  mysqli_real_escape_string($dbc, trim($adress));
$query = "select id_invite from invite where ip='$ip'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
if (mysqli_fetch_array($result)) {
$query = "update invite set id_invite = '$invite_id', iz = '$adress' where ip='$ip'  limit 1";
@$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
else {
$query = "insert into invite (`ip`, `id_invite`, `iz`) values ( '$ip', '$invite_id', '$adress')";
@$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
?>
<div style="background: #363636">
<div class="r6">
<center>
<img src="/img/art_by_eptic1.jpg" width="100%"/></center><center>
 <?php
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
  <?php
}
else {
  ?>
  <div id="error">
  <?php
  if(isset($_POST['log'])) {
    $nick = $_POST['nick']; // Имя
    $pass = $_POST['pass']; //Пароль
    $log = 1;
	if ((empty($nick)) or (!isset($nick))){
	  ?>
	  <p>Вы не ввели ник</p>
	  <?php
	  $log = 0;
	  $login=1;
	}
	if ((empty($pass)) or (!isset($pass))){
	  ?>
	  <p>Вы не ввели пароль</p>
	  <?php
	  $log = 0;
	}
	if ($log == 1) {
	  $nick = mysqli_real_escape_string($dbc, trim($nick));	
	  $pass =  mysqli_real_escape_string($dbc, trim($pass));
	  $query = "Select id, salt from users where nick = '$nick'";
	  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	  $row = mysqli_fetch_array($result);
	  if ($row == 0) {
	  ?>
	  <p>Неверный логин или пароль</p>
	  <?php
	  $login = 0;
	  }
	  else {
	  $salt = $row['salt'];
	  $pass = ($pass.$salt);
	  $query = "Select id, salt from users where nick = '$nick' and password = sha('$pass')";
	  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	  $row = mysqli_fetch_array($result);
	  if ($row == 0) {
	    ?>
	    <p>Неверный логин или пароль</p>
	    <?php
		$login = 0;
	  }
	  else {
	    $ip_user = getenv("REMOTE_ADDR");
        $query = "Select count_login from login where ip = '$ip_user' limit 1";
        $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
        $row = mysqli_fetch_array($result);
		if ($row['count_login'] <=5) { 
	      $query = "Select id, nick from users where nick = '$nick'";
	      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	      $row = mysqli_fetch_array($result);
	      $_SESSION['id'] = $row['id'];
          $_SESSION['nick'] = $row['nick'];
	      ?>
          <script type="text/javascript">
          document.location.href = "index.php";
          </script>
          <?php
		}
		else {
		  ?>
	      <p>Вы использовали все 5 попыток войти в персонажа. Подождите немного</p>
<?php
      $query = "update login set count_login=0 where ip='$ip_user' limit 1";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
	      <?php
		}
	    }
	  }
	}
  }
  if ($login==0) {
  $ip_user = getenv("REMOTE_ADDR");
  $query = "Select count_login from login where ip = '$ip_user' limit 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $row = mysqli_fetch_array($result);
    if (!empty($row)) {
      $query = "update login set count_login=count_login+1 where ip='$ip_user' limit 1";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
    }
	else {
	  $query = "insert into login (`ip`, `count_login`, `count_relost`) values ('$ip_user', '1', '0')";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
	}
  }
?>

<?php
  $nickbot = $_POST['nick'];
  $nickbot = htmlentities($nickbot, ENT_QUOTES);
  $passbot = $_POST['pass'];
  $passbot = htmlentities($passbot, ENT_QUOTES);
  ?>
</div>
</center>
<br/>
</div>
<table>
<tr>
<td style="width:33%;padding-right:4px;">
<div style="position:relative;">
<a class="simple-but border gray mb1" href="reg.php"><span><span>Начать путь</span></span></a>

</div>
</td>
<td style="width:33%;padding-left:4px;">
<div style="position:relative;">
<a class="simple-but gray border mb1" href="lostpass.php"><span><span>Восстановить</span></span></a>

</div>
</td>
</tr>
</table>
<div class="r6">
<center><b>
<form enctype="multipart/form-data" method="post" action="<? $_SERVER['PHP_SELF']; ?>">
  <label for="nick">Ник:</label><br />
  <input type="text" class="input" name="nick" style="width: 90%;" value="<?php echo "$nick";?>" /><br />
  <label for="pass">Пароль:</label><br />
  <input type="password" class="input" name="pass" style="width: 90%;" value="" /><br/>
  <div class="knopka">
  <input type="submit" class="input" value="Войти" name="log" />
  </div>
</form>
</b>
</center>
</div></div>
<p style="clear: left"></p>
<p style="clear: right"></p>
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
?>
</body>
</html>