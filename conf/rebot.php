<?php
$query_rebot = "Select id, hp, max_hp, last_active, time_p, yron_p,	tochn_p, speed_p, gruppa, regen from users where location = '$location' and gruppa != 'dolg'  and gruppa != 'svoboda' and gruppa != 'naemniki'";
$result_rebot = mysqli_query($dbc, $query_rebot) or die ('Ошибка передачи запроса к БД в респавне ботов');
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
while($row_rebot = mysqli_fetch_array($result_rebot)) {
  $hp_rebot = $row_rebot['hp'];
  $id_rebot = $row_rebot['id'];
  if ($hp_rebot == 0) {
    $max_hp_rebot = $row_rebot['max_hp'];
    $last_active_rebot = $row_rebot['last_active'];
    $last_active_rebot = strtotime("$last_active_rebot");
    $razn_rebot_t = ($now- $last_active_rebot);
	if ($razn_rebot_t >= 3) {
	  $query_reb = "update users set hp = '$max_hp_rebot', last_active=NOW()  where  id = '$id_rebot' limit 1";
      $result_reb= mysqli_query($dbc, $query_reb) or die ('Ошибка передачи запроса к БД10');
	}
  }
  else {
    $last_active=$row_rebot['last_active'];
	$regen_us=$row_rebot['regen'];
	$hp_us=$row_rebot['hp'];
	$max_hp_us=$row_rebot['max_hp'];
    //////////////////////////////////////////////HP
   $last_active_us = strtotime("$last_active");
   $hp_time_us = ($now - $last_active_us);
   if ($hp_time_us !=0) {
	$hp_up_us = ($hp_time_us * $regen_us);
    $hp_up_us = ($hp_us + $hp_up_us);
    if (($max_hp_us > $hp_up_us) and ($hp_up_us > 0)) {
	  $hp_us = $hp_up_us;
    }
    if ($hp_up_us > $max_hp_us) {
      $hp_us = $max_hp_us;
    }
  }
	//////////////////////////////////////////////////
    $time_p_abot = $row_rebot['time_p'];
	$time_p_abot = strtotime("$time_p_abot");
	$razn_abot = ($now - $time_p_abot);
	if ($razn_abot > $row_rebot['speed_p']) {
	  $query_abot = "Select id, hp, bronya, sost_cl, razriv_cl, sost_cl from users where location = '$location' and hp > 0 and last_active > NOW() - (60*5) and ban != 1 and id != '$id_rebot'";
      $result_abot = mysqli_query($dbc, $query_abot) or die ('Ошибка передачи запроса к БД7'); 
      $count_users = mysqli_num_rows($result_abot);
	  $row_count = mysqli_fetch_array($result_abot);
      $s=1;
      $rand_number = rand(1,$count_users);
      while ($s<>$rand_number) {
		$row_count = mysqli_fetch_array($result_abot);
        $s=$s+1;

      }
	  $id_set_abot = $row_count['id'];
	  //////////////Выбрали жертву
	  if ($row_count['sost_cl'] > 0) {
	    if ($row_count['gruppa'] == 'mytants') {
	      $bron = $row_count['razriv_cl'];
	    }
	    else {
	      $bron = $row_count['bronya'];
	    }
	  } 
	  else {
	    $bron = 0;
	  }
	  //////////////C бронёй разобрались
	  $p = rand(245,275);
      $p = ($p/1000);
	  if ($bron <> 0) {
	    $attack = ((($row_rebot['yron_p'] * $row_rebot['tochn_p']) / $bron) * $p);
	  }
	  else {
	    $attack = ((($row_rebot['yron_p'] * $row_rebot['tochn_p'])/(300)) * $p);
	  }
	  $id_abot = $row_count['id'];
	  //////////Атаку знаем.
	  $hp_abot = ($row_count['hp'] - $attack);
	  if ($hp_abot < 0) {
	    $hp_abot = 0;
	  }
	  $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing` , `yron`) values (NOW(), '$id_rebot', 1 , '$id_abot', '$attack')";
      $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД18');
	  $query_reb = "update users set hp = '$hp_abot' where  id = '$id_abot' limit 1";
      $result_reb= mysqli_query($dbc, $query_reb) or die ('Ошибка передачи запроса к БД10');
	  $query_reb = "update users set last_active=NOW(), hp='$hp_us',  time_p=NOW() where  id = '$id_rebot' limit 1";
      $result_reb= mysqli_query($dbc, $query_reb) or die ('Ошибка передачи запроса к БД10');
	  
	}
  }
}
?>