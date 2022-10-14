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

///////////////////////////////////////Все данные о локации
  if (empty($err)) {
    $err = $_GET['err'];
  }
  if (!empty($err)) {
    ?>
    <div id="error">
	  <?php 
	  if ($err == 8) {echo "Нельзя использовать аптечки так часто";}
	  if ($err == 7) {echo "Нужно захватить БП чтобы двигаться дальше";}
	  if ($err == 6) {echo "Нет оружия данного типа";}
	  if ($err == 5) {echo "У вас сломано оружиe";}
	  if ($err == 4) {echo "Своих атаковать нельзя";}
	  if ($err == 3) {echo "Оружие не готово";}
	  if ($err == 2) {echo "У вас нет аптечек";}
	  if ($err == 1) {echo "Вы не можете телепортироваться";}
	  ?>
    </div>
    <?php
  }
    $attack = $_GET['attack'];
	$attack = htmlentities($attack, ENT_QUOTES);
  $re_p = $_GET['re_p'];
  if ($lok_out <> 1) {
  if ($row_loc['bp_gruppa'] <> $us_gruppa) {
  ?>
  <p><?php
		if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	    if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/><?php }
	    if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="n"/><?php }?> 
    <a href="attack.php?attack=bp">Атаковать БП
<p><img src="img/ico/apte4ka.png" width="12" height="12" alt="m"/> <a href="uphealth.php">Использовать аптечку</a></p>	
    <?php
  if ($row_loc['bp_gruppa'] == 'dolg') { echo 'Долга'; }
  if ($row_loc['bp_gruppa'] == 'naemniki') { echo 'Одиночек'; }
  if ($row_loc['bp_gruppa'] == 'svoboda') { echo 'Свободы'; }?>
  </a>
  <?php
  if ($row_loc['bp_count_grouppa'] == $us_gruppa and $row_loc['bp_count_now'] <>0) { ?> (<?php echo $row_loc['bp_count_now'];?>/<?php echo $row_loc['bp_count'];?>)<?php }
  if ($row_loc['bp_count_grouppa'] <> $us_gruppa and $row_loc['bp_count_now'] <>0 ) { ?> (-<?php echo $row_loc['bp_count_now'];?>/<?php echo $row_loc['bp_count'];?>)<?php }
  if ($row_loc['bp_count_now'] == 0 ) { ?> (0/<?php echo $row_loc['bp_count'];?>)<?php }
  ?>
  </p>
  <?php
  }
  if (isset($attack)) {
  $gruppa = $row['gruppa']; 
  $query_att = "Select id, nick, hp, gruppa, max_hp, last_active, radiation, regen, antirad_time from users where id = '$attack' and location = '$location' and last_active > NOW() - (60*5) and hp != 0 and gruppa != '$gruppa' and ban != 1 limit 1";
  $result_att = mysqli_query($dbc, $query_att) or die ('Ошибка передачи запроса к БД5');
  $row_att = mysqli_fetch_array($result_att);
    if ($row_att != 0) {
	  $gruppa_us = $row_att['gruppa'];
	  $hp_us = $row_att['hp'];
	  $max_hp_us = $row_att['max_hp'];
	  $last_active_us = $row_att['last_active'];
	  $regen_us = $row_att['regen'];
	  $nick_us =  $row_att['nick'];
	  $radiation_us =  $row_att['radiation'];
	  $antirad_time_us =  $row_att['antirad_time'];
	  $now = (date("Y-m-d H:i:s"));
      $now = strtotime("$now");
   //HP атакованного
   $last_active_us = strtotime("$last_active_us");
   $hp_time_us = ($now - $last_active_us);
   if ($hp_time_us !=0) {
    $antirad_time_us = strtotime("$antirad_time_us");
    $time = (date("Y-m-d H:i:s"));
    $time = strtotime("$time");
    $antirad_time_us = ($time - $antirad_time_us);
    $hp_down_rad = ($radiation_us - $radiation_loc);
	if ($hp_down_rad < 0 and $antirad_time_us > 7200) { 
	  $regen_us = ($regen_us + $hp_down_rad);
	}
	$hp_up_us = ($hp_time_us * $regen_us);
    $hp_up_us = ($hp_us + $hp_up_us);
    if (($max_hp_us > $hp_up_us) and ($hp_up_us > 0)) {
	  $hp_us = $hp_up_us;
    }
    if ($hp_up_us > $max_hp_us) {
      $hp_us = $max_hp_us;
    }
  }
/////////////////////////////////////////
	  if ($row['speed_p'] != 0) {				
		?>
	    <p><img src="img/ico/pistol.png" alt="p" width="12" height="12"/> <a href="attack.php?rand=0&weapon=pistol&attack=<?php echo"$attack"; ?>">Напасть</a> <?php
		if ($gruppa_us == 'svoboda') {?><img src="img/ico/svoboda.png" width="12" height="12" alt="s"/><?php }
	    if ($gruppa_us == 'dolg') {?><img src="img/ico/dolg.png" width="12" height="12" alt="d"/><?php }
	    if ($gruppa_us == 'naemniki') {?><img src="img/ico/odinochki.png" width="12" height="12" alt="n"/><?php }?>
		<a href="profile.php?id=<?php echo"$attack"; ?>"><?php echo "[$nick_us]"; ?></a><?php 
		echo " ($hp_us)";?>
		</p>
	    <?php
	  }
	  if ($row['speed_w'] != 0) {?>
	  <p><img src="img/ico/avtomat.png" alt="a" width="12" height="12"/> <a href="attack.php?rand=0&weapon=avtomat&attack=<?php echo"$attack"; ?>">Напасть</a> <?php
		if ($gruppa_us == 'svoboda') {?><img src="img/ico/svoboda.png" width="12" height="12" alt="s"/><?php }
	    if ($gruppa_us == 'dolg') {?><img src="img/ico/dolg.png" width="12" height="12" alt="d"/><?php }
	    if ($gruppa_us == 'naemniki') {?><img src="img/ico/odinochki.png" width="12" height="12" alt="n"/><?php }?>
		<a href="profile.php?id=<?php echo"$attack"; ?>"><?php echo "[$nick_us]"; ?></a><?php 
		echo " ($hp_us)";?></p>
	    <?php
	  }
	}  
  }
    if ($number_naim != 0 and $row['gruppa'] != 'naemniki') {
  ?>
  <p><img src="img/ico/to4nost.png" width="12" height="12"/> <a href="attack.php?group=naemniki&rand=1">Напасть на "одиночек"</a></p>
  <?php
  }
  if ($number_dolg != 0 and $row['gruppa'] != 'dolg') {
  ?>
  <p><img src="img/ico/to4nost.png" width="12" height="12"/> <a href="attack.php?group=dolg&rand=1">Напасть на "долг"</a></p>
  <?php
  }
  if ($number_svoboda != 0 and $row['gruppa'] != 'svoboda') {
  ?>
  <p><img src="img/ico/to4nost.png" width="12" height="12"/> <a href="attack.php?group=svoboda&rand=1">Напасть на "свободу"</a></p>
  <?php
  }
  $query_number_mytants = "Select id from users where gruppa = 'mytants' and location = '$location' and  hp != 0 and ban != 1 limit 1";
  $result_number_mytants = mysqli_query($dbc, $query_number_mytants) or die ('Ошибка передачи запроса к БД'); 
  $number_mytants = mysqli_num_rows ($result_number_mytants);
  if (!empty($number_mytants)) {
	$number_mytants = mysqli_num_rows ($result_number_mytants);
    ?> <p><img src="img/ico/mytants.png" width="12" height="12" alt="m"/> <a href="attack.php?group=mytants&rand=1">Напасть на мутантов</a></p>
	<?php
  }
  $query_number_bandits = "Select id from users where gruppa = 'bandits' and location = '$location' and hp != 0 and ban != 1 limit 1";
  $result_number_bandits = mysqli_query($dbc, $query_number_bandits) or die ('Ошибка передачи запроса к БД'); 
  $number_bandits = mysqli_num_rows ($result_number_bandits);
  if (!empty($number_bandits)) {
	$number_bandits = mysqli_num_rows ($result_number_bandits);
    ?> <p><img src="img/ico/mytants.png" width="12" height="12" alt="m"/> <a href="attack.php?group=bandits&rand=1">Напасть на бандитов</a></p>
	<?php
  }
  $query_number_bandits = "Select id from users where gruppa = 'monolits' and location = '$location' and hp != 0 and ban != 1 limit 1";
  $result_number_bandits = mysqli_query($dbc, $query_number_bandits) or die ('Ошибка передачи запроса к БД'); 
  $number_bandits = mysqli_num_rows ($result_number_bandits);
  if (!empty($number_bandits)) {
	$number_bandits = mysqli_num_rows ($result_number_bandits);
    ?> <p><img src="img/ico/mytants.png" width="12" height="12" alt="m"/> <a href="attack.php?group=monolits&rand=1">Напасть на монолит</a></p>
	<?php
  }
   $query_number_bandits = "Select id from users where gruppa = 'zombie' and location = '$location' and hp != 0 and ban != 1 limit 1";
  $result_number_bandits = mysqli_query($dbc, $query_number_bandits) or die ('Ошибка передачи запроса к БД'); 
  $number_bandits = mysqli_num_rows ($result_number_bandits);
  if (!empty($number_bandits)) {
	$number_bandits = mysqli_num_rows ($result_number_bandits);
    ?> <p><img src="img/ico/mytants.png" width="12" height="12" alt="m"/> <a href="attack.php?group=zombie&rand=1">Напасть на зомби</a></p>
	<?php
  }
  }
  $need_health = ($max_health * 0.6);
  if (($health < $need_health) and (!empty($aptechki))) {
    $apt_time = $row['time_apt'];
    $apt_time = strtotime("$apt_time");
    $time = (date("Y-m-d H:i:s"));
    $time = strtotime("$time");
	$apt_time = ($time - $apt_time);
  ?> 
    <p><img src="img/ico/apte4ka.png" width="12" height="12"/> <a href="uphealth.php">Использовать аптечку 
	<?php 
	if ($apt_time <=60) { 
	$ttt = (60-$apt_time);
	echo "($ttt сек)"; }
	?></a></p>
  <?php
  }
  $antirad_time = $row['antirad_time'];
  $antirad_time = strtotime("$antirad_time");
  $time = (date("Y-m-d H:i:s"));
  $time = strtotime("$time");
  $antirad_time = ($time - $antirad_time);
  if ($hp_down_rad < 0 and $antirad_time > 7200 and $row['antirad'] <> 0) { 
  ?> 
    <p><img src="img/ico/antirad.png" width="12" height="12"/> <a href="useantirad.php">Использовать антирад</a></p>
  <?php
  }
///////////////////////////////////////Конец данным
?>