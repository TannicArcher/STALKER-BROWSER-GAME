<?php
$tratata1 = '1000000000000000001';
$tratata = '1000000000000000000';
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
  header ('Location: reg.php?err_login=1');
mysqli_close($dbc);
exit();
}

//Если существует сессия
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
//Извлекаем нужные данные о пользователе
$user_id = $_SESSION['id'];
$query_user = "Select gruppa, activ, invite, antirad_time, opit, lvl, location, radiation,razriv_cl, safety_p, safety_w, regen, hp, max_hp, last_active, clan, invite, ko, mentor_time, mentor_type, bronya, sost_cl, yron_p, tochn_p, speed_p, sost_p, time_p, yron_w, tochn_w, speed_w, sost_w, time_w, m_fight from users where id = '$user_id' limit 1";
$result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД1');
$row_user = mysqli_fetch_array($result_user);
$gruppa_user = $row_user['gruppa'];
$regen_user = $row_user['regen'];
$antirad_time_user = $row_user['antirad_time'];
$activ_user = $row_user['activ'];
$invite_user = $row_user['invite'];
$opit_user = $row_user['opit'];
$location_user = $row_user['location'];
$hp_user = $row_user['hp'];
$max_hp_user = $row_user['max_hp'];
$last_active_user = $row_user['last_active'];
$clan_user = $row_user['clan'];
$ko_user = $row_user['ko'];
$invite_user = $row_user['invite'];
$mentor_time_user = $row_user['mentor_time'];
$mentor_type_user = $row_user['mentor_type'];
$bronya_user = $row_user['bronya'];
$bonus_cl_user = $row_user['bonus_cl'];
$sost_br_user = $row_user['sost_cl'];
$lvl_user_bd = $row_user['lvl'];
$radiation_user = $row_user['radiation'];
$m_fight = $row_user['m_fight'];
/////////////////////////////////////////
if ($location_user == 'index') {
  ?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
  <?php
  mysqli_close($dbc);
  exit();
}
//////////////////////////////////////////////////АТАКА МОНСТРА НА РЕЙДЕ
if ($location_user == 'monster1' or $location_user == 'monster2' or $location_user == 'monster3' or $location_user == 'monster4' or $location_user == 'monster5' or $location_user == 'monster6' or $location_user == 'monster7' or $location_user == 'monster8' or $location_user == 'monster9' or $location_user == 'monster10') {
  if ($location_user == 'monster1') {$m = 1;}
  if ($location_user == 'monster2') {$m = 2;}
  if ($location_user == 'monster3') {$m = 3;}
  if ($location_user == 'monster4') {$m = 4;}
  if ($location_user == 'monster5') {$m = 5;}
  if ($location_user == 'monster6') {$m = 6;}
  if ($location_user == 'monster7') {$m = 7;}
  if ($location_user == 'monster8') {$m = 8;}
  if ($location_user == 'monster9') {$m = 9;}
  if ($location_user == 'monster10') {$m = 10;}
  if ($hp_user <= 0) {//Если здоровье равно 0, то ссылкаемся на смерть
  header ('Location: monster.php?m=' . "$m");
  mysqli_close($dbc);
exit();
  }
  $query_isset = "Select id_monster, hp, start, last_active, time_start, clan_id from m_fight where id_fight= '$m_fight' limit 1";
  $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД2');
  $row_isset = mysqli_fetch_array($result_isset);
  if (!empty($row_isset)) {
    if ($row_isset['hp']<=0) {
	  header ('Location: monster.php?m=' . "$m" );
	  $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing`) values (NOW(), '$user_id', 3 , 0)";
      $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД4');  
      mysqli_close($dbc);
exit();
	}
	if ($row_isset['start'] <> 1) {
	  header ('Location: monster.php?m=' . "$m");
      mysqli_close($dbc);
exit();
	}
    $query_m = "Select max_hp, bronya, bonus_type, clan, max_people from monsters where id_monster = '$m' limit 1";
    $result_m = mysqli_query($dbc, $query_m) or die ('Ошибка передачи запроса к БД2');
    $row_m = mysqli_fetch_array($result_m);
	$weapon = $_GET['weapon'];
	$max_people = $row_m['max_people'];
	$max_hp_m = $row_m['max_hp'];
	if (empty($weapon)) {
	  $weapon='pistol';
	}
	else {
	  if ($weapon <> 'pistol' and $weapon <> 'avtomat') {
	    $weapon='pistol';
	  }
	}
	if ($weapon == 'pistol') {
	  $yron_wp=$row_user['yron_p'];
	  $tochn_wp=$row_user['tochn_p'];
	  $speed=$row_user['speed_p'];
	  $sost = $row_user['sost_p'];
	  $safety = $row_user['safety_p'];
	  $last_using = $row_user['time_p'];
	}
	if ($weapon == 'avtomat') {
	  $yron_wp=$row_user['yron_w'];
	  $tochn_wp=$row_user['tochn_w'];
	  $speed=$row_user['speed_w'];
	  $sost = $row_user['sost_w'];
	  $safety = $row_user['safety_w'];
	  $last_using = $row_user['time_w'];
	}
	if ($sost <= 0) {
	  header ('Location: monster.php?m=' . "$m" . '&err=1');
      mysqli_close($dbc);
exit();
	}
	if ($speed <= 0) {
	  header ('Location: monster.php?m=' . "$m" . '&err=2');
      mysqli_close($dbc);
exit();
	}
	$last_using = strtotime("$last_using");
    $razn = ($now - $last_using);
    if ($razn < $speed) {
	  header ('Location: monster.php?m=' . "$m" . '&err=3');
      mysqli_close($dbc);
exit(); 
	}	
	$nadeg = rand(0,70);
    if ($safety <= $nadeg) {
	  header ('Location: monster.php?m=' . "$m");
	  $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing`) values (NOW(), '$user_id', 8 , 0)";
      $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД4');  
      mysqli_close($dbc);
exit();
	}
	
	
	
	
	
	if (!empty($clan_user)) {
  $query_clan = "Select clan_opit, mentor, people from clans where clan_id = '$clan_user' limit 1";
  $result_clan = mysqli_query($dbc, $query_clan) or die ('Ошибка передачи запроса к БД10');
  $row_clan = mysqli_fetch_array($result_clan);
  $clan_opit_user = $row_clan['clan_opit'];
  $mentor_user = $row_clan['mentor'];
  $people_user = $row_clan['people'];
}

////////На наличие наставника
if (!empty($clan_user)) {
$mentor_time_user = strtotime("$mentor_time_user");
$razn_mentor_user = ($now - $mentor_time_user);
if ($razn_mentor_user < 3600) {
  if ($mentor_type_user == 1) { 
    $mentor_user = ($mentor_user / 2);
  }
  $yron_wp = ($yron_wp + ($yron_wp/100 * $mentor_user));
  $tochn_wp = ($tochn_wp + ($tochn_wp/100 * $mentor_user));
  $yron_wp = round ($yron_wp);
  $tochn_wp = round ($tochn_wp);
}
}

/////////////////////////////////
$p = rand(345000,375000);
$p = ($p/1000000);////Коэффициент
$bronya = $row_m['bronya'];
  $attack_user = ((($yron_wp * $tochn_wp) /$bronya) * $p);
  $attack_user = round ($attack_user);
  
////Опыт
$opit_pl = ($attack_user*6);
$opit_pl = round($opit_pl);
if ($opit_pl < 1) {
  $opit_user = ($opit_user + 1);
}
else {
  $opit_user = ($opit_user + $opit_pl);
}  
////////////
////Автивность
$activ_pl = ($attack_user);
$activ_pl = round($activ_pl);
if ($activ_pl < 1) {
  $activ_user = ($activ_user + 1);
}
else {
  $activ_user = ($activ_user + $activ_pl);
}  
////////////
   
/////клан опыт
if (!empty($clan_user)) {

  $clan_opit_pl = (($opit_pl)/(sqrt($people_user)));
  $clan_opit_pl = round($clan_opit_pl);
  $clan_opit = ($clan_opit_user + $clan_opit_pl);
  $ko_user = ($ko_user + $clan_opit_pl);
}
if (!empty($clan_user)) {
	$query_clan = "update clans set clan_opit = clan_opit+'$clan_opit_pl' where clan_id = '$clan_user'";
	$result_clan = mysqli_query($dbc, $query_clan) or die ('Ошибка передачи запроса к БД17');
}
$query_lvl = "Select lvl, opit from opit order by lvl desc";
$result_lvl = mysqli_query($dbc, $query_lvl) or die ('Ошибка передачи запроса к БД3');
$row_lvl = mysqli_fetch_array($result_lvl);
$lvl_user=$row_lvl['lvl'];
while (($opit_user/100) < $row_lvl['opit']) {
  $lvl_user=($lvl_user-1);
  $row_lvl = mysqli_fetch_array($result_lvl);
}
if ($lvl_user_bd<$lvl_user) {
      $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing` , `yron`) values (NOW(), '$user_id', 6 , '0', '$lvl_user')";
      $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД21');
}
$query_a = "update m_inf set active=active+'$activ_pl' where user_id='$user_id' and monster_id='$m' limit 1";
$result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД22');
////////////////////
if ($weapon == 'avtomat') {
  if ($opit_user < $tratata1) {
    $query_re_wp = "update users set activ = '$activ_user', opit = '$opit_user', lvl='$lvl_user', ko = '$ko_user', hp = '$hp_user', last_active = NOW(), time_w = NOW() where id = '$user_id' limit 1";
	$result_re_wp = mysqli_query($dbc, $query_re_wp) or die ('Ошибка передачи запроса к БД22');
  } 
  else {
  $query_re_wp = "update users set activ = '$activ_user', opit = '$tratata', lvl='$lvl_user', ko = '$ko_user', hp = '$hp_user', last_active = NOW(), time_w = NOW() where id = '$user_id' limit 1";
  $result_re_wp = mysqli_query($dbc, $query_re_wp) or die ('Ошибка передачи запроса к БД22');
  }
}
else {
  if ($opit_user < $tratata1) {
  $query_re_wp = "update users set activ = '$activ_user', opit = '$opit_user', lvl='$lvl_user', ko = '$ko_user', hp = '$hp_user', last_active = NOW(), time_p = NOW() where id = '$user_id' limit 1";
  $result_re_wp = mysqli_query($dbc, $query_re_wp) or die ('Ошибка передачи запроса к БД23');
  } 
  else {
  $query_re_wp = "update users set activ = '$activ_user', opit = '$tratata', lvl='$lvl_user', ko = '$ko_user', hp = '$hp_user', last_active = NOW(), time_p = NOW() where id = '$user_id' limit 1";
  $result_re_wp = mysqli_query($dbc, $query_re_wp) or die ('Ошибка передачи запроса к БД23');
  }
}

///////////////////////////Атака на монстра
$hp = ($row_isset['hp'] - $attack_user);
if ($hp>0) {
  $query_re_wp = "update m_fight set hp=$hp where id_fight = '$m_fight' limit 1";
  $result_re_wp = mysqli_query($dbc, $query_re_wp) or die ('Ошибка передачи запроса к БД23');
  $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing` , `yron`) values (NOW(), '$user_id', 12 , '$m', '$attack_user')";
  $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД21');
}
else {
   if ($row_m['bonus_type'] == 3) {
	  //////ХАБАР
	$rand_n = rand(300,600);
	$query_att = "Select id from users where m_fight = '$m_fight' and hp > 0 and last_active > NOW() - 60 and ban != 1 and m_fight = '$m_fight' limit $max_people";
    $result_att = mysqli_query($dbc, $query_att) or die ('Ошибка передачи запроса к БД74a'); 
    $count_att = mysqli_num_rows($result_att);
	$row_att = mysqli_fetch_array($result_att);
	$rrr=rand(1,$count_att);
	$nnn=1;
	  while ($rrr <> $nnn) {
	    $row_att = mysqli_fetch_array($result_att);
		$nnn=$nnn+1;
	  }
	  $id_att = $row_att['id'];
	  $query_a = "update users set habar=habar+$rand_n , m_kill=m_kill+1 where id='$id_att' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  $query_a = "update m_inf set thing_id='$rand_n' where user_id='$id_att' and monster_id='$m' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
     }





   if ($row_m['bonus_type'] == 5) {
	  //////ХАБАР
	$rand_n = rand(1500,3000);
	$query_att = "Select id from users where m_fight = '$m_fight' and hp > 0 and last_active > NOW() - 60 and ban != 1 and m_fight = '$m_fight' limit $max_people";
    $result_att = mysqli_query($dbc, $query_att) or die ('Ошибка передачи запроса к БД74a'); 
    $count_att = mysqli_num_rows($result_att);
	$row_att = mysqli_fetch_array($result_att);
	$rrr=rand(1,$count_att);
	$nnn=1;
	  while ($rrr <> $nnn) {
	    $row_att = mysqli_fetch_array($result_att);
		$nnn=$nnn+1;
	  }
	  $id_att = $row_att['id'];
	  $query_a = "update users set habar=habar+$rand_n , m_kill=m_kill+1 where id='$id_att' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  $query_a = "update m_inf set thing_id='$rand_n' where user_id='$id_att' and monster_id='$m' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
     }




  if ($row_m['bonus_type'] == 6) {
	  //////РУБ
	$rand_r = rand(15,35);
	$query_att = "Select id from users where m_fight = '$m_fight' and hp > 0 and last_active > NOW() - 60 and ban != 1 and m_fight = '$m_fight' limit $max_people";
    $result_att = mysqli_query($dbc, $query_att) or die ('Ошибка передачи запроса к БД74a'); 
    $count_att = mysqli_num_rows($result_att);
	$row_att = mysqli_fetch_array($result_att);
	$rrr=rand(1,$count_att);
	$nnn=1;
	  while ($rrr <> $nnn) {
	    $row_att = mysqli_fetch_array($result_att);
		$nnn=$nnn+1;
	  }
	  $id_att = $row_att['id'];
	  $query_a = "update users set money=money+$rand_r , m_kill=m_kill+1 where id='$id_att' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  $query_a = "update m_inf set thing_id='$rand_r' where user_id='$id_att' and monster_id='$m' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
     }



  if ($row_m['bonus_type'] == 7) {
	  //////опыт
	$rand_o = rand(100000,250000);
	$query_att = "Select id from users where m_fight = '$m_fight' and hp > 0 and last_active > NOW() - 60 and ban != 1 and m_fight = '$m_fight' limit $max_people";
    $result_att = mysqli_query($dbc, $query_att) or die ('Ошибка передачи запроса к БД74a'); 
    $count_att = mysqli_num_rows($result_att);
	$row_att = mysqli_fetch_array($result_att);
	$rrr=rand(1,$count_att);
	$nnn=1;
	  while ($rrr <> $nnn) {
	    $row_att = mysqli_fetch_array($result_att);
		$nnn=$nnn+1;
	  }
	  $id_att = $row_att['id'];
	  $query_a = "update users set opit=opit+$rand_o , m_kill=m_kill+1 where id='$id_att' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  $query_a = "update m_inf set thing_id='$rand_o' where user_id='$id_att' and monster_id='$m' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
     }




    if ($row_m['bonus_type'] == 1) {
	  //////Ветеранские шмотки (низкие)
	$rand_n = rand(1,3);
	if ($rand_n==1) {/////////////Одежда
	  $query_c = "Select clothes_id, max_stats_bronya, min_stats_bronya, max_stats_hp, min_stats_hp, max_stats_rad, min_stats_rad, max_stats_razriv, min_stats_razriv, lvl_need from clothes where clothes_id=2 or clothes_id=3 or clothes_id=4 or clothes_id=1";
	  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД74'); 
	  $count_c = mysqli_num_rows($result_c);
	  $row_c = mysqli_fetch_array($result_c);
	  $type=1;
	}
	if ($rand_n==2) {/////////////pistol
	  $query_c = "Select pistols_id, max_stats_yron, min_stats_yron, max_stats_tochn, min_stats_tochn, min_stats_safety, max_stats_safety, lvl_need, speed from pistols where pistols_id=3 or pistols_id=2 or pistols_id=1";
	  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД74'); 
	  $count_c = mysqli_num_rows($result_c);
	  $row_c = mysqli_fetch_array($result_c);
	  $type=2;
	}
	if ($rand_n==3) {/////////////weapon
	  $query_c = "Select weapons_id, max_stats_yron, min_stats_yron, max_stats_tochn, min_stats_tochn, min_stats_safety, max_stats_safety, lvl_need, speed from weapons where weapons_id=14 or weapons_id=13 or weapons_id=15";
	  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД74d'); 
	  $count_c = mysqli_num_rows($result_c);
	  $row_c = mysqli_fetch_array($result_c);
	  $type=3;
	}
	$rand_n = rand(1,$count_c);
	$z=1;
	while ($z <> $rand_n) {
	  $row_c = mysqli_fetch_array($result_c);
	  $z=$z+1;
	}
	if ($type==1) {
	  $inf_id = $row_c['clothes_id'];
	  $stat1=rand($row_c['min_stats_hp'],$row_c['max_stats_hp']);
	  $stat2=rand($row_c['min_stats_bronya'],$row_c['max_stats_bronya']);
	  $stat3=rand($row_c['min_stats_razriv'],$row_c['max_stats_razriv']);
	  $speed=rand($row_c['min_stats_rad'],$row_c['max_stats_rad']);
	}
	if ($type==2) {
	  $inf_id = $row_c['pistols_id'];
	  $stat1=rand($row_c['min_stats_yron'],$row_c['max_stats_yron']);
	  $stat2=rand($row_c['min_stats_tochn'],$row_c['max_stats_tochn']);
	  $stat3=rand($row_c['min_stats_safety'],$row_c['max_stats_safety']);
	  $speed=$row_c['speed'];
	}
	if ($type==3) {
	  $inf_id = $row_c['weapons_id'];
	  $stat1=rand($row_c['min_stats_yron'],$row_c['max_stats_yron']);
	  $stat2=rand($row_c['min_stats_tochn'],$row_c['max_stats_tochn']);
	  $stat3=rand($row_c['min_stats_safety'],$row_c['max_stats_safety']);
	  $speed=$row_c['speed'];
	}
	$lvl_need=$row_c['lvl_need'];
	$query_att = "Select id from users where m_fight = '$m_fight' and hp > 0 and last_active > NOW() - 60 and ban != 1 and m_fight = '$m_fight' limit $max_people";
    $result_att = mysqli_query($dbc, $query_att) or die ('Ошибка передачи запроса к БД74a'); 
    $count_att = mysqli_num_rows($result_att);
	$row_att = mysqli_fetch_array($result_att);
	$rrr=rand(1,$count_att);
	$nnn=1;
	  while ($rrr <> $nnn) {
	    $row_att = mysqli_fetch_array($result_att);
		$nnn=$nnn+1;
	  }
	  $id_att = $row_att['id'];
	  $query = "Select thing_id from things where user_id='$id_att' and place=0 limit 20";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
      $total = mysqli_num_rows($result);
	  if ($total<20) {
	  $query_att = "insert into things (`user_id`, `type`, `inf_id`, `stat1`, `upgrade_stat1`, `stat2`, `upgrade_stat2`, `stat3`, `upgrade_stat3`, `speed`, `upgrade_speed`, `sost`, `privat`, `place`, `need_lvl`) values ('$id_att', '$type', '$inf_id', '$stat1', 0, '$stat2', 0, '$stat3', 0, '$speed', 0, 1, 1, 0, '$lvl_need')";
	  $result_att = mysqli_query($dbc, $query_att) or die ('Ошибка передачи запроса к БД1010'); 
	  $query_a = "select thing_id from things where user_id='$id_att' and inf_id='$inf_id' and type='$type' and stat1='$stat1' and stat2='$stat2' and stat3='$stat3' and place=0 limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД225');
	  $row_a = mysqli_fetch_array($result_a);
	  $thing_id= $row_a['thing_id'];
	  $query_a = "update m_inf set thing_id='$thing_id' where user_id='$id_att' and monster_id='$m' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  $query_a = "update users set m_kill=m_kill+1 where id='$id_att' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  }
	  else {
	    $query_a = "update m_inf set thing_id='-1' where user_id='$id_att' and monster_id='$m' limit 1";
        $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  $query_a = "update users set m_kill=m_kill+1 where id='$id_att' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  }
     }
	if ($row_m['bonus_type'] == 2) {
	    //////Легендарные вещи шмотки (низкие)
	$rand_n = rand(1,2);
	if ($rand_n==1) {/////////////Одежда
	  $query_c = "Select clothes_id, max_stats_bronya, min_stats_bronya, max_stats_hp, min_stats_hp, max_stats_rad, min_stats_rad, max_stats_razriv, min_stats_razriv, lvl_need from clothes where klass=3";
	  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД444'); 
	  $count_c = mysqli_num_rows($result_c);
	  $row_c = mysqli_fetch_array($result_c);
	  $type=1;
	}
	if ($rand_n==2) {/////////////pistol
	  $query_c = "Select pistols_id, max_stats_yron, min_stats_yron, max_stats_tochn, min_stats_tochn, min_stats_safety, max_stats_safety, lvl_need, speed from pistols where klass=3";
	  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД333'); 
	  $count_c = mysqli_num_rows($result_c);
	  $row_c = mysqli_fetch_array($result_c);
	  $type=2;
	}
	if ($rand_n==3) {/////////////weapon
	  $query_c = "Select weapons_id, max_stats_yron, min_stats_yron, max_stats_tochn, min_stats_tochn, min_stats_safety, max_stats_safety, lvl_need, speed from weapons where klass=3";
	  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД222'); 
	  $count_c = mysqli_num_rows($result_c);
	  $row_c = mysqli_fetch_array($result_c);
	  $type=3;
	}
	$rand_n = rand(1,$count_c);
	$z=1;
	while ($z <> $rand_n) {
	  $row_c = mysqli_fetch_array($result_c);
	  $z=$z+1;
	}
	if ($type==1) {
	  $inf_id = $row_c['clothes_id'];
	  $stat1=rand($row_c['min_stats_hp'],$row_c['max_stats_hp']);
	  $stat2=rand($row_c['min_stats_bronya'],$row_c['max_stats_bronya']);
	  $stat3=rand($row_c['min_stats_razriv'],$row_c['max_stats_razriv']);
	  $speed=rand($row_c['min_stats_rad'],$row_c['max_stats_rad']);
	}
	if ($type==2) {
	  $inf_id = $row_c['pistols_id'];
	  $stat1=rand($row_c['min_stats_yron'],$row_c['max_stats_yron']);
	  $stat2=rand($row_c['min_stats_tochn'],$row_c['max_stats_tochn']);
	  $stat3=rand($row_c['min_stats_safety'],$row_c['max_stats_safety']);
	  $speed=$row_c['speed'];
	}
	if ($type==3) {
	  $inf_id = $row_c['weapons_id'];
	  $stat1=rand($row_c['min_stats_yron'],$row_c['max_stats_yron']);
	  $stat2=rand($row_c['min_stats_tochn'],$row_c['max_stats_tochn']);
	  $stat3=rand($row_c['min_stats_safety'],$row_c['max_stats_safety']);
	  $speed=$row_c['speed'];
	}
	$lvl_need=$row_c['lvl_need'];
	$query_att = "Select id from users where m_fight = '$m_fight' and hp > 0 and last_active > NOW() - (60*5) and ban != 1 and m_fight = '$m_fight' order by clan_rang DESC, ko DESC limit $max_people";
    $result_att = mysqli_query($dbc, $query_att) or die ('Ошибка передачи запроса к БД111'); 
    $count_att = mysqli_num_rows($result_att);
	$row_att = mysqli_fetch_array($result_att);
	  $id_att = $row_att['id'];
	  $query = "Select thing_id from things where user_id='$id_att' and place=0 limit 20";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
      $total = mysqli_num_rows($result);
	  if ($total<20) {
	  $query_att = "insert into things (`user_id`, `type`, `inf_id`, `stat1`, `upgrade_stat1`, `stat2`, `upgrade_stat2`, `stat3`, `upgrade_stat3`, `speed`, `upgrade_speed`, `sost`, `privat`, `place`, `need_lvl`) values ('$id_att', '$type', '$inf_id', '$stat1', 0, '$stat2', 0, '$stat3', 0, '$speed', 0, 1, 0, 0, '$lvl_need')";
	  $result_att = mysqli_query($dbc, $query_att) or die ('Ошибка передачи запроса к БД742'); 
	  $query_a = "select thing_id from things where user_id='$id_att' and inf_id='$inf_id' and type='$type' and stat1='$stat1' and stat2='$stat2' and stat3='$stat3' and place=0 limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД225');
	  $row_a = mysqli_fetch_array($result_a);
	  $thing_id2= $row_a['thing_id'];
	  $query_a = "update m_inf set thing_id='$thing_id2' where user_id='$id_att' and monster_id='$m' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  $query_a = "update users set m_kill=m_kill+1 where id='$id_att' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  }
	  else {
	    $query_a = "update m_inf set thing_id='-1' where user_id='$id_att' and monster_id='$m' limit 1";
        $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  $query_a = "update users set m_kill=m_kill+1 where id='$id_att' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  }
	  //////Ветеранские шмотки (низкие)
	$rand_n = rand(1,3);
	if ($rand_n==1) {/////////////Одежда
	  $query_c = "Select clothes_id, max_stats_bronya, min_stats_bronya, max_stats_hp, min_stats_hp, max_stats_rad, min_stats_rad, max_stats_razriv, min_stats_razriv, lvl_need from clothes where klass=3";
	  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД999'); 
	  $count_c = mysqli_num_rows($result_c);
	  $row_c = mysqli_fetch_array($result_c);
	  $type=1;
	}
	if ($rand_n==2) {/////////////pistol
	  $query_c = "Select pistols_id, max_stats_yron, min_stats_yron, max_stats_tochn, min_stats_tochn, min_stats_safety, max_stats_safety, lvl_need, speed from pistols where klass=3";
	  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД888'); 
	  $count_c = mysqli_num_rows($result_c);
	  $row_c = mysqli_fetch_array($result_c);
	  $type=2;
	}
	if ($rand_n==3) {/////////////weapon
	  $query_c = "Select weapons_id, max_stats_yron, min_stats_yron, max_stats_tochn, min_stats_tochn, min_stats_safety, max_stats_safety, lvl_need, speed from weapons where klass=3";
	  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД777'); 
	  $count_c = mysqli_num_rows($result_c);
	  $row_c = mysqli_fetch_array($result_c);
	  $type=3;
	}
	$rand_n = rand(1,$count_c);
	$z=1;
	while ($z <> $rand_n) {
	  $row_c = mysqli_fetch_array($result_c);
	  $z=$z+1;
	}
	if ($type==1) {
	  $inf_id = $row_c['clothes_id'];
	  $stat1=rand($row_c['min_stats_hp'],$row_c['max_stats_hp']);
	  $stat2=rand($row_c['min_stats_bronya'],$row_c['max_stats_bronya']);
	  $stat3=rand($row_c['min_stats_razriv'],$row_c['max_stats_razriv']);
	  $speed=rand($row_c['min_stats_rad'],$row_c['max_stats_rad']);
	}
	if ($type==2) {
	  $inf_id = $row_c['pistols_id'];
	  $stat1=rand($row_c['min_stats_yron'],$row_c['max_stats_yron']);
	  $stat2=rand($row_c['min_stats_tochn'],$row_c['max_stats_tochn']);
	  $stat3=rand($row_c['min_stats_safety'],$row_c['max_stats_safety']);
	  $speed=$row_c['speed'];
	}
	if ($type==3) {
	  $inf_id = $row_c['weapons_id'];
	  $stat1=rand($row_c['min_stats_yron'],$row_c['max_stats_yron']);
	  $stat2=rand($row_c['min_stats_tochn'],$row_c['max_stats_tochn']);
	  $stat3=rand($row_c['min_stats_safety'],$row_c['max_stats_safety']);
	  $speed=$row_c['speed'];
	}
	$lvl_need=$row_c['lvl_need'];
	$query_att = "Select id from users where m_fight = '$m_fight' and hp > 0 and last_active > NOW() - (60*5) and ban != 1 and m_fight = '$m_fight' order by clan_rang DESC, ko DESC limit $max_people";
    $result_att = mysqli_query($dbc, $query_att) or die ('Ошибка передачи запроса к БД666'); 
    $count_att = mysqli_num_rows($result_att);
	$row_att = mysqli_fetch_array($result_att);
	  $id_att = $row_att['id'];
	  $query = "Select thing_id from things where user_id='$id_att' and place=0 limit 20";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
      $total = mysqli_num_rows($result);
	  if ($total<20) {
	  $query_att = "insert into things (`user_id`, `type`, `inf_id`, `stat1`, `upgrade_stat1`, `stat2`, `upgrade_stat2`, `stat3`, `upgrade_stat3`, `speed`, `upgrade_speed`, `sost`, `privat`, `place`, `need_lvl`) values ('$id_att', '$type', '$inf_id', '$stat1', 0, '$stat2', 0, '$stat3', 0, '$speed', 0, 1, 0, 0, '$lvl_need')";
	  $result_att = mysqli_query($dbc, $query_att) or die ('Ошибка передачи запроса к БД555'); 
	  $query_a = "select thing_id from things where user_id='$id_att' and inf_id='$inf_id' and type='$type' and stat1='$stat1' and stat2='$stat2' and stat3='$stat3' and place=0 limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД225');
	  $row_a = mysqli_fetch_array($result_a);
	  $thing_id1= $row_a['thing_id'];
	  $query_a = "update m_inf set thing_id2='$thing_id1' where user_id='$id_att' and monster_id='$m' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  $query_a = "update users set m_kill=m_kill+1 where id='$id_att' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  }
	  else {
	    $query_a = "update m_inf set thing_id2='-1' where user_id='$id_att' and monster_id='$m' limit 1";
        $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  $query_a = "update users set m_kill=m_kill+1 where id='$id_att' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  }
     }
	 
	 if ($row_m['bonus_type'] == 4) {
	    //////Легендарные вещи шмотки (низкие)
	$rand_n = rand(1,3);
	if ($rand_n==1) {/////////////Одежда
	  $query_c = "Select clothes_id, max_stats_bronya, min_stats_bronya, max_stats_hp, min_stats_hp, max_stats_rad, min_stats_rad, max_stats_razriv, min_stats_razriv, lvl_need from clothes where klass=4 and clothes_id!=13 and clothes_id!=12";
	  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД444'); 
	  $count_c = mysqli_num_rows($result_c);
	  $row_c = mysqli_fetch_array($result_c);
	  $type=1;
	}
	if ($rand_n==2) {/////////////pistol
	  $query_c = "Select pistols_id, max_stats_yron, min_stats_yron, max_stats_tochn, min_stats_tochn, min_stats_safety, max_stats_safety, lvl_need, speed from pistols where klass=4 and pistols_id!=9 and pistols_id!=8";
	  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД333'); 
	  $count_c = mysqli_num_rows($result_c);
	  $row_c = mysqli_fetch_array($result_c);
	  $type=2;
	}
	if ($rand_n==3) {/////////////weapon
	  $query_c = "Select weapons_id, max_stats_yron, min_stats_yron, max_stats_tochn, min_stats_tochn, min_stats_safety, max_stats_safety, lvl_need, speed from weapons where klass=4 and weapons_id!=17 and weapons_id!=18 and weapons_id!=19  and weapons_id!=12 and weapons_id!=20";
	  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД222'); 
	  $count_c = mysqli_num_rows($result_c);
	  $row_c = mysqli_fetch_array($result_c);
	  $type=3;
	}
	$rand_n = rand(1,$count_c);
	$z=1;
	while ($z <> $rand_n) {
	  $row_c = mysqli_fetch_array($result_c);
	  $z=$z+1;
	}
	if ($type==1) {
	  $inf_id = $row_c['clothes_id'];
	  $stat1=rand($row_c['min_stats_hp'],$row_c['max_stats_hp']);
	  $stat2=rand($row_c['min_stats_bronya'],$row_c['max_stats_bronya']);
	  $stat3=rand($row_c['min_stats_razriv'],$row_c['max_stats_razriv']);
	  $speed=rand($row_c['min_stats_rad'],$row_c['max_stats_rad']);
	}
	if ($type==2) {
	  $inf_id = $row_c['pistols_id'];
	  $stat1=rand($row_c['min_stats_yron'],$row_c['max_stats_yron']);
	  $stat2=rand($row_c['min_stats_tochn'],$row_c['max_stats_tochn']);
	  $stat3=rand($row_c['min_stats_safety'],$row_c['max_stats_safety']);
	  $speed=$row_c['speed'];
	}
	if ($type==3) {
	  $inf_id = $row_c['weapons_id'];
	  $stat1=rand($row_c['min_stats_yron'],$row_c['max_stats_yron']);
	  $stat2=rand($row_c['min_stats_tochn'],$row_c['max_stats_tochn']);
	  $stat3=rand($row_c['min_stats_safety'],$row_c['max_stats_safety']);
	  $speed=$row_c['speed'];
	}
	$lvl_need=$row_c['lvl_need'];
	$query_att = "Select id from users where m_fight = '$m_fight' and hp > 0 and last_active > NOW() - (60*5) and ban != 1 and m_fight = '$m_fight' order by clan_rang DESC, ko DESC limit $max_people";
    $result_att = mysqli_query($dbc, $query_att) or die ('Ошибка передачи запроса к БД111'); 
    $count_att = mysqli_num_rows($result_att);
	$row_att = mysqli_fetch_array($result_att);
	  $id_att = $row_att['id'];
	  $query = "Select thing_id from things where user_id='$id_att' and place=0 limit 20";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
      $total = mysqli_num_rows($result);
	  if ($total<20) {
	  $query_att = "insert into things (`user_id`, `type`, `inf_id`, `stat1`, `upgrade_stat1`, `stat2`, `upgrade_stat2`, `stat3`, `upgrade_stat3`, `speed`, `upgrade_speed`, `sost`, `privat`, `place`, `need_lvl`) values ('$id_att', '$type', '$inf_id', '$stat1', 0, '$stat2', 0, '$stat3', 0, '$speed', 0, 1, 0, 0, '$lvl_need')";
	  $result_att = mysqli_query($dbc, $query_att) or die ('Ошибка передачи запроса к БД742'); 
	  $query_a = "select thing_id from things where user_id='$id_att' and inf_id='$inf_id' and type='$type' and stat1='$stat1' and stat2='$stat2' and stat3='$stat3' and place=0 limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД225');
	  $row_a = mysqli_fetch_array($result_a);
	  $thing_id2= $row_a['thing_id'];
	  $query_a = "update m_inf set thing_id='$thing_id2' where user_id='$id_att' and monster_id='$m' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  $query_a = "update users set m_kill=m_kill+1 where id='$id_att' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  }
	  else {
	    $query_a = "update m_inf set thing_id='-1' where user_id='$id_att' and monster_id='$m' limit 1";
        $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  $query_a = "update users set m_kill=m_kill+1 where id='$id_att' limit 1";
      $result_a = mysqli_query($dbc, $query_a) or die ('Ошибка передачи запроса к БД226');
	  }

     }
	/////////////////////Занести тех, кто участвовал в time
	$query_att = "Select id from users where ban != 1 and m_fight = '$m_fight' and last_active > NOW()-(500) limit $max_people";
    $result_att = mysqli_query($dbc, $query_att) or die ('Ошибка передачи запроса к БД7'); 
	while ($row_att = mysqli_fetch_array($result_att)) {
	  $id_time=$row_att['id'];
	  $query_t = "update users set m_fight = 0 where id = '$id_time' limit 1";
      $result_t = mysqli_query($dbc, $query_t) or die ('Ошибка передачи запроса к БД22');
	  $query_t = "select id_monster_time from m_time where user_id='$id_time' and id_monster='$m' limit 1";
      $result_t = mysqli_query($dbc, $query_t) or die ('Ошибка передачи запроса к БД22');
	  $row_t=mysqli_fetch_array($result_t);
	  if (!empty($row_t)) {
	    $query_t = "update m_time set time_respawn=NOW() where user_id='$id_time' and id_monster='$m' limit 1";
        $result_t = mysqli_query($dbc, $query_t) or die ('Ошибка передачи запроса к БД22');
		
	  }
	  else {
	    $query_t = "insert into m_time (`user_id`, `id_monster`, `time_respawn`) values ('$id_time', '$m', NOW())";
        $result_t = mysqli_query($dbc, $query_t) or die ('Ошибка передачи запроса к БД22');
	  }
	}
  if ($row_m['clan'] <> 0) {
    $query_t = "update m_fight set start=0, hp='$max_hp_m' where id_fight='$m_fight' limit 1";
    $result_t = mysqli_query($dbc, $query_t) or die ('Ошибка передачи запроса к БД22');
  }
  $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing` , `yron`) values (NOW(), '$user_id', 12 , '$m', '$attack_user')";
  $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД21');
  $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing` , `yron`) values (NOW(), '$user_id', 13 , '$m', 0)";
  $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД21');
}
//////////////////////////////////////////


/////////////////////////////////////
if ($invite_user > 0) {
  $query = "select clan, ko, opit from users where id = '$invite_user' and ban != 1 limit 1";
  $result= mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД14');
  $row = mysqli_fetch_array($result);
  if (!empty($row)) {
    $clan = $row['clan'];////id клана
	$ko = $row['ko'];////////КО у юзера
	$opit = $row['opit'];//Опыт
	$opit_pl = ($opit_pl*0.1);//добавочный опт
	$opit_pl = round($opit_pl);
	$opit_user = ($opit + $opit_pl);////////////Опыт для типа
	if ($clan <> 0) {//Если есть kлан
	  $query = "Select clan_opit,people from clans where clan_id = '$clan' limit 1";
      $result= mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД10');
	  $row = mysqli_fetch_array($result);
	  $clan_opit = $row['clan_opit'];//Клан опыт в клане
	  $people = $row['people'];/////////ЛЮДИ В КЛАНЕ
	  $clan_opit_pl = ($opit_pl/(sqrt($people)));
	  $clan_opit_pl = round($clan_opit_pl);
	  $clan_opit = ($clan_opit+$clan_opit_pl);
	  $query = "update clans set clan_opit = '$clan_opit' where  clan_id = '$clan' limit 1";
      $result= mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД10');
	  $ko = ($ko + $clan_opit_pl);
	  $query = "update users set opit = '$opit_user', ko = '$ko' where  id = '$invite_user' limit 1";
      $result= mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД10');
	}
	else {
	  $query = "update users set opit = '$opit_user' where  id = '$invite_user' limit 1";
      $result= mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД10');
	}
  }
}  
/////////////////////////////////////
  




	
  }
  else {
    ?>
	<script type="text/javascript">
   document.location.href = "monster.php?m=<?php echo "$m";?>";
    </script>
   <?php
    mysqli_close($dbc);
exit(); 
  }
  ?>
	<script type="text/javascript">
   document.location.href = "monster.php?m=<?php echo "$m";?>";
    </script>
  <?php
mysqli_close($dbc);
exit();
}
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////



