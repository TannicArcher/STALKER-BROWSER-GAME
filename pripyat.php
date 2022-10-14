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
$location = $_GET['location'];
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
$us_location = $row['location'];
if (empty($location)) {
    ?>
    <script type="text/javascript">
    document.location.href = "zona.php";
    </script>
    <?php
    exit();
}
else {
  if ($location <> 'pripyat1' and $location <> 'pripyat2' and $location <> 'pripyat3' and $location <> 'pripyat4' and $location <> 'pripyat5' and $location <> 'pripyat6' and $location <> 'pripyat7' and $location <> 'pripyat8' and $location <> 'pripyat9' and $location <> 'pripyat10') {
   ?>
    <script type="text/javascript">
    document.location.href = "zona.php";
    </script>
    <?php
    exit();
  }
  if ($us_location <> 'pripyat1' and $us_location <> 'pripyat2' and $us_location <> 'pripyat3' and $us_location <> 'pripyat4' and $us_location <> 'pripyat5' and $us_location <> 'pripyat6' and $us_location <> 'pripyat7' and $us_location <> 'pripyat8' and $us_location <> 'pripyat9' and $us_location <> 'pripyat10'  and $us_location <> 'index') {
    ?>
    <script type="text/javascript">
    document.location.href = "zona.php";
    </script>
    <?php
    exit();
  }
}
//////////////////////////////////////////////////////////////////////TELEPORT
if ($location == 'pripyat1') {
  if ($us_gruppa <> 'naemniki' and $us_location <> 'pripyat3') {
    $location = "$us_location";
  }
  if ($us_gruppa == 'naemniki' and $us_location <> 'pripyat3' and $us_location <> 'index') {
    $location = "$us_location";
  }
}
if ($location == 'pripyat2') {
  if ($us_gruppa <> 'svoboda' and $us_location <> 'pripyat4') {
    $location = "$us_location";
  }
  if ($us_gruppa == 'svoboda' and $us_location <> 'pripyat4' and $us_location <> 'index') {
    $location = "$us_location";
  }
}
if ($location == 'pripyat10') {
  if ($us_gruppa <> 'dolg' and $us_location <> 'pripyat9') {
    $location = "$us_location";
  }
  if ($us_gruppa == 'dolg' and $us_location <> 'pripyat9' and $us_location <> 'index') {
    $location = "$us_location";
  }
}
///////
if ($location == 'pripyat3') {
  if ($us_location <> 'pripyat1' and $us_location <> 'pripyat5') {
    $location = "$us_location";
  }
}
if ($location == 'pripyat4') {
  if ($us_location <> 'pripyat2' and $us_location <> 'pripyat6' and $us_location <> 'index') {
    $location = "$us_location";
  }
}
if ($location == 'pripyat5') {
  if ($us_location <> 'pripyat3' and $us_location <> 'pripyat6' and $us_location <> 'pripyat7' and $us_location <> 'pripyat8') {
    $location = "$us_location";
  }
}
if ($location == 'pripyat6') {
  if ($us_location <> 'pripyat5' and $us_location <> 'pripyat4' and $us_location <> 'pripyat8' and $us_location <> 'pripyat7') {
    $location = "$us_location";
  }
}
if ($location == 'pripyat7') {
  if ($us_location <> 'pripyat5' and $us_location <> 'pripyat6' and $us_location <> 'pripyat8') {
    $location = "$us_location";
  }
}
if ($location == 'pripyat8') {
  if ($us_location <> 'pripyat5' and $us_location <> 'pripyat6' and $us_location <> 'pripyat7' and $us_location <> 'pripyat9') {
    $location = "$us_location";
  }
}
if ($location == 'pripyat9') {
  if ($us_location <> 'pripyat10' and $us_location <> 'pripyat8') {
    $location = "$us_location";
  }
}


if ($location <> 'pripyat10' and $location <> 'pripyat9' and $location <> 'pripyat8' and $location <> 'pripyat7' and $location <> 'pripyat1' and $location <> 'pripyat2' and $location <> 'pripyat3' and $location <> 'pripyat4' and $location <> 'pripyat5' and $location <> 'pripyat6') {
?>
    <script type="text/javascript">
    document.location.href = "zona.php";
    </script>
    <?php
    exit();

}




