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
}
$type = $_GET['type'];
$thing_id = $_GET['thing'];
$money_type = $_GET['money'];
$user_id = $_SESSION['id'];
$query_c = "Select user_id from things where place=0 and user_id = '$user_id' limit 20";
$result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД1');
$count = mysqli_num_rows($result_c);
if ($count==20) {
  ?>
  <script type="text/javascript">
  document.location.href="bag.php?err=3";
  </script>
  <?php
  exit();
}
if ($money_type <> 1 and $money_type <> 2) {
  $money_type = 2;
}
$type = mysqli_real_escape_string($dbc, trim($type));
$thing_id = mysqli_real_escape_string($dbc, trim($thing_id));
if (empty($thing_id) or empty($type)) {
  ?>
  <script type="text/javascript">
  document.location.href = "salesman.php";
  </script>
  <?php
  exit();
}
if ($type == '4') {
  ?>
  <script type="text/javascript">
  document.location.href = "salesman.php";
  </script>
  <?php
  exit();
}
if ($type <> 1 and $type <> 2 and $type <> 3 and $type <> 4 and $type <> 5 and $type <> 6 and $type <> 7) {
  ?>
  <script type="text/javascript">
  document.location.href = "salesman.php";
  </script>
  <?php
  exit();
}
if ($type == 1) {
  $query_c = "Select * from clothes where clothes_id = '$thing_id' limit 1";
  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
  $row_cl = mysqli_fetch_array($result_c);
}
if ($type == 2) {
  $query_c = "Select * from pistols where pistols_id = '$thing_id' limit 1";
  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
  $row_cl = mysqli_fetch_array($result_c);
}
if ($type == 3) {
  $query_c = "Select * from weapons where weapons_id = '$thing_id' limit 1";
  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
  $row_cl = mysqli_fetch_array($result_c);
}
if ($type == 4) {
  $query_c = "Select * from helmets where helmet_id = '$thing_id' limit 1";
  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
  $row_cl = mysqli_fetch_array($result_c);
}
if ($type == 5) {
  $query_c = "Select * from ava where ava_id = '$thing_id' limit 1";
  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
  $row_cl = mysqli_fetch_array($result_c);
}
if ($type == 6) {
  $query_c = "Select * from art where art_id = '$thing_id' limit 1";
  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
  $row_cl = mysqli_fetch_array($result_c);
}
if ($type == 7) {
  $query_c = "Select * from detectors where dec_id = '$thing_id' limit 1";
  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
  $row_cl = mysqli_fetch_array($result_c);
}
if ($row_cl == 0) {
  ?>
  <script type="text/javascript">
  document.location.href = "salesman.php";
  </script>
  <?php
  exit();
}

  $query = "Select money, habar from users where id = '$user_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $row = mysqli_fetch_array($result);
  $money = $row['money'];
  $habar = $row['habar'];
  if ($money_type == 1) {
    if ($row_cl['price_hab'] < 0) {
	  $money_type = 2;
	} 
	else {
      $habar = ($habar - $row_cl['price_hab']);
    }
  }
  if ($money_type == 2) {
    if ($row_cl['price'] < 0) {
	?>
    <script type="text/javascript">
    document.location.href = "sale_thing.php?thing=<?php echo "$thing_id";?>&type=<?php echo "$type"?>";
    </script>
    <?php
    exit();
	}
	else {
    $money = ($money - $row_cl['price']);
	}
  }
  if ($money < 0 or $habar < 0) {
    ?>
    <script type="text/javascript">
    document.location.href = "sale_thing.php?thing=<?php echo "$thing_id";?>&type=<?php echo "$type"?>&err=1";
    </script>
    <?php
    exit();
  }
  $query_up = "update users set money='$money', habar='$habar' where id = '$user_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
  if ($type == 1) {
    $inf_id = $row_cl['clothes_id'];
    $stat1 = rand($row_cl['min_stats_hp'],$row_cl['max_stats_hp']);
	$stat2 = rand($row_cl['min_stats_bronya'],$row_cl['max_stats_bronya']);
	$stat3 = rand($row_cl['min_stats_razriv'],$row_cl['max_stats_razriv']);
	$speed = rand($row_cl['min_stats_rad'],$row_cl['max_stats_rad']);
  }
  if ($type == 2) {
    $inf_id = $row_cl['pistols_id'];
    $stat1 = rand($row_cl['min_stats_yron'],$row_cl['max_stats_yron']);
	$stat2 = rand($row_cl['min_stats_tochn'],$row_cl['max_stats_tochn']);
	$stat3 = rand($row_cl['min_stats_safety'],$row_cl['max_stats_safety']);
	$speed = $row_cl['speed'];
  }
  if ($type == 3) {
    $inf_id = $row_cl['weapons_id'];
    $stat1 = rand($row_cl['min_stats_yron'],$row_cl['max_stats_yron']);
	$stat2 = rand($row_cl['min_stats_tochn'],$row_cl['max_stats_tochn']);
	$stat3 = rand($row_cl['min_stats_safety'],$row_cl['max_stats_safety']);
	$speed = $row_cl['speed'];
  }
  if ($type == 4) {
    $inf_id = $row_cl['helmet_id'];
    $stat1 = rand($row_cl['min_stats_hp'],$row_cl['max_stats_hp']);
	$stat2 = rand($row_cl['min_stats_bronya'],$row_cl['max_stats_bronya']);
	$stat3 = rand($row_cl['min_stats_regen'],$row_cl['max_stats_regen']);
	$speed = rand($row_cl['min_stats_rad'],$row_cl['max_stats_rad']);
  }
  if ($type == 5) {
    $inf_id = $row_cl['ava_id'];
    $stat1 = rand($row_cl['min_stats_hp'],$row_cl['max_stats_hp']);
	$stat2 = rand($row_cl['min_stats_bronya'],$row_cl['max_stats_bronya']);
	$stat3 = rand($row_cl['min_stats_regen'],$row_cl['max_stats_regen']);
	$speed = $row_cl['speed'];
  }
  if ($type == 6) {
    $inf_id = $row_cl['art_id'];
    $stat1 = rand($row_cl['min_stats_hp'],$row_cl['max_stats_hp']);
	$stat2 = rand($row_cl['min_stats_bronya'],$row_cl['max_stats_bronya']);
	$stat3 = rand($row_cl['min_stats_regen'],$row_cl['max_stats_regen']);
	$speed = $row_cl['speed'];
  }
  if ($type == 7) {
    $inf_id = $row_cl['dec_id'];
    $stat1 = $row_cl['min_stats_yron'];
	$stat2 = $row_cl['max_stats_yron'];
	$stat3 = rand($row_cl['min_stats_safety'],$row_cl['max_stats_safety']);
	$speed = $row_cl['speed'];
  }
  $name = $row_cl['name'];
  $lvl_need = $row_cl['lvl_need'];
  $query = "insert into things (`user_id`, `type`,`inf_id`,`stat1`,`upgrade_stat1`, `stat2`, `upgrade_stat2`, `stat3`, `upgrade_stat3`, `speed`, `upgrade_speed`, `sost`, `privat`, `place`, `need_lvl`) values ('$user_id', '$type', '$inf_id', '$stat1' , '0', '$stat2', '0', '$stat3', '0', '$speed', '0', '8', '0', '0', '$lvl_need')";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $query = "select thing_id from things where user_id='$user_id' and type = '$type' and inf_id='$inf_id' and stat1='$stat1' and stat2='$stat2' and stat3='$stat3' and speed='$speed'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $row = mysqli_fetch_array($result);
  $thing_id = $row['thing_id'];
  ?>
  <script type="text/javascript">
    document.location.href = "thing.php?thing=<?php echo "$thing_id";?>&err=4";
    </script>
  <?php
mysqli_close($dbc);
?>

</body>
</html>