//Подходит ли по ЛВЛ локация к пользователю.
$query_lvl = "select lvl_need, lvl_to, radiation from location where location_name = '$location_user'";
$result_lvl = mysqli_query($dbc, $query_lvl) or die ('Ошибка передачи запроса к БД2');
$row_lvl = mysqli_fetch_array($result_lvl);
$lvl_to = $row_lvl['lvl_to'];
$lvl_need = $row_lvl['lvl_need'];
$radiation_loc = $row_lvl['radiation'];
$query_lvl = "Select lvl, opit from opit order by lvl desc";
$result_lvl = mysqli_query($dbc, $query_lvl) or die ('Ошибка передачи запроса к БД3');
$row_lvl = mysqli_fetch_array($result_lvl);
$lvl_user=$row_lvl['lvl'];
while (($opit_user/100) < $row_lvl['opit']) {
  $lvl_user=($lvl_user-1);
  $row_lvl = mysqli_fetch_array($result_lvl);
}
if ($lvl_user > $lvl_to) {
    if ($location_user == 'kordon1' or $location_user == 'kordon2' or $location_user == 'kordon3' or $location_user == 'kordon4') {
	?>
	<script type="text/javascript">
   document.location.href = "kordon.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'svalka1' or $location_user == 'svalka2' or $location_user == 'svalka3' or $location_user == 'svalka4') {
	?>
	<script type="text/javascript">
   document.location.href = "svalka.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'agroprom1' or $location_user == 'agroprom2' or $location_user == 'agroprom3' or $location_user == 'agroprom4' or $location_user == 'agroprom5' or $location_user == 'agroprom6') {
	?>
	<script type="text/javascript">
   document.location.href = "agroprom.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'yantar1' or $location_user == 'yantar2' or $location_user == 'yantar3' or $location_user == 'yantar4' or $location_user == 'yantar5' or $location_user == 'yantar6') {
	?>
	<script type="text/javascript">
   document.location.href = "yantar.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'voensklad1' or $location_user == 'voensklad2' or $location_user == 'voensklad3' or $location_user == 'voensklad4' or $location_user == 'voensklad5' or $location_user == 'voensklad6' or $location_user == 'voensklad7') {
	?>
	<script type="text/javascript">
   document.location.href = "voensklad.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'pripyat1' or $location_user == 'pripyat2' or $location_user == 'pripyat3' or $location_user == 'pripyat4' or $location_user == 'pripyat5' or $location_user == 'pripyat6' or $location_user == 'pripyat7' or $location_user == 'pripyat8' or $location_user == 'pripyat9' or $location_user == 'pripyat10') {
	?>
	<script type="text/javascript">
   document.location.href = "pripyat.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'study') {
	?>
	<script type="text/javascript">
   document.location.href = "study.php";
    </script>
  <?php
  }
  if ($location_user == 'secret') {
	?>
	<script type="text/javascript">
   document.location.href = "secret.php";
    </script>
  <?php
  }
  if ($location_user == 'base') {
	?>
	<script type="text/javascript">
   document.location.href = "base.php";
    </script>
  <?php
  }
   mysqli_close($dbc);
exit();
}
//////////////////////////////////////////

