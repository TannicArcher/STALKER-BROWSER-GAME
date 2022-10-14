<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Восстановление пароля';
require_once('conf/head.php');
 ?>
  <div id="main">
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
  <div class="stats">
  <p class="podmenu">Восстановление пароля</p>
  </div>
  <?php
    $nick = $_GET['nick'];
    $password = $_GET['r'];
	$ip_user = getenv("REMOTE_ADDR");
    $query_re = "Select count_relost from login where ip = '$ip_user' limit 1";
    $result_re = mysqli_query($dbc, $query_re) or die ('Ошибка передачи запроса к БД');
    $row_re = mysqli_fetch_array($result_re);
    
	if (!empty($nick) and !empty($password) and $row_re['count_relost'] <6) {
	  $nick = mysqli_real_escape_string($dbc, trim($nick));
	  $password = mysqli_real_escape_string($dbc, trim($password));
	  $query = "Select id from users where id = '$nick' and password = '$password' limit 1";
	  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	  $row = mysqli_fetch_array($result);
	  $user_id = $row['id'];
	  if (!empty($row)) {
	    if (isset($_POST['save'])) {
		$reg = 1;
		  //////////////
		  $pass = $_POST['pass'];
		  $repass = $_POST['repass'];
		  ?><div id="error"><?php
		   if ((isset($pass)) and (!empty($pass))) {
      if (strlen($pass)<6) {
	    ?> 
	    <p>Длина пароля меньше 6 символов</p>
	    <?php
        $reg = 0;
	  }
      if (strlen($pass)>16) {
	    ?> 
	    <p>Длина пароля превышает 16 символа</p>
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
	if ($reg == 1) {
	  $query = "Select salt from users where id = '$nick' and password = '$password' limit 1";
	  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	  $row = mysqli_fetch_array($result);
	  $salt=$row['salt'];
	  $pass = ($pass.$salt);
	  $query_hp = "update users set password = sha( '$pass' )  where id = '$user_id'";
	  $result_hp = mysqli_query($dbc, $query_hp) or die ('Ошибка передачи запроса к БД1');
	   ?>
       <script type="text/javascript">
       document.location.href = "index.php";
       </script>
       <?php
	   exit();
	}
	/////////////////////
	?></div><?php
		}
	    ?>
		<div class="stats">
        <form enctype="multipart/form-data" method="post" action="<? $_SERVER['PHP_SELF']; ?>">
        <label for="pass">Новый пароль:</label><br />
        <input type="text" class="input" name="pass"  /><br />
        <label for="repass">Подтверждение пароля:</label><br />
        <input type="text" class="input" name="repass"  />
		<div class="knopka">
        <input type="submit" class="input" value="Сохранить" name="save" />
		</div>
        </form>
        </div>
		<?php    
	  }
	  else {
	  ?><div class="stats">Время действия ссылки истекло или вы не правильно её ввели <br />(многоразовое выполнение данной операции може привести к плачевным последствиям:))</div><?php
	  /////////////////////////////////////////////
	  $ip_user = getenv("REMOTE_ADDR");
      $query = "Select count_relost from login where ip = '$ip_user' limit 1";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $row = mysqli_fetch_array($result);
    if (!empty($row)) {
      $query = "update login set count_relost=count_relost+1 where ip='$ip_user' limit 1";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
    }
	else {
	  $query = "insert into login (`ip`, `count_login`, `count_relost`) values ('$ip_user', '0', '1')";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
	}
  ////////////////////////////////////
	  }
	}
	else {
	  ?><div class="stats">Время действия ссылки истекло или вы не правильно её ввели <br />(многоразовое выполнение данной операции може привести к плачевным последствиям:))</div><?php
	  /////////////////////////////////////////////
	  $ip_user = getenv("REMOTE_ADDR");
      $query = "Select count_relost from login where ip = '$ip_user' limit 1";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $row = mysqli_fetch_array($result);
    if (!empty($row)) {
      $query = "update login set count_relost=count_relost+1 where ip='$ip_user' limit 1";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
    }
	else {
	  $query = "insert into login (`ip`, `count_login`, `count_relost`) values ('$ip_user', '0', '1')";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
	}
  ////////////////////////////////////
	}
  ?>
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
}
mysqli_close($dbc);

?>
</body>
</html>