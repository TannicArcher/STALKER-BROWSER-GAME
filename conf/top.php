<?php
$user_top = $_SESSION['id'];
$query_pg = "Select `pg` from users where id = '$user_top'";
$result_pg = mysqli_query($dbc, $query_pg) or die ('Ошибка передачи запроса к БД');
$row_pg = mysqli_fetch_array($result_pg);
$pg = $row_pg['pg'];
?>
<?php
if ($pg == '1') {?>
<div class="pg3">
<div class="margin">
<?php } else {?>
<div style="border-left:1px solid #444e4f;border-right:1px solid #444e4f;">
<?php }?>
<div class="blockk">
<div class="pole2">
<?php
$user_top = $_SESSION['id'];
$ipp = getenv("REMOTE_ADDR");
$agent_user = $_SERVER['HTTP_USER_AGENT'];
$query_au = "update users set user_agent = '$agent_user' where id = '$user_top' limit 1";
$result_au = mysqli_query($dbc, $query_au) or die ('Ошибка передачи запроса к БД');
if ($user_top == '11319') {
echo "Ваш ip заблокирован администратором.";
exit;
}
?>



<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////Проверяем Баны
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$ban_p = '0';
$ban_f = '0';
$ban_c = '0';
$blocked = '0';
$query_pb = "Select * from bans where user_id = '$user_top' and type = '1'";
$result_pb = mysqli_query($dbc, $query_pb) or die ('Ошибка передачи запроса к БД');
$row_pb = mysqli_fetch_array($result_pb);
if ($row_pb > '0') {
$ban_p = '1';
$mod_id1 = $row_pb['mod_id'];
$time_ban1 = $row_pb['time_ban'];
$time_type1 = $row_pb['time_type'];
$wtf1 = $row_pb['wtf'];
$query_pb1 = "Select nick from users where id = '$mod_id1'";
$result_pb1 = mysqli_query($dbc, $query_pb1) or die ('Ошибка передачи запроса к БД');
$row_pb1 = mysqli_fetch_array($result_pb1);
$mn1 = $row_pb1['nick'];


$tp1 = ($time_type1 * '60');
$wwon1 = (date("Y-m-d H:i:s"));
$wwon1 = strtotime("$wwon1");
$loto_time1 = $time_ban1;
$loto_time1 = strtotime("$loto_time1");
$loto_time1 = ($loto_time1 + $tp1);
$btp = ($loto_time1 - $wwon1);

if ($btp < '1') {
$query = "delete from bans where user_id = '$user_top' and type = '1' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$query_fb = "Select * from bans where user_id = '$user_top' and type = '2'";
$result_fb = mysqli_query($dbc, $query_fb) or die ('Ошибка передачи запроса к БД');
$row_fb = mysqli_fetch_array($result_fb);
if ($row_fb > '0') {
$ban_f = '1';
$mod_id2 = $row_fb['mod_id'];
$time_ban2 = $row_fb['time_ban'];
$time_type2 = $row_fb['time_type'];
$wtf2 = $row_fb['wtf'];
$query_fb1 = "Select nick from users where id = '$mod_id2'";
$result_fb1 = mysqli_query($dbc, $query_fb1) or die ('Ошибка передачи запроса к БД');
$row_fb1 = mysqli_fetch_array($result_fb1);
$mn2 = $row_fb1['nick'];


$tp2 = ($time_type2 * '60');
$wwon2 = (date("Y-m-d H:i:s"));
$wwon2 = strtotime("$wwon2");
$loto_time2 = $time_ban2;
$loto_time2 = strtotime("$loto_time2");
$loto_time2 = ($loto_time2 + $tp2);
$btf = ($loto_time2 - $wwon2);

if ($btf < '1') {
$query = "delete from bans where user_id = '$user_top' and type = '2' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$query_cb = "Select * from bans where user_id = '$user_top' and type = '3'";
$result_cb = mysqli_query($dbc, $query_cb) or die ('Ошибка передачи запроса к БД');
$row_cb = mysqli_fetch_array($result_cb);
if ($row_cb > '0') {
$ban_c = '1';
$mod_id3 = $row_cb['mod_id'];
$time_ban3 = $row_cb['time_ban'];
$time_type3 = $row_cb['time_type'];
$wtf3 = $row_cb['wtf'];
$query_cb1 = "Select nick from users where id = '$mod_id3' limit 1";
$result_cb1 = mysqli_query($dbc, $query_cb1) or die ('Ошибка передачи запроса к БД');
$row_cb1 = mysqli_fetch_array($result_cb1);
$mn3 = $row_cb1['nick'];


$tp3 = ($time_type3 * '60');
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$loto_time3 = $time_ban3;
$loto_time3 = strtotime("$loto_time3");
$loto_time3 = ($loto_time3 + $tp3);
$btc = ($loto_time3 - $now);

if ($btc < '1') {
$query = "delete from bans where user_id = '$user_top' and type = '3' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$query_blb = "Select * from bans where user_id = '$user_top' and type = '4'";
$result_blb = mysqli_query($dbc, $query_blb) or die ('Ошибка передачи запроса к БД');
$row_blb = mysqli_num_rows($result_blb);
if ($row_blb > '0') {
$blocked = '1';
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////Проверили
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$ipod = strpos($user_agent,"iPod");
$iphone = strpos($user_agent,"iPhone");
$android = strpos($user_agent,"Android");
$symb = strpos($user_agent,"Symbian");
$winphone = strpos($user_agent,"WindowsPhone");
$wp7 = strpos($user_agent,"WP7");
$wp8 = strpos($user_agent,"WP8");
$operam = strpos($user_agent,"Opera M");
$palm = strpos($user_agent,"webOS");
$berry = strpos($user_agent,"BlackBerry");
$mobile = strpos($user_agent,"Mobile");
$htc = strpos($user_agent,"HTC_");
$fennec = strpos($user_agent,"Fennec/");
if ($ipod || $iphone || $android || $symb || $winphone || $wp7 || $wp8 || $operam || $palm || $berry || $mobile || $htc || $fennec) {
$query_device = "update users set device = '1' where id = '$user_top' limit 1";
$result_device = mysqli_query($dbc, $query_device) or die ('Ошибка передачи запроса к БД');
$sms_o = '0';
} else {
$query_device = "update users set device = '2' where id = '$user_top' limit 1";
$result_device = mysqli_query($dbc, $query_device) or die ('Ошибка передачи запроса к БД');
$sms_o = '1';
}
?>




<?php
$time_beg=microtime();
$query_hp = "Select * from users where id = '$user_top'";
$result_hp = mysqli_query($dbc, $query_hp) or die ('Ошибка передачи запроса к БД');
$row_hp = mysqli_fetch_array($result_hp);
$day_bon = $row_hp['bon'];
$fee = $row_hp['nick'];
$ny = $row_hp['ny'];
$hp = $row_hp['hp'];
$ahah = $row_hp['lvl'];
$read_ad = $row_hp['read_ad'];
$gruppa_inv = $row_hp['gruppa'];
$location = $row_hp['location'];
$antirad_time = $row_hp['antirad_time'];
$radiation = $row_hp['radiation'];
$regen = $row_hp['regen'];
$mc1 = $row_hp['mc'];
$mentor_time = $row_hp['mentor_time'];
$mentor_type = $row_hp['mentor_type'];
$max_hp = $row_hp['max_hp'];
$last_active = $row_hp['last_active'];
$clan_ad = $row_hp['clan'];
$now = (date("Y-m-d H:i:s"));
$last_active = strtotime("$last_active");
$now=strtotime("$now");
$poisk_tip = $row_hp['poisk_tip'];
$poisk_time = $row_hp['poisk_time'];
$poisk_time = strtotime("$poisk_time");
$time_v = ($poisk_time - $now);
$poisk = $row_hp['poisk'];
$time_vz = ($now - $poisk_time);
$time_t1 = ('1800' - $time_vz);
$time_t2 = ('5400' - $time_vz);
$time_t3 = ('10800' - $time_vz);
$time_t4 = ('21600' - $time_vz);
$quest = $row_hp['quest'];
$kol = $row_hp['kol'];
$need_kol = $row_hp['need_kol'];
$vid = $row_hp['vid'];
$priz_q = $row_hp['priz_q'];
$polosa = $row_hp['polosa'];
$new = $row_hp['new'];
$clan_mes = $row_hp['clan_mes'];
$message = $row_hp['message'];
$pokaz = $row_hp['pokaz'];
$arena = $row_hp['arena'];
$events = $row_hp['events'];
$moneyy = $row_hp['money'];
$habarr = $row_hp['habar'];
$chek = $row_hp['dengi'];
$aptt = $row_hp['aptechki'];
$radd = $row_hp['antirad'];
$ipp = getenv("REMOTE_ADDR");
$arena_time1 = $row_hp['arena_time'];
$arena_time1 = strtotime("$arena_time1");
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$tim1 = ($arena_time1 + '300');
$time11 = ($tim1 - $now);
?>


<?php

/////////////////////////////////////////////////Атака всякой нечести:)
    $m_fight=$row_hp['m_fight'];
	if ($m_fight<> 0) { 
	$query_at = "Select id_monster, hp, start, last_active, time_start, clan_id from m_fight where id_fight= '$m_fight' limit 1";
    $result_at = mysqli_query($dbc, $query_at) or die ('Ошибка передачи запроса к БД2');
    $row_at = mysqli_fetch_array($result_at);
	if (!empty($row_at)) {
	  if ($row_at['start'] == 1 and $row_at['hp'] > 0) {
	   $m_at = $row_at['id_monster'];
	   $query_m = "Select name, screen, clan, max_people, max_hp, bronya, yron, speed, bonus_type, bonus, location, time_angry, location_name, respawn_time, max_aptechki from monsters where id_monster = '$m_at' limit 1";
$result_m = mysqli_query($dbc, $query_m) or die ('Ошибка передачи запроса к БД2');
$row_m = mysqli_fetch_array($result_m);
$max_people=$row_m['max_people'];
$max_hp_m=$row_m['max_hp'];
$loca=$row_m['location'];
	   
	   
	   
	    ///////////////////////РАНДОМНАЯ Атака Монстра
  $now = (date("Y-m-d H:i:s"));
  $now = strtotime("$now");
  $last_active = $row_at['last_active'];
  $last_active = strtotime("$last_active");
  $time = ($now - $last_active);
  $speed = $row_m['speed'];
  $count = ($time/$speed);
  $s=0;
  $count = round($count);
  while ($s <> $count) {
    
    $s=$s+1;
    $query_att = "Select id, hp, bronya, sost_cl, razriv_cl, sost_cl from users where location='$loca' and hp > 0 and last_active > NOW() - (60*5) and ban != 1 and m_fight = '$m_fight'";
    $result_att = mysqli_query($dbc, $query_att) or die ('Ошибка передачи запроса к БД7'); 
    $count_att = mysqli_num_rows($result_att);
	$row_att = mysqli_fetch_array($result_att);
	$t=1;
	$rand_number = rand(1,$count_att);
	while ($t<>$rand_number) {
      $t=$t+1;
      $row_att = mysqli_fetch_array($result_att);
    }
	///////////Жертва выбраnа
	if ($row_att['sost_cl'] > 0) {
	  $bron = $row_att['razriv_cl'];
	}
	else {
	  $bron = 0;
	}
	$p = rand(245,275);
    $p = ($p/1000);
	if ($bron <> 0) {
	  $attack = (($row_m['yron'] / $bron) * $p);
	}
    else {
	  $attack = ($row_m['yron'] * $p);
	}
	$hp_att = ($row_att['hp'] - $attack);
	if ($hp_att <= 0) {
	  if ($count_att <= 1) {
	    if ($row_m['clan'] <> 0) {
	      $query = "update m_fight set start = 0, hp='$max_hp_m' where id_fight='$m_fight' limit 1";
          $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД4g');
		 }
	     $query = "update users set m_fight = 0 where m_fight='$m_fight' limit $max_people";
         $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД4gt');
	  }
	}
	$id_att = $row_att['id'];
	if ($id_att == $user_top) {
	  $hp=($hp_att);
	  $hp=round($hp);
	}
	$query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing` , `yron`) values (NOW(), '$m_at', 10 , '$id_att', '$attack')";
    $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД18');
	if ($hp_att < 0) { 
	  $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing` , `yron`) values (NOW(), '$m_at', 11 , '$id_att', '0')";
      $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД18');
	}
	$query_reb = "update users set hp = '$hp_att' where  id = '$id_att' limit 1";
    $result_reb= mysqli_query($dbc, $query_reb) or die ('Ошибка передачи запроса к БД10');
	if ($id_att == $user_id) {
	$hphp=$hp_att;
	}
	$query_reb = "update m_fight set last_active=NOW() where  id_fight = '$m_fight' limit 1";
    $result_reb= mysqli_query($dbc, $query_reb) or die ('Ошибка передачи запроса к БД10');	
  }
  ////////////////////////////////////////////
  ////////////////////////////////////////////
      }
	}
   }

///////////////////////////////////////////////////////////////////////// Конец нечести.
$last_active = $row_hp['last_active'];
$last_active = strtotime("$last_active");
///////////////////////////////Наставник
if (!empty($clan_ad)) {
  $mentor_time = strtotime("$mentor_time");
  $razn_mentor = ($now - $mentor_time);
  if ($razn_mentor_user < 3600) {
    $query_ment = "Select mentor from clans where clan_id = '$clan_ad'";
    $result_ment = mysqli_query($dbc, $query_ment) or die ('Ошибка передачи запроса к БД');
    $row_ment = mysqli_fetch_array($result_ment);
	$mentor = $row_ment['mentor'];
    if ($mentor_type == 1) { 
	  $mentor = ($mentor/2);
    }
  $max_hp = ($max_hp+$max_hp/100*$mentor);
  }
}
/////////////////////////////////////////
$hp_time = ($now - $last_active);








if ($hp > 0 ) {
    $antirad_time = strtotime("$antirad_time");
    $time = (date("Y-m-d H:i:s"));
    $time = strtotime("$time");
    $antirad_time = ($time - $antirad_time);
  if ($location <> 'index' and $antirad_time > 7200) {
    $query_loc = "select radiation from location where location_name = '$location'  limit 1";
    $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД2');
    $row_loc = mysqli_fetch_array($result_loc);
	$radiation_loc = $row_loc['radiation'];
	$hp_down_rad = ($radiation - $radiation_loc);
	if ($hp_down_rad < 0) { 
	  $regen = ($regen + $hp_down_rad);
	}
	$showregen = abs($regen);
  }
if ($hp_time !=0) {
  $hp_up = ($hp_time * $regen);
  $hp_up = ($hp + $hp_up);
      if ($hp_up <= 0) {
	    $query_time_hp = "update users set hp = 0, last_active = NOW() where id = '$user_top' limit 1";
	    $result_time_hp = mysqli_query($dbc, $query_time_hp) or die ('Ошибка передачи запроса к БД');
		$hp = 0;	
	  }
      if (($max_hp > $hp_up) and ($hp_up > 0)) {
	    $query_time_hp = "update users set hp = '$hp_up', last_active = NOW() where id = '$user_top' limit 1";
	    $result_time_hp = mysqli_query($dbc, $query_time_hp) or die ('Ошибка передачи запроса к БД');	
      }
      if ($hp_up > $max_hp) {
	    $query_time_hp = "update users set hp = '$max_hp', last_active = NOW() where id = '$user_top' limit 1";
	    $result_time_hp = mysqli_query($dbc, $query_time_hp) or die ('Ошибка передачи запроса к БД');
      }
}
else {
  if ($hp<0) {
  $hp=0;
  }
}
}
else {
  if ($hp<0) {
  $hp=0;
  }
}

$time_p = '--';
$speed_p = $row_hp['speed_p'];
$last_using_p = $row_hp['time_p'];
if ($speed_p <> 0) {
  $last_using_p=strtotime("$last_using_p");
  $timer_p = ($now - $last_using_p);
  $time_p = ($speed_p - $timer_p);
  if ($time_p <0) {
    $time_p = 0;
  }
}
////	
$query_up_act = "update users set last_active = NOW() where id = '$user_top'";
$result_up_act = mysqli_query($dbc, $query_up_act) or die ('Ошибка передачи запроса к БД');
//////

$time_w = '--';
$speed_w = $row_hp['speed_w'];
$last_using_w = $row_hp['time_w'];
if ($speed_w <> 0) {
  $last_using_w=strtotime("$last_using_w");
  $timer_w = ($now - $last_using_w);
  $time_w = ($speed_w - $timer_w);
  if ($time_w <0) {
    $time_w = 0;
  }
}							
?>
<div class="line">





<?php if ($day_bon == '0') {?>
<?php
$query = "update users set dengi=dengi+'1000', slava=slava+'1', bon='1' where id = '$user_top'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<div style="background: gold;">
<i><p class="lal" style="color: black;">Спасибо, что играете в нашу игру! Вам ежедневный бонус: 1000 <img src="http://stalkeronlinegame.epizy.com/img/chek.png" width="15" height="15"/>чеков и 1 <img src="http://stalkeronlinegame.epizy.com/img/slava.png" width="15" height="15"/>славы.</p></i>
</div>
<?php }?>
 
<div id="top">
<?php if ($message != '0' or $new != '0' or $clan_mes != '0' or $mc1 != '0') {if ($pokaz == '1') {?><span class="gold"> Вам пришло сообщение!</span> <a class="gold" href="http://stalkeronlinegame.epizy.com/mailbox.php"><img src="http://stalkeronlinegame.epizy.com/img/ico/mail2.png"  alt="п"width="12" height="12"/>[прочитать]</a><br /><?php }}?>
  <?php if ($message == '0' and $new == '0' and $clan_mes == '0' and $mc1 == '0') {?><a href="http://stalkeronlinegame.epizy.com/mailbox.php"><img src="http://stalkeronlinegame.epizy.com/img/ico/mail3.png" width="12" height="12"/></a><?php } else {?><a href="http://stalkeronlinegame.epizy.com/mailbox.php"><img src="http://stalkeronlinegame.epizy.com/img/ico/mail2.png" width="12" height="12"/></a><?php }?>
<?php
echo " ";
?><img src="http://stalkeronlinegame.epizy.com/img/ico/life.png" alt="h" width="12" height="12"/><?php echo "$hp";?>
<?php
echo " ";
?><img src="http://stalkeronlinegame.epizy.com/img/ico/pistol.png" alt="p" width="12" height="12"/><?php echo "$time_p";?>
<?php
echo " ";
?><img src="http://stalkeronlinegame.epizy.com/img/ico/weapon.png" alt="w" width="36" height="12"/><?php echo "$time_w";?>
<?php
  if ($row_hp['sost_cl']<=0 and $row_hp['bronya'] <> 0) {
  $show=1;
  }
  if ($row_hp['sost_p']<=0 and $row_hp['speed_p'] <> 0) {
  $show=1;
  }
  if ($row_hp['sost_w']<=0 and $row_hp['speed_w'] <> 0) {
  $show=1;
  }
  if ($show==1) {
  ?><a href="http://stalkeronlinegame.epizy.com/clothes.php?id=<?php echo "$user_top"; ?>"><img src="http://stalkeronlinegame.epizy.com/img/ico/redshield.png" alt="w" width="12" height="12" border="0"/></a> <?php 
  }
////////////////////////////////////////////////Излучение
if ($location <> 'index') {
  if ($regen < 0 and $regen > -10) {
    ?><img src="http://stalkeronlinegame.epizy.com/img/ico/smrad.png" alt="r" width="12" height="12"/><?php echo "$showregen";
  }
  
  if ($regen < -10) {
    ?><img src="http://stalkeronlinegame.epizy.com/img/ico/bigrad.png" alt="r" width="12" height="12"/><?php echo "$showregen";
  }
}
?>
<?php if ($time11 > '0' and $location <> 'arrena') {?> 
[<img src="http://stalkeronlinegame.epizy.com/img/ico/time.png" />
<?php
if ($time11 < '60') {?><?php echo "$time11";?> секунд<?php }
if ($time11 > '59' and $time11 < '120') {?>2 минуты<?php }
if ($time11 > '119' and $time11 < '180') {?>3 минуты<?php }
if ($time11 > '179' and $time11 < '240') {?>4 минуты<?php }
if ($time11 > '239' and $time11 < '300') {?>5 минут<?php }
if ($time11 > '299' and $time11 < '360') {?>6 минут<?php }
if ($time11 > '359' and $time11 < '420') {?>7 минут<?php }
if ($time11 > '419' and $time11 < '480') {?>8 минут<?php }
if ($time11 > '479' and $time11 < '540') {?>9 минут<?php }
if ($time11 > '539' and $time11 < '600') {?>10 минут<?php }
if ($time11 > '599' and $time11 < '660') {?>11 минут<?php }
if ($time11 > '659' and $time11 < '720') {?>12 минут<?php }
if ($time11 > '719' and $time11 < '780') {?>13 минут<?php }
if ($time11 > '779' and $time11 < '840') {?>14 минут<?php }
if ($time11 > '839' and $time11 < '900') {?>15 минут<?php }
if ($time11 > '899' and $time11 < '960') {?>16 минут<?php }
if ($time11 > '959' and $time11 < '1020') {?>17 минут<?php }
if ($time11 > '1019' and $time11 < '1080') {?>18 минут<?php }
if ($time11 > '1079' and $time11 < '1140') {?>19 минут<?php }
if ($time11 > '1139' and $time11 < '1200') {?>20 минут<?php }
if ($time11 > '1199' and $time11 < '1260') {?>21 минута<?php }
if ($time11 > '1259' and $time11 < '1320') {?>22 минуты<?php }
if ($time11 > '1319' and $time11 < '1380') {?>23 минуты<?php }
if ($time11 > '1379' and $time11 < '1440') {?>24 минуты<?php }
if ($time11 > '1439' and $time11 < '1500') {?>25 минут<?php }
if ($time11 > '1499' and $time11 < '1560') {?>26 минут<?php }
if ($time11 > '1559' and $time11 < '1620') {?>27 минут<?php }
if ($time11 > '1619' and $time11 < '1680') {?>28 минут<?php }
if ($time11 > '1679' and $time11 < '1740') {?>29 минут<?php }
if ($time11 > '1739' and $time11 < '1800') {?>30 минут<?php }
if ($time11 > '1799' and $time11 < '1860') {?>31 минута<?php }
if ($time11 > '1859' and $time11 < '1920') {?>32 минуты<?php }
?>]
<?php }?>
<?php
if ($speed_p == 0) {?><div class="zx"><p class="red"><img src="http://stalkeronlinegame.epizy.com/img/ico/redshield.png" alt="w" width="12" height="12" border="0"/> Оденьте пистолет. [<a class="red" href="http://stalkeronlinegame.epizy.com/bag.php">в рюкзаке</a>]</p></div>
<?php }?><?php
if ($row_hp['bronya'] == 0) {?><div class="zx"><p class="red"><img src="http://stalkeronlinegame.epizy.com/img/ico/redshield.png" alt="w" width="12" height="12" border="0"/> Оденьте костюм. [<a class="red" href="http://stalkeronlinegame.epizy.com/bag.php">в рюкзаке</a>]</p></div>
<?php }?>




<?php
$user_id122 = $_SESSION['id'];
$query123 = "Select opit, lvl from users where id = '$user_id122' limit 1";
$result123 = mysqli_query($dbc, $query123) or die ('Ошибка передачи запроса к БД');
$row123 = mysqli_fetch_array($result123);
$opit123 = $row123['opit'];
$opit123 = ( $opit123 / '100');
$lvl123 = $row123['lvl'];
$query_lvl1 = "Select opit from opit where opit_id='$lvl123' limit 1";
$result_lvl1 = mysqli_query($dbc, $query_lvl1) or die ('Ошибка передачи запроса к БД');
$row_lvl1 = mysqli_fetch_array($result_lvl1);
$lvl1_opit = $row_lvl1['opit'];
$lvl3_opit = $row_lvl1['opit'];
$query_lvl2 = "Select opit from opit where lvl='$lvl123' limit 1";
$result_lvl2 = mysqli_query($dbc, $query_lvl2) or die ('Ошибка передачи запроса к БД');
$row_lvl2 = mysqli_fetch_array($result_lvl2);
$lvl2_opit = $row_lvl2['opit'];
$opit123 = ( $opit123 - $lvl2_opit );
$lvl1_opit = ( $lvl1_opit - $lvl2_opit );
$proc = (( '100' / $lvl1_opit ) * $opit123 );
$polos = (( '400' / '100') * $proc );
?>
<?php if ($polosa == '0') {?>
<table class="rblock blue esmall">
<tr>
<td><div class="value-block lh1"><span><span><img height="14" width="14" src="http://stalkeronlinegame.epizy.com/img/ico/lvl.gif"/><?php echo "$lvl123";?></span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="background: url(/img/poll-bar-small1.gif) no-repeat; width:<?php echo "$proc";?>%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span><?php $procn = round("$proc"); echo "$procn";?>%</span></span></div></td>
</tr>
</table>

<p style="border-top: solid 1px #444e4f"></p><?php }?>



<?php
$query_bit1 = "Select * from bitva_o where clan1='$clan_ad' or clan2='$clan_ad' limit 1";
$result_bit1 = mysqli_query($dbc, $query_bit1) or die ('Ошибка передачи запроса к БД');
$row_bit1 = mysqli_fetch_array($result_bit1);
$time_bitva3 = $row_bit1['time'];
$time_bitva3 = strtotime("$time_bitva3");
$now3 = (date("Y-m-d H:i:s"));
$now3 = strtotime("$now3");
$time_bittva3 = ($time_bitva3 + '1800');
$time_b3 = ($time_bittva3 - $now3);
?>
<?php
$query18 = "Select * from clans where clan_id='$clan_ad' limit 1";
$result18 = mysqli_query($dbc, $query18) or die ('Ошибка передачи запроса к БД3');
$row18 = mysqli_fetch_array($result18);
$gauss_time8 = $row18['gauss_time'];
$gt8 = strtotime("$gauss_time8");
$gt9 = ($gt8 + '150');
$gt10 = ($gt9 - $now3);
$gt_lal8 = ($gt10 - '90');
?>
<?php
  $query_war = "select war, gauss_at from clans where clan_id = '$clan_ad'";
  $result_war = mysqli_query($dbc, $query_war) or die ('Ошибка передачи запроса к БД');
  $row_war = mysqli_fetch_array($result_war);
  $qwar = $row_war['war'];
  $qgauss = $row_war['gauss_at'];
?>
<?php if ($events > '0') {?>
<center><p><img src="http://stalkeronlinegame.epizy.com/img/star.png"/><a class="bonus" href="http://stalkeronlinegame.epizy.com/events.php">У вас есть новые события</a>.</p></center>
<p style="border-top: dashed 1px #444e4f"></p>
<?php }?>
<?php if ($qgauss == '1' and $gt10 < '90') {?>
<p><a class="bonus" href="http://stalkeronlinegame.epizy.com/gauss.php">Ваш отряд пошел в прорыв</a></p>
<p style="border-top: dashed 1px #444e4f"></p>
<?php }?>
<?php if ($qgauss == '1' and $gt10 > '90') {?>
<p><a class="dan" href="http://stalkeronlinegame.epizy.com/gauss.php">Начались сборы на прорыв. Начало через <?php echo "$gt_lal8";?> секунд</a></p>
<p style="border-top: dashed 1px #444e4f"></p>
<?php }?>
<?php if ($qwar == '1' and $time_b3 > '0') {?>
<p><a class="dan" href="http://stalkeronlinegame.epizy.com/bitva.php">Твой отряд участвует в битве. Начало через <?php
$timeb3 = $time_b3;
if ($timeb3 < '60') {?><?php echo "$timeb3";?> секунд<?php }
if ($timeb3 > '59' and $timeb3 < '120') {?>1 минуту<?php }
if ($timeb3 > '119' and $timeb3 < '180') {?>2 минуты<?php }
if ($timeb3 > '179' and $timeb3 < '240') {?>3 минуты<?php }
if ($timeb3 > '239' and $timeb3 < '300') {?>4 минуты<?php }
if ($timeb3 > '299' and $timeb3 < '360') {?>5 минут<?php }
if ($timeb3 > '359' and $timeb3 < '420') {?>6 минут<?php }
if ($timeb3 > '419' and $timeb3 < '480') {?>7 минут<?php }
if ($timeb3 > '479' and $timeb3 < '540') {?>8 минут<?php }
if ($timeb3 > '539' and $timeb3 < '600') {?>9 минут<?php }
if ($timeb3 > '599' and $timeb3 < '660') {?>10 минут<?php }
if ($timeb3 > '659' and $timeb3 < '720') {?>11 минут<?php }
if ($timeb3 > '719' and $timeb3 < '780') {?>12 минут<?php }
if ($timeb3 > '779' and $timeb3 < '840') {?>13 минут<?php }
if ($timeb3 > '839' and $timeb3 < '900') {?>14 минут<?php }
if ($timeb3 > '899' and $timeb3 < '960') {?>15 минут<?php }
if ($timeb3 > '959' and $timeb3 < '1020') {?>16 минут<?php }
if ($timeb3 > '1019' and $timeb3 < '1080') {?>17 минут<?php }
if ($timeb3 > '1079' and $timeb3 < '1140') {?>18 минут<?php }
if ($timeb3 > '1139' and $timeb3 < '1200') {?>19 минут<?php }
if ($timeb3 > '1199' and $timeb3 < '1260') {?>20 минут<?php }
if ($timeb3 > '1259' and $timeb3 < '1320') {?>21 минуту<?php }
if ($timeb3 > '1319' and $timeb3 < '1380') {?>22 минуты<?php }
if ($timeb3 > '1379' and $timeb3 < '1440') {?>23 минуты<?php }
if ($timeb3 > '1439' and $timeb3 < '1500') {?>24 минуты<?php }
if ($timeb3 > '1499' and $timeb3 < '1560') {?>25 минут<?php }
if ($timeb3 > '1559' and $timeb3 < '1620') {?>26 минут<?php }
if ($timeb3 > '1619' and $timeb3 < '1680') {?>27 минут<?php }
if ($timeb3 > '1679' and $timeb3 < '1740') {?>28 минут<?php }
if ($timeb3 > '1739' and $timeb3 < '1800') {?>29 минут<?php }
if ($timeb3 > '1799' and $timeb3 < '1860') {?>30 минут<?php }
if ($timeb3 > '1859' and $timeb3 < '1920') {?>31 минуту<?php }
?></a></p>
<p style="border-top: dashed 1px #444e4f"></p>
<?php }?>
<?php if ($qwar == '1' and $time_b3 < '1') {?>
<p><a class="net" href="http://stalkeronlinegame.epizy.com/bitva.php">Твой отряд участвует в битве. Битва уже началась!</a></p>
<p style="border-top: dashed 1px #444e4f"></p>
<?php }?>
<?php if ($arena == '1') {?>
<p><a class="gold" href="http://stalkeronlinegame.epizy.com/arena2.php">Вы участвуете в бое на арене</a>.</p>
<p style="border-top: dashed 1px #444e4f"></p>
<?php }?>
<?php
if ($poisk_tip == '1' and $poisk == '1' and $time_v > '-1800') {?>
  <div class="stats">
<a class="white" href="http://stalkeronlinegame.epizy.com/vzlom.php">Идет процесс взлома. Осталось <?php echo "$time_t1";?> секунд, ждите</a>
</div>
<p style="border-top: dashed 1px #444e4f"></p><?php }
?>
<?php
if ($poisk_tip == '1' and $poisk == '1' and $time_v < '-1800') {?>

  <div class="stats">
<a class="bonus" href="http://stalkeronlinegame.epizy.com/vzlom.php">Тайник взломан! Что же там было?</a>
</div>
<p style="border-top: dashed 1px #444e4f"></p><?php }
?>
<?php
if ($poisk_tip == '1' and $poisk == '2' and $time_v > '-5400') {?>

  <div class="stats">
<a class="white" href="http://stalkeronlinegame.epizy.com/vzlom.php">Идет процесс взлома. Осталось <?php echo "$time_t2";?> секунд, ждите</a>
</div>
<p style="border-top: dashed 1px #444e4f"></p><?php }
?>
<?php
if ($poisk_tip == '1' and $poisk == '2' and $time_v < '-5400') {?>

  <div class="stats">
<a class="bonus" href="http://stalkeronlinegame.epizy.com/vzlom.php">Тайник взломан! Что же там было?</a>
</div>
<p style="border-top: dashed 1px #444e4f"></p><?php }
?>
<?php
if ($poisk_tip == '1' and $poisk == '3' and $time_v > '-10800') {?>

  <div class="stats">
<a class="white" href="http://stalkeronlinegame.epizy.com/vzlom.php">Идет процесс взлома. Осталось <?php echo "$time_t3";?> секунд, ждите</a>
</div>
<p style="border-top: dashed 1px #444e4f"></p><?php }
?>
<?php
if ($poisk_tip == '1' and $poisk == '3' and $time_v < '-10800') {?>

  <div class="stats">
<a class="bonus" href="http://stalkeronlinegame.epizy.com/vzlom.php">Тайник взломан! Что же там было?</a>
</div>
<p style="border-top: dashed 1px #444e4f"></p><?php }
?>
<?php
if ($poisk_tip == '1' and $poisk == '4' and $time_v > '-21600') {?>

  <div class="stats">
<a class="white" href="http://stalkeronlinegame.epizy.com/vzlom.php">Идет процесс взлома. Осталось <?php echo "$time_t4";?> секунд, ждите</a>
</div>
<p style="border-top: dashed 1px #444e4f"></p><?php }
?>
<?php
if ($poisk_tip == '1' and $poisk == '4' and $time_v < '-21600') {?>

  <div class="stats">
<a class="bonus" href="http://stalkeronlinegame.epizy.com/vzlom.php">Тайник взломан! Что же там было?</a>
</div>
<p style="border-top: dashed 1px #444e4f"></p><?php }
?>
<?php
if ($quest == '1' and $kol < $need_kol) {?>

<p class="white">Вы выполняете задание. Статус: убито <?php echo "$kol";?> из <?php echo "$need_kol";?>
<?php 
if ($vid == '1') {?> снорков<?php }
if ($vid == '2') {?> химер<?php }
if ($vid == '3') {?> слепых псов<?php }
if ($vid == '4') {?> контролеров<?php }
if ($vid == '5') {?> плотей<?php }
if ($vid == '6') {?> кровососов<?php }
if ($vid == '7') {?> псевдогигантов<?php }
?>
. Награда: <?php echo "$priz_q";?> хабара</p>
<p><img src="http://stalkeronlinegame.epizy.com/img/ico/no.png"/> <a class="white" href="http://stalkeronlinegame.epizy.com/quest_off.php">Отказаться от задания</a></p>
<p style="border-top: solid 1px #444e4f"></p><?php }
?>
<?php if ($quest == '1' and $kol == $need_kol and $vid != '0') {?>
<?php
$query = "update users set quests=quests+'1', quest='0', habar=habar+'$priz_q', need_kol='0', kol='0', vid='0', priz_q='0' where id = '$user_top' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>

<p class="bonus">Вы выполнили свое задание и получили <?php echo "$priz_q";?> <img src="http://stalkeronlinegame.epizy.com/img/ico/materials.png"/> хабара.</p>
<p style="border-top: solid 1px #444e4f"></p>
<?php }?>
<?php
$query = "update users set ip='$ipp' where id = '$user_top' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
$query = "update users set mentor_type='2', mentor_time=NOW() where clan != '0' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
$query_inv = "select user_id_in, clan_name, clan_id, id_in from in_clan where user_id = '$user_top'";
$result_inv = mysqli_query($dbc, $query_inv) or die ('Ошибка передачи запроса к БД');
$row_inv = mysqli_fetch_array($result_inv);
$user_id_in = $row_inv['user_id_in'];
$clan_name = $row_inv['clan_name'];
$clan_id = $row_inv['clan_id'];
$id_in = $row_inv['id_in'];
$count_inv = mysqli_num_rows($result_inv);
if ($count_inv <> 0) {
?>
  <p class="zx"><span class="bonus"><img src="http://stalkeronlinegame.epizy.com/img/ico/point.png" width="12" height="12"/> <a href="http://stalkeronlinegame.epizy.com/profile.php?id=<?php echo "$id_in";?>"><?php echo "$user_id_in";?></a> приглашает вас вступить в 
  <?php
  if ($gruppa_inv == 'svoboda') {?> <img src="http://stalkeronlinegame.epizy.com/img/ico/svobodaon.png" width="12" height="12"/><?php }
  if ($gruppa_inv == 'dolg') {?> <img src="http://stalkeronlinegame.epizy.com/img/ico/dolgon.png" width="12" height="12"/><?php }
  if ($gruppa_inv == 'naemniki') {?> <img src="http://stalkeronlinegame.epizy.com/img/ico/odinochkion.png" width="12" height="12"/><?php }
  ?><a href="http://stalkeronlinegame.epizy.com/company.php?company_id=<?php echo "$clan_id";?>"><?php echo "$clan_name";?></a></span></p>
  <p>[<a href="http://stalkeronlinegame.epizy.com/acceptinv.php?acc=1">Принять</a>][<a href="http://stalkeronlinegame.epizy.com/acceptinv.php?acc=2">Отклонить</a>]</p>
<?php
}
if (!empty($read_ad)) {
  $query_ad = "select ad_nick, ad from clans where clan_id = '$clan_ad'";
  $result_ad = mysqli_query($dbc, $query_ad) or die ('Ошибка передачи запроса к БД');
  $row_ad = mysqli_fetch_array($result_ad);
  $ad = $row_ad['ad'];
  $ad = str_replace('<','&lt;', $ad);
  $ad = str_replace('>','&gt;', $ad);
  $ad = str_replace('"','&quot', $ad);
  $ad = stripslashes("$ad");
  $ad_nick = $row_ad['ad_nick'];
  ?>
  <p class="zx"><span class="white">Объявление отряда: </span><span class="bonus"><?php echo "$ad // $ad_nick"; ?></span> <span class="white">[<a class="white" href="http://stalkeronlinegame.epizy.com/hidead.php">скрыть</a>]</span></p>
  <?php
}
?>
</div>
</div>
</div>