if ($hp_user <= 0) {//Если здоровье равно 0, то ссылкаемся на смерть
  ?>
  <script type="text/javascript">
  document.location.href = "death.php";
  </script>
  <?php
  mysqli_close($dbc);
exit();
}
else {// Если здоровье != 0
  //Обновляем здоровье пользователя
    $antirad_time_user = strtotime("$antirad_time_user");
    $time = (date("Y-m-d H:i:s"));
    $time = strtotime("$time");
    $antirad_time_user = ($time - $antirad_time_user);
	//
  $last_active_user = strtotime("$last_active_user");
  $hp_time_user = ($now - $last_active_user);
  if ($hp_time_user <> 0) {
    $hp_down_rad = ($radiation_user - $radiation_loc);
	if ($hp_down_rad < 0 and $antirad_time_user > 7200) { 
	  $regen_user = ($regen_user + $hp_down_rad);
	}
	$hp_up_user = ($hp_time_user *  $regen_user);
    $hp_up_user = ($hp_user + $hp_up_user);
    if (($max_hp_user > $hp_up_user) and ($hp_up_user > 0)) {
	  $hp_user = "$hp_up_user";
    }
    if ($hp_up_user > $max_hp_user) {
      $hp_user = "$max_hp_user";
    }
  }
  /////////////////////////////////////
}




