<?php
		$location = "$location_user";
		$query_loc = "select count, count_now, habar_ot, habar_do from location where location_name = '$location' limit 1";
        $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
        $row_loc = mysqli_fetch_array($result_loc);
		$count_loc = $row_loc['count'];
		$count_now_loc = $row_loc['count_now'];
		$new_count_now_loc = ($count_now_loc + $attack_user);
		if ($new_count_now_loc >= $count_loc) {
		  $query_loc = "update location set count_now = 0 where location_name = '$location' limit 1";
          $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
		  $query_h = "select id, habar, activ from users where location = '$location' and last_active > NOW() - (60*5) and hp != 0 and ban != 1 ORDER BY `activ` DESC limit 1";
          $result_h = mysqli_query($dbc, $query_h) or die ('Ошибка передачи запроса к БД');
		  $row_h = mysqli_fetch_array($result_h);
		  $id_user_hab = $row_h['id'];
		  $habar = $row_h['habar'];
		  $activ = $row_h['activ'];
		  $activ = ($activ-(($activ/100)*10));
		  $habar_ot= $row_loc['habar_ot'];
		  $habar_do= $row_loc['habar_do'];
		  $habar_up = rand($habar_ot,$habar_do);
		  $habar = ($habar + $habar_up);
		  $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing` , `yron`, `location`) values (NOW(), '$id_user_hab', 4 , '$habar_up', '0', '$location')";
          $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД');
		  $query_user_hab = "update users set habar = '$habar', activ = '$activ' where id = '$id_user_hab' limit 1";
	      $result_user_hab = mysqli_query($dbc, $query_user_hab) or die ('Ошибка передачи запроса к БД');
		}
		else {
		  $query_loc = "update location set count_now = '$new_count_now_loc' where location_name = '$location'";
          $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
		}
		//////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////
?>