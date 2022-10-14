<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Восстановление пароля';
require_once('conf/head.php');
 ?>
  <div class="regf" style="background:#000001 url(http://stalkeronlinegame.epizy.com/img/dlfon.gif) repeat;">
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
  <center><div class="name">Восстановление пароля</div></center>
  <div style="color:#990000;
	padding-bottom: 1px;">
  <?php
  if(isset($_POST['relog'])) {
    $mail = $_POST['mail']; // мыло
	$formail = '#^[A-z0-9-\._]+@[A-z0-9]{2,}\.[A-z]{2,4}$#ui';
    $flag = 1;
	if (empty($mail)){
	  ?>
	  <p>Вы не ввели адрес электронной почты</p>
	  <?php
	   $flag= 0;
	}
	else {
	  if (!preg_match($formail, $mail)) {
	    ?> 
	    <p>Неверный e-mail</p>
	    <?php
	    $flag=0;
	  }
	  $nick = $_POST['nick'];
	  if (empty($nick)){
	    ?>
	    <p>Вы не ввели ник</p>
	    <?php
	    $flag= 0;
	  } 
	  else {
	    $mail =  mysqli_real_escape_string($dbc, trim($mail));
		$nick = mysqli_real_escape_string($dbc, trim($nick));	
		$query = "Select password, id from users where nick = '$nick' and mail = '$mail' limit 1";
	    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	    if ($row = mysqli_fetch_array($result)) {
		  if ($flag == 1) {
		    $password = $row['password'];
			$id = $row['id'];
			$to = "$mail";
		    $msg = "Привет, сталкер $nick !\n Пройди по этой ссылке для восстановления своего пароля:\n http://stalkeronlinegame.epizy.com/relostpass.php?nick=$id&r=$password";
			$subject = 'Восстановление пароля';
			mail($to,$subject,$msg,"From: support STALKERS")
			?>
	        <p>Сообщение успешно отправлено, проверьте почту</p>
	        <?php
		  }
		}
		else {
		  ?>
	      <p>Данные не верны</p>
	      <?php
	      $flag= 0;
		}
	  }
	}
  }
  $phpself= $_SERVER['PHP_SELF'];
  $phpself = htmlentities($phpself, ENT_QUOTES);
  $nickbottom = $_POST['nick'];
  ?>
</div>
<div class="stats"><center><b>
<form enctype="multipart/form-data" method="post" action="<? echo "$phpself"; ?>">
  <label for="mail">Ник:</label><br />
  <input type="text" class="input" style="width: 90%;" name="nick" value="<?php echo "$nickbottom"; ?>" /><br />
  <label for="mail">e-mail:</label><br />
  <input type="text" class="input" style="width: 90%;" name="mail"  />
  <div class="knopka">
  <input type="submit" class="input" value="Восстановить" name="relog" />
  </div>
</form>
<br/>
</div></center></b>
</div>
<?php
}
mysqli_close($dbc);

?>
<div class="link"><a href="login.php" class="link"><img src="img/ico/link.png"/> Вход</a></div>
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
</body>
</html>