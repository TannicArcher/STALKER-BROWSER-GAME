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
$page_title = 'Напарники';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
  $user_id = $_SESSION['id'];
}
$clan_id = $_GET['company_id'];
$clan_id = mysqli_real_escape_string($dbc, trim($clan_id));	
if (empty($clan_id)) {
require_once('conf/notfound.php'); 
}
else {
  $query = "Select mentor, clan_opit, name from clans where clan_id = '$clan_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $row = mysqli_fetch_array($result);
  if ($row == 0) {
    require_once('conf/notfound.php'); 
  }
  else {
  ////////////Проверка на пользователя
  $query_num = "Select mentor_time, habar, money from users where clan = '$clan_id' and id = '$user_id'";
  $result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
  $total = mysqli_num_rows($result_num); 
  if ($total == 0) {
  require_once('conf/notfound.php');
  }
  else {
  ////////////////
    $row_num = mysqli_fetch_array($result_num);
	$money = $row_num['money'];
    $name = $row['name'];
	$mentor = $row['mentor'];
	$clan_opit = $row['clan_opit'];
	$habar = $row_num['habar'];
    ?>
    <div id="main">
    <div class="stats">
    <p class="podmenu"><?php
	  if ($row['gruppa'] == 'svoboda') {?><img src="img/ico/svoboda.png" width="12" height="12"/><?php }
	  if ($row['gruppa'] == 'dolg') {?><img src="img/ico/dolg.png" width="12" height="12"/><?php }
	  if ($row['gruppa'] == 'naemniki') {?><img src="img/ico/naemniki.png" width="12" height="12"/><?php } 
	  echo " Напарники отряда $name"; ?></p>
	</div>
	<div class="stats">
	<?php
	$query_lvl = "Select lvl, opit from clan_opit order by lvl desc";
	  $result_lvl = mysqli_query($dbc, $query_lvl) or die ('Ошибка передачи запроса к БД');
	  $row_lvl = mysqli_fetch_array($result_lvl);
	  $big_next_lvl = $row_lvl['opit'];
	  $lvl=$row_lvl['lvl'];
	  while (($clan_opit/1000)< $row_lvl['opit']) {
	  $next_lvl = $row_lvl['opit'];
	  $lvl=($lvl-1);
	  $row_lvl = mysqli_fetch_array($result_lvl);
	  }
	  if ($next_lvl == 0) {
	    $next_lvl = "$big_next_lvl" ;
	  } 
	$next_lvl = ($next_lvl/100);
	$need_habar = ($mentor * 100);
	?>
	<p><span class="white">Бонус: </span><span class="bonus"><?php echo "+$mentor"?>% к параметрам</span></p>
	</div>
	<?php
	$err = $_GET['err'];
	if (!empty($err)) {
	?>
	<div id="error">
	  <?php 
	  if ($err == 1) {echo "Недостаточно средств";}
	  if ($err == 2) {echo "Сначала поднимите уровень отряда";}
	  ?>
    </div>
	<?php
	}
	///
	$end = $_GET['end'];
	if (!empty($end)) {
	?>
	<div class="stats">
	<span class="bonus">
	  <?php 
	  if ($end == 1) {echo "Напарники успешно натренированы";}
	  ?>
	  </span>
    </div>
	<?php
	}
	///
	?>
	<div class="stats">
	<p><img src="img/ico/point.png" width="12" height="12"/> <a href="acceptmentor.php?mentor=1">Взять новичка</a> (<span class="bonus">+<?php $bon=($mentor/2); $bon = round($bon,1); echo "$bon";?>% к параметрам</span>) [<span class="white"><img src="img/ico/materials.png" width="12" height="12"/> <?php echo "$need_habar"?></span>]</p>
	<p><img src="img/ico/point.png" width="12" height="12"/> <a href="acceptmentor.php?mentor=2">Взять мастера</a> (<span class="bonus">+<?php echo "$mentor";?>% к параметрам</span>) [<span class="white"><img src="img/ico/money.png" width="12" height="12"/> <?php $bon=($mentor*20); echo "$bon"?></span>]</p>
	<?php 
	if ($lvl > $mentor) {
	$uphabar = (($mentor + 1)*150000)
	?>
	<p><img src="img/ico/top.png" width="12" height="12"/> <a href="upmentor.php">Тренировать напарников до нового уровня</a> [<span class="white"><img src="img/ico/materials.png" width="12" height="12"/> <?php
	echo "$uphabar"?></span>]</p>
	<?php
	}
	?>
	</div>
	<div class="stats">
	<p> [<span class="white"><img src="img/ico/materials.png" width="12" height="12"/><?php echo "$habar"?></span>] [<span class="white"><img src="img/ico/money.png" width="12" height="12"/><?php echo "$money"?></span>]</p>
	</div>
	<?php
  }
  
  }
}
?>
</div>
<?php
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/navig.php');
}
require_once('conf/foot.php');
mysqli_close($dbc);

?>
</body>
</html>