//////////////////////////////////////////////////////////////////////
$query_loc = "select bp_gruppa from location where location_name = '$us_location' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД4');
$row_loc = mysqli_fetch_array($result_loc);
if ($row_loc['bp_gruppa'] <> $us_gruppa) {
  if ($us_gruppa == 'naemniki') {
    if ($location == 'pripyat3' and $us_location == 'pripyat1') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat5' and $us_location == 'pripyat3') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat6' and $us_location == 'pripyat5') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat7' and $us_location == 'pripyat5') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat8' and $us_location == 'pripyat5') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat8' and $us_location == 'pripyat6') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat6' and $us_location == 'pripyat8') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat4' and $us_location == 'pripyat6') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat2' and $us_location == 'pripyat4') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat9' and $us_location == 'pripyat8') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat10' and $us_location == 'pripyat9') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat6' and $us_location == 'pripyat7') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat8' and $us_location == 'pripyat7') {
	  $location = "$us_location";
      $err = 7;
	}
  }
  if ($us_gruppa == 'dolg') {
    if ($location == 'pripyat9' and $us_location == 'pripyat10') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat8' and $us_location == 'pripyat9') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat6' and $us_location == 'pripyat8') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat7' and $us_location == 'pripyat8') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat5' and $us_location == 'pripyat8') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat5' and $us_location == 'pripyat6') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat6' and $us_location == 'pripyat5') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat5' and $us_location == 'pripyat7') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat6' and $us_location == 'pripyat7') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat3' and $us_location == 'pripyat5') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat1' and $us_location == 'pripyat3') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat4' and $us_location == 'pripyat6') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat2' and $us_location == 'pripyat4') {
	  $location = "$us_location";
      $err = 7;
	}
  }
  if ($us_gruppa == 'svoboda') {/////////////////////////////////////////////////////
    if ($location == 'pripyat4' and $us_location == 'pripyat2') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat6' and $us_location == 'pripyat4') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat8' and $us_location == 'pripyat6') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat7' and $us_location == 'pripyat6') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat5' and $us_location == 'pripyat6') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat5' and $us_location == 'pripyat8') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat8' and $us_location == 'pripyat5') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat8' and $us_location == 'pripyat7') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat5' and $us_location == 'pripyat7') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat3' and $us_location == 'pripyat5') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat1' and $us_location == 'pripyat3') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat9' and $us_location == 'pripyat8') {
	  $location = "$us_location";
      $err = 7;
	}
	if ($location == 'pripyat10' and $us_location == 'pripyat9') {
	  $location = "$us_location";
      $err = 7;
	}
  }
} 
if ($location == 'index') {
    ?>
    <script type="text/javascript">
    document.location.href = "zona.php";
    </script>
    <?php
    exit();
}
  $location = mysqli_real_escape_string($dbc, trim($location));	
  $query_loc = "update users set location = '$location' where id = '$user_id' limit 1 ";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД3');

////////////////////////////////////////////Названия локаций
if ($location == 'pripyat1') { $page_title = 'ЧАЭС, Подход';}
if ($location == 'pripyat2') { $page_title = 'ЧАЭС, Мост через водохранилище';}
if ($location == 'pripyat3') { $page_title = 'ЧАЭС, Площадь';}
if ($location == 'pripyat4') { $page_title = 'ЧАЭС, Железная дорога';}
if ($location == 'pripyat5') { $page_title = 'ЧАЭС, Поезд';}
if ($location == 'pripyat6') { $page_title = 'ЧАЭС, Вход в 4 энергоблок';}
if ($location == 'pripyat7') { $page_title = 'ЧАЭС, Саркофаг';}
if ($location == 'pripyat8') { $page_title = 'ЧАЭС, Лабиринт';}
if ($location == 'pripyat9') { $page_title = 'ЧАЭС, Монолит';}
if ($location == 'pripyat10') { $page_title = 'ЧАЭС, Подход к бункеру "О-сознания"';}
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
$query_loc = "select count, lvl_need, lvl_to , count_now, bp_gruppa, bp_count, bp_count_now, bp_count_grouppa, radiation  from location where location_name = '$location' limit 1";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД4');
  $row_loc = mysqli_fetch_array($result_loc);
  $radiation_loc = $row_loc['radiation'];
  ?>