/////////////////////////////////////////////////////////БЛОК ПОСТ!!!!
$bp= $_GET['attack']; 
if ($bp == 'bp') {
  $query_loc = "select count, lvl_need, lvl_to , count_now, bp_gruppa, bp_count, bp_count_now, bp_count_grouppa,bronya from location where location_name = '$location_user'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД4');
  $row_loc = mysqli_fetch_array($result_loc);
  $bronya_set = $row_loc['bronya'];
  if (empty($row_loc)) {
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    mysqli_close($dbc);
exit();
  } 
  if ($row_loc['bp_gruppa'] == $gruppa_user) {
    if ($location_user == 'kordon1' or $location_user == 'kordon2' or $location_user == 'kordon3' or $location_user == 'kordon4') {
	?>
	<script type="text/javascript">
   document.location.href = "kordon.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'svalka1' or $location_user == 'svalka2' or $location_user == 'svalka3' or $location_user == 'svalka4') {
	?>
	<script type="text/javascript">
   document.location.href = "svalka.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'agroprom1' or $location_user == 'agroprom2' or $location_user == 'agroprom3' or $location_user == 'agroprom4' or $location_user == 'agroprom5' or $location_user == 'agroprom6') {
	?>
	<script type="text/javascript">
   document.location.href = "agroprom.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'yantar1' or $location_user == 'yantar2' or $location_user == 'yantar3' or $location_user == 'yantar4' or $location_user == 'yantar5' or $location_user == 'yantar6') {
	?>
	<script type="text/javascript">
   document.location.href = "yantar.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'voensklad1' or $location_user == 'voensklad2' or $location_user == 'voensklad3' or $location_user == 'voensklad4' or $location_user == 'voensklad5' or $location_user == 'voensklad6' or $location_user == 'voensklad7') {
	?>
	<script type="text/javascript">
   document.location.href = "voensklad.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'pripyat1' or $location_user == 'pripyat2' or $location_user == 'pripyat3' or $location_user == 'pripyat4' or $location_user == 'pripyat5' or $location_user == 'pripyat6' or $location_user == 'pripyat7' or $location_user == 'pripyat8' or $location_user == 'pripyat9' or $location_user == 'pripyat10') {
	?>
	<script type="text/javascript">
   document.location.href = "pripyat.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'study') {
	?>
	<script type="text/javascript">
   document.location.href = "study.php";
    </script>
  <?php
  }
  if ($location_user == 'secret') {
	?>
	<script type="text/javascript">
   document.location.href = "secret.php";
    </script>
  <?php
  }
  if ($location_user == 'base') {
	?>
	<script type="text/javascript">
   document.location.href = "base.php";
    </script>
  <?php
  }
  mysqli_close($dbc);
exit();
  } 
  $yron_wp = $row_user['yron_p'];
  $tochn_wp = $row_user['tochn_p'];
  $sost_wp = $row_user['sost_p'];
  $speed_wp = $row_user['speed_p'];
  $last_using_wp = $row_user['time_p'];
  if ($yron_wp == 0 and $tochn_wp == 0) {
  if ($location_user == 'kordon1' or $location_user == 'kordon2' or $location_user == 'kordon3' or $location_user == 'kordon4') {
	?>
	<script type="text/javascript">
   document.location.href = "kordon.php?location=<?php echo "$location_user";?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'svalka1' or $location_user == 'svalka2' or $location_user == 'svalka3' or $location_user == 'svalka4') {
	?>
	<script type="text/javascript">
   document.location.href = "svalka.php?location=<?php echo "$location_user";?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'agroprom1' or $location_user == 'agroprom2' or $location_user == 'agroprom3' or $location_user == 'agroprom4' or $location_user == 'agroprom5' or $location_user == 'agroprom6') {
	?>
	<script type="text/javascript">
   document.location.href = "agroprom.php?location=<?php echo "$location_user";?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'yantar1' or $location_user == 'yantar2' or $location_user == 'yantar3' or $location_user == 'yantar4' or $location_user == 'yantar5' or $location_user == 'yantar6') {
	?>
	<script type="text/javascript">
   document.location.href = "yantar.php?location=<?php echo "$location_user";?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'voensklad1' or $location_user == 'voensklad2' or $location_user == 'voensklad3' or $location_user == 'voensklad4' or $location_user == 'voensklad5' or $location_user == 'voensklad6' or $location_user == 'voensklad7') {
	?>
	<script type="text/javascript">
   document.location.href = "voensklad.php?location=<?php echo "$location_user";?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'pripyat1' or $location_user == 'pripyat2' or $location_user == 'pripyat3' or $location_user == 'pripyat4' or $location_user == 'pripyat5' or $location_user == 'pripyat6' or $location_user == 'pripyat7' or $location_user == 'pripyat8' or $location_user == 'pripyat9' or $location_user == 'pripyat10') {
	?>
	<script type="text/javascript">
   document.location.href = "pripyat.php?location=<?php echo "$location_user";?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'study') {
	?>
	<script type="text/javascript">
   document.location.href = "study.php?attack=<?php echo"$id_set"; ?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'secret') {
	?>
	<script type="text/javascript">
   document.location.href = "secret.php?attack=<?php echo"$id_set"; ?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'base') {
	?>
	<script type="text/javascript">
   document.location.href = "base.php?attack=<?php echo"$id_set"; ?>&err=6";
    </script>
  <?php
  }
  mysqli_close($dbc);
exit();
  }
  //////////////////////
  //Если состояние равно 0
  if ($sost_wp == 0) {
    $yron_wp = ($yron_wp*0.7);
$tochn_wp = ($yron_wp*0.7);
  }
  //////////////////////

/////////////////////////////////////

//Проверка на время оружия
$last_using_wp = strtotime("$last_using_wp");
$razn_wp = ($now - $last_using_wp);
if ($razn_wp < $speed_wp) {
  if ($location_user == 'kordon1' or $location_user == 'kordon2' or $location_user == 'kordon3' or $location_user == 'kordon4') {
	?>
	<script type="text/javascript">
   document.location.href = "kordon.php?location=<?php echo "$location_user";?>&err=3&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
    if ($location_user == 'svalka1' or $location_user == 'svalka2' or $location_user == 'svalka3' or $location_user == 'svalka4') {
	?>
	<script type="text/javascript">
   document.location.href = "svalka.php?location=<?php echo "$location_user";?>&err=3&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'agroprom1' or $location_user == 'agroprom2' or $location_user == 'agroprom3' or $location_user == 'agroprom4' or $location_user == 'agroprom5' or $location_user == 'agroprom6') {
	?>
	<script type="text/javascript">
   document.location.href = "agroprom.php?location=<?php echo "$location_user";?>&err=3&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'yantar1' or $location_user == 'yantar2' or $location_user == 'yantar3' or $location_user == 'yantar4' or $location_user == 'yantar5' or $location_user == 'yantar6') {
	?>
	<script type="text/javascript">
   document.location.href = "yantar.php?location=<?php echo "$location_user";?>&err=3&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'voensklad1' or $location_user == 'voensklad2' or $location_user == 'voensklad3' or $location_user == 'voensklad4' or $location_user == 'voensklad5' or $location_user == 'voensklad6' or $location_user == 'voensklad7') {
	?>
	<script type="text/javascript">
   document.location.href = "voensklad.php?location=<?php echo "$location_user";?>&err=3&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'pripyat1' or $location_user == 'pripyat2' or $location_user == 'pripyat3' or $location_user == 'pripyat4' or $location_user == 'pripyat5' or $location_user == 'pripyat6' or $location_user == 'pripyat7' or $location_user == 'pripyat8' or $location_user == 'pripyat9' or $location_user == 'pripyat10') {
	?>
	<script type="text/javascript">
   document.location.href = "pripyat.php?location=<?php echo "$location_user";?>&err=3&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'study') {
	?>
	<script type="text/javascript">
   document.location.href = "study.php?attack=<?php echo"$id_set"; ?>&err=3";
    </script>
  <?php
  }
  if ($location_user == 'secret') {
	?>
	<script type="text/javascript">
   document.location.href = "secret.php?attack=<?php echo"$id_set"; ?>&err=3";
    </script>
  <?php
  }
  if ($location_user == 'base') {
	?>
	<script type="text/javascript">
   document.location.href = "base.php?attack=<?php echo"$id_set"; ?>&err=3";
    </script>
  <?php
  }
  mysqli_close($dbc);
exit();
}
/////////////////////////////////////

////////////////////////////////////Надёжность ОРУЖИЯ!!!
$weapon = $_GET['weapon'];
if (empty($weapon)) {
  $weapon = 'pistol';
}
if ($weapon == 'pistol') {
  $safety_w = $row_user['safety_p'];
}
else {
  $safety_w = $row_user['safety_w'];
}
$nadeg = rand(0,70);
if ($safety_w <= $nadeg) {
if ($location_user == 'kordon1' or $location_user == 'kordon2' or $location_user == 'kordon3' or $location_user == 'kordon4') {
	?>
	<script type="text/javascript">
   document.location.href = "kordon.php?location=<?php echo "$location_user";?>&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
    if ($location_user == 'svalka1' or $location_user == 'svalka2' or $location_user == 'svalka3' or $location_user == 'svalka4') {
	?>
	<script type="text/javascript">
   document.location.href = "svalka.php?location=<?php echo "$location_user";?>&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'agroprom1' or $location_user == 'agroprom2' or $location_user == 'agroprom3' or $location_user == 'agroprom4' or $location_user == 'agroprom5' or $location_user == 'agroprom6') {
	?>
	<script type="text/javascript">
   document.location.href = "agroprom.php?location=<?php echo "$location_user";?>&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'yantar1' or $location_user == 'yantar2' or $location_user == 'yantar3' or $location_user == 'yantar4' or $location_user == 'yantar5' or $location_user == 'yantar6') {
	?>
	<script type="text/javascript">
   document.location.href = "yantar.php?location=<?php echo "$location_user";?>&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'voensklad1' or $location_user == 'voensklad2' or $location_user == 'voensklad3' or $location_user == 'voensklad4' or $location_user == 'voensklad5' or $location_user == 'voensklad6' or $location_user == 'voensklad7') {
	?>
	<script type="text/javascript">
   document.location.href = "voensklad.php?location=<?php echo "$location_user";?>&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'pripyat1' or $location_user == 'pripyat2' or $location_user == 'pripyat3' or $location_user == 'pripyat4' or $location_user == 'pripyat5' or $location_user == 'pripyat6' or $location_user == 'pripyat7' or $location_user == 'pripyat8' or $location_user == 'pripyat9' or $location_user == 'pripyat10') {
	?>
	<script type="text/javascript">
   document.location.href = "pripyat.php?location=<?php echo "$location_user";?>&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'study') {
	?>
	<script type="text/javascript">
   document.location.href = "study.php?attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
 if ($location_user == 'secret') {
	?>
	<script type="text/javascript">
   document.location.href = "secret.php?attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'base') {
	?>
	<script type="text/javascript">
   document.location.href = "base.php?attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing`) values (NOW(), '$user_id', 8 , 0)";
    $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД4');  
  mysqli_close($dbc);
exit();
}
///////////////////////////////////////////////

if (!empty($clan_user)) {
  $query_clan = "Select clan_opit, mentor, people from clans where clan_id = '$clan_user'";
  $result_clan = mysqli_query($dbc, $query_clan) or die ('Ошибка передачи запроса к БД10');
  $row_clan = mysqli_fetch_array($result_clan);
  $clan_opit_user = $row_clan['clan_opit'];
  $mentor_user = $row_clan['mentor'];
  $people_user = $row_clan['people'];
}

////////На наличие наставника
if (!empty($clan_user)) {
$mentor_time_user = strtotime("$mentor_time_user");
$razn_mentor_user = ($now - $mentor_time_user);
if ($razn_mentor_user < 3600) {
  if ($mentor_type_user == 1) { 
    $mentor_user = ($mentor_user / 2);
  }
  $yron_wp = ($yron_wp + ($yron_wp/100 * $mentor_user));
  $tochn_wp = ($tochn_wp + ($tochn_wp/100 * $mentor_user));
  $bronya_user = ($bronya_user + ($bronya_user/100 * $mentor_user));
  $bronya_user = round ($bronya_user);
  $yron_wp = round ($yron_wp);
  $tochn_wp = round ($tochn_wp);
}
}
if (!empty($clan_set)) {
if ($razn_mentor_set < 3600) {
  if ($mentor_type_set == 1) { 
    $mentor_set = ($mentor_set / 2);
  }
  $bronya_set = ($bronya_set + ($mentor_set/100*$mentor_set));
  $bronya_set = round ($bronya_set);
}
}
/////////////////////////////////
$p = rand(345000,375000);
$p = ($p/1000000);////Коэффициент
  $attack_user = ((($yron_wp * $tochn_wp) / $bronya_set) * $p);
  $attack_user = ($attack_user);
  $attack_user = round ($attack_user);
  
////Опыт
$opit_pl = ($attack_user*6);
$opit_pl = round($opit_pl);
if ($opit_pl < 1) {
  $opit_user = ($opit_user + 1);
}
else {
  $opit_user = ($opit_user + $opit_pl);
}  
////////////
////Автивность
$activ_pl = ($attack_user);
$activ_pl = round($activ_pl);
if ($activ_pl < 1) {
  $activ_user = ($activ_user + 1);
}
else {
  $activ_user = ($activ_user + $activ_pl);
}  
////////////
   
/////клан опыт
if (!empty($clan_user)) {

  $clan_opit_pl = (($opit_pl)/(sqrt($people_user)));
  $clan_opit_pl = round($clan_opit_pl);
  $clan_opit = ($clan_opit_user + $clan_opit_pl);
  $ko_user = ($ko_user + $clan_opit_pl);
}  
////////////
///////Расчитываем счётчик бп)
if ($row_loc['bp_count_grouppa'] == $gruppa_user) {
  $bp_count_now = ($row_loc['bp_count_now'] + $attack_user);
  if ($row_loc['bp_count'] <= $bp_count_now) {
    $query_bp = "update location set bp_count_now = 0, bp_gruppa = '$gruppa_user' where location_name = '$location_user'";
    $result_bp = mysqli_query($dbc, $query_bp) or die ('Ошибка передачи запроса к БД11');
  }
  else {
    $query_bp = "update location set bp_count_now = '$bp_count_now' where location_name = '$location_user'";
    $result_bp = mysqli_query($dbc, $query_bp) or die ('Ошибка передачи запроса к БД12');
  }
}
else {
  if ($attack_user < $row_loc['bp_count_now']) {
    $bp_count_now = ($row_loc['bp_count_now'] - $attack_user);
	$query_bp = "update location set bp_count_now = '$bp_count_now' where location_name = '$location_user'";
    $result_bp = mysqli_query($dbc, $query_bp) or die ('Ошибка передачи запроса к БД13');
  }
  else {
    $bp_count_now = ($attack_user - $row_loc['bp_count_now']);
    if ($row_loc['bp_count'] <= $bp_count_now) {
      $query_bp = "update location set bp_count_now = 0, bp_gruppa = '$gruppa_user' where location_name = '$location_user'";
      $result_bp = mysqli_query($dbc, $query_bp) or die ('Ошибка передачи запроса к БД11');
    }
    else {
      $query_bp = "update location set bp_count_now = '$bp_count_now', bp_count_grouppa = '$gruppa_user' where location_name = '$location_user'";
      $result_bp = mysqli_query($dbc, $query_bp) or die ('Ошибка передачи запроса к БД14');
    }
  }
}
$query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing` , `yron`) values (NOW(), '$user_id', 7 , 0, '$attack_user')";
$result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД15');///Записали в лог, что ударили.
if (!empty($clan_user)) {
	$query_clan = "update clans set clan_opit = '$clan_opit' where clan_id = '$clan_user'";
	$result_clan = mysqli_query($dbc, $query_clan) or die ('Ошибка передачи запроса к БД17');
}

/////////////////////
$query_lvl = "Select lvl, opit from opit order by lvl desc";
$result_lvl = mysqli_query($dbc, $query_lvl) or die ('Ошибка передачи запроса к БД3');
$row_lvl = mysqli_fetch_array($result_lvl);
$lvl_user=$row_lvl['lvl'];
while (($opit_user/100) < $row_lvl['opit']) {
  $lvl_user=($lvl_user-1);
  $row_lvl = mysqli_fetch_array($result_lvl);
}
if ($lvl_user_bd<$lvl_user) {
      $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing` , `yron`) values (NOW(), '$user_id', 6 , '0', '$lvl_user')";
      $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД21');
}
////////////////////

if ($opit_user < $tratata1) {
  $query_re_wp = "update users set activ = '$activ_user', opit = '$opit_user', lvl='$lvl_user', ko = '$ko_user', hp = '$hp_user', last_active = NOW(), time_p = NOW() where id = '$user_id'";
  $result_re_wp = mysqli_query($dbc, $query_re_wp) or die ('Ошибка передачи запроса к БД23');
  } 
  else {
  $query_re_wp = "update users set activ = '$activ_user', opit = '$tratata', lvl='$lvl_user', ko = '$ko_user', hp = '$hp_user', last_active = NOW(), time_p = NOW() where id = '$user_id'";
  $result_re_wp = mysqli_query($dbc, $query_re_wp) or die ('Ошибка передачи запроса к БД23');
  }
require_once('conf/habar.php');
///////////////////////////////////////////////////


if ($location_user == 'kordon1' or $location_user == 'kordon2' or $location_user == 'kordon3' or $location_user == 'kordon4') {
	?>
	<script type="text/javascript">
   document.location.href = "kordon.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'svalka1' or $location_user == 'svalka2' or $location_user == 'svalka3' or $location_user == 'svalka4') {
	?>
	<script type="text/javascript">
   document.location.href = "svalka.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'agroprom1' or $location_user == 'agroprom2' or $location_user == 'agroprom3' or $location_user == 'agroprom4' or $location_user == 'agroprom5' or $location_user == 'agroprom6') {
	?>
	<script type="text/javascript">
   document.location.href = "agroprom.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'yantar1' or $location_user == 'yantar2' or $location_user == 'yantar3' or $location_user == 'yantar4' or $location_user == 'yantar5' or $location_user == 'yantar6') {
	?>
	<script type="text/javascript">
   document.location.href = "yantar.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'voensklad1' or $location_user == 'voensklad2' or $location_user == 'voensklad3' or $location_user == 'voensklad4' or $location_user == 'voensklad5' or $location_user == 'voensklad6' or $location_user == 'voensklad7') {
	?>
	<script type="text/javascript">
   document.location.href = "voensklad.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'pripyat1' or $location_user == 'pripyat2' or $location_user == 'pripyat3' or $location_user == 'pripyat4' or $location_user == 'pripyat5' or $location_user == 'pripyat6' or $location_user == 'pripyat7' or $location_user == 'pripyat8' or $location_user == 'pripyat9' or $location_user == 'pripyat10') {
	?>
	<script type="text/javascript">
   document.location.href = "pripyat.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'study') {
	?>
	<script type="text/javascript">
   document.location.href = "study.php";
    </script>
  <?php
  }
  if ($location_user == 'secret') {
	?>
	<script type="text/javascript">
   document.location.href = "secret.php";
    </script>
  <?php
  }
  if ($location_user == 'base') {
	?>
	<script type="text/javascript">
   document.location.href = "base.php";
    </script>
  <?php
  }


/////////////////////////////////////
if ($invite_user > 0) {
  $query = "select clan, ko, opit from users where id = '$invite_user' and ban != 1 limit 1";
  $result= mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД14');
  $row = mysqli_fetch_array($result);
  if (!empty($row)) {
    $clan = $row['clan'];////id клана
	$ko = $row['ko'];////////КО у юзера
	$opit = $row['opit'];//Опыт
	$opit_pl = ($opit_pl*0.1);//добавочный опт
	$opit_pl = round($opit_pl);
	$opit_user = ($opit + $opit_pl);////////////Опыт для типа
	if ($clan <> 0) {//Если есть kлан
	  $query = "Select clan_opit,people from clans where clan_id = '$clan' limit 1";
      $result= mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД10');
	  $row = mysqli_fetch_array($result);
	  $clan_opit = $row['clan_opit'];//Клан опыт в клане
	  $people = $row['people'];/////////ЛЮДИ В КЛАНЕ
	  $clan_opit_pl = ($opit_pl/(sqrt($people)));
	  $clan_opit_pl = round($clan_opit_pl);
	  $clan_opit = ($clan_opit+$clan_opit_pl);
	  $query = "update clans set clan_opit = '$clan_opit' where  clan_id = '$clan' limit 1";
      $result= mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД10');
	  $ko = ($ko + $clan_opit_pl);
	  $query = "update users set opit = '$opit_user', ko = '$ko' where  id = '$invite_user' limit 1";
      $result= mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД10');
	}
	else {
	  $query = "update users set opit = '$opit_user' where  id = '$invite_user' limit 1";
      $result= mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД10');
	}
  }
}  
/////////////////////////////////////


//
mysqli_close($dbc);
exit();
}
//////////////////////////////////////////////////////////////////////// БЛОКПОСТ КОНЕЦ!!!!!!!!!!

//Определяем рандомно или нет.
$rand = $_GET['rand'];
if ($rand <> 0 and $rand <> 1) {
  $rand = 1;
}
if ($rand == 0) {
  $id_set = $_GET['attack'];
  $id_set = mysqli_real_escape_string($dbc, trim($id_set));	
  //Если не указан id атакованого, то кидаем назад в локу.
  if (empty($id_set)) {
if ($location_user == 'kordon1' or $location_user == 'kordon2' or $location_user == 'kordon3' or $location_user == 'kordon4') {
	?>
	<script type="text/javascript">
   document.location.href = "kordon.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'svalka1' or $location_user == 'svalka2' or $location_user == 'svalka3' or $location_user == 'svalka4') {
	?>
	<script type="text/javascript">
   document.location.href = "svalka.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'agroprom1' or $location_user == 'agroprom2' or $location_user == 'agroprom3' or $location_user == 'agroprom4' or $location_user == 'agroprom5' or $location_user == 'agroprom6') {
	?>
	<script type="text/javascript">
   document.location.href = "agroprom.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'yantar1' or $location_user == 'yantar2' or $location_user == 'yantar3' or $location_user == 'yantar4' or $location_user == 'yantar5' or $location_user == 'yantar6') {
	?>
	<script type="text/javascript">
   document.location.href = "yantar.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'voensklad1' or $location_user == 'voensklad2' or $location_user == 'voensklad3' or $location_user == 'voensklad4' or $location_user == 'voensklad5' or $location_user == 'voensklad6' or $location_user == 'voensklad7') {
	?>
	<script type="text/javascript">
   document.location.href = "voensklad.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'pripyat1' or $location_user == 'pripyat2' or $location_user == 'pripyat3' or $location_user == 'pripyat4' or $location_user == 'pripyat5' or $location_user == 'pripyat6' or $location_user == 'pripyat7' or $location_user == 'pripyat8' or $location_user == 'pripyat9' or $location_user == 'pripyat10') {
	?>
	<script type="text/javascript">
   document.location.href = "pripyat.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'study') {
	?>
	<script type="text/javascript">
   document.location.href = "study.php";
    </script>
  <?php
  }
  if ($location_user == 'secret') {
	?>
	<script type="text/javascript">
   document.location.href = "secret.php";
    </script>
  <?php
  }
  if ($location_user == 'base') {
	?>
	<script type="text/javascript">
   document.location.href = "base.php";
    </script>
  <?php
  }
      $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing`) values (NOW(), '$user_id', 3 , 0)";
    $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД4');  
    mysqli_close($dbc);
exit();
  }
  ///
  $query_set = "Select gruppa, location, radiation, regen, antirad_time, hp, max_hp, last_active, clan, mentor_time, mentor_type, bronya, sost_cl, yron_p, tochn_p from users where id = '$id_set' limit 1";
  $result_set = mysqli_query($dbc, $query_set) or die ('Ошибка передачи запроса к БД5');
  $row_set = mysqli_fetch_array($result_set);
  $gruppa_set = $row_set['gruppa'];
  $location_set = $row_set['location'];
  $hp_set = $row_set['hp'];
  $regen_set = $row_set['regen'];
  $max_hp_set = $row_set['max_hp'];
  $last_active_set = $row_set['last_active'];
  $clan_set = $row_set['clan'];
  $mentor_time_set = $row_set['mentor_time'];
  $mentor_type_set = $row_set['mentor_type'];
  $bronya_set = $row_set['bronya'];
  $bonus_cl_set = $row_set['bonus_cl'];
  $sost_br_set = $row_set['sost_cl'];
  $radiation_set = $row_set['radiation'];
  $antirad_time = $row_set['antirad_time'];
}
if ($rand == 1) {
  $gruppa_set = $_GET['group'];
  $gruppa_set = mysqli_real_escape_string($dbc, trim($gruppa_set));
  if ($gruppa_set == 'odinochki') {
    $gruppa_set = 'naemniki';
  }	
  //Если не указана группа, то кидаем назад в локу.
  if (empty($gruppa_set)) {
if ($location_user == 'kordon1' or $location_user == 'kordon2' or $location_user == 'kordon3' or $location_user == 'kordon4') {
	?>
	<script type="text/javascript">
   document.location.href = "kordon.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'svalka1' or $location_user == 'svalka2' or $location_user == 'svalka3' or $location_user == 'svalka4') {
	?>
	<script type="text/javascript">
   document.location.href = "svalka.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'agroprom1' or $location_user == 'agroprom2' or $location_user == 'agroprom3' or $location_user == 'agroprom4' or $location_user == 'agroprom5' or $location_user == 'agroprom6') {
	?>
	<script type="text/javascript">
   document.location.href = "agroprom.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'yantar1' or $location_user == 'yantar2' or $location_user == 'yantar3' or $location_user == 'yantar4' or $location_user == 'yantar5' or $location_user == 'yantar6') {
	?>
	<script type="text/javascript">
   document.location.href = "yantar.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'voensklad1' or $location_user == 'voensklad2' or $location_user == 'voensklad3' or $location_user == 'voensklad4' or $location_user == 'voensklad5' or $location_user == 'voensklad6' or $location_user == 'voensklad7') {
	?>
	<script type="text/javascript">
   document.location.href = "voensklad.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'pripyat1' or $location_user == 'pripyat2' or $location_user == 'pripyat3' or $location_user == 'pripyat4' or $location_user == 'pripyat5' or $location_user == 'pripyat6' or $location_user == 'pripyat7' or $location_user == 'pripyat8' or $location_user == 'pripyat9' or $location_user == 'pripyat10') {
	?>
	<script type="text/javascript">
   document.location.href = "pripyat.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'study') {
	?>
	<script type="text/javascript">
   document.location.href = "study.php";
    </script>
  <?php
  }
  if ($location_user == 'secret') {
	?>
	<script type="text/javascript">
   document.location.href = "secret.php";
    </script>
  <?php
  }
  if ($location_user == 'base') {
	?>
	<script type="text/javascript">
   document.location.href = "base.php";
    </script>
  <?php
  }
    $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing`) values (NOW(), '$user_id', 3 , 0)";
    $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД6');  
    mysqli_close($dbc);
exit();
  }
  ///
  $query_count = "Select id from users where location = '$location_user' and hp != 0 and ban != 1 and gruppa = '$gruppa_set'";
  $result_count = mysqli_query($dbc, $query_count) or die ('Ошибка передачи запроса к БД7'); 
  $count_users = mysqli_num_rows($result_count);
  //Если людей нет в локе, то кидаем назад в локу.
  if ($count_users == 0) {
    if ($location_user == 'kordon1' or $location_user == 'kordon2' or $location_user == 'kordon3' or $location_user == 'kordon4') {
	?>
	<script type="text/javascript">
   document.location.href = "kordon.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'svalka1' or $location_user == 'svalka2' or $location_user == 'svalka3' or $location_user == 'svalka4') {
	?>
	<script type="text/javascript">
   document.location.href = "svalka.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'agroprom1' or $location_user == 'agroprom2' or $location_user == 'agroprom3' or $location_user == 'agroprom4' or $location_user == 'agroprom5' or $location_user == 'agroprom6') {
	?>
	<script type="text/javascript">
   document.location.href = "agroprom.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'yantar1' or $location_user == 'yantar2' or $location_user == 'yantar3' or $location_user == 'yantar4' or $location_user == 'yantar5' or $location_user == 'yantar6') {
	?>
	<script type="text/javascript">
   document.location.href = "yantar.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'voensklad1' or $location_user == 'voensklad2' or $location_user == 'voensklad3' or $location_user == 'voensklad4' or $location_user == 'voensklad5' or $location_user == 'voensklad6' or $location_user == 'voensklad7') {
	?>
	<script type="text/javascript">
   document.location.href = "voensklad.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'pripyat1' or $location_user == 'pripyat2' or $location_user == 'pripyat3' or $location_user == 'pripyat4' or $location_user == 'pripyat5' or $location_user == 'pripyat6' or $location_user == 'pripyat7' or $location_user == 'pripyat8' or $location_user == 'pripyat9' or $location_user == 'pripyat10') {
	?>
	<script type="text/javascript">
   document.location.href = "pripyat.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'study') {
	?>
	<script type="text/javascript">
   document.location.href = "study.php";
    </script>
  <?php
  }
  if ($location_user == 'secret') {
	?>
	<script type="text/javascript">
   document.location.href = "secret.php";
    </script>
  <?php
  }
  if ($location_user == 'base') {
	?>
	<script type="text/javascript">
   document.location.href = "base.php";
    </script>
  <?php
  }
    $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing`) values (NOW(), '$user_id', 3 , 0)";
    $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса №4 к БД');  
    mysqli_close($dbc);
exit();
  }
  ///
  $row_count = mysqli_fetch_array($result_count);
  $s=1;
  $rand_number = rand(1,$count_users);
  while ($s<>$rand_number) {
    $s=$s+1;
  $row_count = mysqli_fetch_array($result_count);
  }
  $id_set = $row_count['id'];
  $query_set = "Select gruppa, radiation, location, antirad_time, regen, hp, max_hp, last_active, clan, mentor_time, mentor_type, bronya, sost_cl, yron_p, tochn_p from users where id = '$id_set' limit 1";
  $result_set = mysqli_query($dbc, $query_set) or die ('Ошибка передачи запроса к БД8');
  $row_set = mysqli_fetch_array($result_set);
  $gruppa_set = $row_set['gruppa'];
  $location_set = $row_set['location'];
  $hp_set = $row_set['hp'];
  $regen_set = $row_set['regen'];
  $max_hp_set = $row_set['max_hp'];
  $last_active_set = $row_set['last_active'];
  $clan_set = $row_set['clan'];
  $mentor_time_set = $row_set['mentor_time'];
  $mentor_type_set = $row_set['mentor_type'];
  $bronya_set = $row_set['bronya'];
  $bonus_cl_set = $row_set['bonus_cl'];
  $sost_br_set = $row_set['sost_cl'];
  $radiation_set = $row_set['radiation'];
  $antirad_time = $row_set['antirad_time'];
}
///////////////////////////////////////////

//Если они в ранзых локациях
if ($location_user <> $location_set) {
if ($location_user == 'kordon1' or $location_user == 'kordon2' or $location_user == 'kordon3' or $location_user == 'kordon4') {
	?>
	<script type="text/javascript">
   document.location.href = "kordon.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'svalka1' or $location_user == 'svalka2' or $location_user == 'svalka3' or $location_user == 'svalka4') {
	?>
	<script type="text/javascript">
   document.location.href = "svalka.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'agroprom1' or $location_user == 'agroprom2' or $location_user == 'agroprom3' or $location_user == 'agroprom4' or $location_user == 'agroprom5' or $location_user == 'agroprom6') {
	?>
	<script type="text/javascript">
   document.location.href = "agroprom.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'yantar1' or $location_user == 'yantar2' or $location_user == 'yantar3' or $location_user == 'yantar4' or $location_user == 'yantar5' or $location_user == 'yantar6') {
	?>
	<script type="text/javascript">
   document.location.href = "yantar.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'voensklad1' or $location_user == 'voensklad2' or $location_user == 'voensklad3' or $location_user == 'voensklad4' or $location_user == 'voensklad5' or $location_user == 'voensklad6' or $location_user == 'voensklad7') {
	?>
	<script type="text/javascript">
   document.location.href = "voensklad.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'pripyat1' or $location_user == 'pripyat2' or $location_user == 'pripyat3' or $location_user == 'pripyat4' or $location_user == 'pripyat5' or $location_user == 'pripyat6' or $location_user == 'pripyat7' or $location_user == 'pripyat8' or $location_user == 'pripyat9' or $location_user == 'pripyat10') {
	?>
	<script type="text/javascript">
   document.location.href = "pripyat.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'study') {
	?>
	<script type="text/javascript">
   document.location.href = "study.php";
    </script>
  <?php
  }
  if ($location_user == 'secret') {
	?>
	<script type="text/javascript">
   document.location.href = "secret.php";
    </script>
  <?php
  }
  if ($location_user == 'base') {
	?>
	<script type="text/javascript">
   document.location.href = "base.php";
    </script>
  <?php
  }
  mysqli_close($dbc);
exit();
}
////////////////////////////
//Если hp атакованого 0, то кидаем назад в локу.
if ($hp_set <0 or $hp_set == 0) {
   if ($location_user == 'kordon1' or $location_user == 'kordon2' or $location_user == 'kordon3' or $location_user == 'kordon4') {
	?>
	<script type="text/javascript">
   document.location.href = "kordon.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'svalka1' or $location_user == 'svalka2' or $location_user == 'svalka3' or $location_user == 'svalka4') {
	?>
	<script type="text/javascript">
   document.location.href = "svalka.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'agroprom1' or $location_user == 'agroprom2' or $location_user == 'agroprom3' or $location_user == 'agroprom4' or $location_user == 'agroprom5' or $location_user == 'agroprom6') {
	?>
	<script type="text/javascript">
   document.location.href = "agroprom.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'yantar1' or $location_user == 'yantar2' or $location_user == 'yantar3' or $location_user == 'yantar4' or $location_user == 'yantar5' or $location_user == 'yantar6') {
	?>
	<script type="text/javascript">
   document.location.href = "yantar.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'voensklad1' or $location_user == 'voensklad2' or $location_user == 'voensklad3' or $location_user == 'voensklad4' or $location_user == 'voensklad5' or $location_user == 'voensklad6' or $location_user == 'voensklad7') {
	?>
	<script type="text/javascript">
   document.location.href = "voensklad.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'pripyat1' or $location_user == 'pripyat2' or $location_user == 'pripyat3' or $location_user == 'pripyat4' or $location_user == 'pripyat5' or $location_user == 'pripyat6' or $location_user == 'pripyat7' or $location_user == 'pripyat8' or $location_user == 'pripyat9' or $location_user == 'pripyat10') {
	?>
	<script type="text/javascript">
   document.location.href = "pripyat.php?location=<?php echo "$location_user";?>";
    </script>
  <?php
  }
  if ($location_user == 'study') {
	?>
	<script type="text/javascript">
   document.location.href = "study.php";
    </script>
  <?php
  }
  if ($location_user == 'secret') {
	?>
	<script type="text/javascript">
   document.location.href = "secret.php";
    </script>
  <?php
  }
  if ($location_user == 'base') {
	?>
	<script type="text/javascript">
   document.location.href = "base.php";
    </script>
  <?php
  }
    $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing`) values (NOW(), '$user_id', 3 , 0)";
    $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД9');  
    mysqli_close($dbc);
exit();
}
//////////////////////////////////////////////

//HP атакованного
  $last_active_set = strtotime("$last_active_set");
  $hp_time_set = ($now - $last_active_set);
  if ($hp_time_set !=0) {
    $antirad_time_set = strtotime("$antirad_time_set");
    $time = (date("Y-m-d H:i:s"));
    $time = strtotime("$time");
    $antirad_time_set = ($time - $antirad_time_set);
    $hp_down_rad = ($radiation_set - $radiation_loc);
	if ($hp_down_rad < 0 and $antirad_time_set > 7200) { 
	  $regen_set = ($regen_set + $hp_down_rad);
	}
	$hp_up_set = ($hp_time_set * $regen_set);
    $hp_up_set = ($hp_set + $hp_up_set);
    if (($max_hp_set > $hp_up_set) and ($hp_up_set > 0)) {
	  $hp_set = $hp_up_set;
    }
    if ($hp_up_set > $max_hp_set) {
      $hp_set = $max_hp_set;
    }
  }
/////////////////////////////////////////


// Проверка на атаку своих
if ($gruppa_user == $gruppa_set) {
  if ($location_user == 'kordon1' or $location_user == 'kordon2' or $location_user == 'kordon3' or $location_user == 'kordon4') {
	?>
	<script type="text/javascript">
   document.location.href = "kordon.php?location=<?php echo "$location_user";?>&err=4";
    </script>
  <?php
  }
  if ($location_user == 'svalka1' or $location_user == 'svalka2' or $location_user == 'svalka3' or $location_user == 'svalka4') {
	?>
	<script type="text/javascript">
   document.location.href = "svalka.php?location=<?php echo "$location_user";?>&err=4";
    </script>
  <?php
  }
  if ($location_user == 'agroprom1' or $location_user == 'agroprom2' or $location_user == 'agroprom3' or $location_user == 'agroprom4' or $location_user == 'agroprom5' or $location_user == 'agroprom6') {
	?>
	<script type="text/javascript">
   document.location.href = "agroprom.php?location=<?php echo "$location_user";?>&err=4";
    </script>
  <?php
  }
  if ($location_user == 'yantar1' or $location_user == 'yantar2' or $location_user == 'yantar3' or $location_user == 'yantar4' or $location_user == 'yantar5' or $location_user == 'yantar6') {
	?>
	<script type="text/javascript">
   document.location.href = "yantar.php?location=<?php echo "$location_user";?>&err=4";
    </script>
  <?php
  }
  if ($location_user == 'voensklad1' or $location_user == 'voensklad2' or $location_user == 'voensklad3' or $location_user == 'voensklad4' or $location_user == 'voensklad5' or $location_user == 'voensklad6' or $location_user == 'voensklad7') {
	?>
	<script type="text/javascript">
   document.location.href = "voensklad.php?location=<?php echo "$location_user";?>&err=4";
    </script>
  <?php
  }
  if ($location_user == 'pripyat1' or $location_user == 'pripyat2' or $location_user == 'pripyat3' or $location_user == 'pripyat4' or $location_user == 'pripyat5' or $location_user == 'pripyat6' or $location_user == 'pripyat7' or $location_user == 'pripyat8' or $location_user == 'pripyat9' or $location_user == 'pripyat10') {
	?>
	<script type="text/javascript">
   document.location.href = "pripyat.php?location=<?php echo "$location_user";?>&err=4";
    </script>
  <?php
  }
   if ($location_user == 'study') {
	?>
	<script type="text/javascript">
   document.location.href = "study.php?err=4";
    </script>
  <?php
  }
  if ($location_user == 'secret') {
	?>
	<script type="text/javascript">
   document.location.href = "secret.php?err=4";
    </script>
  <?php
  }
  if ($location_user == 'base') {
	?>
	<script type="text/javascript">
   document.location.href = "base.php?err=4";
    </script>
  <?php
  }
  mysqli_close($dbc);
exit();
}
/////////////////////////////////////

//Проверка на оружие
$weapon = $_GET['weapon'];
if (empty($weapon)) {
  $weapon = 'pistol';
}
if ($weapon == 'avtomat') {//Если оружие выбрано автомат
  $yron_wp = $row_user['yron_w'];
  $tochn_wp = $row_user['tochn_w'];
  $sost_wp = $row_user['sost_w'];
  $speed_wp = $row_user['speed_w'];
  $last_using_wp = $row_user['time_w'];
  //Если автомата нет
  if ($yron_wp == 0 and $tochn_wp == 0) {
  if ($location_user == 'kordon1' or $location_user == 'kordon2' or $location_user == 'kordon3' or $location_user == 'kordon4') {
	?>
	<script type="text/javascript">
   document.location.href = "kordon.php?location=<?php echo "$location_user";?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'svalka1' or $location_user == 'svalka2' or $location_user == 'svalka3' or $location_user == 'svalka4') {
	?>
	<script type="text/javascript">
   document.location.href = "svalka.php?location=<?php echo "$location_user";?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'agroprom1' or $location_user == 'agroprom2' or $location_user == 'agroprom3' or $location_user == 'agroprom4' or $location_user == 'agroprom5' or $location_user == 'agroprom6') {
	?>
	<script type="text/javascript">
   document.location.href = "agroprom.php?location=<?php echo "$location_user";?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'yantar1' or $location_user == 'yantar2' or $location_user == 'yantar3' or $location_user == 'yantar4' or $location_user == 'yantar5' or $location_user == 'yantar6') {
	?>
	<script type="text/javascript">
   document.location.href = "yantar.php?location=<?php echo "$location_user";?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'voensklad1' or $location_user == 'voensklad2' or $location_user == 'voensklad3' or $location_user == 'voensklad4' or $location_user == 'voensklad5' or $location_user == 'voensklad6' or $location_user == 'voensklad7') {
	?>
	<script type="text/javascript">
   document.location.href = "voensklad.php?location=<?php echo "$location_user";?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'pripyat1' or $location_user == 'pripyat2' or $location_user == 'pripyat3' or $location_user == 'pripyat4' or $location_user == 'pripyat5' or $location_user == 'pripyat6' or $location_user == 'pripyat7' or $location_user == 'pripyat8' or $location_user == 'pripyat9' or $location_user == 'pripyat10') {
	?>
	<script type="text/javascript">
   document.location.href = "pripyat.php?location=<?php echo "$location_user";?>&err=6";
    </script>
  <?php
  }
   if ($location_user == 'study') {
	?>
	<script type="text/javascript">
   document.location.href = "study.php?err=6";
    </script>
  <?php
  }
  if ($location_user == 'secret') {
	?>
	<script type="text/javascript">
   document.location.href = "secret.php?err=6";
    </script>
  <?php
  }
  if ($location_user == 'base') {
	?>
	<script type="text/javascript">
   document.location.href = "base.php?err=6";
    </script>
  <?php
  }
  mysqli_close($dbc);
exit();
  }
  //////////////////////
  //Если состояние равно 0
  if ($sost_wp == 0) {
    $yron_wp = ($yron_wp*0.7);
$tochn_wp = ($yron_wp*0.7);
  }
  //////////////////////
}
if ($weapon == 'pistol') {//Если оружие выбрано пистолет
  $yron_wp = $row_user['yron_p'];
  $tochn_wp = $row_user['tochn_p'];
  $sost_wp = $row_user['sost_p'];
  $speed_wp = $row_user['speed_p'];
  $last_using_wp = $row_user['time_p'];
  //Если автомата нет
  if ($yron_wp == 0 and $tochn_wp == 0) {
if ($location_user == 'kordon1' or $location_user == 'kordon2' or $location_user == 'kordon3' or $location_user == 'kordon4') {
	?>
	<script type="text/javascript">
   document.location.href = "kordon.php?location=<?php echo "$location_user";?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'svalka1' or $location_user == 'svalka2' or $location_user == 'svalka3' or $location_user == 'svalka4') {
	?>
	<script type="text/javascript">
   document.location.href = "svalka.php?location=<?php echo "$location_user";?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'agroprom1' or $location_user == 'agroprom2' or $location_user == 'agroprom3' or $location_user == 'agroprom4' or $location_user == 'agroprom5' or $location_user == 'agroprom6') {
	?>
	<script type="text/javascript">
   document.location.href = "agroprom.php?location=<?php echo "$location_user";?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'yantar1' or $location_user == 'yantar2' or $location_user == 'yantar3' or $location_user == 'yantar4' or $location_user == 'yantar5' or $location_user == 'yantar6') {
	?>
	<script type="text/javascript">
   document.location.href = "yantar.php?location=<?php echo "$location_user";?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'voensklad1' or $location_user == 'voensklad2' or $location_user == 'voensklad3' or $location_user == 'voensklad4' or $location_user == 'voensklad5' or $location_user == 'voensklad6' or $location_user == 'voensklad7') {
	?>
	<script type="text/javascript">
   document.location.href = "voensklad.php?location=<?php echo "$location_user";?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'pripyat1' or $location_user == 'pripyat2' or $location_user == 'pripyat3' or $location_user == 'pripyat4' or $location_user == 'pripyat5' or $location_user == 'pripyat6' or $location_user == 'pripyat7' or $location_user == 'pripyat8' or $location_user == 'pripyat9' or $location_user == 'pripyat10') {
	?>
	<script type="text/javascript">
   document.location.href = "pripyat.php?location=<?php echo "$location_user";?>&err=6";
    </script>
  <?php
  }
  if ($location_user == 'study') {
	?>
	<script type="text/javascript">
   document.location.href = "study.php?err=6";
    </script>
  <?php
  }
  if ($location_user == 'secret') {
	?>
	<script type="text/javascript">
   document.location.href = "secret.php?err=6";
    </script>
  <?php
  }
  if ($location_user == 'base') {
	?>
	<script type="text/javascript">
   document.location.href = "base.php?err=6";
    </script>
  <?php
  }
  mysqli_close($dbc);
exit();
  }
  //////////////////////
  //Если состояние равно 0
  if ($sost_wp == 0) {
    $yron_wp = ($yron_wp*0.7);
$tochn_wp = ($yron_wp*0.7);
  }
  //////////////////////
}
/////////////////////////////////////

//Проверка на время оружия
$last_using_wp = strtotime("$last_using_wp");
$razn_wp = ($now - $last_using_wp);
if ($razn_wp < $speed_wp) {
  if ($location_user == 'kordon1' or $location_user == 'kordon2' or $location_user == 'kordon3' or $location_user == 'kordon4') {
	?>
	<script type="text/javascript">
   document.location.href = "kordon.php?location=<?php echo "$location_user";?>&err=3&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
    if ($location_user == 'svalka1' or $location_user == 'svalka2' or $location_user == 'svalka3' or $location_user == 'svalka4') {
	?>
	<script type="text/javascript">
   document.location.href = "svalka.php?location=<?php echo "$location_user";?>&err=3&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'agroprom1' or $location_user == 'agroprom2' or $location_user == 'agroprom3' or $location_user == 'agroprom4' or $location_user == 'agroprom5' or $location_user == 'agroprom6') {
	?>
	<script type="text/javascript">
   document.location.href = "agroprom.php?location=<?php echo "$location_user";?>&err=3&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'yantar1' or $location_user == 'yantar2' or $location_user == 'yantar3' or $location_user == 'yantar4' or $location_user == 'yantar5' or $location_user == 'yantar6') {
	?>
	<script type="text/javascript">
   document.location.href = "yantar.php?location=<?php echo "$location_user";?>&err=3&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'voensklad1' or $location_user == 'voensklad2' or $location_user == 'voensklad3' or $location_user == 'voensklad4' or $location_user == 'voensklad5' or $location_user == 'voensklad6' or $location_user == 'voensklad7') {
	?>
	<script type="text/javascript">
   document.location.href = "voensklad.php?location=<?php echo "$location_user";?>&err=3&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'pripyat1' or $location_user == 'pripyat2' or $location_user == 'pripyat3' or $location_user == 'pripyat4' or $location_user == 'pripyat5' or $location_user == 'pripyat6' or $location_user == 'pripyat7' or $location_user == 'pripyat8' or $location_user == 'pripyat9' or $location_user == 'pripyat10') {
	?>
	<script type="text/javascript">
   document.location.href = "pripyat.php?location=<?php echo "$location_user";?>&err=3&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'study') {
	?>
	<script type="text/javascript">
   document.location.href = "study.php?err=3";
    </script>
  <?php
  }
  if ($location_user == 'secret') {
	?>
	<script type="text/javascript">
   document.location.href = "secret.php?attack=<?php echo"$id_set"; ?>&err=3";
    </script>
  <?php
  }
  if ($location_user == 'base') {
	?>
	<script type="text/javascript">
   document.location.href = "base.php?attack=<?php echo"$id_set"; ?>&err=3";
    </script>
  <?php
  }
  mysqli_close($dbc);
exit();
}
/////////////////////////////////////

////////////////////////////////////Надёжность ОРУЖИЯ!!!
$weapon = $_GET['weapon'];
if (empty($weapon)) {
  $weapon = 'pistol';
}
if ($weapon == 'pistol') {
  $safety_w = $row_user['safety_p'];
}
else {
  $safety_w = $row_user['safety_w'];
}
$nadeg = rand(0,70);
if ($safety_w <= $nadeg) {
if ($location_user == 'kordon1' or $location_user == 'kordon2' or $location_user == 'kordon3' or $location_user == 'kordon4') {
	?>
	<script type="text/javascript">
   document.location.href = "kordon.php?location=<?php echo "$location_user";?>&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
    if ($location_user == 'svalka1' or $location_user == 'svalka2' or $location_user == 'svalka3' or $location_user == 'svalka4') {
	?>
	<script type="text/javascript">
   document.location.href = "svalka.php?location=<?php echo "$location_user";?>&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'agroprom1' or $location_user == 'agroprom2' or $location_user == 'agroprom3' or $location_user == 'agroprom4' or $location_user == 'agroprom5' or $location_user == 'agroprom6') {
	?>
	<script type="text/javascript">
   document.location.href = "agroprom.php?location=<?php echo "$location_user";?>&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'yantar1' or $location_user == 'yantar2' or $location_user == 'yantar3' or $location_user == 'yantar4' or $location_user == 'yantar5' or $location_user == 'yantar6') {
	?>
	<script type="text/javascript">
   document.location.href = "yantar.php?location=<?php echo "$location_user";?>&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'voensklad1' or $location_user == 'voensklad2' or $location_user == 'voensklad3' or $location_user == 'voensklad4' or $location_user == 'voensklad5' or $location_user == 'voensklad6' or $location_user == 'voensklad7') {
	?>
	<script type="text/javascript">
   document.location.href = "voensklad.php?location=<?php echo "$location_user";?>&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'pripyat1' or $location_user == 'pripyat2' or $location_user == 'pripyat3' or $location_user == 'pripyat4' or $location_user == 'pripyat5' or $location_user == 'pripyat6' or $location_user == 'pripyat7' or $location_user == 'pripyat8' or $location_user == 'pripyat9' or $location_user == 'pripyat10') {
	?>
	<script type="text/javascript">
   document.location.href = "pripyat.php?location=<?php echo "$location_user";?>&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'study') {
	?>
	<script type="text/javascript">
   document.location.href = "study.php";
    </script>
  <?php
  }
  if ($location_user == 'secret') {
	?>
	<script type="text/javascript">
   document.location.href = "secret.php?attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'base') {
	?>
	<script type="text/javascript">
   document.location.href = "base.php?attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing`) values (NOW(), '$user_id', 8 , 0)";
    $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД4');  
  mysqli_close($dbc);
exit();
}
///////////////////////////////////////////////

//Извлекаем данные о клане пользователя.
if (!empty($clan_user)) {
  $query_clan = "Select clan_opit, mentor, people from clans where clan_id = '$clan_user'";
  $result_clan = mysqli_query($dbc, $query_clan) or die ('Ошибка передачи запроса к БД10');
  $row_clan = mysqli_fetch_array($result_clan);
  $clan_opit_user = $row_clan['clan_opit'];
  $mentor_user = $row_clan['mentor'];
  $people_user = $row_clan['people'];
}
///////////////////////////////////////

//Если есть mentor_time у цели
$mentor_time_set = strtotime("$mentor_time_set");
$razn_mentor_set = ($now - $mentor_time_set);
if ($razn_mentor_set < 3600) {
  $query_clan = "Select mentor from clans where clan_id = '$clan_set'";
  $result_clan = mysqli_query($dbc, $query_clan) or die ('Ошибка передачи запроса к БД');
  $row_clan = mysqli_fetch_array($result_clan);
  $mentor_set = $row_clan['mentor'];
}
/////////////////////////////////


//К ДАННОМУ МЕСТУ МЫ ИМЕЕМ:
//1) Что человек залогинился
//2) Что человек не мёртв
//3) Что человек подходит для локации по ЛВЛ
//4) Что всё что нас интересует и нужно указанно или взято автоматически
//5) Определили вид оружия из которого атакуем
//6) Что юзер не атакует своих
//7) Проверили на смертность атакуемого
//8) Извлекли данные по оружию
//9) Проверили, что оружие готово.
//10) взяли данные клана пользователя
//11) Если есть наставники у цели, то берём их уровень.

///////////////////////////////////Атака
//////////////////////////////////////////
$p = rand(345000,375000);
$p = ($p/1000000);////Коэффициент
////////На наличие наставника
if (!empty($clan_user)) {
$mentor_time_user = strtotime("$mentor_time_user");
$razn_mentor_user = ($now - $mentor_time_user);
if ($razn_mentor_user < 3600) {
  if ($mentor_type_user == 1) { 
    $mentor_user = ($mentor_user / 2);
  }
  $yron_wp = ($yron_wp + ($yron_wp/100*$mentor_user));
  $tochn_wp = ($tochn_wp + ($tochn_wp/100*$mentor_user));
  $bronya_user = ($bronya_user + ($bronya_user/100*$mentor_user));
  $bronya_user = round ($bronya_user);
  $yron_wp = round ($yron_wp);
  $tochn_wp = round ($tochn_wp);
}
}
if (!empty($clan_set)) {
if ($razn_mentor_set < 3600) {
  if ($mentor_type_set == 1) { 
    $mentor_set = ($mentor_set / 2);
  }
  $bronya_set = ($bronya_set + ($bronya_set/100*$mentor_set));
  $bronya_set = round ($bronya_set);
}
}
/////////////////////////////////

if ($bronya_set == 0) { 
  $attack_user = (($yron_wp * $tochn_wp / 500) * $p);
  $attack_user = ($attack_user);
  $attack_user = round ($attack_user);
}
else {
  if ($sost_br_set == 0) {
    $attack_user = (($yron_wp * $tochn_wp) / ($bronya_set*0.6) * $p);
    $attack_user = ($attack_user);
    $attack_user = round ($attack_user);
  } 
  else {
  $attack_user = ((($yron_wp * $tochn_wp) / $bronya_set) * $p);
  $attack_user = ($attack_user);
  $attack_user = round ($attack_user);
  }
}
////Опыт
$opit_pl = ($attack_user*6);
$opit_pl = round($opit_pl);
if ($opit_pl < 1) {
  $opit_user = ($opit_user + 1);
}
else {
  $opit_user = ($opit_user + $opit_pl);
}  
////////////
////Автивность
$activ_pl = ($attack_user);
$activ_pl = round($activ_pl);
if ($activ_pl < 1) {
  $activ_user = ($activ_user + 1);
}
else {
  $activ_user = ($activ_user + $activ_pl);
}  
////////////
   
/////клан опыт
if (!empty($clan_user)) {

  $clan_opit_pl = (($opit_pl)/(sqrt($people_user)));
  $clan_opit_pl = round($clan_opit_pl);
  $clan_opit = ($clan_opit_user + $clan_opit_pl);
  $ko_user = ($ko_user + $clan_opit_pl);
}  
////////////

$hp_set = ($hp_set - $attack_user);

if ($hp_set < 0) {
  $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing` , `yron`) values (NOW(), '$user_id', 1 , '$id_set', '$attack_user')";
  $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД15');///Записали в лог, что ударили.
  $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing` , `yron`) values (NOW(), '$user_id', 2 , '$id_set', '$attack_user')";
  $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД12');///Записали в лог, что ударили.
    $query_re = "update users set hp = 0, last_active = NOW() where id = '$id_set'";
    $result_re = mysqli_query($dbc, $query_re) or die ('Ошибка передачи запроса к БД13');///Записали здоровье атакованного
  if (!empty($clan_user)) {
	$query_clan = "update clans set clan_opit = '$clan_opit' where clan_id = '$clan_user'";
	$result_clan = mysqli_query($dbc, $query_clan) or die ('Ошибка передачи запроса к БД14');
  }///КО клана 
}
if ($hp_set <> 0 and $hp_set > 0) {
  $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing` , `yron`) values (NOW(), '$user_id', 1 , '$id_set', '$attack_user')";
  $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД15');///Записали в лог, что ударили.
    $query_re = "update users set hp = '$hp_set', last_active = NOW() where id = '$id_set'";
    $result_re = mysqli_query($dbc, $query_re) or die ('Ошибка передачи запроса к БД16');///Записали здоровье атакованного
  if (!empty($clan_user)) {
	$query_clan = "update clans set clan_opit = '$clan_opit' where clan_id = '$clan_user'";
	$result_clan = mysqli_query($dbc, $query_clan) or die ('Ошибка передачи запроса к БД17');
  }///КО клана 
}

$query_lvl = "Select lvl, opit from opit order by lvl desc";
$result_lvl = mysqli_query($dbc, $query_lvl) or die ('Ошибка передачи запроса к БД3');
$row_lvl = mysqli_fetch_array($result_lvl);
$lvl_user=$row_lvl['lvl'];
while (($opit_user/100) < $row_lvl['opit']) {
  $lvl_user=($lvl_user-1);
  $row_lvl = mysqli_fetch_array($result_lvl);
}
if ($lvl_user_bd<$lvl_user) {
      $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing` , `yron`) values (NOW(), '$user_id', 6 , '0', '$lvl_user')";
      $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД21');
}
$apt=0;
$rad=0;
$radapt = rand(1,100);
if ($radapt>96) {
  $choose = rand(1,10);
  if ($choose <=8) {
    $apt=1;
	$query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing` , `yron`) values (NOW(), '$user_id', 15 , '0', '')";
    $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД21');
  }
  if ($choose >8) {
    $rad=1;
	$query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing` , `yron`) values (NOW(), '$user_id', 14 , '0', '')";
    $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД21');
  }
} 
////////////////////
if ($weapon == 'avtomat') {
  if ($opit_user < $tratata1) {
    $query_re_wp = "update users set activ = '$activ_user', aptechki=aptechki+'$apt', antirad=antirad+'$rad', opit = '$opit_user', lvl='$lvl_user', ko = '$ko_user', hp = '$hp_user', last_active = NOW(), time_w = NOW() where id = '$user_id'";
	$result_re_wp = mysqli_query($dbc, $query_re_wp) or die ('Ошибка передачи запроса к БД22');
  } 
  else {
  $query_re_wp = "update users set activ = '$activ_user', aptechki=aptechki+'$apt', antirad=antirad+'$rad' ,  opit = '$tratata', lvl='$lvl_user', ko = '$ko_user', hp = '$hp_user', last_active = NOW(), time_w = NOW() where id = '$user_id'";
	$result_re_wp = mysqli_query($dbc, $query_re_wp) or die ('Ошибка передачи запроса к БД29');
  }
}
else {
  if ($opit_user < $tratata1) {
  $query_re_wp = "update users set activ = '$activ_user', aptechki=aptechki+'$apt', antirad=antirad+'$rad' , opit = '$opit_user', lvl='$lvl_user', ko = '$ko_user', hp = '$hp_user', last_active = NOW(), time_p = NOW() where id = '$user_id'";
  $result_re_wp = mysqli_query($dbc, $query_re_wp) or die ('Ошибка передачи запроса к БД23');
  } 
  else {
  $query_re_wp = "update users set activ = '$activ_user', aptechki=aptechki+'$apt', antirad=antirad+'$rad' , opit = '$tratata', lvl='$lvl_user', ko = '$ko_user', hp = '$hp_user', last_active = NOW(), time_p = NOW() where id = '$user_id'";
  $result_re_wp = mysqli_query($dbc, $query_re_wp) or die ('Ошибка передачи запроса к БД23');
  }
}
require_once('conf/habar.php');

/////////////////////////////////////
if ($invite_user > 0) {
  $query = "select clan, ko, opit from users where id = '$invite_user' and ban != 1 limit 1";
  $result= mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД14');
  $row = mysqli_fetch_array($result);
  if (!empty($row)) {
    $clan = $row['clan'];////id клана
	$ko = $row['ko'];////////КО у юзера
	$opit = $row['opit'];//Опыт
	$opit_pl = ($opit_pl*0.1);//добавочный опт
	$opit_pl = round($opit_pl);
	$opit_user = ($opit + $opit_pl);////////////Опыт для типа
	if ($clan <> 0) {//Если есть kлан
	  $query = "Select clan_opit,people from clans where clan_id = '$clan' limit 1";
      $result= mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД10');
	  $row = mysqli_fetch_array($result);
	  $clan_opit = $row['clan_opit'];//Клан опыт в клане
	  $people = $row['people'];/////////ЛЮДИ В КЛАНЕ
	  $clan_opit_pl = ($opit_pl/(sqrt($people)));
	  $clan_opit_pl = round($clan_opit_pl);
	  $clan_opit = ($clan_opit+$clan_opit_pl);
	  $query = "update clans set clan_opit = '$clan_opit' where  clan_id = '$clan' limit 1";
      $result= mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД10');
	  $ko = ($ko + $clan_opit_pl);
	  $query = "update users set opit = '$opit_user', ko = '$ko' where  id = '$invite_user' limit 1";
      $result= mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД10');
	}
	else {
	  $query = "update users set opit = '$opit_user' where  id = '$invite_user' limit 1";
      $result= mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД10');
	}
  }
}  
/////////////////////////////////////
/////////////////////////?>
    <?php
	if ($location_user == 'kordon1' or $location_user == 'kordon2' or $location_user == 'kordon3' or $location_user == 'kordon4') {
	?>
	<script type="text/javascript">
   document.location.href = "kordon.php?location=<?php echo "$location_user";?>&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
    if ($location_user == 'svalka1' or $location_user == 'svalka2' or $location_user == 'svalka3' or $location_user == 'svalka4') {
	?>
	<script type="text/javascript">
   document.location.href = "svalka.php?location=<?php echo "$location_user";?>&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'agroprom1' or $location_user == 'agroprom2' or $location_user == 'agroprom3' or $location_user == 'agroprom4' or $location_user == 'agroprom5' or $location_user == 'agroprom6') {
	?>
	<script type="text/javascript">
   document.location.href = "agroprom.php?location=<?php echo "$location_user";?>&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'yantar1' or $location_user == 'yantar2' or $location_user == 'yantar3' or $location_user == 'yantar4' or $location_user == 'yantar5' or $location_user == 'yantar6') {
	?>
	<script type="text/javascript">
   document.location.href = "yantar.php?location=<?php echo "$location_user";?>&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'voensklad1' or $location_user == 'voensklad2' or $location_user == 'voensklad3' or $location_user == 'voensklad4' or $location_user == 'voensklad5' or $location_user == 'voensklad6' or $location_user == 'voensklad7') {
	?>
	<script type="text/javascript">
   document.location.href = "voensklad.php?location=<?php echo "$location_user";?>&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'pripyat1' or $location_user == 'pripyat2' or $location_user == 'pripyat3' or $location_user == 'pripyat4' or $location_user == 'pripyat5' or $location_user == 'pripyat6' or $location_user == 'pripyat7' or $location_user == 'pripyat8' or $location_user == 'pripyat9' or $location_user == 'pripyat10') {
	?>
	<script type="text/javascript">
   document.location.href = "pripyat.php?location=<?php echo "$location_user";?>&attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'study') {
	?>
	<script type="text/javascript">
   document.location.href = "study.php";
    </script>
  <?php
  }
  if ($location_user == 'secret') {
	?>
	<script type="text/javascript">
   document.location.href = "secret.php?attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  if ($location_user == 'base') {
	?>
	<script type="text/javascript">
   document.location.href = "base.php?attack=<?php echo"$id_set"; ?>";
    </script>
  <?php
  }
  ///Назад в локу
   mysqli_close($dbc);

?>