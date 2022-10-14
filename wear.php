<?php
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
$H=getenv("HTTP_REFERER");
if (empty($H)) {
?>
<script type="text/javascript">
  document.location.href = "index.php";
</script>
<?php
exit();
}
$user_id = $_SESSION['id'];
$thing_id = $_GET['thing'];
$query = "Select lvl, clan from users where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$clan = $row['clan'];
$querywar = "Select war from clans where clan_id = '$clan' limit 1";
$resultwar = mysqli_query($dbc, $querywar) or die ('Ошибка передачи запроса к БД');
$rowwar = mysqli_fetch_array($resultwar);
$war = $rowwar['war'];
$query_c = "Select type,stat1,upgrade_stat1,stat2,upgrade_stat2,stat3,upgrade_stat3,speed,upgrade_speed,sost,privat,need_lvl from things where place=0 and thing_id = '$thing_id' and user_id='$user_id' limit 1";
$result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
$count = mysqli_num_rows($result_c);
$row_c = mysqli_fetch_array($result_c);
$type = $row_c['type'];
$stat1 = $row_c['stat1'];
$stat2 = $row_c['stat2'];
$stat3 = $row_c['stat3'];
$sost = $row_c['sost'];
$bonus = $row_c['bonus'];
$speed = $row_c['speed'];
if ($count==0) {
?>
<script type="text/javascript">
document.location.href="<?php echo "$H" ?>";
</script>
<?php
exit();
}
if ($row['lvl']< $row_c['need_lvl']) {
?>
<script type="text/javascript">
  document.location.href = "bag.php?err=2";
</script>
<?php
exit();
}
//////////////////Знаем, что шмотка есть и она в рюкзаке
if ($type == 1) {
    $query = "select bronya from users where id = '$user_id' limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	$row = mysqli_fetch_array($result);
	$isset = $row['bronya'];
}
if ($type == 2) {
    $query = "select yron_p from users where id = '$user_id' limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	$row = mysqli_fetch_array($result);
	$isset = $row['yron_p'];
}
if ($type == 3) {
    $query = "select yron_w from users where id = '$user_id' limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	$row = mysqli_fetch_array($result);
	$isset = $row['yron_w'];
}
if ($type == 4) {
    $query = "select regen from users where id = '$user_id' limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	$row = mysqli_fetch_array($result);
	$isset = $row['regen'];
}
if ($type == 5) {
    $query = "select avatar from users where id = '$user_id' limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	$row = mysqli_fetch_array($result);
	$isset = $row['avatar'];
}
if ($type == 6) {
    $query = "select regen from users where id = '$user_id' limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	$row = mysqli_fetch_array($result);
	$isset = $row['regen'];
}
if ($type == 7) {
    $query = "select thing_id from things where user_id = '$user_id' and place='2' limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	$row = mysqli_fetch_array($result);
	$isset = $row['thing_id'];
}
///////////////////Проверили одета ли шмотка на человеке
if (!empty($isset)) {//Если одета, то снимаем старую
  $query = "Update things set place = '0' where user_id = '$user_id' and place=2 and type='$type' limit 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
$query = "Update things set place = '2', privat = 1 where place = 0 and user_id = '$user_id' and thing_id = '$thing_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
//////////////////////////////////////Одежду одели, обновляем статы.
if ($type == 1) {
  //////////////Статы апаем
  if ($row_c['upgrade_stat1'] <> 0) {
    if ($row_c['upgrade_stat1'] == 4) {$procent = 75;}
    if ($row_c['upgrade_stat1'] == 3) {$procent = 50;}
    if ($row_c['upgrade_stat1'] == 2) {$procent = 25;}
    if ($row_c['upgrade_stat1'] == 1) {$procent = 15;}
    $stat1 = ($stat1 + ($stat1/100*$procent));
  }
  if ($row_c['upgrade_stat2'] <> 0) {
    if ($row_c['upgrade_stat2'] == 4) {$procent = 75;}
    if ($row_c['upgrade_stat2'] == 3) {$procent = 50;}
    if ($row_c['upgrade_stat2'] == 2) {$procent = 25;}
    if ($row_c['upgrade_stat2'] == 1) {$procent = 15;}
    $stat2 = ($stat2 + ($stat2/100*$procent));
  }
  if ($row_c['upgrade_stat3'] <> 0) {
    if ($row_c['upgrade_stat3'] == 4) {$procent = 75;}
    if ($row_c['upgrade_stat3'] == 3) {$procent = 50;}
    if ($row_c['upgrade_stat3'] == 2) {$procent = 25;}
    if ($row_c['upgrade_stat3'] == 1) {$procent = 15;}
    $stat3 = ($stat3 + ($stat3/100*$procent));
  }
  if ($row_c['upgrade_speed'] <> 0) {
    if ($row_c['upgrade_speed'] == 4) {$procent = 75;}
    if ($row_c['upgrade_speed'] == 3) {$procent = 50;}
    if ($row_c['upgrade_speed'] == 2) {$procent = 25;}
    if ($row_c['upgrade_speed'] == 1) {$procent = 15;}
    $speed = ($speed + ($speed/100*$procent));
  }
  /////////////////////////
  $query = "Update users set max_hp = '$stat1', bronya = '$stat2', razriv_cl = '$stat3', sost_cl='$sost', radiation = '$speed' where id = '$user_id' limit 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
if ($type == 2) {
    //////////////Статы апаем
  if ($row_c['upgrade_stat1'] <> 0) {
    if ($row_c['upgrade_stat1'] == 4) {$procent = 75;}
    if ($row_c['upgrade_stat1'] == 3) {$procent = 50;}
    if ($row_c['upgrade_stat1'] == 2) {$procent = 25;}
    if ($row_c['upgrade_stat1'] == 1) {$procent = 15;}
    $stat1 = ($stat1 + ($stat1/100*$procent));
  }
  if ($row_c['upgrade_stat2'] <> 0) {
    if ($row_c['upgrade_stat2'] == 4) {$procent = 75;}
    if ($row_c['upgrade_stat2'] == 3) {$procent = 50;}
    if ($row_c['upgrade_stat2'] == 2) {$procent = 25;}
    if ($row_c['upgrade_stat2'] == 1) {$procent = 15;}
    $stat2 = ($stat2 + ($stat2/100*$procent));
  }
  if ($row_c['upgrade_stat3'] <> 0) {
    if ($row_c['upgrade_stat3'] == 4) {$procent = 75;}
    if ($row_c['upgrade_stat3'] == 3) {$procent = 50;}
    if ($row_c['upgrade_stat3'] == 2) {$procent = 25;}
    if ($row_c['upgrade_stat3'] == 1) {$procent = 15;}
    $stat3 = ($stat3 + ($stat3/100*$procent));
  }
  if ($row_c['upgrade_speed'] <> 0) {
    if ($row_c['upgrade_speed'] == 4) {$procent = 75;}
    if ($row_c['upgrade_speed'] == 3) {$procent = 50;}
    if ($row_c['upgrade_speed'] == 2) {$procent = 25;}
    if ($row_c['upgrade_speed'] == 1) {$procent = 15;}
    $speed = ($speed - $row_c['upgrade_speed']);
  }
  if ($stat3 > 100) {
	    $stat3 = 100;
  }
  /////////////////////////
  $query = "Update users set tochn_p = '$stat2', yron_p = '$stat1', sost_p = '$sost', speed_p = '$speed', safety_p = '$stat3' where id = '$user_id' limit 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
if ($type == 3) {
    //////////////Статы апаем
  if ($row_c['upgrade_stat1'] <> 0) {
    if ($row_c['upgrade_stat1'] == 4) {$procent = 75;}
    if ($row_c['upgrade_stat1'] == 3) {$procent = 50;}
    if ($row_c['upgrade_stat1'] == 2) {$procent = 25;}
    if ($row_c['upgrade_stat1'] == 1) {$procent = 15;}
    $stat1 = ($stat1 + ($stat1/100*$procent));
  }
  if ($row_c['upgrade_stat2'] <> 0) {
    if ($row_c['upgrade_stat2'] == 4) {$procent = 75;}
    if ($row_c['upgrade_stat2'] == 3) {$procent = 50;}
    if ($row_c['upgrade_stat2'] == 2) {$procent = 25;}
    if ($row_c['upgrade_stat2'] == 1) {$procent = 15;}
    $stat2 = ($stat2 + ($stat2/100*$procent));
  }
  if ($row_c['upgrade_stat3'] <> 0) {
    if ($row_c['upgrade_stat3'] == 4) {$procent = 75;}
    if ($row_c['upgrade_stat3'] == 3) {$procent = 50;}
    if ($row_c['upgrade_stat3'] == 2) {$procent = 25;}
    if ($row_c['upgrade_stat3'] == 1) {$procent = 15;}
    $stat3 = ($stat3 + ($stat3/100*$procent));
  }
  if ($row_c['upgrade_speed'] <> 0) {
    if ($row_c['upgrade_speed'] == 4) {$procent = 75;}
    if ($row_c['upgrade_speed'] == 3) {$procent = 50;}
    if ($row_c['upgrade_speed'] == 2) {$procent = 25;}
    if ($row_c['upgrade_speed'] == 1) {$procent = 15;}
    $speed = ($speed - ($speed/100*$procent));
  }
  if ($stat3 > 100) {
    $stat3 = 100;
  }
  /////////////////////////
  $query = "Update users set tochn_w = '$stat2', yron_w = '$stat1', sost_w = '$sost', speed_w = '$speed', safety_w = '$stat3' where id = '$user_id' limit 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
if ($type == 4) {
  //////////////Статы апаем
  if ($row_c['upgrade_stat1'] <> 0) {
    if ($row_c['upgrade_stat1'] == 4) {$procent = 75;}
    if ($row_c['upgrade_stat1'] == 3) {$procent = 50;}
    if ($row_c['upgrade_stat1'] == 2) {$procent = 25;}
    if ($row_c['upgrade_stat1'] == 1) {$procent = 15;}
    $stat1 = ($stat1 + ($stat1/100*$procent));
  }
  if ($row_c['upgrade_stat2'] <> 0) {
    if ($row_c['upgrade_stat2'] == 4) {$procent = 75;}
    if ($row_c['upgrade_stat2'] == 3) {$procent = 50;}
    if ($row_c['upgrade_stat2'] == 2) {$procent = 25;}
    if ($row_c['upgrade_stat2'] == 1) {$procent = 15;}
    $stat2 = ($stat2 + ($stat2/100*$procent));
  }
  if ($row_c['upgrade_stat3'] <> 0) {
    if ($row_c['upgrade_stat3'] == 4) {$procent = 75;}
    if ($row_c['upgrade_stat3'] == 3) {$procent = 50;}
    if ($row_c['upgrade_stat3'] == 2) {$procent = 25;}
    if ($row_c['upgrade_stat3'] == 1) {$procent = 15;}
    $stat3 = ($stat3 + ($stat3/100*$procent));
  }
  if ($row_c['upgrade_speed'] <> 0) {
    if ($row_c['upgrade_speed'] == 4) {$procent = 75;}
    if ($row_c['upgrade_speed'] == 3) {$procent = 50;}
    if ($row_c['upgrade_speed'] == 2) {$procent = 25;}
    if ($row_c['upgrade_speed'] == 1) {$procent = 15;}
    $speed = ($speed + ($speed/100*$procent));
  }
  /////////////////////////
  $query = "Update users set regen = regen where id = '$user_id' limit 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
if ($type == 5) {
  //////////////Статы апаем
  if ($row_c['upgrade_stat1'] <> 0) {
    if ($row_c['upgrade_stat1'] == 4) {$procent = 75;}
    if ($row_c['upgrade_stat1'] == 3) {$procent = 50;}
    if ($row_c['upgrade_stat1'] == 2) {$procent = 25;}
    if ($row_c['upgrade_stat1'] == 1) {$procent = 15;}
    $stat1 = ($stat1 + ($stat1/100*$procent));
  }
  if ($row_c['upgrade_stat2'] <> 0) {
    if ($row_c['upgrade_stat2'] == 4) {$procent = 75;}
    if ($row_c['upgrade_stat2'] == 3) {$procent = 50;}
    if ($row_c['upgrade_stat2'] == 2) {$procent = 25;}
    if ($row_c['upgrade_stat2'] == 1) {$procent = 15;}
    $stat2 = ($stat2 + ($stat2/100*$procent));
  }
  if ($row_c['upgrade_stat3'] <> 0) {
    if ($row_c['upgrade_stat3'] == 4) {$procent = 75;}
    if ($row_c['upgrade_stat3'] == 3) {$procent = 50;}
    if ($row_c['upgrade_stat3'] == 2) {$procent = 25;}
    if ($row_c['upgrade_stat3'] == 1) {$procent = 15;}
    $stat3 = ($stat3 + ($stat3/100*$procent));
  }
  if ($row_c['upgrade_speed'] <> 0) {
    if ($row_c['upgrade_speed'] == 4) {$procent = 75;}
    if ($row_c['upgrade_speed'] == 3) {$procent = 50;}
    if ($row_c['upgrade_speed'] == 2) {$procent = 25;}
    if ($row_c['upgrade_speed'] == 1) {$procent = 15;}
    $speed = ($speed + ($speed/100*$procent));
  }
  /////////////////////////
  $query = "Update users set avatar = '$speed' where id = '$user_id' limit 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
if ($type == 6) {
  //////////////Статы апаем
  if ($row_c['upgrade_stat1'] <> 0) {
    if ($row_c['upgrade_stat1'] == 4) {$procent = 75;}
    if ($row_c['upgrade_stat1'] == 3) {$procent = 50;}
    if ($row_c['upgrade_stat1'] == 2) {$procent = 25;}
    if ($row_c['upgrade_stat1'] == 1) {$procent = 15;}
    $stat1 = ($stat1 + ($stat1/100*$procent));
  }
  if ($row_c['upgrade_stat2'] <> 0) {
    if ($row_c['upgrade_stat2'] == 4) {$procent = 75;}
    if ($row_c['upgrade_stat2'] == 3) {$procent = 50;}
    if ($row_c['upgrade_stat2'] == 2) {$procent = 25;}
    if ($row_c['upgrade_stat2'] == 1) {$procent = 15;}
    $stat2 = ($stat2 + ($stat2/100*$procent));
  }
  if ($row_c['upgrade_stat3'] <> 0) {
    if ($row_c['upgrade_stat3'] == 4) {$procent = 75;}
    if ($row_c['upgrade_stat3'] == 3) {$procent = 50;}
    if ($row_c['upgrade_stat3'] == 2) {$procent = 25;}
    if ($row_c['upgrade_stat3'] == 1) {$procent = 15;}
    $stat3 = ($stat3 + ($stat3/100*$procent));
  }
  if ($row_c['upgrade_speed'] <> 0) {
    if ($row_c['upgrade_speed'] == 4) {$procent = 75;}
    if ($row_c['upgrade_speed'] == 3) {$procent = 50;}
    if ($row_c['upgrade_speed'] == 2) {$procent = 25;}
    if ($row_c['upgrade_speed'] == 1) {$procent = 15;}
    $speed = ($speed + ($speed/100*$procent));
  }
  /////////////////////////
  $query = "Update users set regen = '$speed' where id = '$user_id' limit 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
?>

<script type="text/javascript">
document.location.href="<?php echo "$H" ?>";
</script>
<?php

mysqli_close($dbc);
?>