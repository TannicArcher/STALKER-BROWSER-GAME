<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "reg.php?err_login=1";
  </script>
  <?php
  exit();
}
$stat_number= $_GET['stat'];
$thing_id = $_GET['thing'];
$thing_id = htmlentities($thing_id, ENT_QUOTES);
$thing_id = mysqli_real_escape_string($dbc, trim($thing_id));	
$user_id = $_SESSION['id'];
if (empty($stat_number) or empty($thing_id)) {
  ?>
  <script type="text/javascript">
  document.location.href = "clothes.php?id=<?php echo "$user_id"?>";
  </script>
  <?php
  exit();
}
$query = "Select * from things where thing_id='$thing_id' and user_id='$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД2');
$total = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
if ($total == 0) {
  ?>
  <script type="text/javascript">
  document.location.href = "clothes.php?id=<?php echo "$user_id"?>";
  </script>
  <?php
  exit();
}
if ($stat_number > 4 or $stat_number < 1) {
  ?>
  <script type="text/javascript">
  document.location.href = "upgrade.php?thing=<?php echo "$thing_id"?>";
  </script>
  <?php
  exit();
}
//////////////////////Знаем что шмотка пользователя и она сушествует.
//////////////////////Знаем, что ид шмотки не пустой и апгрейд тоже и меньше 4
$query_up = "Select money, habar from users where id = '$user_id' limit 1";
$result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
$row_up = mysqli_fetch_array($result_up);
$money = $row_up['money'];
$habar = $row_up['habar'];
///stat1= stat1
///stat2= stat2
///stat3= stat3
///stat4= speed
if ($stat_number == 1) {
  $stat_up = $row['upgrade_stat1'];
}
if ($stat_number == 2) {
  $stat_up = $row['upgrade_stat2'];
}
if ($stat_number == 3) {
  $stat_up = $row['upgrade_stat3'];
}
if ($stat_number == 4) {
  $stat_up = $row['upgrade_speed'];
}
if ($stat_up>=4) {
  ?>
  <script type="text/javascript">
  document.location.href = "upgrade.php?thing=<?php echo "$thing_id"?>&err=1";
  </script>
  <?php
  exit();
}
$stat_up =($stat_up + 1);
$need_money = 0;
$need_habar = 0;
if ($stat_up == 4) {
  $need_money = 25000;
}
if ($stat_up == 3) {
  $need_money = 10000;
}
if ($stat_up == 2) {
$need_habar = 30000;
}
if ($stat_up == 1) {
$need_habar = 5000;
}
$money = ($money - $need_money);
$habar = ($habar - $need_habar);
if ($money < 0 or $habar < 0) {
  ?>
  <script type="text/javascript">
  document.location.href = "upgrade.php?thing=<?php echo "$thing_id"?>&err=2";
  </script>
  <?php
  exit();  
}
/////////////////////////////////////Денег хватает.