<div id="main">
<p class="podmenu"><?php 
if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
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
    document.location.href = "zona.php?err=6";
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
?>
<div class="stats">
<?php 
//////////////////////////////////////////////////111111111111111111111
if ($location == 'pripyat1') {
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat3' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/bottomright.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat3">Бежать на площадь</a></p>
<?php
}
////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////222222222222222222222222222222222
if ($location == 'pripyat2') {
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat4' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/bottomleft.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat4">Бежать к железной дороге</a></p>
<?php
}
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////333333333333333333333333333333333333
if ($location == 'pripyat3') {
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat1' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/topleft.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat1">Уйти с территории ЧАЭС</a></p>
<?php
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat5' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/bottomright.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat5">Бежать к поезду</a></p>
<?php

}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////4444444444444444444444444444444444
if ($location == 'pripyat4') {
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat2' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/topright.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat2">Бежать к мосту</a></p>
<?php
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat6' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/bottomleft.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat6">Бежать к входу в 4 энергоблок</a></p>
<?php
}
//////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////5555555555555555555555555555555555555555
if ($location == 'pripyat5') {
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat3' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/topleft.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat3">Бежать на площадь</a></p>
<?php
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat6' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/right.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat6">Бежать к входу в 4 энергоблок</a></p>
<?php
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat7' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/bottomright.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat7">Забежать в саркофаг</a></p>
<?php
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat8' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/bottom.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat8">Забежать в лабиринт</a></p>
<?php
}
///////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////666666666666666666666666666666666
if ($location == 'pripyat6') {
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat4' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/topright.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat4">Бежать к железной дороге</a></p>
<?php
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat5' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/left.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat5">Бежать к поезду</a></p>
<?php
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat7' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/bottomleft.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat7">Забежать в саркофаг</a></p>
<?php
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat8' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/bottom.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat8">Забежать в лабиринт</a></p>
<?php
}
///////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////7777777777777777777777777777777
if ($location == 'pripyat7') {
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat5' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/topleft.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat5">Бежать к поезду</a></p>
<?php
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat6' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/topright.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat6">Бежать к входу в 4 энергоблок</a></p>
<?php
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat8' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/bottom.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat8">Забежать в лабиринт</a></p>
<?php
}
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////888888888888888888888888888888888888
if ($location == 'pripyat8') {
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat5' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/topleft.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat5">Бежать к поезду</a></p>
<?php
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat7' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/top.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat7">Забежать в саркофаг</a></p>
<?php
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat6' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/topright.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat6">Бежать к входу 4 энергоблок</a></p>
<?php
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat9' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/bottom.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat9">Бежать к Монолиту</a></p>
<?php
}
///////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////999999999999999999999999999
if ($location == 'pripyat9') {
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat8' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/top.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat8">Забежать в лабиринт</a></p>
<?php
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat10' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/bottom.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat10">Бежать в комнату О-сознания</a></p>
<?php
}
////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////10101010101010101010101010101010
if ($location == 'pripyat10') {
$query_loc = "Select bp_gruppa from location where location_name = 'pripyat9' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$row_loc = mysqli_fetch_array($result_loc);
?>
<p><img src="img/ico/top.png" width="12" height="12"/> <?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?>  <a href="pripyat.php?location=pripyat9">Бежать к Монолиту</a></p>
<?php
}
////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
if ($us_gruppa == 'naemniki' and $location == 'pripyat1') {
?><p><img src="img/ico/out.png" width="12" height="12"/> <img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/> <a href="zona.php">Покинуть локацию</a></p><?php
}
if ($us_gruppa == 'dolg' and $location == 'pripyat10') {
?><p><img src="img/ico/out.png" width="12" height="12"/> <img src="img/ico/dolgon.png" width="12" height="12" alt="o"/> <a href="zona.php">Покинуть локацию</a></p><?php
}
if ($us_gruppa == 'svoboda' and $location == 'pripyat2') {
?><p><img src="img/ico/out.png" width="12" height="12"/> <img src="img/ico/svobodaon.png" width="12" height="12" alt="o"/> <a href="zona.php">Покинуть локацию</a></p><?php
}
if ($us_gruppa == 'mon' and $location == 'pripyat4') {
?><p><img src="img/ico/out.png" width="12" height="12"/> <img src="img/ico/monolit.png" width="12" height="12" alt="o"/> <a href="zona.php">Покинуть локацию</a></p><?php
}

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