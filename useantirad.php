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
$query = "Select antirad, location from users where id = '$user_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$antirad = $row['antirad'];
$location_user = $row['location'];
if ($antirad <> 0) {
  $antirad = ($antirad - 1);
  $query = "update users set antirad_time = NOW(), antirad = '$antirad'  where id = '$user_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $query_log = "insert into log (`time`, `user_id`, `sboitie`, `thing` , `yron`) values (NOW(), '$user_id', 9 , '0', '0')";
  $result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД');
  ///////////////////////////////////////////Вылечели и телепортируем
  if ($location_user == 'secret') {
	?>
	<script type="text/javascript">
   document.location.href = "secret.php";
    </script>
  <?php
  }
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
  /////////////////////////////////////////////////
}
else {
  ?>
  <script type="text/javascript">
  document.location.href="<?php echo "$H" ?>";
  </script>
  <?php
}
exit();
mysqli_close($dbc);
?>