//////////////////////////////Если шмотка ОДЕТА 
if ($row['place'] == 2) {
  if ($stat_up == 4) {
    $procent = 75;
  }
  if ($stat_up == 3) {
    $procent = 50;
  }
  if ($stat_up == 2) {
    $procent = 25;
  }
  if ($stat_up == 1) {
    $procent = 15;
  }
  if ($row['type'] == 1) {////////////////одежда
    if ($stat_number == 1) {///Если это СТАТ1
	  $hp = ($row['stat1']);
	  $hp = ($hp + ($hp/100*$procent));
	  $query_up = "update users set money='$money', habar='$habar', max_hp = '$hp' where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	  $query_up = "update things set  upgrade_stat1 = '$stat_up' where user_id = '$user_id' and thing_id='$thing_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
	if ($stat_number == 2) {///СТАТ2
	  $bronya = ($row['stat2']);
	  $bronya = ($bronya + ($bronya/100*$procent));
	  $query_up = "update users set money='$money', habar='$habar', bronya = '$bronya' where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	  $query_up = "update things set  upgrade_stat2 = '$stat_up' where user_id = '$user_id' and thing_id='$thing_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
	if ($stat_number == 3) {///СТАТ3
	  $razriv_cl = ($row['stat3']);
	  $razriv_cl = ($razriv_cl + ($razriv_cl/100*$procent));
	  $query_up = "update users set money='$money', habar='$habar', razriv_cl = '$razriv_cl' where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	  $query_up = "update things set  upgrade_stat3 = '$stat_up' where user_id = '$user_id' and thing_id='$thing_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
	if ($stat_number == 4) {///СПЕЕД
	  $radiation = ($row['speed']);
	  $radiation = ($radiation + ($radiation/100*$procent));
	  $query_up = "update users set money='$money', habar='$habar', radiation = '$radiation' where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	  $query_up = "update things set  upgrade_speed = '$stat_up' where user_id = '$user_id' and thing_id='$thing_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
  }
  if ($row['type'] == 2) {////////////////pistol
    if ($stat_number == 1) {///Если это СТАТ1
	  $yron = ($row['stat1']);
$yron = ($yron + ($yron/100*$procent));
	  $query_up = "update users set money='$money', habar='$habar', yron_p = '$yron' where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	  $query_up = "update things set  upgrade_stat1 = '$stat_up' where user_id = '$user_id' and thing_id='$thing_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
	if ($stat_number == 2) {///СТАТ2
	  $tochn = ($row['stat2']);
	  $tochn = ($tochn + ($tochn/100*$procent));
	  $query_up = "update users set money='$money', habar='$habar', tochn_p = '$tochn' where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	  $query_up = "update things set  upgrade_stat2 = '$stat_up' where user_id = '$user_id' and thing_id='$thing_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
	if ($stat_number == 3) {///СТАТ3
	  $safety = ($row['stat3']);
	  $safety = ($safety + ($safety/100*$procent));
	  if ($safety > 100) {
	    $safety = 100;
	  }
	  $query_up = "update users set money='$money', habar='$habar', safety_p = '$safety' where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	  $query_up = "update things set  upgrade_stat3 = '$stat_up' where user_id = '$user_id' and thing_id='$thing_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
	if ($stat_number == 4) {///СПЕЕД
	  $speed = ($row['speed'] - $stat_up);
	  $query_up = "update users set money='$money', habar='$habar', speed_p = '$speed' where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	  $query_up = "update things set  upgrade_speed = '$stat_up' where user_id = '$user_id' and thing_id='$thing_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
  }
  if ($row['type'] == 3) {////////////////avtomat
    if ($stat_number == 1) {///Если это СТАТ1
	  $yron = ($row['stat1']);
$yron = ($yron + ($yron/100*$procent));
	  $query_up = "update users set money='$money', habar='$habar', yron_w = '$yron' where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	  $query_up = "update things set  upgrade_stat1 = '$stat_up' where user_id = '$user_id' and thing_id='$thing_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
	if ($stat_number == 2) {///СТАТ2
	  $tochn = ($row['stat2']);
	  $tochn = ($tochn + ($tochn/100*$procent));
	  $query_up = "update users set money='$money', habar='$habar', tochn_w = '$tochn' where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	  $query_up = "update things set  upgrade_stat2 = '$stat_up' where user_id = '$user_id' and thing_id='$thing_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
	if ($stat_number == 3) {///СТАТ3
	  $safety = ($row['stat3']);
	  $safety = ($safety + ($safety/100*$procent));
	  if ($safety > 100) {
	    $safety = 100;
	  }
	  $query_up = "update users set money='$money', habar='$habar', safety_w = '$safety' where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	  $query_up = "update things set  upgrade_stat3 = '$stat_up' where user_id = '$user_id' and thing_id='$thing_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
	if ($stat_number == 4) {///СПЕЕД
	  $speed =($row['speed']);
	  $speed = ($speed - ($speed/100*$procent));
	  $query_up = "update users set money='$money', habar='$habar', speed_w = '$speed' where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	  $query_up = "update things set  upgrade_speed = '$stat_up' where user_id = '$user_id' and thing_id='$thing_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
  }
}
else {
      if ($stat_number == 1) {///Если это СТАТ1
	  $query_up = "update users set money='$money', habar='$habar' where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	  $query_up = "update things set  upgrade_stat1 = '$stat_up' where user_id = '$user_id' and thing_id='$thing_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
	if ($stat_number == 2) {///СТАТ2
	  $query_up = "update users set money='$money', habar='$habar' where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	  $query_up = "update things set  upgrade_stat2 = '$stat_up' where user_id = '$user_id' and thing_id='$thing_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
	if ($stat_number == 3) {///СТАТ3
	  $query_up = "update users set money='$money', habar='$habar' where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	  $query_up = "update things set  upgrade_stat3 = '$stat_up' where user_id = '$user_id' and thing_id='$thing_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
	if ($stat_number == 4) {///СПЕЕД
	  $query_up = "update users set money='$money', habar='$habar' where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	  $query_up = "update things set  upgrade_speed = '$stat_up' where user_id = '$user_id' and thing_id='$thing_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
}


/////////////////////////////////////////////////
?>
  <script type="text/javascript">
  document.location.href = "upgrade.php?thing=<?php echo "$thing_id"?>&err=3";
  </script>
  <?php
/////////////////////////////////////////////////////
//////////////////////////////////////////////////////
mysqli_close($dbc);
?>

</body>
</html>