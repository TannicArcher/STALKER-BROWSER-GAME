<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "reg.php";
  </script>
  <?php
  exit();
}
$user_id = $_SESSION['id'];
$query = "Select gruppa, hp, max_hp, last_active, radiation, antirad_time, regen, opit, aptechki, speed_p, speed_w, antirad_time, antirad, location, time_apt from users where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД1');
$row = mysqli_fetch_array($result);
$health = $row['hp'];
if ($health == 0) {//Если здоровье равно 0, то ссылкаемся на смерть
  ?>
  <script type="text/javascript">
  document.location.href = "death.php";
  </script>
  <?php
  exit();
}
$max_health = $row['max_hp'];
$us_gruppa = $row['gruppa'];
$aptechki = $row['aptechki'];
$query_lvl = "Select lvl, opit from opit order by lvl desc";
$result_lvl = mysqli_query($dbc, $query_lvl) or die ('Ошибка передачи запроса к БД3');
$row_lvl = mysqli_fetch_array($result_lvl);
$us_lvl=$row_lvl['lvl'];
while (($row['opit']/100) < $row_lvl['opit']) {
  $us_lvl=($us_lvl-1);
  $row_lvl = mysqli_fetch_array($result_lvl);
}
$query_loc = "update users set location = 'base' where id = '$user_id' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД3');
////////////////////////////////////////////Названия локаций
$page_title = 'Деревня новичков';
$location = 'base';
/////////////////////////////////////////////////
///////////////////////////////Восстановление здоровья при переходе при старом счётчике
if ($location <> $us_location) {
	$hp = $row['hp'];
	$antirad_time = $row['antirad_time'];
	$antirad_time = strtotime("$antirad_time");
	$radiation = $row['radiation'];
	$regen = $row['regen'];
    $time_top = (date("Y-m-d H:i:s"));
    $time_top = strtotime("$time_top");
    $antirad_time = ($time_top - $antirad_time);
	$max_hp = $row['max_hp'];
    $last_active = $row['last_active'];
    $last_active = strtotime("$last_active");
    $hp_time = ($time_top - $last_active);
	if ($antirad_time > 7200) {
	  $query_loc = "select radiation from location where location_name = '$us_location' limit 1";
      $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД2');
      $row_loc = mysqli_fetch_array($result_loc);
      $radiation_loc = $row_loc['radiation'];
	  $hp_down_rad = ($radiation - $radiation_loc);
	  if ($hp_down_rad < 0) { 
	    $regen = ($regen + $hp_down_rad);
	  }
	  if ($hp_time !=0) {
      $hp_up = ($hp_time * $regen);
      $hp_up = ($hp + $hp_up);
	  if ($hp_up <= 0) {
	    $query_time_hp = "update users set hp = 0, last_active = NOW() where id = '$user_id' limit 1";
	    $result_time_hp = mysqli_query($dbc, $query_time_hp) or die ('Ошибка передачи запроса к БД');	
		$hp_search = 0;
	  }
      if (($max_hp > $hp_up) and ($hp_up > 0)) {
	    $query_time_hp = "update users set hp = '$hp_up', last_active = NOW() where id = '$user_id' limit 1";
	    $result_time_hp = mysqli_query($dbc, $query_time_hp) or die ('Ошибка передачи запроса к БД');	
		$hp_search = "$hp_up";
      }
      if ($hp_up > $max_hp) {
	    $query_time_hp = "update users set hp = '$max_hp', last_active = NOW() where id = '$user_id' limit 1";
	    $result_time_hp = mysqli_query($dbc, $query_time_hp) or die ('Ошибка передачи запроса к БД');
		$hp_search = "$max_hp";
      }
	    if ($hp_search == 0) {//Если здоровье равно 0, то ссылкаемся на смерть
         ?>
         <script type="text/javascript">
         document.location.href = "death.php";
         </script>
         <?php
         exit();
        }
	  }
    }
}

//////////////////////////////////////////////////


require_once('conf/head.php');
require_once('conf/top.php');
if ($hp<=0) {
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
exit();
}
$query_loc = "select count, lvl_need, lvl_to , count_now, bp_gruppa, bp_count, bp_count_now, bp_count_grouppa from location where location_name = 'base' limit 1";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД4');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
<div id="main">
<p class="podmenu"><?php 
if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  echo " $page_title"; ?></p>
  <p><img src="img/ico/bp.png" width="12" height="12" alt="s"/> <?php echo $row_loc['count_now']; echo '/'; echo $row_loc['count'];?></p> 
<?php
require_once('conf/count.php');
if ($row_loc['lvl_to'] < $us_lvl) {
?>
<div id="error">
Ваш уровень стал слишком высоким для этой локации
</div>
<?php
$lok_out=1;
} 
  if ($row_loc['lvl_need'] > $us_lvl) {
    ?>
    <script type="text/javascript">
    document.location.href = "zona.php?err=1";
    </script>
    <?php
    exit();
  }
//////////////////////РЕСПАВН БОТОВ
require_once('conf/rebot.php');
////////////////////////////////////
////////////////////// ДАННЫЕ О ЛОКАЦИИ
require_once('conf/loc.php');
///////////////////////////////////////
?><div class="stats"><?php
if ($us_gruppa == 'naemniki') {
?><p><img src="img/ico/out.png" width="12" height="12"/> <img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/> <a href="zona.php">Покинуть локацию</a></p><?php
}
if ($us_gruppa == 'dolg') {
?><p><img src="img/ico/out.png" width="12" height="12"/> <img src="img/ico/dolgon.png" width="12" height="12" alt="o"/> <a href="zona.php">Покинуть локацию</a></p><?php
}
if ($us_gruppa == 'svoboda') {
?><p><img src="img/ico/out.png" width="12" height="12"/> <img src="img/ico/svobodaon.png" width="12" height="12" alt="o"/> <a href="zona.php">Покинуть локацию</a></p><?php
}
if ($us_gruppa == 'mon') {
?><p><img src="img/ico/out.png" width="12" height="12"/> <img src="img/ico/monolit.png" width="12" height="12" alt="o"/> <a href="zona.php">Покинуть локацию</a></p><?php
}
?></div><?php


?>
</div>
<?php 
 require_once('conf/log.php');
 require_once('conf/navig.php');
 require_once('conf/foot.php');
 mysqli_close($dbc);
  ?>
</div>

</body>
</html>