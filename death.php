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
if ((!isset($_SESSION['id'])) and (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "reg.php?err_login=1";
  </script>
  <?php
}
$user_id = $_SESSION['id'];
$query = "Select hp, location, max_hp, sost_p, sost_w, sost_cl from users where id = '$user_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД1');
$row = mysqli_fetch_array($result);
$hp = $row['hp'];
$max_hp = $row['max_hp'];
$us_loc = $row['location'];
$re = $_GET['re'];
if (!empty($re)) {
   if ($hp <= 0) {
    $sost_p = $row['sost_p'];
	if ($sost_p>0) {
	  $sost_p = ($sost_p - 1);
	}
	$sost_w = $row['sost_w'];
	if ($sost_w>0) {
	  $sost_w = ($sost_w - 1);
	}
	$sost_cl = $row['sost_cl'];
	if ($sost_cl>0) {
	  $sost_cl = ($sost_cl - 1);
	}
    $query = "update users set hp = '$max_hp', location = 'index', sost_cl = '$sost_cl', sost_p = '$sost_p', sost_w = '$sost_w' where id = '$user_id'";
	$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////
	$query = "update things set sost = '$sost_cl' where user_id = '$user_id' and type = 1 and place=2";
	 $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	 $query = "update things set sost = '$sost_p' where user_id = '$user_id' and type = 2 and place=2";
	 $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	 $query = "update things set sost = '$sost_w' where user_id = '$user_id' and type = 3 and place=2";
	 $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	}
	if ($us_loc == 'monster1' or $us_loc == 'monster2' or $us_loc == 'monster3' or $us_loc == 'monster4') {
	  $m = $_GET['m'];
	  header ('Location: monster.php?m=' . "$m");
	}
	////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
    ?>
    <script type="text/javascript">
    document.location.href = "zona.php";
    </script>
  <?php
 }
if ($hp == 0) {
  $page_title = 'Смерть';
  require_once('conf/head.php');
  require_once('conf/top.php');
  ?>
  <div id="main">
  <div id="error">Вас убили</div>
  <div class="stats"> 
  <p><img src="img/ico/point.png" width="12" height="12"/> <a href="death.php?re=1">Восстановиться</a></p>
  </div>
  </div>
  <?php
 require_once('conf/log.php');
require_once('conf/navig.php');
require_once('conf/foot.php');
}
else {
  ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
  <?php
}
mysqli_close($dbc);

?>
</body>
</html>
